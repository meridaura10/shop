@extends('client.layouts.auth')

@section('content')
    <div class="sidenav">
        <div class="login-main-text">

            <div class="bg-white p-3 mb-2">
                <a href="{{ route('home') }}"><img src="{{ asset('/client/img/logo.png') }}" alt=""></a>
            </div>
            <h2>Application<br> Register Page</h2>
            <p>Login or register from here to access.</p>
        </div>
    </div>
    <div class="main">
        <div class="col-md-6 col-sm-12">
            <div class="login-form">
                <form method="post" action="{{ route('register') }}">
                    @method('POST')
                    @csrf
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" placeholder="email@gmail.com">
                    </div>
                    @error('email')
                    <div class="text-danger mb-2">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password">
                    </div>
                    @error('password')
                    <div class="text-danger mb-2">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Password confirmation">
                    </div>
                    <button type="submit" class="btn btn-black">Зарегеструватись</button>
                    <a href="{{ route('login') }}">
                        <button type="button" class="btn btn-secondary">Ввійти</button>
                    </a>
                </form>
            </div>
        </div>
    </div>
@endsection
