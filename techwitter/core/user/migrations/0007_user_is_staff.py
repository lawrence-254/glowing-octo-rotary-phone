# Generated by Django 5.1 on 2024-11-19 19:33

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ('core_user', '0006_user_avatar'),
    ]

    operations = [
        migrations.AddField(
            model_name='user',
            name='is_staff',
            field=models.BooleanField(default=False),
        ),
    ]
