from rest_framework import status
from rest_framework import status


from core.fixtures.user import user
from core.fixtures.post import post

class TestPostViewSet:
    endpoint = '/api/post/'

    def test_list(self, client, user, post):
        client.force_authenticate(user=user)
        response = client.get(self.endpoint)
        assert response.status_code == status.HTTP_200_OK
        assert response.data["count"] == 1

    def test_retrieve(self, client, user, post):
        client.force_authenticate(user=user)
        response = client.get(self.endpoint + str(post.public_id) + "/")
        assert response.status_code == status.HTTP_200_OK
        assert response.data['id'] == post.public_id.hex
        assert response.data['body'] == post.body
        assert response.data['author']['id'] == post.author.public_id.hex

    # def test_create(self, client, user):
    #     client.force_authenticate(user=user)
    #     data = {
    #         "title":"Test Post Title",
    #         "body": "Test Post Body",
    #         "author": user.public_id.hex
    #     }

    #     response = client.post(self.endpoint, data)
    #     assert response.status_code == status.HTTP_201_CREATED
    #     assert response.data['body'] == data['body']
    #     assert response.data['title']  == data['title']
    #     assert response.data['author']['id'] == user.public_id.hex

    def test_update(self, client, user, post):
        client.force_authenticate(user=user)
        data = {
            "title": "Test Post Title Update",
            "body": "Test Post Body Update",
            "author": user.public_id.hex
        }
        response = client.put(self.endpoint + str(post.public_id) + "/", data)

        assert response.status_code == status.HTTP_200_OK
        assert response.data['body'] == data['body']
        assert response.data['title'] == data['title']

    def test_delete(self, client, user, post):
        client.force_authenticate(user=user)
        response = client.delete(self.endpoint + str(post.public_id) + "/")
        assert response.status_code == status.HTTP_204_NO_CONTENT


    """Test for non-registered/anonymous users users"""
    def test_list_anonymous(self, client, post):
        response = client.get(self.endpoint)
        assert response.status_code == status.HTTP_200_OK
        assert response.data["count"] == 1

    def test_retrieve_anonymous(self, client, post):
        response = client.get(self.endpoint + str(post.public_id) + "/")
        assert response.status_code == status.HTTP_200_OK
        assert response.data['id'] == post.public_id.hex
        assert response.data['title'] == post.title
        assert response.data['body'] == post.body
        assert response.data['author'] == post.author.public_id.hex

    def test_create_anonymous(self, client):
        data = {
            "Body": "Test Body Anonymous",
            "title": "Test Title Anonymous",
            "author": "test_anonymous_user"
        }
        response = client.post(self.endpoint, data)
        assert response.status_code == status.HTTP_401_UNAUTHORIZED

    def test_update_anonymous(self, client, post):
        data = {
            "Body": "Test Body Anonymous",
            "title": "Test Title Anonymous",
            "author": "test_anonymous_user"
        }
        response = client.put(self.endpoint + str(post.public_id) + "/", data)
        assert response.status_code == status.HTTP_401_UNAUTHORIZED

    def test_delete_anonymous(self, client, post):
        
        response = client.delete(self.endpoint + str(post.public_id) + "/")
        assert response.status_code == status.HTTP_401_UNAUTHORIZED