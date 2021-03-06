# Generated by Django 2.0.7 on 2018-09-27 07:50

from django.db import migrations, models
import django.db.models.deletion


class Migration(migrations.Migration):

    dependencies = [
        ('buy_and_sell', '0002_auto_20180827_1510'),
    ]

    operations = [
        migrations.CreateModel(
            name='ItemPostage',
            fields=[
                ('id', models.AutoField(auto_created=True, primary_key=True, serialize=False, verbose_name='ID')),
                ('name', models.CharField(max_length=255)),
                ('value', models.DecimalField(decimal_places=2, max_digits=10)),
                ('item', models.ForeignKey(on_delete=django.db.models.deletion.CASCADE, related_name='postage', to='buy_and_sell.Item')),
            ],
        ),
    ]
