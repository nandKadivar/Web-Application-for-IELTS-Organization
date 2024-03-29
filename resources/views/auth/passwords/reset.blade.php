@extends('layouts.app')

@section('title')
    Reset password
@endsection
@section('content')

<main class="d-flex align-items-center justify-content-center" style="background-color: #f1f1f1">
    <div class="d-flex flex-column align-items-center login-card">
        <div>
            <img src="/media/logos/logo-3.svg" />
        </div>

        <div class="align-items-center justify-content-center mt-5" style="width: 80%">
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="d-flex flex-column align-items-center input-card">
                    <div class="d-flex flex-column align-items-center form-group">
                        <div class="d-flex flex-row align-items-center justify-content-between input-container">
                            <div class="input-icon"><i class="fas fa-user"></i></div>
                            <input id="email" type="email" class="input-field @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus placeholder="Email">
                        </div>
                    
                        <div class="d-flex flex-row align-items-center justify-content-between input-container mt-4">
                            <div class="input-icon"><i class="fas fa-key"></i></div>
                            <input id="password" type="password" class="input-field @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="New Password"/>
                        </div>
                    
                        <div class="d-flex flex-row align-items-center justify-content-between input-container mt-4">
                            <div class="input-icon"><i class="fas fa-key"></i></div>
                            <input id="password-confirm" type="password" class="input-field" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password" />
                        </div>
                    
                    </div>
                    @error('email')
                        <div class="d-flex flex-row align-items-center justify-content-center error-container my-1 alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror

                    @error('password')
                        <div class="d-flex flex-row align-items-center justify-content-center error-container my-1 alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="d-flex flex-row align-items-center justify-content-center remenber-me-container my-4">
                        <div>
                            <button type="submit" class="btn btn-danger" style="width: 250px; height: 50px">
                                {{ __('Reset Password') }}
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection

{{-- @extends('layouts.app')

@section('content')
<main class="d-flex align-items-center justify-content-center" style="background-color: #f1f1f1">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Reset Password') }}</div>
    
                    <div class="card-body">
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf
    
                            <input type="hidden" name="token" value="{{ $token }}">
    
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
    
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
    
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
    
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
    
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
    
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
    
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Reset Password') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection --}}
