# Generated by Django 2.0.7 on 2018-09-28 12:31

import datetime
from django.db import migrations, models
import django.db.models.deletion
import main_site.models


class Migration(migrations.Migration):

    dependencies = [
        ('main_site', '0016_auto_20180922_1326'),
    ]

    operations = [
        migrations.CreateModel(
            name='Order',
            fields=[
                ('uid', models.CharField(default=main_site.models.make_uid, editable=False, max_length=8, primary_key=True, serialize=False, unique=True)),
                ('date', models.DateTimeField(default=datetime.datetime.now)),
                ('card_token', models.CharField(max_length=255)),
                ('name_on_card', models.CharField(max_length=255)),
                ('worldpay_order_id', models.CharField(max_length=255)),
                ('customer', models.ForeignKey(on_delete=django.db.models.deletion.DO_NOTHING, related_name='orders', to='main_site.Customer')),
            ],
        ),
        migrations.CreateModel(
            name='OrderItem',
            fields=[
                ('id', models.AutoField(auto_created=True, primary_key=True, serialize=False, verbose_name='ID')),
                ('type', models.CharField(max_length=255)),
                ('item_id', models.CharField(max_length=255)),
                ('quantity', models.IntegerField()),
                ('delivery', models.CharField(max_length=255)),
                ('order', models.ForeignKey(on_delete=django.db.models.deletion.CASCADE, related_name='items', to='main_site.Order')),
            ],
        ),
    ]
