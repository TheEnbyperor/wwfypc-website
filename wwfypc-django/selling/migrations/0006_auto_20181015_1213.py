# Generated by Django 2.1.2 on 2018-10-15 12:13

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ('selling', '0005_devicepermutationvalue_display_name'),
    ]

    operations = [
        migrations.AlterField(
            model_name='valueestimate',
            name='permutations',
            field=models.ManyToManyField(blank=True, to='selling.DevicePermutationValue'),
        ),
    ]
