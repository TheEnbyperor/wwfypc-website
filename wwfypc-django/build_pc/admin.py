from django.contrib import admin
from . import models


class CustomisationOptionInlineAdmin(admin.TabularInline):
    model = models.CustomisationOption


class CustomisationInlineAdmin(admin.StackedInline):
    model = models.Customisation
    extra = 1


@admin.register(models.BasePcModel)
class BasePcModelAdmin(admin.ModelAdmin):
    inlines = [CustomisationInlineAdmin]


@admin.register(models.Customisation)
class CustomisationAdmin(admin.ModelAdmin):
    inlines = [CustomisationOptionInlineAdmin]


class PcPostageAdmin(admin.TabularInline):
    model = models.PcPostage
    extra = 1


@admin.register(models.PcPrice)
class PcPriceAdmin(admin.ModelAdmin):
    inlines = [PcPostageAdmin]
