# Generated by Django 2.0.7 on 2018-08-20 11:58

import datetime
from django.db import migrations, models
import django.db.models.deletion
import main_site.models
import phonenumber_field.modelfields


class Migration(migrations.Migration):

    dependencies = [
        ('main_site', '0006_auto_20180818_1419'),
    ]

    operations = [
        migrations.CreateModel(
            name='Customer',
            fields=[
                ('id', models.AutoField(auto_created=True, primary_key=True, serialize=False, verbose_name='ID')),
                ('name', models.CharField(max_length=255)),
                ('email', models.EmailField(max_length=254)),
                ('phone', phonenumber_field.modelfields.PhoneNumberField(max_length=128)),
                ('address', models.TextField(blank=True)),
            ],
        ),
        migrations.CreateModel(
            name='PostalOrder',
            fields=[
                ('uid', models.CharField(default=main_site.models.make_uid, editable=False, max_length=8, primary_key=True, serialize=False, unique=True)),
                ('date', models.DateTimeField(default=datetime.datetime.now)),
                ('additional_items', models.TextField(blank=True)),
                ('customer', models.ForeignKey(on_delete=django.db.models.deletion.DO_NOTHING, to='main_site.Customer')),
                ('device', models.ForeignKey(on_delete=django.db.models.deletion.DO_NOTHING, to='main_site.DeviceType')),
                ('repair', models.ForeignKey(on_delete=django.db.models.deletion.DO_NOTHING, to='main_site.RepairType')),
            ],
        ),
    ]