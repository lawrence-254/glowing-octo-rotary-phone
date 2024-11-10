from django.db import models
from core.abstract.models import AbstractModel, AbstractManager

class CommentManager(AbstractManager):
    pass

class Comment(AbstractModel):
    title = models.CharField(max_length=150)
    body = models.TextField()
    author = models.ForeignKey("core_user.User", on_delete=models.PROTECT)
    post = models.ForeignKey("core_post.Post", on_delete=models.PROTECT)
    edited = models.BooleanField(default=False)

    objects = CommentManager()

    def __str__(self):
        return self.author.name