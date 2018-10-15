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
    category = models.ForeignKey(ItemCategory, related_name='items', on_delete=models.DO_NOTHING, blank=True)
    name = models.CharField(max_length=255, blank=False)
    price = models.DecimalField(decimal_places=2, max_digits=10, blank=False)
    sold = models.BooleanField(blank=False, default=False)
    reserved = models.BooleanField(blank=False)

    def __str__(self):
        return self.name


class ItemImage(models.Model):
    item = models.ForeignKey(Item, related_name='images', on_delete=models.CASCADE)
    image = models.FileField(blank=False)

    def __str__(self):
        return str(self.id)


class ItemSpec(models.Model):
    item = models.ForeignKey(Item, related_name='specs', on_delete=models.CASCADE)
    name = models.CharField(max_length=255, blank=False)
    value = models.CharField(max_length=255, blank=False)

    def __str__(self):
        return self.name


class ItemPostage(models.Model):
    item = models.ForeignKey(Item, related_name='postage', on_delete=models.CASCADE)
    name = models.CharField(max_length=255, blank=False)
    value = models.DecimalField(max_digits=10, decimal_places=2, blank=False)

    def __str__(self):
        return self.name