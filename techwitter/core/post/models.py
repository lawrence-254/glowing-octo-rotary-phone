from django.db import models
from core.abstract.models import AbstractModel, AbstractManager

# Create your models here.
class PostManager(AbstractManager):
    pass

class Post(AbstractModel):
    author= models.ForeignKey(to="core_user.User", on_delete=models.CASCADE)
    title = models.CharField(max_length=200)
    image =models.ImageField(upload_to='post_images', default="")
    body = models.TextField()
    edited = models.BooleanField(default=False)

    objects = PostManager()
    def __str__(self):
        return f"{self.author.name}"
    
    class Meta:
        db_table = "'techwitter.post"