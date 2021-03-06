# Generated by Django 2.0.7 on 2018-08-18 14:19

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ('main_site', '0005_auto_20180815_1024'),
    ]

    operations = [
        migrations.AddField(
            model_name='siteconfig',
            name='appointment_description',
            field=models.TextField(default='', verbose_name='"Book an appointment" description'),
            preserve_default=False,
        ),
        migrations.AddField(
            model_name='siteconfig',
            name='post_description',
            field=models.TextField(default='', verbose_name='"Post" description'),
            preserve_default=False,
        ),
        migrations.AddField(
            model_name='siteconfig',
            name='walk_in_description',
            field=models.TextField(default='', verbose_name='"Walk in" description'),
            preserve_default=False,
        ),
    ]
