from django.db import models
from core.abstract.models import AbstractModel, AbstractManager

class CommentManager(AbstractManager):
    pass
"""
files functions
"""
def comment_directory_path(instance, filename):
    # locatio that the file will be uploaded to is MEDIA_ROOT/comment_<id>/<filename>
    return 'comment_images_/{0}/{1}'.format(instance.public_id, filename)

class Comment(AbstractModel):
    title = models.CharField(max_length=150, blank=True, null=True)
    body = models.TextField()
    author = models.ForeignKey("core_user.User", on_delete=models.PROTECT)
    images =models.ImageField(upload_to=comment_directory_path, blank=True, null=True)
    post = models.ForeignKey("core_post.Post", on_delete=models.PROTECT)
    edited = models.BooleanField(default=False)

    objects = CommentManager()

    def __str__(self):
        return self.author.name
    
    class Meta:
        db_table = "core_comment" 
