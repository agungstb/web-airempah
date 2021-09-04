@extends('auth.app')
@section('title', 'Register')
@section('content')
    <div class="login-container">
        <div class="row">
            <div class="col-lg-4 col-md-5 col-sm-9 lfh">
                <div class="card login-box">
                    <div class="card-body">
                        <h5 class="card-title">Sign Up</h5>
                        <form method="POST" action="{{ route('register') }}" autocomplete="off">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="exampleInputName1" aria-describedby="nameHelp" placeholder="Enter Name">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="exampleInputPassword1" placeholder="Password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="exampleInputPassword2" placeholder="Password Confirmation">
                                @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary float-right m-l-xxs">
                                {{ __('Register') }}
                            </button>
                            @if (Route::has('login'))
                                <a href="{{ route('login') }}" class="btn btn-secondary float-right">Login</a>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
