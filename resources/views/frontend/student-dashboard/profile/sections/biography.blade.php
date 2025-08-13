<div class="tab-pane fade show {{ session('profile_tab') == 'bio' ? 'active': '' }}" id="itemFour-tab-pane" role="tabpanel" aria-labelledby="itemFour-tab" tabindex="0">
    <style>
        .modern-bio-container {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }
        
        .bio-header {
            text-align: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #f3f4f6;
        }
        
        .bio-header h3 {
            color: #0066cc;
            font-weight: 700;
            margin: 0;
            font-size: 1.5rem;
        }
        
        .bio-header p {
            color: #6b7280;
            margin: 0.5rem 0 0 0;
            font-size: 0.95rem;
        }
        
        .modern-bio-group {
            margin-bottom: 1.5rem;
        }
        
        .modern-bio-label {
            display: block;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
        }
        
        .modern-bio-input {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #f9fafb;
        }
        
        .modern-bio-input:focus {
            outline: none;
            border-color: #0066cc;
            background: white;
            box-shadow: 0 0 0 3px rgba(0, 102, 204, 0.1);
        }
        
        .modern-bio-textarea {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #f9fafb;
            resize: vertical;
            min-height: 120px;
            font-family: inherit;
        }
        
        .modern-bio-textarea:focus {
            outline: none;
            border-color: #0066cc;
            background: white;
            box-shadow: 0 0 0 3px rgba(0, 102, 204, 0.1);
        }
        
        .modern-bio-submit {
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
        
        .modern-bio-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 102, 204, 0.4);
        }
        
        .bio-icon {
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
        
        @media (max-width: 768px) {
            .modern-bio-container {
                padding: 1.5rem;
            }
        }
    </style>
    
    <div class="modern-bio-container">
        <div class="bio-header">
            <div class="bio-icon">
                <i class="fas fa-user-edit"></i>
            </div>
            <h3>{{ __('Biography Information') }}</h3>
            <p>{{ __('Tell us about yourself and your professional background') }}</p>
        </div>
        
        <form action="{{ route('student.setting.bio.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-12">
                    <div class="modern-bio-group">
                        <label for="designation" class="modern-bio-label">
                            <i class="fas fa-briefcase me-2 text-primary"></i>{{ __('Designation') }}
                        </label>
                        <input id="designation" name="designation" type="text" value="{{ $user->job_title }}" class="modern-bio-input" placeholder="e.g. Software Developer, Student, etc.">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="modern-bio-group">
                        <label for="short-bio" class="modern-bio-label">
                            <i class="fas fa-align-left me-2 text-primary"></i>{{ __('Short Bio') }}
                        </label>
                        <textarea id="short-bio" name="short_bio" class="modern-bio-textarea" placeholder="Write a brief description about yourself (2-3 sentences)">{{ $user->short_bio }}</textarea>
                        <small class="text-muted">{{ __('This will be displayed as a summary on your profile') }}</small>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="modern-bio-group">
                        <label for="bio" class="modern-bio-label">
                            <i class="fas fa-file-alt me-2 text-primary"></i>{{ __('Bio') }}
                        </label>
                        <textarea id="bio" name="bio" class="modern-bio-textarea" style="min-height: 150px;" placeholder="Tell us more about your background, experience, interests, and goals">{{ $user->bio }}</textarea>
                        <small class="text-muted">{{ __('Provide detailed information about your professional background and interests') }}</small>
                    </div>
                </div>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="modern-bio-submit">
                    <i class="fas fa-save me-2"></i>{{ __('Update Biography') }}
                </button>
            </div>
        </form>
    </div>
</div>
