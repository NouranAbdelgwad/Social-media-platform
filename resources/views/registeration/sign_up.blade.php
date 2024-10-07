@extends("layouts.layout")

@section("title", "Sign Up")

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
            @endif
            <form action="/sign-up" method="POST">
                @csrf
                <h2 class="text-center" ><b>Sign Up</b></h2>
                <label for="name">Full Name</label>
                <input type="text" class="form-control" name="name" value="{{old('name')}}" required>
                <label for="email" class="mt-2">Email</label>
                <input type="email" class="form-control" name="email" value="{{old('email')}}" required>
                <label for="password" class="mt-2">Password</label>
                <input type="password" class="form-control" name="password" required>
                <label for="password_confirmation" class="mt-2">Confirm Password</label>
                <input type="password" class="form-control" name="password_confirmation" required>
                <div class="d-flex justify-content-center" >
                    <input type="submit" value="Sign Up" class="main-btn w-50 text-center mt-2">
                </div>
                <div class="text-center mt-2">
                    <span class="text-secondary" >Aready have an account?</span>
                    <a href="/log-in">Log in</a>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection
