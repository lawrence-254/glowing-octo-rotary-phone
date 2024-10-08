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
    path('profile', views.profile, name='profile'),
    # post actions
    path('create', views.create, name='create'),
]
