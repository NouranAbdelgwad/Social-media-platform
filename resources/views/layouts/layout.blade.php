<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Main Layout')</title>
    {{-- style --}}
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    {{-- bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    {{-- emoji picker --}}
    <script src="https://cdn.tiny.cloud/1/ftefylgonx8makg8wwx80ww78ph4g8h8zak3fcxvcdnvsexc/tinymce/7/tinymce.min.js"
        referrerpolicy="origin"></script>
</head>

<body>
    @if(!request()->is("log-in") && !request()->is("sign-up"))
    <nav class="nav-design">
        <div class="nav-logo">
            <a href="/">
                <img src="{{ asset('/assets/images/logo-no-background.png') }}" alt="logo">
            </a>
        </div>
        <div class="search-bar nav-search">
            <form action="" method="GET" class="search-form">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-search" viewBox="0 0 16 16">
                    <path
                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                </svg>
                <input type="text" class="search-input">
            </form>
        </div>
        <div class="profile-details">
        @if(Auth::check())
        <img src="{{ asset('storage/' . Auth::user()->picture_path) }}" alt="{{ Auth::user()->picture_path }}">
        @endif
        <a href="/profile/{{Auth::user()->id}}" class="no-decoration"><h6>{{Auth::user()->name}}</h6></a>
        </div>
    </nav>
    @endif

    @yield('content')

    @if (request()->is("/"))
    <script>
        tinymce.init({
            selector: "#mytextarea",
            plugins: "emoticons",
            toolbar: "emoticons",
            toolbar_location: "bottom",
            menubar: false
        });
    </script>
    @endif

</body>

</html>
