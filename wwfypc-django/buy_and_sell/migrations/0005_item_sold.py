# Generated by Django 2.0.7 on 2018-10-06 10:23

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ('buy_and_sell', '0004_auto_20180929_1224'),
    ]

    operations = [
        migrations.AddField(
            model_name='item',
            name='sold',
            field=models.BooleanField(default=False),
        ),
    ]