<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ __('Student Registration') }} || {{ $setting->app_name }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset($setting->favicon) }}">
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="{{ asset('backend/css/toastr.min.css') }}">
    
    <!-- reCAPTCHA -->
    @if (Cache::get('setting')->recaptcha_status === 'active')
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    @endif
</head>
<body>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            overflow: hidden;
        }
        
        .student-register-container {
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
            background: rgba(40, 47, 118, 0.85);
            z-index: 1;
        }
        
        .left-panel::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(40, 47, 118, 0.9) 0%, rgba(119, 126, 200, 0.8) 100%);
            z-index: 2;
        }
        
        .left-content {
            position: relative;
            z-index: 3;
            max-width: 500px;
        }
        
        .welcome-title {
            font-size: 3rem;
            font-weight: 800;
            line-height: 1.2;
            margin: 0 0 1.5rem 0;
            background: linear-gradient(135deg, #ffffff 0%, #f0f0f0 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .welcome-subtitle {
            font-size: 1.25rem;
            font-weight: 400;
            margin: 0 0 3rem 0;
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
            margin-bottom: 1.5rem;
            font-size: 1.1rem;
            font-weight: 500;
        }
        
        .feature-icon {
            width: 24px;
            height: 24px;
            margin-right: 1rem;
            opacity: 0.9;
        }
        
        .right-panel {
            flex: 1;
            background: #f8fafc;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
        }
        
        .register-card {
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
        
        .register-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .register-title {
            color: #1e293b;
            font-size: 1.5rem;
            font-weight: 600;
            margin: 0 0 0.5rem 0;
        }
        
        .register-subtitle {
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
            box-shadow: 0 0 0 3px rgba(40, 47, 118, 0.1);
        }
        
        .form-input::placeholder {
            color: #9ca3af;
        }
        
        .register-button {
            width: 100%;
            padding: 12px 24px;
            background: linear-gradient(135deg, #282f76 0%, #777ec8 100%);
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 0.875rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            margin-top: 1rem;
        }
        
        .register-button:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 20px rgba(40, 47, 118, 0.2);
        }
        
        .account__social {
            margin-bottom: 1.5rem;
        }
        
        .account__social-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 12px 16px;
            background: #ffffff;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            color: #374151;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }
        
        .account__social-btn:hover {
            background: #f9fafb;
            border-color: #9ca3af;
        }
        
        .account__social-btn img {
            width: 20px;
            height: 20px;
            margin-right: 8px;
        }
        
        .account__divider {
            text-align: center;
            margin: 1.5rem 0;
            position: relative;
        }
        
        .account__divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #e5e7eb;
        }
        
        .account__divider span {
            background: white;
            color: #6b7280;
            padding: 0 1rem;
            font-size: 0.875rem;
        }
        
        .account__switch {
            text-align: center;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid #e5e7eb;
        }
        
        .account__switch p {
            color: #6b7280;
            font-size: 0.875rem;
            margin: 0;
        }
        
        .account__switch a {
            color: #282f76;
            text-decoration: none;
            font-weight: 600;
            margin-left: 0.25rem;
        }
        
        .account__switch a:hover {
            color: #1e2563;
        }
        
        .footer-text {
            text-align: center;
            margin-top: 2rem;
            color: #9ca3af;
            font-size: 0.75rem;
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .student-register-container {
                flex-direction: column;
            }
            
            .left-panel {
                min-height: 40vh;
                padding: 40px 30px;
            }
            
            .welcome-title {
                font-size: 2rem;
            }
            
            .welcome-subtitle {
                font-size: 1rem;
            }
            
            .right-panel {
                padding: 20px;
            }
            
            .register-card {
                padding: 32px 24px;
            }
        }
        
        /* Validation Error Styles */
        .invalid-feedback {
            color: #dc2626;
            font-size: 0.75rem;
            margin-top: 0.25rem;
        }
    </style>

    <div class="student-register-container">
        <!-- Left Panel -->
        <div class="left-panel">
            <div class="left-content">
                <h1 class="welcome-title">Join {{ $setting->app_name }}</h1>
                <p class="welcome-subtitle">Start your sustainable development learning journey and make a global impact.</p>
                
                <ul class="feature-list">
                    <li class="feature-item">
                        <svg class="feature-icon" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        Expert-Led Courses
                    </li>
                    <li class="feature-item">
                        <svg class="feature-icon" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" clip-rule="evenodd"></path>
                        </svg>
                        Verified Certificates
                    </li>
                    <li class="feature-item">
                        <svg class="feature-icon" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path>
                        </svg>
                        Global Community
                    </li>
                </ul>
            </div>
        </div>
        
        <!-- Right Panel -->
        <div class="right-panel">
            <div class="register-card">
                <div class="brand-section">
                    <a href="{{ route('home') }}" class="brand-logo">{{ $setting->app_name }}</a>
                    <p class="brand-tagline">Student Registration</p>
                </div>
                
                <div class="register-header">
                    <h2 class="register-title">{{ __('Create Your Account') }}</h2>
                    <p class="register-subtitle">Join thousands of learners making a difference worldwide.</p>
                </div>

                @if($setting->google_login_status == 'active')
                <div class="account__social">
                    <a href="{{ route('auth.social', 'google') }}" class="account__social-btn">
                        <img src="{{ asset('frontend/img/icons/google.svg') }}" alt="Google">
                        {{ __('Sign up with Google') }}
                    </a>
                </div>
                <div class="account__divider">
                    <span>{{ __('or') }}</span>
                </div>
                @endif

                <form id="studentRegisterForm" action="{{ route('register') }}" method="POST">
                    @csrf
                    
                    <div class="form-group">
                        <label for="name" class="form-label">{{ __('Full Name') }}</label>
                        <input 
                            id="name" 
                            type="text" 
                            class="form-input" 
                            name="name"
                            tabindex="1" 
                            autofocus 
                            value="{{ old('name') }}"
                            placeholder="Enter your full name"
                            required
                        >
                        <x-frontend.validation-error name="name" />
                    </div>
                    
                    <div class="form-group">
                        <label for="email" class="form-label">{{ __('Email Address') }}</label>
                        <input 
                            id="email" 
                            type="email" 
                            class="form-input" 
                            name="email"
                            tabindex="2" 
                            value="{{ old('email') }}"
                            placeholder="Enter your email address"
                            required
                        >
                        <x-frontend.validation-error name="email" />
                    </div>
                    
                    <div class="form-group">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                        <input 
                            id="password" 
                            type="password" 
                            class="form-input" 
                            name="password"
                            tabindex="3"
                            placeholder="Create a strong password"
                            required
                        >
                        <x-frontend.validation-error name="password" />
                    </div>
                    
                    <div class="form-group">
                        <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                        <input 
                            id="password_confirmation" 
                            type="password" 
                            class="form-input" 
                            name="password_confirmation"
                            tabindex="4"
                            placeholder="Confirm your password"
                            required
                        >
                        <x-frontend.validation-error name="password_confirmation" />
                    </div>
                    
                    <!-- g-recaptcha -->
                    @if (Cache::get('setting')->recaptcha_status === 'active')
                    <div class="form-group">
                        <div class="g-recaptcha" data-sitekey="{{ Cache::get('setting')->recaptcha_site_key }}"></div>
                        <x-frontend.validation-error name="g-recaptcha-response" />
                    </div>
                    @endif
                    
                    <button id="studentRegisterBtn" type="submit" class="register-button" tabindex="5">
                        <svg style="width: 16px; height: 16px; margin-right: 8px;" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"></path>
                        </svg>
                        {{ __('Create Account') }}
                    </button>
                </form>
                
                <div class="account__switch">
                    <p>{{ __('Already have an account?') }}<a href="{{ route('login') }}">{{ __('Sign In') }}</a></p>
                </div>
                
                <div class="footer-text">
                    © 2025 {{ $setting->app_name }} - Student Registration
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('backend/js/jquery-3.7.1.min.js') }}"></script>
    <!-- Toastr JS -->
    <script src="{{ asset('backend/js/toastr.min.js') }}"></script>
    
    <!-- Show validation errors -->
    @if ($errors->any())
        <script>
            $(document).ready(function() {
                @foreach ($errors->all() as $error)
                    toastr.error('{{ $error }}');
                @endforeach
            });
        </script>
    @endif
    
    <!-- Show success message -->
    @if (session('success'))
        <script>
            $(document).ready(function() {
                toastr.success('{{ session('success') }}');
            });
        </script>
    @endif
    
    <!-- Show error message -->
    @if (session('error'))
        <script>
            $(document).ready(function() {
                toastr.error('{{ session('error') }}');
            });
        </script>
    @endif
</body>
</html>
