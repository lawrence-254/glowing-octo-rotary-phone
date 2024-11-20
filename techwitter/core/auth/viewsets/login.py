from rest_framework.response import Response
from rest_framework.viewsets import ViewSet
from rest_framework.permissions import AllowAny
from rest_framework import status
from rest_framework_simplejwt.exceptions import TokenError, InvalidToken

from core.auth.serializers import LoginSerializer


class LoginViewSet(ViewSet):
    """
    A ViewSet for handling user login using JWT authentication.
    """
    serializer_class = LoginSerializer
    permission_classes = [AllowAny]
    http_method_names = ['post']

    def create(self, request, *args, **kwargs):
        serializer = self.serializer_class(data=request.data)
        try:
            serializer.is_valid(raise_exception=True)
            return Response(serializer.validated_data, status=status.HTTP_200_OK)
        except TokenError as e:
            # Handles invalid token errors
            print(e)
            raise InvalidToken(detail=str(e))
        except Exception as e:
            # General error handling for unexpected exceptions
            print(e)
            return Response(
                {"error": "An unexpected error occurred.", "details": str(e)},
                status=status.HTTP_400_BAD_REQUEST
            )
