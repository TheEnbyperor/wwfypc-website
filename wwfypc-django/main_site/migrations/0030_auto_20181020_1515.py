# Generated by Django 2.1.2 on 2018-10-20 15:15

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ('main_site', '0029_menuitem_anchor'),
    ]

    operations = [
        migrations.AlterField(
            model_name='menuitem',
            name='anchor',
            field=models.CharField(blank=True, max_length=255),
        ),
    ]
