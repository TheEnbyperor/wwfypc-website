# Generated by Django 2.0.7 on 2018-10-06 14:09

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ('unlocking', '0001_initial'),
    ]

    operations = [
        migrations.AddField(
            model_name='devicetype',
            name='image',
            field=models.FileField(default='', upload_to=''),
            preserve_default=False,
        ),
    ]