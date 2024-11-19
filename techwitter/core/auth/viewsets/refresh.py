from rest_framework.response import Response
from rest_framework_simplejwt.views import TokenRefreshView
from rest_framework.permissions import AllowAny
from rest_framework import status, viewsets
from rest_framework_simplejwt.exceptions import TokenError, InvalidToken


class RefreshViewSet(viewsets.ViewSet, TokenRefreshView):
    """
    A ViewSet for refreshing JWT tokens.
    """
    permission_classes = [AllowAny]
    http_method_names = ['post']

    def create(self, request, *args, **kwargs):
        serializer = self.get_serializer(data=request.data)

        try:
            serializer.is_valid(raise_exception=True)
            return Response(serializer.validated_data, status=status.HTTP_200_OK)
        except TokenError as e:
            # Handles invalid token errors
            raise InvalidToken(detail=str(e))
        except Exception as e:
            # Handles unexpected errors gracefully
            return Response(
                {"error": "An unexpected error occurred.", "details": str(e)},
                status=status.HTTP_400_BAD_REQUEST
            )
