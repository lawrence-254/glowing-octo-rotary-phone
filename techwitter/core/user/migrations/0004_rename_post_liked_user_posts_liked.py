# Generated by Django 5.1 on 2024-11-07 15:57

from django.db import migrations


class Migration(migrations.Migration):

    dependencies = [
        ('core_user', '0003_user_post_liked'),
    ]

    operations = [
        migrations.RenameField(
            model_name='user',
            old_name='post_liked',
            new_name='posts_liked',
        ),
    ]