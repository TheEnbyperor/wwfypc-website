from django.db import models


class ServicePage(models.Model):
    name = models.CharField(max_length=255, blank=False)
    url = models.CharField(max_length=255, blank=False)

    def __str__(self):
        return self.name


class ServicePageSection(models.Model):
    page = models.ForeignKey(ServicePage, on_delete=models.CASCADE, blank=False, related_name='sections')
    title = models.CharField(max_length=255, blank=True)
    subtitle = models.TextField(blank=True)
    text = models.TextField(blank=True)
    image = models.FileField(blank=True)

    def __str__(self):
        return self.title