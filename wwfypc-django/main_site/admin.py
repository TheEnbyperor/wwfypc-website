from django.contrib import admin
import solo.admin
from . import models

admin.site.register(models.DeviceCategory)
admin.site.register(models.DeviceType)
admin.site.register(models.RepairType)
admin.site.register(models.MainSliderSlide)
admin.site.register(models.SiteConfig, solo.admin.SingletonModelAdmin)
admin.site.register(models.Customer)
admin.site.register(models.PostalOrder)
