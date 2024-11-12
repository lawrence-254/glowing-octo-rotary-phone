from rest_framework import status

from core.fixtures.user import user
from core.fixtures.post import post

class TestPostViewSet:
    endpoint = '/api/post/'