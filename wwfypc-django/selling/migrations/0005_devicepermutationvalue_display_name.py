# Generated by Django 2.0.7 on 2018-10-05 09:57

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ('selling', '0004_remove_devicepermutation_model'),
    ]

    operations = [
        migrations.AddField(
            model_name='devicepermutationvalue',
            name='display_name',
            field=models.CharField(default='', max_length=255),
            preserve_default=False,
        ),
    ]