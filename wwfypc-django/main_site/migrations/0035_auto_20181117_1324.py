# Generated by Django 2.1.2 on 2018-11-17 13:24

from django.db import migrations, models
import django.db.models.deletion


class Migration(migrations.Migration):
    atomic = False

    dependencies = [
        ('main_site', '0034_auto_20181110_1415'),
    ]

    operations = [
        migrations.RenameField(
            model_name='appointment',
            old_name='uid',
            new_name='id',
        ),
        migrations.RenameField(
            model_name='order',
            old_name='uid',
            new_name='id',
        ),
        migrations.RenameField(
            model_name='postalorder',
            old_name='uid',
            new_name='id',
        ),
        migrations.AlterField(
            model_name='orderitem',
            name='order',
            field=models.ForeignKey(on_delete=django.db.models.deletion.CASCADE, related_name='items', to='main_site.Order', to_field='id'),
        ),
    ]
