@extends('admin.auth.app')
@section('title')
    <title>{{ __('Login') }}</title>
@endsection
@section('content')
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            overflow: hidden;
        }
        
        .frontieri-login-container {
            min-height: 100vh;
            display: flex;
            position: relative;
        }
        
        .left-panel {
             flex: 1;
             background: url('/uploads/custom-images/lmss.jpg') center/cover no-repeat;
             display: flex;
             flex-direction: column;
             justify-content: center;
             align-items: flex-start;
             padding: 80px 60px;
             color: white;
             position: relative;
             overflow: hidden;
         }
         
         .left-panel::after {
             content: '';
             position: absolute;
             top: 0;
             left: 0;
             right: 0;
             bottom: 0;
             background: rgba(59, 130, 246, 0.7);
             z-index: 1;
         }
        
        .left-panel::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="20" cy="20" r="1" fill="%23ffffff" opacity="0.1"/><circle cx="80" cy="40" r="1" fill="%23ffffff" opacity="0.1"/><circle cx="40" cy="80" r="1" fill="%23ffffff" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>') repeat;
            opacity: 0.3;
        }
        
        .welcome-content {
             position: relative;
             z-index: 3;
             max-width: 400px;
         }
        
        .welcome-title {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            line-height: 1.1;
        }
        
        .welcome-subtitle {
            font-size: 1.1rem;
            margin-bottom: 2.5rem;
            opacity: 0.9;
            line-height: 1.6;
        }
        
        .feature-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .feature-item {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
            font-size: 1rem;
            opacity: 0.9;
        }
        
        .feature-icon {
            width: 20px;
            height: 20px;
            margin-right: 12px;
            flex-shrink: 0;
        }
        
        .right-panel {
            flex: 1;
            background: #f8fafc;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
        }
        
        .login-card {
            background: white;
            border-radius: 16px;
            padding: 48px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            border: 1px solid #e2e8f0;
        }
        
        .brand-section {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .brand-logo {
            color: #282f76;
            font-size: 1.8rem;
            font-weight: 700;
            text-decoration: none;
            margin-bottom: 0.5rem;
            display: block;
        }
        
        .brand-tagline {
            color: #64748b;
            font-size: 0.875rem;
            margin: 0;
        }
        
        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .login-title {
            color: #1e293b;
            font-size: 1.5rem;
            font-weight: 600;
            margin: 0 0 0.5rem 0;
        }
        
        .login-subtitle {
            color: #64748b;
            font-size: 0.875rem;
            margin: 0;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-label {
            display: block;
            color: #374151;
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }
        
        .form-input {
            width: 100%;
            padding: 12px 16px;
            background: #ffffff;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            color: #1f2937;
            font-size: 0.875rem;
            transition: all 0.2s ease;
            box-sizing: border-box;
        }
        
        .form-input:focus {
            outline: none;
            border-color: #282f76;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        
        .form-input::placeholder {
            color: #9ca3af;
        }
        
        .forgot-link {
            text-align: right;
            margin-top: 0.5rem;
        }
        
        .forgot-link a {
            color: #282f76;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
        }
        
        .forgot-link a:hover {
            color: #282f76;
        }
        
        .login-button {
            width: 100%;
            padding: 12px 24px;
            background: #282f76;
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 0.875rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            margin-top: 1rem;
        }
        
        .login-button:hover {
            background: #282f76;
            transform: translateY(-1px);
            box-shadow: 0 10px 15px -3px rgba(59, 130, 246, 0.3);
        }
        
        .login-button:active {
            transform: translateY(0);
        }
        
        .footer-text {
            text-align: center;
            margin-top: 2rem;
            color: #64748b;
            font-size: 0.75rem;
        }
        
        @media (max-width: 768px) {
            .frontieri-login-container {
                flex-direction: column;
            }
            
            .left-panel {
                padding: 40px 30px;
                min-height: 40vh;
            }
            
            .welcome-title {
                font-size: 2rem;
            }
            
            .right-panel {
                padding: 20px;
            }
            
            .login-card {
                padding: 32px 24px;
            }
        }
        
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .login-card {
            animation: slideIn 0.6s ease-out;
        }
        

    </style>
    
    <div class="frontieri-login-container">
        <!-- Left Panel -->
        <div class="left-panel">
            <div class="welcome-content">
                <h1 class="welcome-title">Welcome to {{ config('app.name', 'IFL LMS') }} Learning Management System</h1>
                <p class="welcome-subtitle">Learn what ever you want.</p>
                
                <ul class="feature-list">
                    <li class="feature-item">
                        <svg class="feature-icon" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        Courses
                    </li>
                    <li class="feature-item">
                        <svg class="feature-icon" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        Certificate
                    </li>
                    <li class="feature-item">
                        <svg class="feature-icon" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                        </svg>
                        Secure Access
                    </li>
                </ul>
            </div>
        </div>
        
        <!-- Right Panel -->
        <div class="right-panel">
            <div class="login-card">
                <div class="brand-section">
                    <a href="{{ route('home') }}" class="brand-logo">IFL LMS</a>
                    <p class="brand-tagline">Admin Portal</p>
                </div>
                
                <div class="login-header">
                    <h2 class="login-title">{{ __('Welcome Back') }}!</h2>
                    <p class="login-subtitle">Please sign in to continue to your dashboard.</p>
                </div>

                <form id="adminLoginForm" action="{{ route('admin.store-login') }}" method="POST">
                    @csrf
                    
                    <div class="form-group">
                        <label for="email" class="form-label">{{ __('Email Address') }}</label>
                        <input 
                            id="email" 
                            type="email" 
                            class="form-input" 
                            name="email"
                            tabindex="1" 
                            autofocus 
                            value="{{ old('email') }}"
                            placeholder="Enter your email"
                            required
                        >
                    </div>
                    
                    <div class="form-group">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                        <input 
                            id="password" 
                            type="password" 
                            class="form-input" 
                            name="password"
                            tabindex="2"
                            placeholder="Enter your password"
                            required
                        >
                        
                        <div class="forgot-link">
                            <a href="{{ route('admin.password.request') }}">
                                {{ __('Forgot Password?') }}
                            </a>
                        </div>
                    </div>
                    
                    <button id="adminLoginBtn" type="submit" class="login-button" tabindex="4">
                        <svg style="width: 16px; height: 16px; margin-right: 8px;" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 3a1 1 0 011 1v12a1 1 0 11-2 0V4a1 1 0 011-1zm7.707 3.293a1 1 0 010 1.414L9.414 9H17a1 1 0 110 2H9.414l1.293 1.293a1 1 0 01-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        {{ __('Sign In') }}
                    </button>
                </form>
                
                <div class="footer-text">
                    © 2025 IFL LMS - Admin Portal
                </div>
            </div>
        </div>
    </div>
@endsection
