from django.shortcuts import render, redirect
from django.contrib.auth.models import User, auth
from django.contrib import messages
from .models import Profile
from django.http import HttpResponse

def home(request):
    context= {'title':'Home'}
    return render(request, 'core/home.html', context)

def register(request):
    context={'title':'REGISTER'}

    if request.method =='POST':
        email = request.POST['email']
        username= request.POST['username']
        password = request.POST['password']
        confirm_password = request.POST['confirmPassword']
        if password == confirm_password:
            hashed_password = ''
            if User.objects.filter(email=email).exists():
                messages.info(request,'Email is taken, please try another email')
                return redirect('regster')
            elif User.objects.filter(username=username).exists():
                messages.info(request, 'Username is taken, Please try another one')
                return redirect('register')
            else:
                user = User.objects.create_user(email=email, username=username, password=hashed_password)
                user.save()
                # log user in and create a profile object

                user_model =User.objects.get(username=username)
                new_profile =Profile.objects.create_user(user=user_model, id_user=user_model.id)
        else:
            messages.info(request, 'Passwords has to match')
            return redirect('register')
        print(username)
        print(email)
        print(password)
        print(confirm_password)
    else:
        return render(request, 'core/auth/register.html', context)
    return render(request, 'core/auth/register.html', context)

def login(request):
    context={'title':'LOGIN'}
    if request.method == 'POST':
        email_or_username = request.POST['emailname']
        password = request.POST['password']
        print(email_or_username)
        print(password)
    else:
        return render(request, 'core/auth/login.html', context)
    return render(request, 'core/auth/login.html', context)