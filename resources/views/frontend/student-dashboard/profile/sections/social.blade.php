<div class="tab-pane fade show {{ session('profile_tab') == 'social' ? 'active': '' }}" id="itemThree-tab-pane" role="tabpanel" aria-labelledby="itemThree-tab"
tabindex="0">
    <style>
        .modern-social-container {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }
        
        .social-header {
            text-align: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #f3f4f6;
        }
        
        .social-header h3 {
            color: #0066cc;
            font-weight: 700;
            margin: 0;
            font-size: 1.5rem;
        }
        
        .social-header p {
            color: #6b7280;
            margin: 0.5rem 0 0 0;
            font-size: 0.95rem;
        }
        
        .modern-social-group {
            margin-bottom: 1.5rem;
        }
        
        .modern-social-label {
            display: block;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
        }
        
        .modern-social-input {
            width: 100%;
            padding: 0.875rem 1rem 0.875rem 3rem;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #f9fafb;
        }
        
        .modern-social-input:focus {
            outline: none;
            border-color: #0066cc;
            background: white;
            box-shadow: 0 0 0 3px rgba(0, 102, 204, 0.1);
        }
        
        .social-input-wrapper {
            position: relative;
        }
        
        .social-input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #6b7280;
            z-index: 2;
        }
        
        .modern-social-submit {
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
        
        .modern-social-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 102, 204, 0.4);
        }
        
        .social-icon {
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
        
        .social-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }
        
        @media (max-width: 768px) {
            .modern-social-container {
                padding: 1.5rem;
            }
            
            .social-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
    
    <div class="modern-social-container">
        <div class="social-header">
            <div class="social-icon">
                <i class="fas fa-share-alt"></i>
            </div>
            <h3>{{ __('Social Media Links') }}</h3>
            <p>{{ __('Connect your social media profiles to showcase your online presence') }}</p>
        </div>
        
        <form action="{{ route('student.setting.socials.update') }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="social-grid">
                <div class="modern-social-group">
                    <label for="facebook" class="modern-social-label">
                        <i class="fab fa-facebook text-primary me-2"></i>{{ __('Facebook') }}
                    </label>
                    <div class="social-input-wrapper">
                        <i class="fab fa-facebook social-input-icon"></i>
                        <input id="facebook" name="facebook" type="url" value="{{ $user->facebook }}" class="modern-social-input" placeholder="https://facebook.com/username">
                    </div>
                </div>
                
                <div class="modern-social-group">
                    <label for="twitter" class="modern-social-label">
                        <i class="fab fa-twitter text-primary me-2"></i>{{ __('Twitter') }}
                    </label>
                    <div class="social-input-wrapper">
                        <i class="fab fa-twitter social-input-icon"></i>
                        <input id="twitter" name="twitter" type="url" value="{{ $user->twitter }}" class="modern-social-input" placeholder="https://twitter.com/username">
                    </div>
                </div>
                
                <div class="modern-social-group">
                    <label for="linkedin" class="modern-social-label">
                        <i class="fab fa-linkedin text-primary me-2"></i>{{ __('LinkedIn') }}
                    </label>
                    <div class="social-input-wrapper">
                        <i class="fab fa-linkedin social-input-icon"></i>
                        <input id="linkedin" name="linkedin" type="url" value="{{ $user->linkedin }}" class="modern-social-input" placeholder="https://linkedin.com/in/username">
                    </div>
                </div>
                
                <div class="modern-social-group">
                    <label for="website" class="modern-social-label">
                        <i class="fas fa-globe text-primary me-2"></i>{{ __('Website') }}
                    </label>
                    <div class="social-input-wrapper">
                        <i class="fas fa-globe social-input-icon"></i>
                        <input id="website" name="website" type="url" value="{{ $user->website }}" class="modern-social-input" placeholder="https://yourwebsite.com">
                    </div>
                </div>
                
                <div class="modern-social-group">
                    <label for="github" class="modern-social-label">
                        <i class="fab fa-github text-primary me-2"></i>{{ __('Github') }}
                    </label>
                    <div class="social-input-wrapper">
                        <i class="fab fa-github social-input-icon"></i>
                        <input id="github" name="github" type="url" value="{{ $user->github }}" class="modern-social-input" placeholder="https://github.com/username">
                    </div>
                </div>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="modern-social-submit">
                    <i class="fas fa-save me-2"></i>{{ __('Update Social Links') }}
                </button>
            </div>
        </form>
    </div>
</div>

