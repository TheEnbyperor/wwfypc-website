# Generated by Django 2.1.2 on 2018-11-19 13:02

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ('buy_and_sell', '0007_auto_20181015_1811'),
    ]

    operations = [
        migrations.AlterField(
            model_name='itemcategory',
            name='colour',
            field=models.IntegerField(choices=[(3, 'Red'), (1, 'Orange'), (2, 'Blue'), (4, 'Green'), (5, 'Black'), (6, 'Red Inverse')], default=1),
        ),
    ]
