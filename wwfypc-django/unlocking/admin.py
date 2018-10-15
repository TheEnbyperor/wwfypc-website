from django.contrib import admin
from adminsortable2.admin import SortableAdminMixin
from . import models


@admin.register(models.DeviceType)
class DeviceTypeAdmin(SortableAdminMixin, admin.ModelAdmin):
    pass


@admin.register(models.Network)
class NetworkAdmin(SortableAdminMixin, admin.ModelAdmin):
    pass


admin.site.register(models.UnlockingPrice)
