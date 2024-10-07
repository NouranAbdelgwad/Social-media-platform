@extends("layouts.layout")

@section("title", "Log In")

@section("content")
<div class="centered">
<div class="sign-up-container shadow">
    <div class="sign-up-page">
        <div class="sign-up-img">
            <img src="{{ asset('assets/images/sign-up-img.jpg') }}" alt="Sign Up Image">
        </div>
        <div class="sign-up-form">
            @if ($errors->any())
            <div>
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger" role="alert">
                            <strong>{{$error}}</strong>
                        </div>
                    @endforeach
            </div>
            @elseif(session('error'))
            <div class="alert alert-danger" role="alert">
                <strong>{{session('error')}}</strong>
            </div>
            @endif
            <form action="/log-in" method="POST">
                @csrf
                <h2 class="text-center" ><b>Log In</b></h2>
                <label for="email" class="mt-2">Email</label>
                <input type="email" class="form-control" name="email" value="{{old('email')}}" required>
                <label for="password" class="mt-2">Password</label>
                <input type="password" class="form-control" name="password" required>
                <div class="d-flex justify-content-center" >
                    <input type="submit" value="LogIn" class="main-btn w-50 text-center mt-2">
                </div>
                <div class="text-center mt-2">
                    <span class="text-secondary" >Don't have an account?</span>
                    <a href="/sign-up">Sign up</a>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection
