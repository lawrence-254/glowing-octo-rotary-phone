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
    print(context)
    if request.method =='POST':
        email = request.POST['email']
        username= request.POST['username']
        password = request.POST['password']
        confirm_password = request.POST['confirmPassword']
        if password == confirm_password:
            if User.objects.filter(email=email).exists():
                messages.info(request,'Email is taken, please try another email')
                return redirect('regster')
            elif User.objects.filter(username=username).exists():
                messages.info(request, 'Username is taken, Please try another one')
                return redirect('register')
            else:
                user = User.objects.create_user(email=email, username=username, password=password)
                user.save()
                # log user in and create a profile object

                user_model =User.objects.get(username=username)
                new_profile =Profile.objects.create(user=user_model, id_user=user_model.id)
                new_profile.save()
                return redirect('login')
        else:
            messages.info(request, 'Passwords has to match')
            return redirect('register')
    else:
        return render(request, 'core/auth/register.html', context)

def login(request):
    context={'title':'LOGIN'}
    if request.method == 'POST':
        email_or_username = request.POST['emailname']
        password = request.POST['password']

        if not email_or_username:
            messages.info(request, 'Please provide an email, or username')
            return redirect('login')
        elif not password:
            messages.info(request, 'Please provide a password')
            return redirect('login')
        else:
            try:
                user = User.objects.get(email=email_or_username)
            except User.DoesNotExist:
                try:
                    user =User.objects.get(username=email_or_username)
                except User.DoesNotExist:
                    user = None
                    messages.error(request, 'User not found, ensure your details are correct')
                    return redirect('login')
            if user:
                user = auth.authenticate(request, username=user.username, password=password)
                print(user)
                if user is not None:
                    auth.login(request, user)
                    return redirect('home')
                else:
                    messages.error(request, 'Wrong password')
                    return redirect('login')
    else:
        return render(request, 'core/auth/login.html', context)

def logout(request):
    pass