# import uuid
from django.db import models
from django.contrib.auth.models import AbstractBaseUser, BaseUserManager, PermissionsMixin

from core.abstract.models import AbstractModel, AbstractManager

"""
User manager model
"""
class UserManager(BaseUserManager, AbstractManager):
    def create_user(self, username, email, password=None, **kwargs):
        """
        Creates and returns a normal user with an email, username and password.
        """
        if not username:
            raise TypeError('Username is required to create an account')
        if not email:
            raise TypeError('Email is required to create an account')
        if not password:
            raise TypeError('Users must create accounts with passwords for security reasons')
        
        user = self.model(username=username, email=self.normalize_email(email), **kwargs)
        user.set_password(password)
        user.save(using=self._db)

        return user
    
    def create_superuser(self, email, username, password, **kwargs):
        """
        Creates and returns a user with administrator privileges (a superuser).
        """
        if not username:
            raise TypeError('Superusers must have usernames')
        if not email:
            raise TypeError('Superusers must have an email')
        if not password:
            raise TypeError('Superuser must be protected by a password')

        user = self.create_user(username, email, password, **kwargs)
        user.is_superuser = True
        user.is_staff = True
        user.save(using=self._db)
        return user


"""
files functions
"""
def user_directory_path(instance, filename):
    # locatio that the file will be uploaded to is MEDIA_ROOT/user_<id>/<filename>
    return 'user_images_{0}/{1}'.format(instance.public_id, filename)

"""
User model that enables user information to be stored within the database
"""
class User(AbstractBaseUser, AbstractModel, PermissionsMixin):
    username = models.CharField(db_index=True, max_length=255, unique=True)
    first_name = models.CharField(max_length=255)
    last_name = models.CharField(max_length=255)
    bio = models.TextField(null=True, blank=True)
    avatar = models.ImageField(upload_to=user_directory_path, null=True, blank=True)
    email = models.EmailField(db_index=True, unique=True)
    is_active = models.BooleanField(default=True)
    is_superuser = models.BooleanField(default=False)
    is_staff = models.BooleanField(default=False)  # Required for admin access
    posts_liked = models.ManyToManyField("core_post.post", related_name="liked_by")

    USERNAME_FIELD = 'email'
    REQUIRED_FIELDS = ['username']

    objects = UserManager()

    def __str__(self):
        return f"{self.email}"
    
    def like(self, post):
        """Add a like to a post from a specific user when it does not exist."""
        if not self.has_liked(post): 
            self.posts_liked.add(post)
    
    def remove_like(self, post):
        """Remove a like from a post by a specific user."""
        if self.has_liked(post):
            self.posts_liked.remove(post)
    
    def has_liked(self, post):
        """Return True if the user has liked a post, else False."""
        return self.posts_liked.filter(pk=post.pk).exists()
    
    @property
    def name(self):
        return f"{self.first_name} {self.last_name}"
