from django.contrib import admin
from adminsortable2.admin import SortableAdminMixin, SortableInlineAdminMixin
from . import models


class CustomisationOptionInlineAdmin(SortableInlineAdminMixin, admin.TabularInline):
    model = models.CustomisationOption


class CustomisationInlineAdmin(SortableInlineAdminMixin, admin.StackedInline):
    model = models.Customisation
    extra = 1


@admin.register(models.BasePcModel)
class BasePcModelAdmin(SortableAdminMixin, admin.ModelAdmin):
    inlines = [CustomisationInlineAdmin]


@admin.register(models.Customisation)
class CustomisationAdmin(SortableAdminMixin, admin.ModelAdmin):
    inlines = [CustomisationOptionInlineAdmin]


class PcPostageAdmin(SortableInlineAdminMixin, admin.TabularInline):
    model = models.PcPostage
    extra = 1


@admin.register(models.PcPrice)
class PcPriceAdmin(admin.ModelAdmin):
    inlines = [PcPostageAdmin]
