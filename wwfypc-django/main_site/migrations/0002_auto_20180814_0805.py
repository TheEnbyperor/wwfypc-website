# Generated by Django 2.0.7 on 2018-08-14 08:05

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ('main_site', '0001_initial'),
    ]

    operations = [
        migrations.AlterModelOptions(
            name='devicecategory',
            options={'verbose_name_plural': 'Device categories'},
        ),
        migrations.RenameField(
            model_name='repairtype',
            old_name='device_category',
            new_name='device_type',
        ),
        migrations.AddField(
            model_name='repairtype',
            name='description',
            field=models.TextField(default=''),
        ),
        migrations.AlterField(
            model_name='devicecategory',
            name='icon',
            field=models.FileField(upload_to=''),
        ),
    ]
