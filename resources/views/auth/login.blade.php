@extends('layouts.app')

@section('title', __('Login'))

@section('content')
<div class="auth-wrapper">
    <div class="auth-card glass-card">
        <div class="auth-header">
            <h2>{{ __('Welcome Back') }}</h2>
            <p>{{ __('Log in to your account to manage your favorites and inquiries.') }}</p>
        </div>

        <form action="{{ route('login') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label>{{ __('Email Address') }}</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="name@example.com" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>{{ __('Password') }}</label>
                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">{{ __('Log In') }}</button>

            <div class="auth-footer">
                <p>{{ __("Don't have an account?") }} <a href="{{ route('register') }}">{{ __('Register here') }}</a></p>
            </div>
        </form>
    </div>
</div>

<style>
    .auth-wrapper { 
        min-height: 90vh; display: flex; align-items: center; justify-content: center; 
        padding: 2rem; padding-top: 5rem;
    }
    .auth-card { width: 100%; max-width: 450px; }
    .auth-header { text-align: center; margin-bottom: 2.5rem; }
    .auth-header h2 { font-size: 2.2rem; font-weight: 800; margin-bottom: 0.5rem; letter-spacing: -1px; }
    .auth-header p { color: var(--secondary); font-size: 0.95rem; }
    .w-100 { width: 100%; margin-top: 1rem; }
    .auth-footer { text-align: center; margin-top: 2rem; font-size: 0.9rem; color: var(--secondary); }
    .auth-footer a { color: var(--accent); text-decoration: none; font-weight: 600; }
    .error-text { color: var(--danger); font-size: 0.8rem; margin-top: 0.5rem; display: block; }
</style>
@endsection
