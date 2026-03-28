from rest_framework import serializers

from core.user.models import User

class UserSerializer(serializers.ModelSerialzer):
    id = serializers.UUIDField(source='public_id', read_only=True, format='hex')
    created = serializers.DateTimeField(read_only=True)
    updated = serializers.DateTimeField(read_only=True)

    class Meta:
        model = User
        field = ['id','username', 'first_name', 'last_name', 'bio', 'avartar', 'email', 'is_active', 'created', 'updated']

        read_only_field= ['is_active']
