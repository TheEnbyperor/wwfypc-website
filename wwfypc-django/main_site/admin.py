from django.contrib import admin
import solo.admin
# import buy_and_sell.models
from adminsortable2.admin import SortableAdminMixin, SortableInlineAdminMixin
from . import models


@admin.register(models.AppointmentTimeRule)
class AppointmentTimeRuleAdmin(admin.ModelAdmin):
    list_display = ('__str__', 'start_time', 'end_time', 'recurring', 'start_date', 'end_date', 'monday', 'tuesday',
                    'wednesday', 'thursday', 'friday', 'saturday', 'sunday')
    list_editable = ('start_time', 'end_time', 'recurring', 'start_date', 'end_date', 'monday', 'tuesday', 'wednesday',
                     'thursday', 'friday', 'saturday', 'sunday')
    save_as = True


@admin.register(models.AppointmentTimeBlockRule)
class AppointmentTimeRuleAdmin(admin.ModelAdmin):
    list_display = ('__str__', 'start_time', 'end_time', 'date')
    list_editable = ('start_time', 'end_time', 'date')
    save_as = True


# @admin.register(models.Appointment)
# class AppointmentAdmin(admin.ModelAdmin):
#     list_display = ('__str__', 'date')
#     save_as = True


# class OrderItemAdmin(admin.TabularInline):
#     model = models.OrderItem
#     fields = ('type', 'item_from_type', 'quantity', 'delivery_from_type',)
#     readonly_fields = ('type', 'item_from_type', 'delivery_from_type',)
#
#     def item_from_type(self, obj):
#         if obj.type == "buy_and_sell":
#             return buy_and_sell.models.Item.objects.get(id=obj.item_id)
#         elif obj.type == "unlocking":
#             id, _ = obj.item_id.split(";", 1)
#             return buy_and_sell.models.UnlockingPrice.objects.get(id=id)
#     item_from_type.short_description = 'Item'
#
#     def delivery_from_type(self, obj):
#         if obj.type == "buy_and_sell":
#             return buy_and_sell.models.ItemPostage.objects.get(id=obj.delivery)
#         elif obj.type == "unlocking":
#             return "N/A"
#     delivery_from_type.short_description = 'Delivery'
#
#     def has_add_permission(self, request, obj=None):
#         return False
#
#     def has_delete_permission(self, request, obj=None):
#         return False


# @admin.register(models.Order)
# class OrderAdmin(admin.ModelAdmin):
#     inlines = [OrderItemAdmin]
#     save_as = True


# class CustomerPostalOrdersInline(admin.StackedInline):
#     model = models.PostalOrder
#     extra = 0
#
#
# class CustomerAppointmentInline(admin.StackedInline):
#     model = models.Appointment
#     extra = 0
#
#
# class CustomerOrderInline(admin.StackedInline):
#     model = models.Order
#     extra = 0
#
#
@admin.register(models.Customer)
class CustomerAdmin(admin.ModelAdmin):
    # inlines = [CustomerPostalOrdersInline, CustomerAppointmentInline, CustomerOrderInline]
    save_as = True


class DeviceTypeInlineAdmin(SortableInlineAdminMixin, admin.TabularInline):
    model = models.DeviceType


class RepairTypeInlineAdmin(SortableInlineAdminMixin, admin.StackedInline):
    model = models.RepairType
    extra = 1


@admin.register(models.DeviceCategory)
class DeviceCategoryAdmin(SortableAdminMixin, admin.ModelAdmin):
    inlines = [DeviceTypeInlineAdmin]
    save_as = True


@admin.register(models.DeviceType)
class DeviceTypeAdmin(SortableAdminMixin, admin.ModelAdmin):
    inlines = [RepairTypeInlineAdmin]
    save_as = True


@admin.register(models.RepairType)
class RepairTypeAdmin(SortableAdminMixin, admin.ModelAdmin):
    save_as = True


# @admin.register(models.MainSliderSlide)
# class MainSliderSlideAdmin(SortableAdminMixin, admin.ModelAdmin):
#     save_as = True
#
#
# @admin.register(models.SellingPoint)
# class SellingPointAdmin(SortableAdminMixin, admin.ModelAdmin):
#     pass
#
#
# @admin.register(models.OtherService)
# class OtherServiceAdmin(SortableAdminMixin, admin.ModelAdmin):
#     save_as = True
#
#
# @admin.register(models.MenuItem)
# class MenuItemAdmin(SortableAdminMixin, admin.ModelAdmin):
#     save_as = True


admin.site.register(models.SiteConfig, solo.admin.SingletonModelAdmin)
# admin.site.register(models.PostalOrder)
