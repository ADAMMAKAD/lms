@extends('admin.auth.app')
@section('title')
    <title>{{ __('Login') }}</title>
@endsection
@section('content')
    <style>
        body {
            margin: 0;
            padding: 0;
            overflow: hidden;
        }
        
        .modern-login-container {
            min-height: 100vh;
            background: #ffffff;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(2deg); }
        }
        
        .login-glass-card {
            background: #ffffff;
            border-radius: 20px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 25px 45px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 100%;
            max-width: 450px;
            position: relative;
            z-index: 10;
            animation: slideUp 0.8s ease-out;
        }
        
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .modern-brand {
            text-align: center;
            margin-bottom: 40px;
        }
        
        .modern-brand h1 {
            color: #0066cc;
            font-weight: 700;
            font-size: 2.8rem;
            margin: 0;
            letter-spacing: -2px;
        }
        
        .modern-brand p {
            color: #6b7280;
            margin: 8px 0 0 0;
            font-size: 1rem;
            font-weight: 300;
        }
        
        .welcome-text {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .welcome-text h3 {
            color: #374151;
            font-weight: 600;
            font-size: 1.5rem;
            margin: 0;
        }
        
        .modern-form-group {
            margin-bottom: 25px;
            position: relative;
        }
        
        .modern-input {
            width: 100%;
            padding: 15px 20px;
            background: #f9fafb;
            border: 1px solid #d1d5db;
            border-radius: 12px;
            color: #374151;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        
        .modern-input:focus {
            outline: none;
            background: #ffffff;
            border-color: #0066cc;
            box-shadow: 0 0 0 3px rgba(0, 102, 204, 0.1);
            transform: translateY(-2px);
        }
        
        .modern-input::placeholder {
            color: #9ca3af;
        }
        
        .floating-label {
            position: absolute;
            top: 15px;
            left: 20px;
            color: #9ca3af;
            font-size: 16px;
            transition: all 0.3s ease;
            pointer-events: none;
        }
        
        .modern-input:focus + .floating-label,
        .modern-input:not(:placeholder-shown) + .floating-label {
            top: -10px;
            left: 15px;
            font-size: 12px;
            color: #0066cc;
            background: #ffffff;
            padding: 2px 8px;
            border-radius: 6px;
        }
        
        .forgot-password {
            text-align: right;
            margin-top: 10px;
        }
        
        .forgot-password a {
            color: #0066cc;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s ease;
        }
        
        .forgot-password a:hover {
            color: #004499;
        }
        
        .modern-login-btn {
            width: 100%;
            padding: 15px;
            background: #0066cc;
            border: none;
            border-radius: 12px;
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 20px;
            box-shadow: 0 10px 25px rgba(0, 102, 204, 0.3);
        }
        
        .modern-login-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(0, 102, 204, 0.4);
            background: #004499;
        }
        
        .modern-login-btn:active {
            transform: translateY(-1px);
        }
        
        @media (max-width: 768px) {
            .login-glass-card {
                padding: 30px 25px;
                margin: 10px;
            }
            
            .modern-brand h1 {
                font-size: 2.2rem;
            }
        }
    </style>
    
    <div class="modern-login-container">
        <div class="login-glass-card">
            <div class="modern-brand">
                <a href="{{ route('home') }}" style="text-decoration: none;">
                    <h1>UNDP LMS</h1>
                    <p>Admin Portal</p>
                </a>
            </div>
            
            <div class="welcome-text">
                <h3>{{ __('Welcome Back') }}</h3>
            </div>
            
            <form id="adminLoginForm" action="{{ route('admin.store-login') }}" method="POST">
                @csrf
                
                <div class="modern-form-group">
                    <input 
                        id="email" 
                        type="email" 
                        class="modern-input" 
                        name="email"
                        placeholder=" "
                        tabindex="1" 
                        autofocus 
                        value="{{ old('email') }}"
                        required
                    >
                    <label for="email" class="floating-label">{{ __('Email Address') }}</label>
                </div>
                
                <div class="modern-form-group">
                    <input 
                        id="password" 
                        type="password" 
                        class="modern-input" 
                        name="password"
                        placeholder=" "
                        tabindex="2"
                        required
                    >
                    <label for="password" class="floating-label">{{ __('Password') }}</label>
                    
                    <div class="forgot-password">
                        <a href="{{ route('admin.password.request') }}">
                            {{ __('Forgot Password?') }}
                        </a>
                    </div>
                </div>
                
                <button id="adminLoginBtn" type="submit" class="modern-login-btn" tabindex="4">
                    {{ __('Sign In') }}
                </button>
            </form>
        </div>
    </div>
@endsection
