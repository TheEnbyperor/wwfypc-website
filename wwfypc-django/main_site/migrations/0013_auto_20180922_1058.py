# Generated by Django 2.0.7 on 2018-09-22 10:58

import datetime
from django.db import migrations, models
from django.utils.timezone import utc


class Migration(migrations.Migration):

    dependencies = [
        ('main_site', '0012_appointmenttimerule'),
    ]

    operations = [
        migrations.AddField(
            model_name='appointmenttimerule',
            name='end_date',
            field=models.DateField(blank=True, null=True),
        ),
        migrations.AddField(
            model_name='appointmenttimerule',
            name='friday',
            field=models.BooleanField(default=False),
        ),
        migrations.AddField(
            model_name='appointmenttimerule',
            name='monday',
            field=models.BooleanField(default=False),
        ),
        migrations.AddField(
            model_name='appointmenttimerule',
            name='recurring',
            field=models.BooleanField(default=False, help_text='If recurring then End Date has no meaning'),
        ),
        migrations.AddField(
            model_name='appointmenttimerule',
            name='saturday',
            field=models.BooleanField(default=False),
        ),
        migrations.AddField(
            model_name='appointmenttimerule',
            name='start_date',
            field=models.DateField(default=datetime.datetime(2018, 9, 22, 10, 58, 49, 803314, tzinfo=utc)),
        ),
        migrations.AddField(
            model_name='appointmenttimerule',
            name='sunday',
            field=models.BooleanField(default=False),
        ),
        migrations.AddField(
            model_name='appointmenttimerule',
            name='thursday',
            field=models.BooleanField(default=False),
        ),
        migrations.AddField(
            model_name='appointmenttimerule',
            name='tuesday',
            field=models.BooleanField(default=False),
        ),
        migrations.AddField(
            model_name='appointmenttimerule',
            name='wednesday',
            field=models.BooleanField(default=False),
        ),
    ]
