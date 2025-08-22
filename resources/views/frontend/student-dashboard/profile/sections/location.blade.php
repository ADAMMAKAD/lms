<div class="tab-pane fade show {{ session('profile_tab') == 'location' ? 'active' : '' }}" id="itemSix-tab-pane"
    role="tabpanel" aria-labelledby="itemSix-tab" tabindex="0">
    <style>
        .modern-location-container {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }
        
        .location-header {
            text-align: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #f3f4f6;
        }
        
        .location-header h3 {
            color: #0066cc;
            font-weight: 700;
            margin: 0;
            font-size: 1.5rem;
        }
        
        .location-header p {
            color: #6b7280;
            margin: 0.5rem 0 0 0;
            font-size: 0.95rem;
        }
        
        .modern-location-group {
            margin-bottom: 1.5rem;
        }
        
        .modern-location-label {
            display: block;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
        }
        
        .modern-location-label code {
            color: #ef4444;
            background: none;
            padding: 0;
            font-size: 0.9rem;
        }
        
        .modern-location-input {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #f9fafb;
        }
        
        .modern-location-input:focus {
            outline: none;
            border-color: #0066cc;
            background: white;
            box-shadow: 0 0 0 3px rgba(0, 102, 204, 0.1);
        }
        
        .modern-location-select {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #f9fafb;
            cursor: pointer;
        }
        
        .modern-location-select:focus {
            outline: none;
            border-color: #0066cc;
            background: white;
            box-shadow: 0 0 0 3px rgba(0, 102, 204, 0.1);
        }
        
        .modern-location-textarea {
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
        
        .modern-location-textarea:focus {
            outline: none;
            border-color: #0066cc;
            background: white;
            box-shadow: 0 0 0 3px rgba(0, 102, 204, 0.1);
        }
        
        .modern-location-submit {
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
        
        .modern-location-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 102, 204, 0.4);
        }
        
        .location-icon {
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
            .modern-location-container {
                padding: 1.5rem;
            }
        }
    </style>
    
    <div class="modern-location-container">
        <div class="location-header">
            <div class="location-icon">
                <i class="fas fa-map-marker-alt"></i>
            </div>
            <h3>{{ __('Location Information') }}</h3>
            <p>{{ __('Update your location details and address') }}</p>
        </div>
        
        <form action="{{ route('student.setting.address.update') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-4">
                    <div class="modern-location-group">
                        <label for="country" class="modern-location-label">
                            <i class="fas fa-globe me-2 text-primary"></i>{{ __('Country') }} <code>*</code>
                        </label>
                        <select name="country" id="country" class="country modern-location-select">
                            @if(isset($ethiopia) && $ethiopia)
                                <option value="{{ $ethiopia->id }}" selected>{{ $ethiopia->name }}</option>
                            @else
                                <option value="">{{ __('Select Country') }}</option>
                                @foreach (countries() as $country)
                                <option @selected($user->country_id == $country->id) value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="modern-location-group">
                        <label for="state" class="modern-location-label">
                            <i class="fas fa-map me-2 text-primary"></i>{{ __('State') }}
                        </label>
                        <select name="state" id="state" class="state modern-location-select">
                            <option value="">{{ __('Select State') }}</option>
                            @if(isset($states) && $states->count() > 0)
                                @foreach ($states as $state)
                                    <option @selected($user->state === $state->name) value="{{ $state->name }}">{{ $state->name }}</option>
                                @endforeach
                            @elseif (!empty($user->state))
                                <option selected value="{{ $user->state }}">{{ $user->state }}</option>
                            @endif
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="modern-location-group">
                        <label for="city" class="modern-location-label">
                            <i class="fas fa-city me-2 text-primary"></i>{{ __('City') }}
                        </label>
                        <input type="text" class="modern-location-input" name="city" id="city" value="{{ $user->city }}" placeholder="Enter your city">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="modern-location-group">
                        <label for="address" class="modern-location-label">
                            <i class="fas fa-home me-2 text-primary"></i>{{ __('Address') }}
                        </label>
                        <textarea name="address" id="address" class="modern-location-textarea" placeholder="Enter your full address">{{ $user->address }}</textarea>
                        <small class="text-muted">{{ __('Provide your complete address including street, area, and postal code') }}</small>
                    </div>
                </div>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="modern-location-submit">
                    <i class="fas fa-save me-2"></i>{{ __('Update Location') }}
                </button>
            </div>
        </form>
    </div>
</div>
