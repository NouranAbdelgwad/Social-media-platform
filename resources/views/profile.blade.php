@extends('layouts.layout')
@section('title', 'welcome')

@section('content')
    <div class="container">
        @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('info'))
    <div class="alert alert-info">
        {{ session('info') }}
    </div>
@endif

        @if (Auth::user()->id == $user->id)
            <form action="/edit/profile/{{ Auth::user()->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="profile-page d-flex justify-content-between">
                    <div class="img-container">
                        <img id="profile-image" class="profile-image" src="{{ asset('storage/' . $user->picture_path) }}"
                            alt="profile image">
                        <!-- File input hidden -->
                        <input type="file" id="file-input" name="picture_path" accept="image/*" style="display: none;"
                            required>
                        <!-- Label with SVG that triggers file input -->
                        <label class="bg-light" for="file-input">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                class="bi bi-pencil" viewBox="0 0 16 16">
                                <path
                                    d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325" />
                            </svg>
                        </label>
                    </div>
                    <div class="form-container">
                        <div class="w-100 p-3">
                            <h5>Username</h5>
                            <input type="text" name="name" value="{{ $user->name }}" class="form-control">
                            <br>
                            <h5>Email</h5>
                            <input type="text" name="email" value="{{ Auth::user()->email }}" class="form-control">
                            <br>
                            <h5>Bio</h5>
                            <input type="text" name="bio" value="{{ $user->bio }}" class="form-control">
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="main-btn w-30 save-changes">Save Changes</button>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between w-50 m-auto mt-3">
                            <div class="text-center">
                                <h5>Followers</h5>
                                <h6>{{ $followersCount }}</h6>
                            </div>
                            <div class="text-center">
                                <h5>Following</h5>
                                <h6>{{ $followingCount }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        @else
            <div class="profile-page">
                <img id="profile-image" class="profile-image" src="{{ asset('storage/' . $user->picture_path) }}"
                    alt="profile image">
                <div class="form-container">
                    <h1>{{ $user->name }}</h1>
                    <h3>{{ $user->email }}</h3>
                    <p>{{$user->bio}}</p>
                    <div class="d-flex justify-content-between w-50  mt-3">
                        <div class="text-center">
                            <h5>Followers</h5>
                            <h6>{{ $followersCount }}</h6>
                        </div>
                        <div class="text-center">
                            <h5>Following</h5>
                            <h6>{{ $followingCount }}</h6>
                        </div>
                    </div>
                    @if(DB::table('friends')->where('user_id', Auth::user()->id)->where('friend_user_id', $user->id)->exists())
                    <form action="{{ route('unfollow', ['id' => $user->id]) }}" method="POST">
                        @csrf
                        <button class="main-btn m-2" type="submit" style="width: 20%; align-self: center;">Unfollow</button>
                    </form>
                @else
                    <form action="{{ route('follow', ['id' => $user->id]) }}" method="POST">
                        @csrf
                        <button class="main-btn m-2" type="submit" style="width: 20%; align-self: center;">Follow</button>
                    </form>
                @endif


                </div>

            </div>
        @endif
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Posts</a>
            </li>
        </ul>
        <div class="posts">
            @if ($posts->count() > 0)
                @foreach ($posts as $post)
                <div class="post">
                    <div class="profile-details-1">
                        <img src="{{ asset('storage/' . $post->user->picture_path) }}"
                            alt="{{ $post->post_pic_path }}">
                        <div>
                            <h6>{{ $post->user->name }}</h6>
                            <p class="text-secondary">{{ $post->location }}</p>
                        </div>
                    </div>
                    <p>{{ $post->content }}</p>
                    <img src="{{ asset('storage/' . $post->post_pic_path) }}"
                        alt="{{ $post->post_pic_path }}"class="post-img">
                    <div class="d-flex justify-content-between text-secondary m-2">
                        <h6>{{ $post->likes->count() }} Likes</h6>
                        <h6>{{ $post->comments->count() }} Comments</h6>
                    </div>
                    <hr>
                    <div class="reactions d-flex text-secondary justify-content-between">
                        <div class="d-flex w-30">
                            <form action="{{ route('post.like', $post->id) }}" method="POST"
                                class="like-form">
                                @csrf
                                <button type="submit" class="like-btn" data-post-id="{{ $post->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                        <path
                                            d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15" />
                                    </svg>
                                    <span>Like</span>
                                </button>
                            </form>
                        </div>
                        <div class="d-flex w-30">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                fill="currentColor" class="bi bi-chat-left" viewBox="0 0 16 16">
                                <path
                                    d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z" />
                            </svg>
                            <h6>Comment</h6>
                        </div>
                        <div class="d-flex w-30">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                fill="currentColor" class="bi bi-share" viewBox="0 0 16 16">
                                <path
                                    d="M13.5 1a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3M11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.5 2.5 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5m-8.5 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3m11 5.5a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3" />
                            </svg>
                            <h6>Share</h6>
                        </div>
                    </div>
                    <hr>
                    <div class="comments">
                        @foreach ($post->comments as $comment)
                            <div class="comment p-3 m-3">
                                <img src="{{ asset('storage/' . $comment->user->picture_path) }}" alt="picture">
                                <strong>{{ $comment->user->name }}</strong>: {{ $comment->content }}
                            </div>
                        @endforeach
                    </div>
                    <div class="input-container">
                        <div>
                            <img src="{{ asset('storage/' . Auth::user()->picture_path) }}"
                                alt="{{ Auth::user()->picture_path }}">
                        </div>
                        <form action="/post/comment/{{ $post->id }}" method="POST">
                            @csrf
                            <input type="text" name="content" id="message" placeholder="Write a comment..."
                                required>
                            <button type="submit" id="send">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="20"
                                    fill="currentColor" class="bi bi-send" viewBox="0 0 16 16">
                                    <path
                                        d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576zm6.787-8.201L1.591 6.602l4.339 2.76z" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            @else
                <h1 class="text-center">
                    No Posts Yet
                </h1>
            @endif
        </div>
    </div>
    <script>
        // File input change event to preview the uploaded image
        document.getElementById('file-input').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profile-image').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
        document.querySelectorAll('.like-btn').forEach(button => {
            button.addEventListener('click', function(event) {
                // event.preventDefault();

                const svg = this.querySelector('svg');
                const isLiked = svg.classList.contains('liked');

                if (isLiked) {
                    svg.classList.remove('liked');
                    svg.innerHTML =
                        `
                <path
                    d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15" />`;
                    svg.style.fill = 'currentColor'; // Default color
                } else {
                    svg.classList.add('liked');
                    svg.innerHTML = `
                <path fill-rule="evenodd"
                    d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 2.562-3.248 8 1.314z"/>`;
                    svg.style.fill = 'pink'; // Liked color
                }
            });
        });
    </script>
@endsection
