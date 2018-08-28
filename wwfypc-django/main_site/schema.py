import graphene
from graphene import Mutation
from graphene_django.types import DjangoObjectType
from graphene_django.converter import convert_django_field
import phonenumber_field.modelfields
from django.core.exceptions import ValidationError
import datetime
from . import models


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


class FormError(graphene.ObjectType):
    field = graphene.String(required=True)
    errors = graphene.List(
        graphene.String,
        required=True
    )


def validation_error_to_graphene(error):
    return map(lambda item: FormError(field=item[0], errors=item[1]), error)


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

        order.date = datetime.datetime.now()
        order.device = device
        order.repair = repair
        order.additional_items = additional_items

        order.save()

        return CreatePostalOrder(ok=True, order=order)


class Query:
    site_config = graphene.Field(SiteConfigType)

    main_slider_slides = graphene.List(MainSliderSlideType)

    device_categories = graphene.List(DeviceCategoryType)

    device_types = graphene.List(DeviceTypeType,
                                 category=graphene.ID())
    device_type = graphene.Field(DeviceTypeType,
                                 id=graphene.NonNull(graphene.ID))

    repair_types = graphene.List(RepairTypeType,
                                 device_type=graphene.ID())
    repair_type = graphene.Field(RepairTypeType,
                                 id=graphene.NonNull(graphene.ID))

    def resolve_site_config(self, info):
        return models.SiteConfig.objects.first()

    def resolve_main_slider_slides(self, info):
        return models.MainSliderSlide.objects.all()

    def resolve_device_categories(self, info, **kwargs):
        return models.DeviceCategory.objects.all()

    def resolve_device_types(self, info, **kwargs):
        device_types = models.DeviceType.objects.all()

        category = kwargs.get("category")
        if category is not None:
            device_types = device_types.filter(device_category=category)

        return device_types

    def resolve_device_type(self, info, id):
        return models.DeviceType.objects.filter(id=id)[0]

    def resolve_repair_types(self, info, **kwargs):
        device_types = models.RepairType.objects.all()

        device_type = kwargs.get("device_type")
        if device_type is not None:
            device_types = device_types.filter(device_type=device_type)

        return device_types

    def resolve_repair_type(self, info, id):
        return models.RepairType.objects.filter(id=id)[0]


class Mutation:
    create_postal_order = CreatePostalOrder.Field()
