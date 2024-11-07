from rest_framework import serializers
from rest_framework.exceptions import ValidationError

from core.abstract.serializers import AbstractSerializer
from core.post.models import Post
from core.user.models import User

class PostSerializer(AbstractSerializer):
    author = serializers.SlugRelatedField(queryset=User.objects.all(), slug_field='public_id')
    
    def validate_author(self, value):
        if self.context["request"].user != value:
            raise ValidationError("You need to have an account to create a post")
        return value
    
    class Meta:
        model = Post
        fields = ['id', 'author', 'title', 'image', 'body', 'edited', 'created_at', 'updated_at']
        read_only_fields = ["edited"]