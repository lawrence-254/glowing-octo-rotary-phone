import pytest

from core.user.models import User

# data_user={
#     "username": "user",
#     "email": "test@testing.mail",
#     "firstname": "test",
#     "lastname": "user",
#     "password": "12_not@realpassword"
# }
data_user ={
    'username': 'testuser',
    'email': 'test@mail.com',
    'password': 'testpassword',
    'first_name': 'test',
    'last_name': 'user'
}

@pytest.fixture
def user(db) ->User:
    return User.objects.create_user(**data_user)