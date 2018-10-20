from django.db import models
from solo.models import SingletonModel
from django.utils.crypto import get_random_string
import django.utils.timezone
import datetime
import string
import phonenumber_field.modelfields
from ckeditor.fields import RichTextField

COLOURS = (
    (1, "Yellow"),
    (2, "Blue"),
    (3, "Orange"),
    (4, "Green"),
    (5, "Black"),
    (6, "Orange Inverse"),
)


class OrderedModel(models.Model):
    order = models.PositiveIntegerField(default=0, blank=False, null=False)

    class Meta:
        abstract = True
        ordering = ('order',)


class SiteConfig(SingletonModel):
    landline = phonenumber_field.modelfields.PhoneNumberField(blank=False)
    mobile = phonenumber_field.modelfields.PhoneNumberField(blank=False)
    email = models.EmailField(blank=False)
    address = RichTextField(blank=False)
    opening_hours = RichTextField(blank=False)
    google_maps_place_id = models.CharField(max_length=255, blank=False)

    appointment_description = RichTextField(verbose_name="\"Book an appointment\" description")
    walk_in_description = RichTextField(verbose_name="\"Walk in\" description")
    post_description = RichTextField(verbose_name="\"Post\" description")

    featured_review = RichTextField()
    featured_review_name = models.CharField(max_length=255)

    why_choose_us = RichTextField()

    twitter_url = models.URLField(blank=True)
    google_url = models.URLField(blank=True)
    facebook_url = models.URLField(blank=True)

    def __str__(self):
        return "Site config"


class SellingPoint(OrderedModel):
    title = RichTextField()
    text = RichTextField()
    image = models.FileField()

    def __str__(self):
        return self.title


class OtherService(OrderedModel):
    name = RichTextField()
    icon = models.FileField()
    description = RichTextField()
    colour = models.IntegerField(choices=COLOURS, default=1)
    button_text = models.CharField(max_length=255)
    link_to = models.CharField(max_length=255)

    def __str__(self):
        return self.name


class MenuItem(OrderedModel):
    name = models.CharField(max_length=255)
    link_to = models.CharField(max_length=255)

    def __str__(self):
        return self.name


class AppointmentTimeBlockRule(models.Model):
    start_time = models.TimeField(default=datetime.time())
    end_time = models.TimeField(default=datetime.time())

    date = models.DateField(default=django.utils.timezone.now)

    def __str__(self):
        return "#" + str(self.pk)


class AppointmentTimeRule(models.Model):
    start_time = models.TimeField(default=datetime.time())
    end_time = models.TimeField(default=datetime.time())

    recurring = models.BooleanField(help_text="If recurring then End Date has no meaning", default=False)
    start_date = models.DateField(default=django.utils.timezone.now)
    end_date = models.DateField(blank=True, null=True)

    monday = models.BooleanField(default=False)
    tuesday = models.BooleanField(default=False)
    wednesday = models.BooleanField(default=False)
    thursday = models.BooleanField(default=False)
    friday = models.BooleanField(default=False)
    saturday = models.BooleanField(default=False)
    sunday = models.BooleanField(default=False)

    def __str__(self):
        return "#" + str(self.pk)


class MainSliderSlide(OrderedModel):
    class Meta:
        verbose_name_plural = "Main slider"
        ordering = ('order',)

    title = models.CharField(max_length=255, blank=False)
    colour = models.IntegerField(choices=COLOURS, blank=False, default=1)
    text = RichTextField()
    button_text = models.CharField(max_length=255)
    link_to = models.CharField(max_length=255)
    image = models.FileField()
    background_image = models.FileField()

    def __str__(self):
        return self.title


class DeviceCategory(OrderedModel):
    class Meta:
        verbose_name_plural = "Device categories"
        ordering = ('order',)

    name = RichTextField(blank=False)
    description = RichTextField(blank=False)
    colour = models.IntegerField(choices=COLOURS, blank=False, default=1)
    icon = models.FileField(blank=False)

    def __str__(self):
        return self.name


class DeviceType(OrderedModel):
    device_category = models.ForeignKey(DeviceCategory, on_delete=models.CASCADE,
                                        related_name="device_types", blank=False)
    name = models.CharField(max_length=255, blank=False)

    def __str__(self):
        return self.name


class RepairType(OrderedModel):
    device_type = models.ForeignKey(DeviceType, on_delete=models.CASCADE,
                                    related_name="repair_types", blank=False)
    name = models.CharField(max_length=255, blank=False)
    price = models.DecimalField(blank=False, decimal_places=2, max_digits=10)
    repair_time = models.CharField(max_length=255, blank=True)
    description = RichTextField(default="")

    def __str__(self):
        return f"{self.device_type.name}: {self.name}"


def make_uid(length=8):
    return get_random_string(length=length, allowed_chars=string.digits+string.ascii_letters)


class Customer(models.Model):
    name = models.CharField(max_length=255, blank=True)
    email = models.EmailField(blank=False)
    phone = phonenumber_field.modelfields.PhoneNumberField(blank=True)
    address = models.TextField(blank=True)

    def __str__(self):
        return self.name


class PostalOrder(models.Model):
    uid = models.CharField(max_length=8, unique=True, editable=False, default=make_uid, primary_key=True)
    customer = models.ForeignKey(Customer, on_delete=models.DO_NOTHING, blank=True, related_name="postal_orders")
    date = models.DateTimeField(blank=False, default=datetime.datetime.now)
    device = models.ForeignKey(DeviceType, on_delete=models.DO_NOTHING, blank=True)
    repair = models.ForeignKey(RepairType, on_delete=models.DO_NOTHING, blank=True)
    additional_items = models.TextField(blank=True)

    def __str__(self):
        return self.uid


class Appointment(models.Model):
    uid = models.CharField(max_length=8, unique=True, editable=False, default=make_uid, primary_key=True)
    customer = models.ForeignKey(Customer, on_delete=models.DO_NOTHING, blank=True, related_name="appointments")
    date = models.DateTimeField(blank=False)
    device = models.ForeignKey(DeviceType, on_delete=models.DO_NOTHING, blank=True)
    repair = models.ForeignKey(RepairType, on_delete=models.DO_NOTHING, blank=True)

    def __str__(self):
        return self.uid


class Order(models.Model):
    uid = models.CharField(max_length=8, unique=True, editable=False, default=make_uid, primary_key=True)
    customer = models.ForeignKey(Customer, on_delete=models.DO_NOTHING, blank=True, related_name="orders")
    date = models.DateTimeField(blank=False, default=datetime.datetime.now)
    card_token = models.CharField(max_length=255, blank=False)
    name_on_card = models.CharField(max_length=255, blank=False)
    worldpay_order_id = models.CharField(max_length=255, blank=False)

    def __str__(self):
        return self.uid


class OrderItem(models.Model):
    order = models.ForeignKey(Order, on_delete=models.CASCADE, blank=False, related_name="items")
    type = models.CharField(max_length=255, blank=False)
    item_id = models.CharField(max_length=255, blank=False)
    quantity = models.IntegerField(blank=False)
    delivery = models.CharField(max_length=255, blank=False)

    def __str__(self):
        return str(self.id)
