from django.urls import path
from . import views

urlpatterns = [
    path('', views.index, name='index'),
    path('home', views.home, name='home'),
    path('register', views.register, name='register'),
    path('login', views.login, name='login'),
    path('logout', views.logout, name='logout'),
    path('reset', views.reset_password, name='reset'),
    path('settings', views.settings, name='settings'),
    path('profile/<str:pk>', views.profile, name='profile'),
    path('follow', views.follow, name='follow'),
    # post actions
    path('create', views.create, name='create'),
    path('like-post', views.like_post, name='like-post'),
    path('view', views.view_post, name='view'),
    # comment
    path('comment', views.comment, name='comment'),
    path('like-comment', views.like_comment, name='like-comment'),
]
