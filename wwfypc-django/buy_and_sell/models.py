from django.db import models
from main_site.models import COLOURS


class ItemCategory(models.Model):
    name = models.CharField(max_length=255, blank=False)
    colour = models.IntegerField(choices=COLOURS, blank=False, default=1)

    class Meta:
        verbose_name_plural = "Item categories"

    def __str__(self):
        return self.name


class Item(models.Model):
    category = models.ForeignKey(ItemCategory, related_name='items', on_delete=models.DO_NOTHING)
    name = models.CharField(max_length=255, blank=False)
    price = models.DecimalField(decimal_places=2, max_digits=99, blank=False)
    reserved = models.BooleanField(blank=False)

    def __str__(self):
        return self.name


class ItemImage(models.Model):
    item = models.ForeignKey(Item, related_name='images', on_delete=models.CASCADE)
    image = models.ImageField(blank=False)

    def __str__(self):
        return str(self.id)


class ItemSpec(models.Model):
    item = models.ForeignKey(Item, related_name='specs', on_delete=models.CASCADE)
    name = models.CharField(max_length=255, blank=False)
    value = models.CharField(max_length=255, blank=False)

    def __str__(self):
        return self.name