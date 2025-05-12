@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="login-box">
        <div class="header">
            <h1>Welcome Back!</h1>
            <p>Please login to your account</p>
        </div>

        @if ($errors->any())
            <div class="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="login-form">
            @csrf

            <div class="field">
                <div class="label">Username</div>
                <input type="text" name="username" id="username" value="{{ old('username') }}" required>
            </div>

            <div class="field">
                <div class="label">Password</div>
                <input type="password" name="password" id="password" required>
            </div>

            <div class="field">
                <button type="submit">Login</button>
            </div>
        </form>

        <div class="signup-link">
            Don't have an account? <a href="{{ route('signup') }}">Sign up</a>
        </div>
    </div>
</div>

@push('styles')
<style>
    .container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .login-box {
        background: white;
        border-radius: 10px;
        padding: 40px;
        width: 100%;
        max-width: 500px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    .header {
        text-align: center;
        margin-bottom: 40px;
    }

    .header h1 {
        font-size: 32px;
        color: #333;
        margin-bottom: 10px;
        font-weight: 700;
        letter-spacing: -0.5px;
    }

    .header p {
        color: #666;
        font-size: 16px;
        font-weight: 400;
    }

    .alert {
        background: #fff3f3;
        border: 1px solid #ff6b6b;
        border-radius: 6px;
        padding: 15px 20px;
        margin-bottom: 25px;
    }

    .alert ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        color: #ff6b6b;
    }

    .field {
        margin-bottom: 25px;
    }

    .label {
        font-size: 14px;
        color: #555;
        margin-bottom: 8px;
        font-weight: 500;
        letter-spacing: 0.3px;
    }

    .field input {
        width: 96%;
        padding: 12px;
        border: 2px solid #eee;
        border-radius: 6px;
        font-size: 15px;
        transition: all 0.3s ease;
    }

    .field input:focus {
        border-color: #ff6b00;
        outline: none;
    }

    .field button {
        width: 100%;
        padding: 14px;
        background: #ff6b00;
        color: white;
        border: none;
        border-radius: 6px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.3s ease;
        letter-spacing: 0.3px;
    }

    .field button:hover {
        background: #ff8533;
    }

    .signup-link {
        text-align: center;
        margin-top: 25px;
        color: #666;
    }

    .signup-link a {
        color: #ff6b00;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s ease;
    }

    .signup-link a:hover {
        color: #ff8533;
    }

    @media (max-width: 480px) {
        .login-box {
            padding: 30px 20px;
        }

        .header h1 {
            font-size: 28px;
        }
    }
</style>
@endpush
@endsection
