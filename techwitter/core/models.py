import uuid
from django.db import models
from django.contrib.auth import get_user_model
from datetime import datetime

User = get_user_model()

# Create your models here
class Profile(models.Model):
    user = models.ForeignKey(User, on_delete=models.CASCADE)
    id_user = models.IntegerField()
    bio = models.TextField(blank=True)
    avi = models.ImageField(upload_to="profile_mages", default="")
    location = models.CharField(max_length=100, blank=True)

    def __str__(self):
        return self.user.username
    
class Post(models.Model):
    id = models.UUIDField(primary_key=True,default=uuid.uuid4)
    author = models.CharField(max_length=100)
    image =models.ImageField(upload_to='post_images')
    title = models.TextField(max_length=250)
    body=models.TextField()
    created_at=models.DateField(auto_now=datetime.now())
    likes= models.IntegerField(default=0)
    def __str__(self):
        return f"{self.title}, by {self.author}"
