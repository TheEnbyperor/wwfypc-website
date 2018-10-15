from django.db import models
import main_site.models


class DeviceType(main_site.models.OrderedModel):
    name = models.CharField(max_length=255)
    image = models.FileField()

    def __str__(self):
        return self.name


class Network(main_site.models.OrderedModel):
    name = models.CharField(max_length=255)
    description = models.TextField()

    def __str__(self):
        return self.name


class UnlockingPrice(models.Model):
    device = models.ForeignKey(DeviceType, on_delete=models.CASCADE, related_name='unlocking_prices')
    network = models.ForeignKey(Network, on_delete=models.CASCADE, related_name='unlocking_prices')
    price = models.DecimalField(max_digits=10, decimal_places=2)

    def __str__(self):
        return f"{self.device}: {self.network}"
