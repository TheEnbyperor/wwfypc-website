from django.contrib import admin
from adminsortable2.admin import SortableAdminMixin, SortableInlineAdminMixin
from . import models


class ServicePageSectionAdmin(SortableInlineAdminMixin, admin.StackedInline):
    model = models.ServicePageSection
    extra = 1


@admin.register(models.ServicePage)
class ServicePageAdmin(SortableAdminMixin, admin.ModelAdmin):
    inlines = [ServicePageSectionAdmin]

