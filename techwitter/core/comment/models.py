from django.db import models
from core.abstract.models import AbstractModel, AbstractManager

class CommentManager(AbstractManager):
    pass

class Comment(AbstractModel):
    title = models.CharField(max_length=150)
    body = models.TextField()
    author = 
