# Generated by Django 2.0.7 on 2018-10-12 10:44

from django.db import migrations


class Migration(migrations.Migration):

    dependencies = [
        ('build_pc', '0003_customisation_customisationoption_pcprice'),
    ]

    operations = [
        migrations.AlterModelOptions(
            name='pcprice',
            options={'verbose_name': 'PC Price'},
        ),
        migrations.RenameField(
            model_name='pcprice',
            old_name='device',
            new_name='base_pc',
        ),
    ]