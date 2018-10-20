from django.contrib import admin
from adminsortable2.admin import SortableAdminMixin
from . import models


@admin.register(models.DeviceType)
class DeviceTypeAdmin(SortableAdminMixin, admin.ModelAdmin):
    save_as = True


@admin.register(models.Network)
class NetworkAdmin(SortableAdminMixin, admin.ModelAdmin):
    save_as = True

    
@admin.register(models.UnlockingPrice)
class UnlockingAdmin(admin.ModelAdmin):
    save_as = True
