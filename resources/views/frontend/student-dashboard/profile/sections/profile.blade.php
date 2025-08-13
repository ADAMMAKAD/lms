<div class="tab-pane fade show {{ session('profile_tab') == 'profile' ? 'active': '' }}" id="itemOne-tab-pane" role="tabpanel" aria-labelledby="itemOne-tab" tabindex="0">
    <style>
        .modern-cover-section {
            background: linear-gradient(135deg, #0066cc 0%, #004499 100%);
            border-radius: 16px;
            padding: 2rem;
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
        }
        
        .modern-cover-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('{{ asset($user->cover) }}');
            background-size: cover;
            background-position: center;
            opacity: 0.3;
            z-index: 1;
        }
        
        .cover-content {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
        }
        
        .profile-avatar-section {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .modern-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 4px solid white;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            object-fit: cover;
        }
        
        .avatar-upload-btn {
            background: rgba(255, 255, 255, 0.2);
            border: 2px solid white;
            color: white;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }
        
        .avatar-upload-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: scale(1.1);
        }
        
        .cover-edit-btn {
            background: rgba(255, 255, 255, 0.2);
            border: 2px solid white;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }
        
        .cover-edit-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            color: white;
            transform: translateY(-2px);
        }
        
        .modern-form-container {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }
        
        .modern-form-group {
            margin-bottom: 1.5rem;
        }
        
        .modern-form-label {
            display: block;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
        }
        
        .modern-form-label code {
            color: #ef4444;
            background: none;
            padding: 0;
            font-size: 0.9rem;
        }
        
        .modern-form-input {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #f9fafb;
        }
        
        .modern-form-input:focus {
            outline: none;
            border-color: #0066cc;
            background: white;
            box-shadow: 0 0 0 3px rgba(0, 102, 204, 0.1);
        }
        
        .modern-form-select {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #f9fafb;
            cursor: pointer;
        }
        
        .modern-form-select:focus {
            outline: none;
            border-color: #0066cc;
            background: white;
            box-shadow: 0 0 0 3px rgba(0, 102, 204, 0.1);
        }
        
        .modern-submit-btn {
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
        
        .modern-submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 102, 204, 0.4);
        }
        
        @media (max-width: 768px) {
            .cover-content {
                flex-direction: column;
                text-align: center;
            }
            
            .modern-cover-section {
                padding: 1.5rem;
            }
            
            .modern-form-container {
                padding: 1.5rem;
            }
        }
    </style>
    
    <div class="modern-cover-section">
        <div class="cover-content">
            <div class="profile-avatar-section">
                <img class="modern-avatar preview-avatar" src="{{ asset($user->image) }}" alt="Profile Image">
                <button class="avatar-upload-btn" title="Upload Photo" onclick="$('#avatar').trigger('click')">
                    <i class="fas fa-camera"></i>
                </button>
            </div>
            <a href="javascript:;" onclick="$('#cover-img').trigger('click')" class="cover-edit-btn">
                <i class="fas fa-edit me-2"></i>{{ __('Edit Cover Photo') }}
            </a>
        </div>
    </div>
    
    <div class="modern-form-container">
        <form action="{{ route('student.setting.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="file" name="avatar" id="avatar" hidden>
            <input type="file" name="cover" id="cover-img" hidden>

            <div class="row">
                <div class="col-md-12">
                    <div class="modern-form-group">
                        <label for="name" class="modern-form-label">{{ __('Full Name') }} <code>*</code></label>
                        <input id="name" name="name" type="text" value="{{ $user->name }}" class="modern-form-input" placeholder="Enter your full name">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="modern-form-group">
                        <label for="email" class="modern-form-label">{{ __('Email') }} <code>*</code></label>
                        <input id="email" name="email" type="email" value="{{ $user->email }}" class="modern-form-input" placeholder="Enter your email address">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="modern-form-group">
                        <label for="phone" class="modern-form-label">{{ __('Phone') }}</label>
                        <input id="phone" name="phone" type="text" value="{{ $user->phone }}" class="modern-form-input" placeholder="Enter your phone number">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="modern-form-group">
                        <label for="gender" class="modern-form-label">{{ __('Gender') }}</label>
                        <select name="gender" id="gender" class="modern-form-select">
                            <option value="">{{ __('Select Gender') }}</option>
                            <option @selected($user->gender == 'male') value="male">{{ __('Male') }}</option>
                            <option @selected($user->gender == 'female') value="female">{{ __('Female') }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="modern-form-group">
                        <label for="age" class="modern-form-label">{{ __('Age') }}</label>
                        <input id="age" name="age" type="number" value="{{ $user->age }}" class="modern-form-input" placeholder="Enter your age">
                    </div>
                </div>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="modern-submit-btn">
                    <i class="fas fa-save me-2"></i>{{ __('Update Profile') }}
                </button>
            </div>
        </form>
    </div>
</div>
