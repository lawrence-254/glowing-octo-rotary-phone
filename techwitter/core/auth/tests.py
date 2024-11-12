import pytest

from rest_framework import status

from core.fixtures.user import user

from core.user.models import User

class TestAuthenticationViewSet:
    endpoint = '/api/auth/'

    def test_login(self, client, user):
        data={
            "email": user.email,
            "password" : "testpassword"
        }

        response = client.post(self.endpoint + "login/", data)

        assert response.status_code == status.HTTP_200_OK
        assert response.data['access']
        assert response.data['user']['id'] == user.public_id.hex
        assert response.data['user']['username'] == user.username
        assert response.data['user']['email'] == user.email
    
    def test_register(self, client, db):
        data={
            "username": "johnDoe",
            "email": "john@doe.mail",
            "password": "testpassword",
            "first_name": "john",
            "last_name": "doe"
        }

        response = client.post(self.endpoint + "register/", data)

        assert response.status_code == status.HTTP_201_CREATED

    