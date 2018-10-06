import graphene
from graphene import ObjectType, Mutation, InputObjectType
from graphene_django.types import DjangoObjectType
from graphene_django.converter import convert_django_field
from graphql import GraphQLError
import django.utils.timezone
import phonenumber_field.modelfields
from django.core.exceptions import ValidationError
import datetime
from django.utils import timezone
from django.core import mail
import pytz
import buy_and_sell.schema
import unlocking.schema
import requests
import os
from . import models
from . import forms

WORLDPAY_API_KEY = os.getenv("WORLDPAY_SERVER_KEY", "")


@convert_django_field.register(phonenumber_field.modelfields.PhoneNumberField)
def convert_phone_number_to_string(field, registry=None):
    return graphene.NonNull(graphene.String)


class SiteConfigType(DjangoObjectType):
    class Meta:
        model = models.SiteConfig

    def resolve_landline(self, info):
        return self.landline.as_national

    def resolve_mobile(self, info):
        return self.mobile.as_national


class MainSliderSlideType(DjangoObjectType):
    colour = graphene.NonNull(graphene.Int)

    class Meta:
        model = models.MainSliderSlide

    def resolve_image(self, info):
        return self.image.url

    def resolve_background_image(self, info):
        return self.background_image.url


class SellingPointType(DjangoObjectType):
    class Meta:
        model = models.SellingPoint

    def resolve_image(self, info):
        return self.image.url


class OtherServiceType(DjangoObjectType):
    colour = graphene.NonNull(graphene.Int)

    class Meta:
        model = models.OtherService

    def resolve_icon(self, info):
        return self.icon.url


class RepairTypeType(DjangoObjectType):
    class Meta:
        model = models.RepairType


class DeviceTypeType(DjangoObjectType):
    repair_types = graphene.List(RepairTypeType)

    class Meta:
        model = models.DeviceType

    def resolve_repair_types(self, info):
        return self.repair_types.all()


class DeviceCategoryType(DjangoObjectType):
    colour = graphene.NonNull(graphene.Int)
    device_types = graphene.List(DeviceTypeType)

    class Meta:
        model = models.DeviceCategory

    def resolve_icon(self, info):
        return self.icon.url

    def resolve_device_types(self, info):
        return self.device_types.all()


class Customer(DjangoObjectType):
    class Meta:
        model = models.Customer

    def resolve_phone(self, info):
        return self.phone.as_national


class PostalOrder(DjangoObjectType):
    customer = graphene.NonNull(Customer)

    class Meta:
        model = models.PostalOrder


class Appointment(DjangoObjectType):
    customer = graphene.NonNull(Customer)

    class Meta:
        model = models.Appointment


class OrderItem(DjangoObjectType):
    class Meta:
        model = models.OrderItem


class Order(DjangoObjectType):
    items = graphene.NonNull(graphene.List(graphene.NonNull(OrderItem)))

    class Meta:
        model = models.Order


class CartItemSpec(ObjectType):
    name = graphene.NonNull(graphene.String)
    value = graphene.NonNull(graphene.String)


class CartItemDelivery(ObjectType):
    id = graphene.NonNull(graphene.ID)
    name = graphene.NonNull(graphene.String)
    price = graphene.NonNull(graphene.Float)


class CartItem(ObjectType):
    name = graphene.NonNull(graphene.String)
    price = graphene.NonNull(graphene.Float)
    image = graphene.NonNull(graphene.String)
    quantity_available = graphene.NonNull(graphene.Int)
    specs = graphene.List(CartItemSpec)
    deliveries = graphene.List(CartItemDelivery)


class AppointmentTime(ObjectType):
    time = graphene.NonNull(graphene.types.datetime.Time)
    booked = graphene.NonNull(graphene.Boolean)


class FormError(ObjectType):
    field = graphene.NonNull(graphene.String)
    errors = graphene.List(
        graphene.String,
        required=True
    )


def validation_error_to_graphene(error):
    return map(lambda item: FormError(field=item[0], errors=item[1]), error)


def form_error_to_graphene(error: dict):
    return map(lambda item: FormError(field=item[0], errors=item[1]), error.items())


class CreatePostalOrder(Mutation):
    class Arguments:
        name = graphene.String(required=True)
        email = graphene.String(required=True)
        phone = graphene.String(required=True)
        address = graphene.String(required=True)
        additional_items = graphene.String(required=True)
        device = graphene.ID(required=True)
        repair = graphene.ID(required=True)

    ok = graphene.NonNull(graphene.Boolean)
    errors = graphene.List(FormError)
    order = graphene.Field(PostalOrder)

    def mutate(self, info, name, email, phone, address, additional_items, device, repair):
        try:
            device = models.DeviceType.objects.get(id=device)
        except models.DeviceType.DoesNotExist:
            return CreatePostalOrder(ok=False, errors=validation_error_to_graphene([("device", ["Invalid device"])]))

        try:
            repair = models.RepairType.objects.get(id=repair, device_type_id=device)
        except models.RepairType.DoesNotExist:
            return CreatePostalOrder(ok=False, errors=validation_error_to_graphene([("repair", ["Invalid repair"])]))

        order = models.PostalOrder()

        matching_customers = models.Customer.objects.filter(email=email)
        if len(matching_customers) > 0:
            customer = matching_customers.first()
        else:
            customer = models.Customer()
            customer.email = email
        customer.name = name
        customer.phone = phone
        customer.address = address

        try:
            customer.full_clean()
        except ValidationError as e:
            return CreatePostalOrder(ok=False, errors=validation_error_to_graphene(e))
        customer.save()
        order.customer = customer

        order.date = django.utils.timezone.now()
        order.device = device
        order.repair = repair
        order.additional_items = additional_items

        order.save()

        return CreatePostalOrder(ok=True, order=order)


class CreateAppointment(Mutation):
    class Arguments:
        name = graphene.String(required=True)
        email = graphene.String(required=True)
        phone = graphene.String(required=True)
        date = graphene.Date(required=True)
        time = graphene.Time(required=True)
        device = graphene.ID(required=True)
        repair = graphene.ID(required=True)

    ok = graphene.NonNull(graphene.Boolean)
    errors = graphene.List(FormError)
    appointment = graphene.Field(Appointment)

    def mutate(self, info, name, email, phone, date, time, device, repair):
        if not check_booking_time(date, time):
            return CreatePostalOrder(ok=False, errors=validation_error_to_graphene([("time", ["Invalid time"])]))

        try:
            device = models.DeviceType.objects.get(id=device)
        except models.DeviceType.DoesNotExist:
            return CreatePostalOrder(ok=False, errors=validation_error_to_graphene([("device", ["Invalid device"])]))

        try:
            repair = models.RepairType.objects.get(id=repair, device_type_id=device)
        except models.RepairType.DoesNotExist:
            return CreatePostalOrder(ok=False, errors=validation_error_to_graphene([("repair", ["Invalid repair"])]))

        appointment = models.Appointment()

        matching_customers = models.Customer.objects.filter(email=email)
        if len(matching_customers) > 0:
            customer = matching_customers.first()
        else:
            customer = models.Customer()
            customer.email = email
        customer.name = name
        customer.phone = phone

        try:
            customer.full_clean()
        except ValidationError as e:
            return CreatePostalOrder(ok=False, errors=validation_error_to_graphene(e))
        customer.save()
        appointment.customer = customer

        appointment.date = datetime.datetime.combine(date, time)
        appointment.device = device
        appointment.repair = repair

        appointment.save()

        return CreateAppointment(ok=True, appointment=appointment)


class OrderItemInput(InputObjectType):
    type = graphene.ID(required=True)
    id = graphene.ID(required=True)
    quantity = graphene.Int(required=True)
    delivery = graphene.ID(required=True)


def get_client_ip(request):
    x_forwarded_for = request.META.get('HTTP_X_FORWARDED_FOR')
    if x_forwarded_for:
        ip = x_forwarded_for.split(',')[0]
    else:
        ip = request.META.get('REMOTE_ADDR')
    return ip


class CreateOrder(Mutation):
    class Arguments:
        name = graphene.String(required=True)
        name_on_card = graphene.String(required=True)
        email = graphene.String(required=True)
        phone = graphene.String(required=True)
        address = graphene.String(required=True)
        card_token = graphene.String(required=True)
        items = graphene.List(graphene.NonNull(OrderItemInput), required=True)

    ok = graphene.NonNull(graphene.Boolean)
    errors = graphene.List(FormError)
    order = graphene.Field(Order)

    def mutate(self, info, name, name_on_card, email, phone, address, card_token, items):
        for item in items:
            if item.type == "buy_and_sell":
                validation = buy_and_sell.schema.validate_item(item.id, item.delivery, item.quantity)
                if validation is not None:
                    return CreateOrder(ok=False, errors=validation_error_to_graphene(validation))
            if item.type == "unlocking":
                validation = unlocking.schema.validate_item(item.id, item.delivery, item.quantity)
                if validation is not None:
                    return CreateOrder(ok=False, errors=validation_error_to_graphene(validation))
            else:
                return CreateOrder(ok=False, errors=validation_error_to_graphene([("type", ["Invalid item type"])]))

        matching_customers = models.Customer.objects.filter(email=email)
        if len(matching_customers) > 0:
            customer = matching_customers.first()
        else:
            customer = models.Customer()
            customer.email = email
        customer.name = name
        customer.phone = phone
        customer.address = address

        try:
            customer.full_clean()
        except ValidationError as e:
            return CreateOrder(ok=False, errors=validation_error_to_graphene(e))
        customer.save()

        total_price = 0
        description_items = []
        for item in items:
            if item.type == "buy_and_sell":
                total_price += buy_and_sell.schema.calculate_price(item.id, item.delivery, item.quantity)
                description_items.append(
                    buy_and_sell.schema.make_item_description(item.id, item.delivery, item.quantity))
            if item.type == "unlocking":
                total_price += unlocking.schema.calculate_price(item.id, item.delivery, item.quantity)
                description_items.append(
                    unlocking.schema.make_item_description(item.id, item.delivery, item.quantity))

        description = "; ".join(description_items)

        card_resp = requests.post("https://api.worldpay.com/v1/orders", headers={
            "Authorization": WORLDPAY_API_KEY,
        }, json={
            "token": card_token,
            "orderType": "ECOM",
            "amount": int(total_price * 100),
            "currencyCode": "GBP",
            "settlementCurrency": "GBP",
            "orderDescription": description,
            "name": name_on_card,
            "shopperEmailAddress": email,
            "shopperIdAddress": get_client_ip(info.context),
            "shopperUserAgent": info.context.META.get("HTTP_USER_AGENT"),
            "shopperAcceptHeader": info.context.META.get('HTTP_ACCEPT'),
        })
        resp_data = card_resp.json()

        if card_resp.status_code != requests.codes.ok:
            error = resp_data["message"] + ": " + resp_data["description"]
            return CreateOrder(ok=False, errors=validation_error_to_graphene([("card", [error])]))

        if resp_data["paymentStatus"] != "SUCCESS":
            return CreateOrder(
                ok=False,
                errors=validation_error_to_graphene(
                    [("card", [f"Card error, reason: {resp_data['paymentStatusReason']}"])]
                )
            )

        order = models.Order()
        order.customer = customer
        order.card_token = card_token
        order.name_on_card = name_on_card
        order.worldpay_order_id = resp_data["orderCode"]
        order.save()

        for item in items:
            if item.type == "buy_and_sell":
                buy_and_sell.schema.place_order(item.id, item.delivery, item.quantity)
            order_item = models.OrderItem()
            order_item.order = order
            order_item.type = item.type
            order_item.item_id = item.id
            order_item.delivery = item.delivery
            order_item.quantity = item.quantity
            order_item.save()

        site_config = models.SiteConfig.objects.first()

        cart_message = "\r\n".join(description_items)
        message = f"Name: {name}\r\n" \
                  f"Email: {email}\r\n" \
                  f"Phone: {phone}\r\n" \
                  f"Address:\r\n{address}\r\n\r\n" \
                  "---\r\n\r\n" \
                  "Cart contents" \
                  f"{cart_message}"

        email_message = mail.EmailMessage(
            f"New order placed {order.uid}",
            message,
            site_config.email,
            [site_config.email],
            reply_to=[email],
        )
        email_message.send()

        return CreateOrder(ok=True, order=order)


class ContactForm(Mutation):
    class Arguments:
        name = graphene.String(required=True)
        email = graphene.String(required=True)
        phone = graphene.String(required=True)
        message = graphene.String(required=True)

    ok = graphene.NonNull(graphene.Boolean)
    errors = graphene.List(FormError)

    def mutate(self, info, name, email, phone, message):
        contact_form = forms.ContactForm({
            'name': name,
            'email': email,
            'phone': phone,
            'message': message
        })

        if not contact_form.is_valid():
            return ContactForm(ok=False, errors=form_error_to_graphene(contact_form.errors))

        name = contact_form.cleaned_data["name"]
        email = contact_form.cleaned_data["email"]
        phone = contact_form.cleaned_data["phone"]
        message = contact_form.cleaned_data["message"]

        matching_customers = models.Customer.objects.filter(email=email)
        if len(matching_customers) > 0:
            customer = matching_customers.first()
        else:
            customer = models.Customer()
            customer.email = email
        customer.name = name
        customer.phone = phone

        try:
            customer.full_clean()
        except ValidationError as e:
            return CreateOrder(ok=False, errors=validation_error_to_graphene(e))
        customer.save()

        site_config = models.SiteConfig.objects.first()

        email_message = mail.EmailMessage(
            f"Sell form message from {name}",
            f"Name: {name}\r\nEmail: {email}\r\nPhone: {phone}\r\n\r\n---\r\n\r\n{message}",
            site_config.email,
            [site_config.email],
            reply_to=[email],
        )
        email_message.send()

        return ContactForm(ok=True)


def check_booking_time(date: datetime.date, time: datetime.time):
    tz = pytz.timezone("Europe/London")
    rules = models.AppointmentTimeRule.objects.all()
    now = datetime.datetime.now()

    cur_time = datetime.datetime.combine(date, time)
    appointments = models.Appointment.objects.filter(date__year=date.year, date__month=date.month, date__day=date.day)
    time_block_rules = models.AppointmentTimeBlockRule.objects.filter(date=date)
    passes_rules = False
    booked = True
    for rule in rules:
        if rule.start_date > cur_time.date():
            continue
        if not rule.recurring and rule.end_date < cur_time.date():
            continue

        if not rule.monday and cur_time.weekday() == 0:
            continue
        if not rule.tuesday and cur_time.weekday() == 1:
            continue
        if not rule.wednesday and cur_time.weekday() == 2:
            continue
        if not rule.thursday and cur_time.weekday() == 3:
            continue
        if not rule.friday and cur_time.weekday() == 4:
            continue
        if not rule.saturday and cur_time.weekday() == 5:
            continue
        if not rule.sunday and cur_time.weekday() == 6:
            continue

        start_time = timezone.make_naive(timezone.make_aware(
            datetime.datetime.combine(date, rule.start_time), tz)
                                         .astimezone(pytz.utc))
        end_time = timezone.make_naive(timezone.make_aware(
            datetime.datetime.combine(date, rule.end_time), tz)
                                       .astimezone(pytz.utc))
        if not (start_time <= cur_time and end_time >= (cur_time + datetime.timedelta(hours=1))):
            continue

        if cur_time.date() < now.date():
            continue

        passes_rules = True

        if cur_time < now:
            continue

        blocked = False
        for rule in time_block_rules:
            start_time = timezone.make_naive(timezone.make_aware(
                datetime.datetime.combine(date, rule.start_time), tz)
                                             .astimezone(pytz.utc))
            end_time = timezone.make_naive(timezone.make_aware(
                datetime.datetime.combine(date, rule.end_time), tz)
                                           .astimezone(pytz.utc))
            slot_end = cur_time + datetime.timedelta(hours=1)
            if start_time < slot_end and end_time > cur_time:
                blocked = True
                break

        if blocked:
            continue

        num_appointments = 0
        for appointment in appointments:
            date = timezone.make_naive(appointment.date)
            slot_end = cur_time + datetime.timedelta(hours=1)
            appointment_end = date + datetime.timedelta(hours=1)
            if date < slot_end and appointment_end > cur_time:
                num_appointments += 1

        if num_appointments >= 5:
            continue

        booked = False

    return passes_rules, booked


def get_booking_times(date: datetime.date):
    times = []
    cur_time = datetime.datetime.combine(date, datetime.datetime.min.time())
    while cur_time.time() <= datetime.time(23) and cur_time.date() == date:
        passes_rules, booked = check_booking_time(cur_time.date(), cur_time.time())
        if passes_rules:
            times.append(AppointmentTime(time=cur_time.time(), booked=booked))
            cur_time += datetime.timedelta(minutes=30)

        cur_time += datetime.timedelta(minutes=30)

    return times


class Query:
    site_config = graphene.NonNull(SiteConfigType)

    main_slider_slides = graphene.NonNull(graphene.List(graphene.NonNull(MainSliderSlideType)))

    selling_points = graphene.NonNull(graphene.List(graphene.NonNull(SellingPointType)))

    other_services = graphene.NonNull(graphene.List(graphene.NonNull(OtherServiceType)))

    device_categories = graphene.NonNull(graphene.List(graphene.NonNull(DeviceCategoryType)))

    device_category = graphene.NonNull(DeviceCategoryType,
                                       id=graphene.NonNull(graphene.ID))

    device_types = graphene.NonNull(graphene.List(DeviceTypeType), category=graphene.ID())
    device_type = graphene.NonNull(DeviceTypeType, id=graphene.NonNull(graphene.ID))

    repair_types = graphene.NonNull(graphene.List(RepairTypeType), device_type=graphene.ID())
    repair_type = graphene.NonNull(RepairTypeType, id=graphene.NonNull(graphene.ID))

    appointment_times = graphene.NonNull(
        graphene.List(graphene.NonNull(AppointmentTime)),
        date=graphene.Date(required=True)
    )

    cart_item = graphene.NonNull(
        CartItem,
        category=graphene.NonNull(graphene.ID),
        id=graphene.NonNull(graphene.ID)
    )

    def resolve_site_config(self, info):
        return models.SiteConfig.objects.first()

    def resolve_main_slider_slides(self, info):
        return models.MainSliderSlide.objects.all()

    def resolve_selling_points(self, info):
        return models.SellingPoint.objects.all()

    def resolve_other_services(self, info):
        return models.OtherService.objects.all()

    def resolve_device_categories(self, info):
        return models.DeviceCategory.objects.all()

    def resolve_device_category(self, info, id):
        return models.DeviceCategory.objects.get(id=id)

    def resolve_device_types(self, info, **kwargs):
        device_types = models.DeviceType.objects.all()

        category = kwargs.get("category")
        if category is not None:
            device_types = device_types.filter(device_category=category)

        return device_types

    def resolve_device_type(self, info, id):
        return models.DeviceType.objects.get(id=id)

    def resolve_repair_types(self, info, **kwargs):
        device_types = models.RepairType.objects.all()

        device_type = kwargs.get("device_type")
        if device_type is not None:
            device_types = device_types.filter(device_type=device_type)

        return device_types

    def resolve_repair_type(self, info, id):
        return models.RepairType.objects.get(id=id)

    def resolve_appointment_times(self, info, date):
        return get_booking_times(date)

    def resolve_cart_item(self, info, category, id):
        if category == "buy_and_sell":
            return buy_and_sell.schema.get_item(id)
        elif category == "unlocking":
            return unlocking.schema.get_item(id)
        else:
            raise GraphQLError("Invalid type")


class Mutation:
    create_postal_order = CreatePostalOrder.Field()
    create_appointment = CreateAppointment.Field()
    create_order = CreateOrder.Field()
    contact_form = ContactForm.Field()
