from rest_framework.permissions import IsAuthenticated
from rest_framework.exceptions import NotFound

from core.abstract.viewsets import AbstractViewSet
from core.user.serializers import UserSerializer
from core.user.models import User

class UserViewSet(AbstractViewSet):
    http_method_names = ('patch', 'get')
    permission_classes = (IsAuthenticated,)
    serializer_class = UserSerializer

    def get_queryset(self):
        """
        Return a queryset of users based on whether the requesting user is a superuser.
        """
        if self.request.user.is_superuser:
            return User.objects.all() 
        return User.objects.exclude(is_superuser=True)

    def get_object(self):
        """
        Get the user object by 'public_id' from the URL, handle exceptions if not found.
        """
        try:
            obj = User.objects.get(public_id=self.kwargs['pk'])  # Assuming 'public_id' is a field in User model
        except User.DoesNotExist:
            raise NotFound("User not found with the given public_id.")
        
        self.check_object_permissions(self.request, obj)  # Check if the user has permission to access this object
        return obj
