from django.contrib import admin
from . import models


class ServicePageSectionAdmin(admin.StackedInline):
    model = models.ServicePageSection
    extra = 1


@admin.register(models.ServicePage)
class ServicePageAdmin(admin.ModelAdmin):
    inlines = [ServicePageSectionAdmin]

