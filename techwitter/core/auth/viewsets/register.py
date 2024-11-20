from rest_framework.response import Response
from rest_framework.viewsets import ViewSet
from rest_framework.permissions import AllowAny
from rest_framework import status
from rest_framework_simplejwt.tokens import RefreshToken
from core.auth.serializers.register import RegisterSerializer

class RegisterViewSet(ViewSet):
    serializer_class = RegisterSerializer
    permission_classes = (AllowAny,)
    http_method_names = ['post']

    def create(self, request, *args, **kwargs):
        """
        Handle user registration by validating the data and creating a user.
        Returns the user's data and JWT tokens.
        """
        try:
            # Initialize the serializer with the incoming request data
            serializer = self.serializer_class(data=request.data)
            
            # Validate the data and raise exceptions if invalid
            serializer.is_valid(raise_exception=True)
            
            # Save the new user
            user = serializer.save()
            
            # Create JWT tokens for the new user
            refresh = RefreshToken.for_user(user)
            
            # Prepare the response data
            response_data = {
                "user": serializer.data,
                "refresh": str(refresh), 
                "access": str(refresh.access_token),
            }
            
            return Response(response_data, status=status.HTTP_201_CREATED)
        
        except Exception as e:
            # Print the error to the console
            print(f"Error in RegisterViewSet.create: {e}")
            
            # Return a generic error response
            return Response(
                {"error": "An error occurred during registration. Please try again."},
                status=status.HTTP_400_BAD_REQUEST
            )

