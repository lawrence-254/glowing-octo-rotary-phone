from rest_framework import status

from core.fixtures.user import user
from core.fixtures.comment import comment
from core.fixtures.post import post

class TestCommentViewSet:
    endpoint = '/api/post/'

    def test_list(self, client, user, post, comment):
        client.force_authenticate(user=user)
        response = client.get(self.endpoint + str(post.public_id) + "/comment/")

        assert response.status_code == status.HTTP_200_OK
        assert response.data["count"] == 1

    def test_retrieve(self, client, user, post, comment):
        client.force_authenticate(user=user)
        response = client.get(self.endpoint + str(post.public_id) + "/comment/" + str(comment.public_id) + "/")

        assert response.status_code == status.HTTP_200_OK
        assert response.data['id'] == comment.public_id.hex
        assert response.data['title'] == comment.title
        assert response.data['body'] == comment.body
        assert response.data['author']['id'] == comment.author.public_id.hex

    def test_create(self, client, user, post):
        client.force_authenticate(user=user)
        data = {
            "title": "Test Comment Title",
            "body": "Test Comment Body",
            "author": user.public_id.hex,
            "post": post.public_id.hex
        }
        response = client.post(self.endpoint + str(post.public_id) + "/comment/", data)

        assert response.status_code == status.HTTP_201_CREATED
        assert response.data['title'] ==data['title']
        assert response.data['body'] == data['body']
        assert response.data['author']['id'] == user.public_id.hex

    def test_update(self, client,user, post, comment):
        client.force_authenticate(user=user)
        data={
            "title": "Test Comment Title",
            "body": "Test Comment Body",
            "author": user.public_id.hex,
            "post": post.public_id.hex
        }
        response =client.put(self.endpoint + str(post.public_id) + "/comment/" + str(comment.public_id) + "/", data)

        assert response.status_code == status.HTTP_200_OK
        assert response.data['title'] == data['title']
        assert response.data['body'] == data['body']


    def test_delete(self, client, user, post, comment):
        client.force_authenticate(user=user)
        response = client.delete(self.endpoint + str(post.public_id) + "/comment/" + str(comment.public_id) + "/")

        assert response.status_code == status.HTTP_204_NO_CONTENT


    def test_list_anonymous(self, client, post, comment):
        response = client.get(self.endpoint + str(post.public_id) + "/comment/")
        assert response.status_code == status.HTTP_200_OK
        assert response.data["count"] == 1

    def test_retrieve_anonymous(self, client, post, comment):
        response = client.get(self.endpoint + str(post.public_id) + "/comment/" + str(comment.public_id) + "/")
        assert response.status_code == status.HTTP_200_OK

    def test_create_anonyous(self, client, post, comment):
        data={
            "title": "Test Comment Title",
            "body": "Test Comment Body",
            "post": post.public_id.hex
        }
        response = client.post(self.endpoint + str(post.public_id) + "/comment/", data)
        # assert response.status_code == status.HTTP_401_UNAUTHORIZED
        assert response.status_code == status.HTTP_400_BAD_REQUEST

    def test_update_anonymous(self, client, post, comment):
        data={
            "title": "Test Comment Title",
            "body": "Test Comment Body",
            "post": post.public_id.hex
        }
        response = client.put(self.endpoint + str(post.public_id) + "/comment/" + str(comment.public_id)+ "/", data)
        # assert response.status_code == status.HTTP_401_UNAUTHORIZED
        assert response.status_code == status.HTTP_400_BAD_REQUEST

    def test_delete_anonymous(self, client, post, comment):
        response = client.delete(self.endpoint + str(post.public_id) + "/comment/" + str(comment.public_id) +"/")
        assert response.status_code == status.HTTP_401_UNAUTHORIZED