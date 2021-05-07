@extends('layouts.auth')

@section('content')
<div class="col-md-5">
    <div class="card-group">
        <div class="card p-4">
            <div class="card-body">
                <h1>{{ __('auth.login') }}</h1>
                <p class="text-muted">{{ __('auth.sublogin') }}</p>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <em class="icon-envelope"></em>
                            </span>
                        </div>
                        <input type="text" name="UserLogin" class="form-control @error('UserLogin') is-invalid @enderror" value="{{ old('UserLogin') }}" placeholder="{{ __('UserLogin') }}" required autofocus>
                        @error('UserLogin')
                            <span class="error invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <em class="icon-lock"></em>
                            </span>
                        </div>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="{{ __('password') }}" required autocomplete="current-password">
                        @error('password')
                            <span class="error invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <button class="btn btn-primary px-4" type="submit">{{ __('auth.login') }}</button>
                        </div>
                        {{-- @if (Route::has('password.request'))
                            <div class="col-6 text-right">
                                <a class="btn btn-link px-0" href="{{ route('password.request') }}">
                                    {{ __('auth.forgot') }}
                                </a>
                            </div>
                        @endif --}}
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
