import graphene
from graphene_django.types import DjangoObjectType
from graphene_django.converter import convert_django_field
import phonenumber_field.modelfields
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
