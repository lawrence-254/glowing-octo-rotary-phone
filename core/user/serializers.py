from core.abstraction.serializer import AbstractSerializer
from core.user.models import User

class UserSerializer(AbstractSerializer):

    class Meta:
        model = User
        field = ['id','username', 'first_name', 'last_name', 'bio', 'avartar', 'email', 'is_active', 'created', 'updated']

        read_only_field= ['is_active']
