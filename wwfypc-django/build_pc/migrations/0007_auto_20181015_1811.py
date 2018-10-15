# Generated by Django 2.1.2 on 2018-10-15 18:11

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ('build_pc', '0006_auto_20181015_1213'),
    ]

    operations = [
        migrations.AlterModelOptions(
            name='basepcmodel',
            options={'ordering': ('order',), 'verbose_name': 'Base PC model'},
        ),
        migrations.AlterModelOptions(
            name='customisation',
            options={'ordering': ('order',)},
        ),
        migrations.AlterModelOptions(
            name='customisationoption',
            options={'ordering': ('order',)},
        ),
        migrations.AlterModelOptions(
            name='pcpostage',
            options={'ordering': ('order',)},
        ),
        migrations.AddField(
            model_name='basepcmodel',
            name='order',
            field=models.PositiveIntegerField(default=0),
        ),
        migrations.AddField(
            model_name='customisation',
            name='order',
            field=models.PositiveIntegerField(default=0),
        ),
        migrations.AddField(
            model_name='customisationoption',
            name='order',
            field=models.PositiveIntegerField(default=0),
        ),
        migrations.AddField(
            model_name='pcpostage',
            name='order',
            field=models.PositiveIntegerField(default=0),
        ),
    ]