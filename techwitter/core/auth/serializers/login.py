from rest_framework_simplejwt.serializers import TokenObtainPairSerializer
from rest_framework_simplejwt.settings import api_settings
from django.contrib.auth.models import update_last_login
from core.user.serializers import UserSerializer

class LoginSerializer(TokenObtainPairSerializer):
    def validate(self, attrs):
        """
        Custom validate method for handling JWT login and including user data.
        """
        # Call the parent class's validate method to generate the tokens
        data = super().validate(attrs)

        # Get the refresh token
        refresh = self.get_token(self.user)

        # Serialize the user data and add it to the response
        data['user'] = UserSerializer(self.user).data
        data['refresh'] = str(refresh)  # The refresh token as a string
        data['access'] = str(refresh.access_token)  # The access token as a string

        # Optionally update the last login if the setting is enabled
        if api_settings.UPDATE_LAST_LOGIN:
            update_last_login(None, self.user)  # No request object needed, just the user

        return data
