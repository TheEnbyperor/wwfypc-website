from django.contrib import admin
from . import models

admin.site.register(models.DeviceType)
admin.site.register(models.Network)
admin.site.register(models.UnlockingPrice)
