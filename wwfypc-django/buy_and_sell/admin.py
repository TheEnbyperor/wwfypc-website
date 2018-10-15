from django.contrib import admin
from adminsortable2.admin import SortableAdminMixin, SortableInlineAdminMixin
from . import models


class ItemImageInline(SortableInlineAdminMixin, admin.TabularInline):
    model = models.ItemImage
    extra = 3


class ItemSpecInline(SortableInlineAdminMixin, admin.TabularInline):
    model = models.ItemSpec
    extra = 3


class ItemPostageInline(SortableInlineAdminMixin, admin.TabularInline):
    model = models.ItemPostage
    extra = 1


@admin.register(models.Item)
class ItemAdmin(SortableAdminMixin, admin.ModelAdmin):
    inlines = [ItemImageInline, ItemSpecInline, ItemPostageInline]


@admin.register(models.ItemCategory)
class ItemCategoryAdmin(SortableAdminMixin, admin.ModelAdmin):
    pass
