@extends('auth.app')
@section('title', 'Login')
@section('content')
    <div class="login-container">
        <div class="row">
            <div class="col-lg-4 col-md-5 col-sm-9 lfh">
                <div class="card login-box">
                    <div class="card-body">
                        <h5 class="card-title">Sign In</h5>
                        <form method="POST" action="{{ route('login') }}" autocomplete="off">
                            @csrf
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
                            <div class="custom-control custom-checkbox form-group">
                                <input type="checkbox" class="custom-control-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="custom-control-label" for="remember">Remember</label>
                            </div>
                            {{-- @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="float-left forgot-link">Forgot password?</a>
                            @endif --}}

                            <button type="submit" class="btn btn-primary float-right m-l-xxs">
                                {{ __('Login') }}
                            </button>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-secondary float-right">Register</a>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
