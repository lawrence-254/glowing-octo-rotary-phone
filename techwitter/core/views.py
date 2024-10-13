from django.shortcuts import render, redirect
from django.contrib.auth.models import User, auth
from django.contrib import messages
from .models import Profile, Post,Comment
from django.contrib.auth.decorators import login_required
from django.http import HttpResponse


#Authentication
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
                return redirect('register')
            elif User.objects.filter(username=username).exists():
                messages.info(request, 'Username is taken, Please try another one')
                return redirect('register')
            else:
                user = User.objects.create_user(email=email, username=username, password=password)
                user.save()
                # log user in and create a profile object
                user_login = auth.authenticate(username=username, password=password)
                if user_login is not None:
                    auth.login(request, user_login)
                    user_model = User.objects.get(username=username)
                    new_profile = Profile.objects.create(user=user_model, id_user=user_model.id)
                    new_profile.save()
                    return redirect('settings')
                else:
                    messages.info(request, 'Authentication failed, please try again')
                    return redirect('register')
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

@login_required(login_url='index')
def logout(request):
    auth.logout(request)
    return redirect('login')

def reset_password(request):
    context = {'title': 'RESET'}
    return render(request, 'core/auth/reset.html', context)

#end of authentication

#profile action
@login_required(login_url='index')
def settings(request):
    
    user_profile=Profile.objects.get(user=request.user)
    context= {
        'title': 'PROFILE SETTINGS',
        'user_profile': user_profile 
        }
    if request.method == 'POST':
        if request.FILES.get('avi') == None:
            image = user_profile.avi
            bio = request.POST['bio']
            location =request.POST['location']

            user_profile.avi = image
            user_profile.bio = bio
            user_profile.location = location
            user_profile.save()

        if request.FILES.get('avi') != None:
            image = request.FILES.get('avi')
            bio = request.POST['bio']
            location =request.POST['location']

            user_profile.avi = image
            user_profile.bio = bio
            user_profile.location = location
            user_profile.save()
        return redirect('settings')
    return render(request, 'core/profile/settings.html', context)


@login_required(login_url='index')
def profile(request):
    user_object = User.objects.get(username=request.user.username)
    profile_object = Profile.objects.get(user=user_object)
    context={
        'title': 'PROFILE',
        'user_profile': profile_object,
             }
    return render(request, 'core/profile/profile.html', context)

# end of profile action
# views
def index(request):
    return render(request, 'core/index.html')

@login_required(login_url='index')
def home(request):
    user_object = User.objects.get(username=request.user.username)
    profile_object = Profile.objects.get(user=user_object)
    post_object = Post.objects.all()
    context= {
        'title':'Home',
        'user_profile': profile_object,
        'post_object': post_object
              }
    # print(post_object)
    # print(profile_object)
    # for p in post_object:
    #     print(p)
    return render(request, 'core/home.html', context)
# end of views

# post actions
@login_required(login_url='index')
def create(request):
    if request.method == 'POST':
        author = request.user.username
        image= request.FILES.get('post_image')
        title= request.POST.get('title')
        body= request.POST.get('body')
        if image:
            new_post = Post.objects.create(author=author, image=image, title=title, body=body)
        else: 
            new_post = Post.objects.create(author=author, title=title, body=body)
        print(new_post, 'from create')
        new_post.save()
        if new_post:
            return redirect('home')
        else:
            print('post not created')
    context={'title': 'NEW POST'}
    return render(request, 'core/post/create.html', context)


    
@login_required(login_url='index')
def view_post(request):
    
    post_id=request.post.id
    post_object = Post.objects.filter(id=post_id)
    post_comment_object = Comment.objects.filter(post=post_id)
    context = {
        'post': post_object,
        'post_comment': post_comment_object
    }

    return render(request, 'core/post/view.html', context)


@login_required(login_url='index')
def comment(request):
    if request.method == 'POST':
        post = request.post.id
        author = request.user.username
        image = request.FILES.get('comment_image')
        title= request.POST.get['title']
        body = request.POST.get['comment_body']
        if image:
            new_comment = Comment.objects.create(post=post, author=author, image=image,title=title, body=body)
        else:
            new_comment = Comment.objects.create(post=post, author=author, title=title, body=body)

        post_comment = new_comment.save()
        # return post_comment
    else:
        return redirect('core/post/view.html')
    
    context = {
        'comment': post_comment
    }
    return render(request, 'core/post/view.html', context)
        
# end of post actions