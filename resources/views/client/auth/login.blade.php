@extends('client.layouts.auth')

@section('content')
    <div class="sidenav">
        <div class="login-main-text">

                <div class="bg-white p-3 mb-2">
                    <a href="{{ route('home') }}"><img src="{{ asset('/client/img/logo.png') }}" alt=""></a>
                </div>

            <h2>Application<br> Login Page</h2>
            <p>Login or register from here to access.</p>
        </div>
    </div>
    <div class="main">
        <div class="col-md-6 col-sm-12">
            <div class="login-form">
                @if ($errors->any())
                    <div class="alert alert-danger">
                       Невірні данні для входу
                    </div>
                @endif
                <form method="post" action="{{ route('login') }}">
                    @method('POST')
                    @csrf
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control" placeholder="email@gmail.com">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-black">Login</button>
                    <a href="{{ route('login.github') }}" class="btn btn-dark">
                        Увійти через GitHub
                    </a>
                    <a href="{{ route('register') }}">
                        <button type="button" class="btn btn-secondary">Register</button>
                    </a>
                </form>
            </div>
        </div>
    </div>
@endsection
