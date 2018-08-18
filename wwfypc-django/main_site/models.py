from django.db import models
from solo.models import SingletonModel
import phonenumber_field.modelfields

COLOURS = (
    (1, "Yellow"),
    (2, "Blue"),
    (3, "Orange"),
    (4, "Green"),
)


class SiteConfig(SingletonModel):
    landline = phonenumber_field.modelfields.PhoneNumberField(blank=False)
    mobile = phonenumber_field.modelfields.PhoneNumberField(blank=False)
    email = models.EmailField(blank=False)
    address = models.TextField(blank=False)
    opening_hours = models.TextField(blank=False)
    google_maps_place_id = models.CharField(max_length=255, blank=False)

    appointment_description = models.TextField(verbose_name="\"Book an appointment\" description")
    walk_in_description = models.TextField(verbose_name="\"Walk in\" description")
    post_description = models.TextField(verbose_name="\"Post\" description")

    def __str__(self):
        return "Site config"


class MainSliderSlide(models.Model):
    class Meta:
        verbose_name_plural = "Main slider"

    title = models.CharField(max_length=255, blank=False)
    colour = models.IntegerField(choices=COLOURS, blank=False, default=1)
    text = models.TextField()
    button_text = models.CharField(max_length=255)
    image = models.FileField()
    background_image = models.FileField()

    def __str__(self):
        return self.title


class DeviceCategory(models.Model):
    class Meta:
        verbose_name_plural = "Device categories"

    name = models.CharField(max_length=255, blank=False)
    icon = models.FileField(blank=False)

    def __str__(self):
        return self.name


class DeviceType(models.Model):
    device_category = models.ForeignKey(DeviceCategory, on_delete=models.CASCADE,
                                        related_name="device_types", blank=False)
    name = models.CharField(max_length=255, blank=False)

    def __str__(self):
        return self.name


class RepairType(models.Model):
    device_type = models.ForeignKey(DeviceType, on_delete=models.CASCADE,
                                    related_name="repair_types", blank=False)
    name = models.CharField(max_length=255, blank=False)
    price = models.DecimalField(blank=False, decimal_places=2, max_digits=10)
    description = models.TextField(default="")

    def __str__(self):
        return self.name
