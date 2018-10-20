from django.db import models
import main_site.models
from ckeditor.fields import RichTextField


class BasePcModel(main_site.models.OrderedModel):
    name = models.CharField(max_length=255)
    price_range = models.CharField(max_length=255)
    image = models.FileField()
    base_price = models.DecimalField(max_digits=10, decimal_places=2)
    description = RichTextField()

    class Meta:
        verbose_name = "Base PC model"
        ordering = ('order',)

    def __str__(self):
        return self.name


class Customisation(main_site.models.OrderedModel):
    base_pc = models.ForeignKey(BasePcModel, on_delete=models.CASCADE, related_name='customisations')
    name = models.CharField(max_length=255)
    help_text = RichTextField()

    def __str__(self):
        return f"{self.base_pc.name}: {self.name}"


class CustomisationOption(main_site.models.OrderedModel):
    customisation = models.ForeignKey(Customisation, on_delete=models.CASCADE, related_name='options')
    name = models.CharField(max_length=255)
    additional_cost = models.DecimalField(max_digits=10, decimal_places=2)

    def __str__(self):
        return self.name


class PcPostage(main_site.models.OrderedModel):
    name = models.CharField(max_length=255)
    price = models.DecimalField(max_digits=10, decimal_places=2)
    pc = models.ForeignKey(BasePcModel, on_delete=models.CASCADE, related_name='postage')

    def __str__(self):
        return self.name
