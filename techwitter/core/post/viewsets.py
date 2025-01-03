from rest_framework import status
from rest_framework.permissions import IsAuthenticated
from rest_framework.response import Response
from rest_framework.decorators import action
from rest_framework.parsers import MultiPartParser, FormParser, JSONParser


from core.abstract.viewsets import AbstractViewSet
from core.post.models import Post
from core.post.serializers import PostSerializer

from django.views.decorators.csrf import csrf_exempt

import logging
logger = logging.getLogger(__name__)

class PostViewSet(AbstractViewSet):
    http_method_names = ('post', 'get', 'put', 'delete')
    permission_classes = (IsAuthenticated,)
    parser_classes = [MultiPartParser, FormParser, JSONParser]
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

  
    @csrf_exempt
    def create(self, request, *args, **kwargs):
        serializer = PostSerializer(data=request.data)
        if serializer.is_valid():
            serializer.save()
            return Response(serializer.data, status=201)
        return Response(serializer.errors, status=400)
        # try:
        #     logger.debug(f"Request data: {request.data}")
        #     # title=  request.POST.get("title")
        #     # author= request.POST.get("author")
        #     # body= request.POST.get("body"),
        #     # image= request.FILES.get("image")

        #     # postData ={
        #     #     author: author,
        #     #     title: 
        #     # }
        #     # return Response(
        #     #     print(f"image: {image}\n author: {author}\n body: {body}\n title: {title}"),
        #     #     print(request.POST)
        #     # )
        #     serializer = self.get_serializer(data=request.data)
        #     serializer.is_valid(raise_exception=True)
        #     self.perform_create(serializer)
        #     return Response(
        #         serializer.data, {"message": "Post Created successfully"}, status=status.HTTP_201_CREATED
        #     )
        # except Exception as e:
        #     return Response({"error ": str(e)}, status=status.HTTP_400_BAD_REQUEST)
    
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

