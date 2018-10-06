from django.contrib import admin
from . import models


class DeviceModelAdmin(admin.TabularInline):
    model = models.DeviceModel


@admin.register(models.DeviceCategory)
class DeviceCategoryAdmin(admin.ModelAdmin):
    inlines = [DeviceModelAdmin]


class DevicePermutationValueAdmin(admin.TabularInline):
    model = models.DevicePermutationValue


@admin.register(models.DevicePermutation)
class DevicePermutationAdmin(admin.ModelAdmin):
    inlines = [DevicePermutationValueAdmin]


@admin.register(models.ValueEstimate)
class ValueEstimateAdmin(admin.ModelAdmin):
    pass