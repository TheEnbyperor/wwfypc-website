# Generated by Django 2.1.2 on 2018-11-22 14:41

from django.db import migrations, models
import django.db.models.deletion


class Migration(migrations.Migration):

    dependencies = [
        ('buy_and_sell', '0008_auto_20181119_1302'),
    ]

    operations = [
        migrations.AlterField(
            model_name='item',
            name='category',
            field=models.ForeignKey(blank=True, null=True, on_delete=django.db.models.deletion.SET_NULL, related_name='items', to='buy_and_sell.ItemCategory'),
        ),
    ]
