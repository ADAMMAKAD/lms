<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ __('Admin Forgot Password') }} || {{ $setting->app_name }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset($setting->favicon) }}">
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="{{ asset('backend/css/toastr.min.css') }}">
</head>
<body>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            overflow: hidden;
        }
        
        .admin-forgot-container {
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
        
        .admin-forgot-card {
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
        
        .admin-forgot-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .admin-forgot-title {
            color: #1e293b;
            font-size: 1.5rem;
            font-weight: 600;
            margin: 0 0 0.5rem 0;
        }
        
        .admin-forgot-subtitle {
            color: #64748b;
            font-size: 0.875rem;
            margin: 0;
            line-height: 1.5;
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
        
        .reset-button {
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
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .reset-button:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 20px rgba(40, 47, 118, 0.2);
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
        
        .admin-info {
            background: #fef3c7;
            border: 1px solid #fbbf24;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }
        
        .admin-info-content {
            display: flex;
            align-items: flex-start;
        }
        
        .admin-icon {
            width: 20px;
            height: 20px;
            color: #d97706;
            margin-right: 0.75rem;
            margin-top: 0.125rem;
            flex-shrink: 0;
        }
        
        .admin-text {
            color: #92400e;
            font-size: 0.8rem;
            line-height: 1.4;
            margin: 0;
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .admin-forgot-container {
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
            
            .admin-forgot-card {
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

    <div class="admin-forgot-container">
        <!-- Left Panel -->
        <div class="left-panel">
            <div class="left-content">
                <h1 class="welcome-title">Admin Recovery</h1>
                <p class="welcome-subtitle">Secure password reset for {{ $setting->app_name }} administrators.</p>
                
                <ul class="feature-list">
                    <li class="feature-item">
                        <svg class="feature-icon" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 8a6 6 0 01-7.743 5.743L10 14l-1 1-1 1H6v2H2v-4l4.257-4.257A6 6 0 1118 8zm-6-4a1 1 0 100 2 2 2 0 012 2 1 1 0 102 0 4 4 0 00-4-4z" clip-rule="evenodd"></path>
                        </svg>
                        Admin-Level Security
                    </li>
                    <li class="feature-item">
                        <svg class="feature-icon" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        Enhanced Protection
                    </li>
                    <li class="feature-item">
                        <svg class="feature-icon" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                        </svg>
                        Quick Recovery
                    </li>
                </ul>
            </div>
        </div>
        
        <!-- Right Panel -->
        <div class="right-panel">
            <div class="admin-forgot-card">
                <div class="brand-section">
                    <a href="{{ route('admin.login') }}" class="brand-logo">{{ $setting->app_name }}</a>
                    <p class="brand-tagline">Admin Password Recovery</p>
                </div>
                
                <div class="admin-forgot-header">
                    <h2 class="admin-forgot-title">{{ __('Admin Password Reset') }}</h2>
                    <p class="admin-forgot-subtitle">{{ __('Enter your admin email address to receive a secure password reset link.') }}</p>
                </div>

                <div class="admin-info">
                    <div class="admin-info-content">
                        <svg class="admin-icon" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        <p class="admin-text">{{ __('This is for administrators only. The reset link will be sent to your registered admin email address.') }}</p>
                    </div>
                </div>

                <form id="adminForgotPasswordForm" action="{{ route('admin.forget-password') }}" method="POST">
                    @csrf
                    
                    <div class="form-group">
                        <label for="email" class="form-label">{{ __('Admin Email Address') }}</label>
                        <input 
                            id="email" 
                            type="email" 
                            class="form-input" 
                            name="email"
                            tabindex="1" 
                            autofocus 
                            value="{{ old('email') }}"
                            placeholder="Enter your admin email address"
                            required
                        >
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <button id="adminResetPasswordBtn" type="submit" class="reset-button" tabindex="2">
                        <svg style="width: 16px; height: 16px; margin-right: 8px;" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                        </svg>
                        {{ __('Send Admin Reset Link') }}
                    </button>
                </form>
                
                <div class="account__switch">
                    <p>{{ __('Remember your password?') }}<a href="{{ route('admin.login') }}">{{ __('Back to Login') }}</a></p>
                </div>
                
                <div class="footer-text">
                    © 2025 {{ $setting->app_name }} - Admin Portal
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
