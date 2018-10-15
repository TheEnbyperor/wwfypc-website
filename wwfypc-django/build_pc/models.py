from django.db import models
import main_site.models


class BasePcModel(main_site.models.OrderedModel):
    name = models.CharField(max_length=255)
    price_range = models.CharField(max_length=255)
    image = models.FileField()
    description = models.TextField()

    class Meta:
        verbose_name = "Base PC model"
        ordering = ('order',)

    def __str__(self):
        return self.name


class Customisation(main_site.models.OrderedModel):
    base_pc = models.ForeignKey(BasePcModel, on_delete=models.CASCADE, related_name='customisations')
    name = models.CharField(max_length=255)
    help_text = models.TextField()

    def __str__(self):
        return self.name


class CustomisationOption(main_site.models.OrderedModel):
    customisation = models.ForeignKey(Customisation, on_delete=models.CASCADE, related_name='options')
    name = models.CharField(max_length=255)

    def __str__(self):
        return self.name


class PcPrice(models.Model):
    base_pc = models.ForeignKey(BasePcModel, on_delete=models.CASCADE, related_name='prices')
    options = models.ManyToManyField(CustomisationOption, blank=True)
    price = models.DecimalField(max_digits=10, decimal_places=2)

    class Meta:
        verbose_name = "PC Price"

    def __str__(self):
        names = ", ".join(map(lambda p: str(p), self.options.all()))
        return f"{str(self.base_pc)}; {names}"


class PcPostage(main_site.models.OrderedModel):
    name = models.CharField(max_length=255)
    price = models.DecimalField(max_digits=10, decimal_places=2)
    pc = models.ForeignKey(PcPrice, on_delete=models.CASCADE, related_name='postage')

    def __str__(self):
        return self.name
