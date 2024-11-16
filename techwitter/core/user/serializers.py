from rest_framework import serializers
from core.user.models import User

from core.abstract.serializers import AbstractSerializer

# class UserSerializer(serializers.ModelSerializer):
class UserSerializer(AbstractSerializer):
    id = serializers.UUIDField(source='public_id', read_only=True, format='hex')
    created_at = serializers.DateTimeField(read_only=True)
    updated_at = serializers.DateTimeField(read_only=True)

    class Meta:
        model = User
        # fields = ['id', 'username', 'first_name', 'last_name', 'email', 'is_active', 'created_at', 'updated_at']
        fields = ['id', 'username', 'first_name', 'last_name', 'bio', 'avatar', 'email', 'is_active', 'created_at', 'updated_at']
        read_only_field=['is_active']