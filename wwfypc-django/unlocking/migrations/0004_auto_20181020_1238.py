# Generated by Django 2.1.2 on 2018-10-20 12:38

import ckeditor.fields
from django.db import migrations


class Migration(migrations.Migration):

    dependencies = [
        ('unlocking', '0003_auto_20181015_1811'),
    ]

    operations = [
        migrations.AlterField(
            model_name='network',
            name='description',
            field=ckeditor.fields.RichTextField(),
        ),
    ]
