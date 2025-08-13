<div class="tab-pane fade {{ session('profile_tab') == 'password' ? 'show active': '' }}" id="itemTwo-tab-pane" role="tabpanel" aria-labelledby="itemTwo-tab" tabindex="0">
    <style>
        .modern-password-container {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }
        
        .password-header {
            text-align: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #f3f4f6;
        }
        
        .password-header h3 {
            color: #0066cc;
            font-weight: 700;
            margin: 0;
            font-size: 1.5rem;
        }
        
        .password-header p {
            color: #6b7280;
            margin: 0.5rem 0 0 0;
            font-size: 0.95rem;
        }
        
        .modern-password-group {
            margin-bottom: 1.5rem;
        }
        
        .modern-password-label {
            display: block;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
        }
        
        .modern-password-input {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #f9fafb;
        }
        
        .modern-password-input:focus {
            outline: none;
            border-color: #0066cc;
            background: white;
            box-shadow: 0 0 0 3px rgba(0, 102, 204, 0.1);
        }
        
        .modern-password-submit {
            background: linear-gradient(135deg, #0066cc 0%, #004499 100%);
            color: white;
            border: none;
            padding: 1rem 2rem;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 102, 204, 0.3);
        }
        
        .modern-password-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 102, 204, 0.4);
        }
        
        .password-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #0066cc 0%, #004499 100%);
            border-radius: 50%;
            color: white;
            margin-bottom: 1rem;
        }
        
        .password-strength-info {
            background: #f0f9ff;
            border: 1px solid #bae6fd;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }
        
        .password-strength-info h6 {
            color: #0066cc;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        
        .password-strength-info ul {
            margin: 0;
            padding-left: 1.2rem;
            color: #374151;
            font-size: 0.9rem;
        }
        
        .password-strength-info li {
            margin-bottom: 0.25rem;
        }
        
        @media (max-width: 768px) {
            .modern-password-container {
                padding: 1.5rem;
            }
        }
    </style>
    
    <div class="modern-password-container">
        <div class="password-header">
            <div class="password-icon">
                <i class="fas fa-lock"></i>
            </div>
            <h3>{{ __('Change Password') }}</h3>
            <p>{{ __('Update your password to keep your account secure') }}</p>
        </div>
        
        <div class="password-strength-info">
            <h6><i class="fas fa-shield-alt me-2"></i>{{ __('Password Requirements') }}</h6>
            <ul>
                <li>{{ __('At least 8 characters long') }}</li>
                <li>{{ __('Include uppercase and lowercase letters') }}</li>
                <li>{{ __('Include at least one number') }}</li>
                <li>{{ __('Include at least one special character') }}</li>
            </ul>
        </div>
        
        <form action="{{ route('student.setting.password.update') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-12">
                    <div class="modern-password-group">
                        <label for="current_password" class="modern-password-label">
                            <i class="fas fa-key me-2 text-primary"></i>{{ __('Current Password') }}
                        </label>
                        <input id="current_password" name="current_password" type="password" class="modern-password-input" placeholder="Enter your current password">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="modern-password-group">
                        <label for="password" class="modern-password-label">
                            <i class="fas fa-lock me-2 text-primary"></i>{{ __('New Password') }}
                        </label>
                        <input id="password" name="password" type="password" class="modern-password-input" placeholder="Enter new password">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="modern-password-group">
                        <label for="password_confirmation" class="modern-password-label">
                            <i class="fas fa-check-circle me-2 text-primary"></i>{{ __('Confirm New Password') }}
                        </label>
                        <input id="password_confirmation" name="password_confirmation" type="password" class="modern-password-input" placeholder="Confirm new password">
                    </div>
                </div>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="modern-password-submit">
                    <i class="fas fa-save me-2"></i>{{ __('Update Password') }}
                </button>
            </div>
        </form>
    </div>
</div>
