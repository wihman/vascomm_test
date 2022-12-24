@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center" style="border-radius: 5px; margin-top: 100px;">
            <div class="col-md-10">
                {{--            <div class="card" style="border-radius: 10px; margin-top: 50px; border: 0px">--}}
                {{--                <div class="card-body" style="">--}}
                <div class="row">
                    <div class="col-md-6 leftside">

                        <div align="center">
                            <div style="margin-top: 20px; margin-bottom: 10px;">
                                <center><img src="/img/logo.png" alt="" height="70px"></center>
                            </div>
                            <p style="font-size: 20px; font-weight: bold">Welcome Back,</p>
                            <p style="margin-top: -23px; color: rgb(196, 194, 194)">Sign in to start your session</p>
                        </div>

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group row" align="center">
                                <label for="email" class="col-md-10 col-form-label text-md-left offset-md-1">{{ __('NIK') }}</label>
                                <div class="col-md-10 offset-md-1" style="z-index: 9">
                                    <input id="email" type="text" class="form-control" name="email" autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-10 col-form-label text-md-left offset-md-1">{{ __('Password') }}</label>

                                <div class="col-md-10 offset-md-1" style="z-index: 9">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-10 offset-md-1">
                                    <button type="submit" class="btn btnones col-md-12">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-5 offset-md-1" style="margin-top: 10px">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-5 text-md-right" style="margin-top: 2px; z-index: 9">
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Password ?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <br><br>
                        </form>
                    </div>
                    <div class="col-md-6 rightside full-img"></div>
                </div>
                {{--                </div>--}}
                {{--            </div>--}}
            </div>
        </div>
    </div>
@endsection
