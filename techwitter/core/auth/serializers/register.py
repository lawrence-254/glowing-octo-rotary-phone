from rest_framework import serializers

from core.user.serializers import UserSerializer
from core.user.models import User

class RegisterSerializer(UserSerializer):
    """
    serializer that requests user registrations
    """
    password = serializers.CharField(max_length=120, min_length=8, write_only=True, required=True)

    class Meta:
        model =User
        fields = ['id', 'username', 'first_name', 'last_name', 'email', 'password']
        # fields = ['id', 'username', 'first_name', 'last_name', 'bio', 'avatar', 'email', 'password']

    def create(self, validated_data):
        return User.objects.create_user(**validated_data)
