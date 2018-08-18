from django.contrib import admin
import solo.admin
from . import models


@admin.register(models.DeviceCategory)
class DeviceCategoryAdmin(admin.ModelAdmin):
    pass


admin.site.register(models.DeviceType)
admin.site.register(models.RepairType)
admin.site.register(models.MainSliderSlide)
admin.site.register(models.SiteConfig, solo.admin.SingletonModelAdmin)
