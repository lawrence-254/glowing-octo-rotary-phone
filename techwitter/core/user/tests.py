import pytest

from core.user.models import User

data_user ={
    'username': 'testuser',
    'email': 'test@mail.com',
    'password': 'testpassword',
    'first_name': 'test',
    'last_name': 'user'
}

@pytest.mark.django_db
def test_create_user():
    user = User.objects.create_user(**data_user)
    assert user.username == data_user['username']
    assert user.email == data_user['email']
    assert user.first_name == data_user['first_name']
    assert user.last_name == data_user['last_name']
    assert user.is_active == True
    assert user.is_staff == True
    assert user.is_superuser == False
    assert user.check_password(data_user['password']) == True