from django.contrib import admin
import solo.admin
import buy_and_sell.models
import unlocking.models
from . import models


@admin.register(models.AppointmentTimeRule)
class AppointmentTimeRuleAdmin(admin.ModelAdmin):
    list_display = ('__str__', 'start_time', 'end_time', 'recurring', 'start_date', 'end_date', 'monday', 'tuesday',
                    'wednesday', 'thursday', 'friday', 'saturday', 'sunday')
    list_editable = ('start_time', 'end_time', 'recurring', 'start_date', 'end_date', 'monday', 'tuesday', 'wednesday',
                     'thursday', 'friday', 'saturday', 'sunday')


@admin.register(models.AppointmentTimeBlockRule)
class AppointmentTimeRuleAdmin(admin.ModelAdmin):
    list_display = ('__str__', 'start_time', 'end_time', 'date')
    list_editable = ('start_time', 'end_time', 'date')


@admin.register(models.Appointment)
class AppointmentAdmin(admin.ModelAdmin):
    list_display = ('__str__', 'date')


class OrderItemAdmin(admin.TabularInline):
    model = models.OrderItem
    fields = ('type', 'item_from_type', 'quantity', 'delivery_from_type',)
    readonly_fields = ('type', 'item_from_type', 'delivery_from_type',)

    def item_from_type(self, obj):
        if obj.type == "buy_and_sell":
            return buy_and_sell.models.Item.objects.get(id=obj.item_id)
        elif obj.type == "unlocking":
            id, _ = obj.item_id.split(";", 1)
            return buy_and_sell.models.UnlockingPrice.objects.get(id=id)
    item_from_type.short_description = 'Item'

    def delivery_from_type(self, obj):
        if obj.type == "buy_and_sell":
            return buy_and_sell.models.ItemPostage.objects.get(id=obj.delivery)
        elif obj.type == "unlocking":
            return "N/A"
    delivery_from_type.short_description = 'Delivery'

    def has_add_permission(self, request, obj=None):
        return False

    def has_delete_permission(self, request, obj=None):
        return False


@admin.register(models.Order)
class OrderAdmin(admin.ModelAdmin):
    inlines = [OrderItemAdmin]


class CustomerPostalOrdersInline(admin.StackedInline):
    model = models.PostalOrder
    extra = 0


class CustomerAppointmentInline(admin.StackedInline):
    model = models.Appointment
    extra = 0


class CustomerOrderInline(admin.StackedInline):
    model = models.Order
    extra = 0


@admin.register(models.Customer)
class OrderAdmin(admin.ModelAdmin):
    inlines = [CustomerPostalOrdersInline, CustomerAppointmentInline, CustomerOrderInline]


class DeviceTypeInlineAdmin(admin.TabularInline):
    model = models.DeviceType


class RepairTypeInlineAdmin(admin.StackedInline):
    model = models.RepairType
    extra = 1


@admin.register(models.DeviceCategory)
class DeviceCategoryAdmin(admin.ModelAdmin):
    inlines = [DeviceTypeInlineAdmin]


@admin.register(models.DeviceType)
class DeviceTypeAdmin(admin.ModelAdmin):
    inlines = [RepairTypeInlineAdmin]


admin.site.register(models.RepairType)
admin.site.register(models.MainSliderSlide)
admin.site.register(models.SiteConfig, solo.admin.SingletonModelAdmin)
admin.site.register(models.PostalOrder)
admin.site.register(models.SellingPoint)
admin.site.register(models.OtherService)
