from django.urls import path
from . import views

urlpatterns = [
    path('', views.index, name=''),
    path('home', views.home, name='home'),
    path('register', views.register, name='register'),
    path('login', views.login, name='login'),
    path('logout', views.logout,  name='logout'),
    path('reset', views.reset_password, name='reset'),
    path('settings', views.settings, name='settings'),
    path('billing', views.billing, name='billing'),
    path('notification',views.notification,name='notification'),
    path('privacy', views.privacy, name='privacy'),
    path('profile', views.profile, name='profile'),
    path('security', views.security, name='security'),
    path('secial_links', views.social_links, name='social_links'),
    # post actions
    path('create', views.create, name='create'),
]