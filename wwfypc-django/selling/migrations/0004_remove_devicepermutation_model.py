# Generated by Django 2.0.7 on 2018-10-01 12:34

from django.db import migrations


class Migration(migrations.Migration):

    dependencies = [
        ('selling', '0003_auto_20181001_1232'),
    ]

    operations = [
        migrations.RemoveField(
            model_name='devicepermutation',
            name='model',
        ),
    ]
