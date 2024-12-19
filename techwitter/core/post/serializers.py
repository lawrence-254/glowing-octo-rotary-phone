from rest_framework import serializers
from rest_framework.exceptions import ValidationError

from core.abstract.serializers import AbstractSerializer
from core.post.models import Post
from core.user.models import User
from core.user.serializers import UserSerializer

from django.conf import settings

class PostSerializer(AbstractSerializer):
    author = serializers.SlugRelatedField(
        queryset=User.objects.all(),
        slug_field='public_id'
    )
    liked = serializers.SerializerMethodField()
    likes_count = serializers.SerializerMethodField()
    
    def validate_author(self, value):
        if self.context["request"].user != value:
            raise ValidationError("You can only create posts for your own account.")
        return value
    
    def to_representation(self, instance):
        rep = super().to_representation(instance)
        # Fetch author details by public_id
        author = User.objects.filter(public_id=rep["author"]).first()
        if settings.DEBUG:
            request = self.context.get('request')
            rep['image']= request.build_absolute_uri(rep['image'])
        if author:
            rep["author"] = UserSerializer(author).data
        return rep
    
    def update(self, instance, validated_data):
        if not instance.edited:
            validated_data['edited'] = True 
        instance = super().update(instance, validated_data)
        return instance
    
    def get_liked(self, instance):
        request = self.context.get('request', None)
        if not request or request.user.is_anonymous:
            return False
        return request.user.has_liked(instance)
    
    def get_likes_count(self, instance):
        # Assuming 'liked_by' is a ManyToMany field
        return instance.liked_by.count()
    
    class Meta:
        model = Post
        fields = [
            'id', 'author', 'title', 'image', 'body', 'edited', 
            'created_at', 'updated_at', 'liked', 'likes_count'
        ]
        read_only_fields = ['id', 'created_at', 'updated_at', 'edited']
