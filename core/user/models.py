from django.contrib.auth.models import AbstractBaseUser, BaseUserManager, PermissionsMixin
from django.db import models

from core.abstraction.models import AbstractManager, AbstractModel

# Create your models here.
class UserManager(BaseUserManager, AbstractManager):
    def create_user(self, username, email, password=None, **kwargs):
        if username is None:
            raise TypeError('Username cannot be empty')
        if email is None:
            raise TypeError('Email cannot be empty')
        if password is None:
            raise TypeError('Password cannot be empty')
        
        user = self.model(username=username, email=self.normalize_email(email), **kwargs)
        user.set_password(password)
        user.save(using=self._db)

        return user
    
    def create_superuser(self, username, email, password=None, **kwargs):
        if username is None:
            raise TypeError('Superuser username cannot be empty')
        if email is None:
            raise TypeError('Superuser email cannot be empty')
        if password is None:
            raise TypeError('Superuser password cannot be empty')
        
        user = self.create_user(username, email, password, **kwargs)
        user.is_superuser=True
        user.is_staff= True
        user.save(using=self._db)

        return user

class User(AbstractBaseUser, AbstractModel, PermissionsMixin):
    username=models.CharField(db_index=True, max_length=252, unique=True, editable=True)
    first_name= models.CharField(db_index=True, max_length=252, editable=True)
    last_name=models.CharField(db_index=True, max_length=252, editable=True)
    email=models.EmailField(db_index=True, unique=True, editable=True)
    is_active=models.BooleanField(default=True)
    is_superuser=models.BooleanField(default=False)

    USERNAME_FIELD='username'
    EMAIL_FIELD='email'
    REQUIRED_FIELDS=['username']

    def __str__(self):
        return f"{self.email}"

    @property
    def name(self):
        return f"{self.first_name} {self.last_name}"

        