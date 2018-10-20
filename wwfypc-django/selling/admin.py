from django.contrib import admin
from adminsortable2.admin import SortableAdminMixin, SortableInlineAdminMixin
from . import models


class DeviceModelAdmin(SortableInlineAdminMixin,  admin.TabularInline):
    model = models.DeviceModel


@admin.register(models.DeviceCategory)
class DeviceCategoryAdmin(SortableAdminMixin, admin.ModelAdmin):
    inlines = [DeviceModelAdmin]
    save_as = True


class DevicePermutationValueAdmin(SortableInlineAdminMixin, admin.TabularInline):
    model = models.DevicePermutationValue


@admin.register(models.DevicePermutation)
class DevicePermutationAdmin(SortableAdminMixin, admin.ModelAdmin):
    inlines = [DevicePermutationValueAdmin]
    save_as = True


@admin.register(models.ValueEstimate)
class ValueEstimateAdmin(admin.ModelAdmin):
    save_as = True
