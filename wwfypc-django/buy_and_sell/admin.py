from django.contrib import admin
from . import models


class ItemImageInline(admin.TabularInline):
    model = models.ItemImage
    extra = 3


class ItemSpecInline(admin.TabularInline):
    model = models.ItemSpec
    extra = 3


@admin.register(models.Item)
class ItemAdmin(admin.ModelAdmin):
    inlines = [ItemImageInline, ItemSpecInline]


admin.site.register(models.ItemCategory)
