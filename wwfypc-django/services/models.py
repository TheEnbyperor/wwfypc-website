from django.db import models
import main_site.models
from ckeditor.fields import RichTextField
from ckeditor_uploader.fields import RichTextUploadingField


class ServicePage(main_site.models.OrderedModel):
    name = models.CharField(max_length=255, blank=False)
    url = models.CharField(max_length=255, blank=False)
    header_background = models.ImageField()
    header_text = RichTextUploadingField(blank=False)

    def __str__(self):
        return self.name


class ServicePageSection(main_site.models.OrderedModel):
    page = models.ForeignKey(ServicePage, on_delete=models.CASCADE, blank=False, related_name='sections')
    title = models.CharField(max_length=255, blank=True)
    subtitle = RichTextField(blank=True)
    text = RichTextField(blank=True)
    image = models.FileField(blank=True)

    def __str__(self):
        return self.title
