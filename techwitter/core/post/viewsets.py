from rest_framework import status
from rest_framework.permissions import IsAuthenticated
from rest_framework.response import Response
from rest_framework.decorators import action

from core.abstract.viewsets import AbstractViewSet
from core.post.models import Post
from core.post.serializers import PostSerializer


class PostViewSet(AbstractViewSet):
    http_method_names = ('post', 'get', 'put', 'delete')
    permission_classes = (IsAuthenticated,) 
    serializer_class = PostSerializer

    def get_queryset(self):
        return Post.objects.all()
    
    def get_object(self):
        obj = Post.objects.filter(public_id=self.kwargs['pk']).first() 
        if not obj:
            from rest_framework.exceptions import NotFound
            raise NotFound("Post not found")
        self.check_object_permissions(self.request, obj)
        return obj
    
    def create(self, request, *args, **kwargs):
        serializer = self.get_serializer(data=request.data)
        serializer.is_valid(raise_exception=True)
        self.perform_create(serializer)
        return Response(
            serializer.data, status=status.HTTP_201_CREATED
        )
    
    @action(methods=['post'], detail=True)
    def like(self, request, *args, **kwargs):
        post = self.get_object()
        user = self.request.user
        user.like(post)
        serializer = self.get_serializer(post, context={'request': request})
        return Response(
            serializer.data, status=status.HTTP_200_OK
        )
    
    @action(methods=['post'], detail=True)
    def remove_like(self, request, *args, **kwargs):
        post = self.get_object()
        user = self.request.user
        user.remove_like(post)  # Assuming `remove_like` is a method on the User model
        serializer = self.get_serializer(post, context={'request': request})
        return Response(
            serializer.data, status=status.HTTP_200_OK
        )
