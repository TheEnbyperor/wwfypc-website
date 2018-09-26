from django.contrib import admin
import solo.admin
from . import models


@admin.register(models.AppointmentTimeRule)
class AppointmentTimeRuleAdmin(admin.ModelAdmin):
    list_display = ('__str__', 'start_time', 'end_time', 'recurring', 'start_date', 'end_date', 'monday', 'tuesday',
                    'wednesday', 'thursday', 'friday', 'saturday', 'sunday')
    list_editable = ('start_time', 'end_time', 'recurring', 'start_date', 'end_date', 'monday', 'tuesday', 'wednesday',
                     'thursday', 'friday', 'saturday', 'sunday')


admin.site.register(models.DeviceCategory)
admin.site.register(models.DeviceType)
admin.site.register(models.RepairType)
admin.site.register(models.MainSliderSlide)
admin.site.register(models.SiteConfig, solo.admin.SingletonModelAdmin)
admin.site.register(models.Customer)
admin.site.register(models.PostalOrder)
admin.site.register(models.Appointment)
