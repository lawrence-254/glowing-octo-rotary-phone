import uuid
from django.db import models
from django.contrib.auth.models import AbstractBaseUser, BaseUserManager, PermissionsMixin
from django.core.exceptions import ObjectDoesNotExist
from django.http import Http404

from core.abstract.models import AbstractModel, AbstractManager


"""
User manager model
"""
class UserManager(BaseUserManager, AbstractManager):
    # def get_object_by_public_id(self, public_id):
    #     try:
    #         instance = self.get(public_id=public_id)
    #         return instance
    #     except(ObjectDoesNotExist, ValueError, TypeError):
    #         return Http404
    
    def create_user(self, username, email, password=None, **kwargs):
        """
        a function that creates and returns a normal user with an email, phone number
        username and password
        """
        if username is None:
            raise TypeError('username is required to create an account')
        if email is None:
            raise TypeError('email is required to create an account')
        if password is None:
            raise TypeError('users  must create accounts with passwords for security reasons')
        
        user = self.model(username=username, email=self.normalize_email(email), **kwargs)
        user.set_password(password)
        user.save(using=self._db)

        return user
    
    def create_superuser(self, email, username, password, **kwargs):
        """
        creates and returns a user with administrator privilages (a superuser)
        """
        if username is None:
            raise TypeError('Superusers must have usernames')
        if email is None:
            raise TypeError('Superuser must have an email')
        if password is None:
            raise TypeError('superuser must by protected by a password')

        user = self.create_user(username, email, password, **kwargs)
        user.is_superuser = True
        user.is_staff = True
        user.save(using=self._db)
        return user

"""
user model that enables user information to be stored within the database
"""
class User(AbstractBaseUser, AbstractModel, PermissionsMixin):
    # public_id= models.UUIDField(db_index=True, unique=True, default=uuid.uuid4, editable=False)
    username = models.CharField(db_index=True, max_length=255, unique=True)
    first_name = models.CharField(max_length=255)
    last_name = models.CharField(max_length=255)
    email = models.EmailField(db_index=True, unique=True)
    is_active = models.BooleanField(default=True)
    is_superuser = models.BooleanField(default=False)
    # created_at = models.DateTimeField(auto_now=True)
    # updated_at = models.DateTimeField(auto_now_add=True)

    USERNAME_FIELD = 'email'
    REQUIRED_FIELDS = ['username']

    objects = UserManager()

    def __str__(self):
        return f"{self.email}"
    
    @property
    def name(self):
        return f"{self.first_name} {self.last_name}"