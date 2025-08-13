@extends('frontend.layouts.master')
@section('meta_title', $seo_setting['contact_page']['seo_title'])
@section('meta_description', $seo_setting['contact_page']['seo_description'])
@section('contents')
    <!-- breadcrumb-area -->
    <x-frontend.breadcrumb :title="__('Contact Us')" :subtitle="__('Get in touch with us for any questions or support')" :links="[['url' => route('home'), 'text' => __('Home')], ['url' => '', 'text' => __('Contact Us')]]" />
    <!-- breadcrumb-area-end -->
    
    <style>
        .modern-contact-area {
            background: #ffffff;
            min-height: 100vh;
            padding: 80px 0;
        }
        
        .contact-info-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            padding: 40px 30px;
            box-shadow: 0 8px 32px rgba(0, 102, 204, 0.1);
            margin-bottom: 30px;
            transition: all 0.3s ease;
        }
        
        .contact-info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 102, 204, 0.15);
        }
        
        .contact-form-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            padding: 50px 40px;
            box-shadow: 0 8px 32px rgba(0, 102, 204, 0.1);
            transition: all 0.3s ease;
        }
        
        .contact-info-item {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
            padding: 20px;
            border-radius: 15px;
            background: rgba(0, 102, 204, 0.05);
            transition: all 0.3s ease;
        }
        
        .contact-info-item:hover {
            background: rgba(0, 102, 204, 0.1);
            transform: translateX(10px);
        }
        
        .contact-info-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #0066cc, #004499);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 20px;
            flex-shrink: 0;
        }
        
        .contact-info-icon img {
            width: 24px;
            height: 24px;
            filter: brightness(0) invert(1);
        }
        
        .contact-info-content h4 {
            color: #0066cc;
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 8px;
        }
        
        .contact-info-content p,
        .contact-info-content a {
            color: #666;
            font-size: 14px;
            margin: 0;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .contact-info-content a:hover {
            color: #0066cc;
        }
        
        .modern-form-title {
            color: #0066cc;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 10px;
            text-align: center;
        }
        
        .modern-form-subtitle {
            color: #666;
            font-size: 16px;
            margin-bottom: 40px;
            text-align: center;
        }
        
        .modern-form-group {
            position: relative;
            margin-bottom: 30px;
        }
        
        .modern-form-input {
            width: 100%;
            padding: 20px 15px 15px;
            border: 2px solid #e1e5e9;
            border-radius: 12px;
            font-size: 16px;
            background: #ffffff;
            transition: all 0.3s ease;
            outline: none;
        }
        
        .modern-form-input:focus {
            border-color: #0066cc;
            box-shadow: 0 0 0 3px rgba(0, 102, 204, 0.1);
        }
        
        .modern-form-label {
            position: absolute;
            top: 20px;
            left: 15px;
            color: #999;
            font-size: 16px;
            transition: all 0.3s ease;
            pointer-events: none;
            background: #ffffff;
            padding: 0 5px;
        }
        
        .modern-form-input:focus + .modern-form-label,
        .modern-form-input:not(:placeholder-shown) + .modern-form-label {
            top: -8px;
            font-size: 12px;
            color: #0066cc;
            font-weight: 600;
        }
        
        .modern-form-textarea {
            width: 100%;
            padding: 20px 15px;
            border: 2px solid #e1e5e9;
            border-radius: 12px;
            font-size: 16px;
            background: #ffffff;
            transition: all 0.3s ease;
            outline: none;
            min-height: 120px;
            resize: vertical;
        }
        
        .modern-form-textarea:focus {
            border-color: #0066cc;
            box-shadow: 0 0 0 3px rgba(0, 102, 204, 0.1);
        }
        
        .modern-submit-btn {
            background: #0066cc;
            color: white;
            border: none;
            padding: 18px 40px;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        
        .modern-submit-btn:hover {
            background: #0052a3;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 102, 204, 0.3);
        }
        
        .modern-submit-btn img {
            width: 16px;
            height: 16px;
            filter: brightness(0) invert(1);
        }
        
        .contact-map-container {
            margin-top: 60px;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(0, 102, 204, 0.1);
        }
        
        .contact-map-container iframe {
            width: 100%;
            height: 400px;
            border: none;
        }
        
        @media (max-width: 768px) {
            .modern-contact-area {
                padding: 40px 0;
            }
            
            .contact-form-card {
                padding: 30px 20px;
            }
            
            .contact-info-card {
                padding: 30px 20px;
            }
            
            .contact-info-item {
                flex-direction: column;
                text-align: center;
            }
            
            .contact-info-icon {
                margin-right: 0;
                margin-bottom: 15px;
            }
        }
    </style>
    
    <!-- contact-area -->
    <section class="modern-contact-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="contact-info-card">
                        @if($contact?->address)
                        <div class="contact-info-item">
                            <div class="contact-info-icon">
                                <img src="{{ asset('frontend/img/icons/map.svg') }}" alt="img">
                            </div>
                            <div class="contact-info-content">
                                <h4>{{ __('Address') }}</h4>
                                <p>{{ $contact?->address }}</p>
                            </div>
                        </div>
                        @endif
                        
                        @if ($contact?->phone_one || $contact?->phone_two)
                        <div class="contact-info-item">
                            <div class="contact-info-icon">
                                <img src="{{ asset('frontend/img/icons/contact_phone.svg') }}" alt="img">
                            </div>
                            <div class="contact-info-content">
                                <h4>{{ __('Phone') }}</h4>
                                @if($contact?->phone_one)
                                    <a href="tel:{{ $contact?->phone_one }}">{{ $contact?->phone_one }}</a><br>
                                @endif
                                @if($contact?->phone_two)
                                    <a href="tel:{{ $contact?->phone_two }}">{{ $contact?->phone_two }}</a>
                                @endif
                            </div>
                        </div>
                        @endif
                        
                        @if($contact?->email_one || $contact?->email_two)
                        <div class="contact-info-item">
                            <div class="contact-info-icon">
                                <img src="{{ asset('frontend/img/icons/emial.svg') }}" alt="img">
                            </div>
                            <div class="contact-info-content">
                                <h4>{{ __('E-mail Address') }}</h4>
                                @if($contact?->email_one)
                                    <a href="mailto:{{ $contact?->email_one }}">{{ $contact?->email_one }}</a><br>
                                @endif
                                @if($contact?->email_two)
                                    <a href="mailto:{{ $contact?->email_two }}">{{ $contact?->email_two }}</a>
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="{{ ($contact?->address || $contact?->phone_one || $contact?->phone_two || $contact?->email_one || $contact?->email_two) ? 'col-lg-8' : 'col-lg-12' }}">
                    <div class="contact-form-card">
                        <h4 class="modern-form-title">{{ __('Send Us Message') }}</h4>
                        <p class="modern-form-subtitle">{{ __('Your email address will not be published. Required fields are marked') }} *</p>
                        
                        <form id="contact-form" action="" method="POST">
                            @csrf
                            
                            <div class="modern-form-group">
                                <textarea name="message" class="modern-form-textarea" placeholder=" " required></textarea>
                                <label class="modern-form-label">{{ __('Message') }} *</label>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="modern-form-group">
                                        <input name="subject" type="text" class="modern-form-input" placeholder=" " required>
                                        <label class="modern-form-label">{{ __('Subject') }} *</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="modern-form-group">
                                        <input name="name" type="text" class="modern-form-input" placeholder=" " required>
                                        <label class="modern-form-label">{{ __('Name') }} *</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="modern-form-group">
                                        <input name="email" type="email" class="modern-form-input" placeholder=" " required>
                                        <label class="modern-form-label">{{ __('E-mail') }} *</label>
                                    </div>
                                </div>
                                
                                <!-- g-recaptcha -->
                                @if (Cache::get('setting')->recaptcha_status === 'active')
                                    <div class="col-12">
                                        <div class="modern-form-group">
                                            <div class="g-recaptcha"
                                                data-sitekey="{{ Cache::get('setting')->recaptcha_site_key }}"></div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            
                            <button type="submit" class="modern-submit-btn">
                                {{ __('Submit Now') }}
                                <img src="{{ asset('frontend/img/icons/right_arrow.svg') }}" alt="img">
                            </button>
                        </form>
                        
                        <p class="ajax-response mb-0 mt-3 text-center"></p>
                    </div>
                </div>
            </div>
            <!-- contact-map -->
            @if($contact?->map)
            <div class="contact-map-container">
                <iframe src="{{ $contact?->map }}" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            @endif
            <!-- contact-map-end -->
        </div>
    </section>
    <!-- contact-area-end -->
@endsection

@if (session('contactUs') && $setting->google_tagmanager_status == 'active' && $marketing_setting?->contact_page)
    @php
        $contactUs = session('contactUs');
        session()->forget('contactUs');
    @endphp
    @push('scripts')
        <script>
            $(function() {
                dataLayer.push({
                    'event': 'contactUs',
                    'contact_info': @json($contactUs)
                });
            });
        </script>
    @endpush
@endif
