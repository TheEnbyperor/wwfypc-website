from django.db import models
import main_site.models


class DeviceCategory(main_site.models.OrderedModel):
    name = models.CharField(max_length=255)
    icon = models.FileField()

    class Meta:
        verbose_name_plural = "Device categories"
        ordering = ('order',)

    def __str__(self):
        return self.name


class DeviceModel(main_site.models.OrderedModel):
    category = models.ForeignKey(DeviceCategory, on_delete=models.CASCADE, related_name='models')
    name = models.CharField(max_length=255)
    
    def __str__(self):
        return f"{self.category.name}: {self.name}"


class DevicePermutation(main_site.models.OrderedModel):
    name = models.CharField(max_length=255)
    
    def __str__(self):
        return self.name
    
    
class DevicePermutationValue(main_site.models.OrderedModel):
    permutation = models.ForeignKey(DevicePermutation, on_delete=models.CASCADE, related_name='values')
    display_name = models.CharField(max_length=255)
    value = models.CharField(max_length=255)
    
    def __str__(self):
        return f"{str(self.permutation)}: {self.value}"


class ValueEstimate(models.Model):
    device = models.ForeignKey(DeviceModel, on_delete=models.CASCADE, related_name='estimates')
    permutations = models.ManyToManyField(DevicePermutationValue, blank=True)
    price = models.DecimalField(max_digits=10, decimal_places=2)

    def __str__(self):
        names = ", ".join(map(lambda p: str(p), self.permutations.all()))
        return f"{str(self.device)}; {names}"
