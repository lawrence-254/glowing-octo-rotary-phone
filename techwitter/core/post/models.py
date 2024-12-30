from django.db import models
from django.contrib.auth.models import PermissionsMixin


from core.abstract.models import AbstractModel, AbstractManager

# Create your models here.
class PostManager(AbstractManager):
    pass

"""
files functions
"""
def post_directory_path(instance, filename):
    # location that the file will be uploaded to is MEDIA_ROOT/post_<id>/<filename>
    return 'post_images_/{0}/{1}'.format(instance.public_id, filename)

class Post(AbstractModel):
    author = models.ForeignKey(
        to="core_user.User", 
        on_delete=models.CASCADE
    )
    title = models.CharField(max_length=200, blank=True, null=True)
    image = models.ImageField(
        upload_to=post_directory_path, 
        blank=True, 
        null=True 
    )
    body = models.TextField()
    edited = models.BooleanField(default=False)

    objects = PostManager()

    def __str__(self):
        return f"{self.author.name}" 

    class Meta:
        db_table = "techwitter_post" 
