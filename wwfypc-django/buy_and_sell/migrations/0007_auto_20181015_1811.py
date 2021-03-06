# Generated by Django 2.1.2 on 2018-10-15 18:11

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ('buy_and_sell', '0006_auto_20181015_1213'),
    ]

    operations = [
        migrations.AlterModelOptions(
            name='item',
            options={'ordering': ('order',)},
        ),
        migrations.AlterModelOptions(
            name='itemcategory',
            options={'ordering': ('order',), 'verbose_name_plural': 'Item categories'},
        ),
        migrations.AlterModelOptions(
            name='itemimage',
            options={'ordering': ('order',)},
        ),
        migrations.AlterModelOptions(
            name='itempostage',
            options={'ordering': ('order',)},
        ),
        migrations.AlterModelOptions(
            name='itemspec',
            options={'ordering': ('order',)},
        ),
        migrations.AddField(
            model_name='item',
            name='order',
            field=models.PositiveIntegerField(default=0),
        ),
        migrations.AddField(
            model_name='itemcategory',
            name='order',
            field=models.PositiveIntegerField(default=0),
        ),
        migrations.AddField(
            model_name='itemimage',
            name='order',
            field=models.PositiveIntegerField(default=0),
        ),
        migrations.AddField(
            model_name='itempostage',
            name='order',
            field=models.PositiveIntegerField(default=0),
        ),
        migrations.AddField(
            model_name='itemspec',
            name='order',
            field=models.PositiveIntegerField(default=0),
        ),
    ]
