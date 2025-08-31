@extends('frontend.layouts.master')
@section('meta_title', $seo_setting['contact_page']['seo_title'])
@section('meta_description', $seo_setting['contact_page']['seo_description'])
@section('contents')
    <!-- breadcrumb-area -->
    <x-frontend.breadcrumb :title="__('Contact Us')" :subtitle="__('Get in touch with us for any questions or support')" :links="[['url' => route('home'), 'text' => __('Home')], ['url' => '', 'text' => __('Contact Us')]]" />
    <!-- breadcrumb-area-end -->
    
    <style>
        /* Modern Contact Page Styling */
        .modern-contact-area {
            background: linear-gradient(135deg, #f8fafc 0%, #e3f2fd 50%, #f0f9ff 100%);
            min-height: 100vh;
            padding: 100px 0;
            position: relative;
            overflow: hidden;
        }
        
        .modern-contact-area::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="contact-dots" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1" fill="%230066cc" opacity="0.05"/></pattern></defs><rect width="100" height="100" fill="url(%23contact-dots)"/></svg>') repeat;
            animation: float 20s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        .contact-info-card {
            background: linear-gradient(135deg, rgba(255,255,255,0.95) 0%, rgba(248,250,252,0.9) 100%);
            backdrop-filter: blur(25px);
            border: 2px solid rgba(0,102,204,0.1);
            border-radius: 24px;
            padding: 50px 40px;
            box-shadow: 0 15px 50px rgba(0,102,204,0.12);
            margin-bottom: 40px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            animation: fadeInUp 0.8s ease-out;
        }
        
        .contact-info-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #0066cc 0%, #ffd700 50%, #0066cc 100%);
            border-radius: 24px 24px 0 0;
        }
        
        .contact-info-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 25px 60px rgba(0,102,204,0.2);
            border-color: rgba(0,102,204,0.2);
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .contact-form-card {
            background: linear-gradient(135deg, rgba(255,255,255,0.98) 0%, rgba(248,250,252,0.95) 100%);
            backdrop-filter: blur(30px);
            border: 2px solid rgba(0,102,204,0.12);
            border-radius: 28px;
            padding: 60px 50px;
            box-shadow: 0 20px 60px rgba(0,102,204,0.15);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            animation: fadeInUp 0.8s ease-out 0.2s both;
        }
        
        .contact-form-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, #0066cc 0%, #ffd700 30%, #0066cc 60%, #ffd700 100%);
            border-radius: 28px 28px 0 0;
        }
        
        .contact-form-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 30px 80px rgba(0,102,204,0.2);
            border-color: rgba(0,102,204,0.2);
        }
        
        .contact-info-item {
            display: flex;
            align-items: center;
            margin-bottom: 35px;
            padding: 28px 24px;
            border-radius: 20px;
            background: linear-gradient(135deg, rgba(0,102,204,0.06) 0%, rgba(255,215,0,0.03) 100%);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(0,102,204,0.08);
            position: relative;
            overflow: hidden;
            animation: slideInLeft 0.6s ease-out;
            animation-delay: calc(var(--item-index, 0) * 0.1s);
        }
        
        .contact-info-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(0,102,204,0.1), rgba(255,215,0,0.05), transparent);
            transition: left 0.6s ease;
        }
        
        .contact-info-item:hover {
            background: linear-gradient(135deg, rgba(0,102,204,0.12) 0%, rgba(255,215,0,0.08) 100%);
            transform: translateX(15px) translateY(-3px);
            box-shadow: 0 12px 30px rgba(0,102,204,0.15);
            border-color: rgba(0,102,204,0.2);
        }
        
        .contact-info-item:hover::before {
            left: 100%;
        }
        
        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        .contact-info-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #0066cc 0%, #004499 50%, #002266 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 25px;
            flex-shrink: 0;
            transition: all 0.4s ease;
            position: relative;
            box-shadow: 0 8px 25px rgba(0,102,204,0.3);
        }
        
        .contact-info-icon::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(45deg, #0066cc, #ffd700, #0066cc);
            border-radius: 50%;
            z-index: -1;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .contact-info-item:hover .contact-info-icon {
            transform: scale(1.1) rotate(10deg);
            box-shadow: 0 12px 35px rgba(0,102,204,0.4);
        }
        
        .contact-info-item:hover .contact-info-icon::before {
            opacity: 1;
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
            font-size: 36px;
            font-weight: 800;
            margin-bottom: 50px;
            text-align: center;
            position: relative;
            animation: fadeInDown 0.8s ease-out;
        }
        
        .modern-form-title::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, #0066cc, #ffd700);
            border-radius: 2px;
        }
        
        .modern-form-subtitle {
            color: #666;
            font-size: 16px;
            margin-bottom: 40px;
            text-align: center;
        }
        
        .modern-form-group {
            position: relative;
            margin-bottom: 35px;
            animation: fadeInUp 0.6s ease-out;
            animation-delay: calc(var(--form-index, 0) * 0.1s);
            animation-fill-mode: both;
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
            background: linear-gradient(135deg, #0066cc 0%, #004499 50%, #002266 100%);
            color: white;
            border: none;
            padding: 20px 50px;
            border-radius: 16px;
            font-size: 18px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            position: relative;
            overflow: hidden;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 8px 30px rgba(0,102,204,0.3);
        }
        
        .modern-submit-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.6s ease;
        }
        
        .modern-submit-btn:hover {
            background: linear-gradient(135deg, #004499 0%, #002266 50%, #001133 100%);
            transform: translateY(-4px) scale(1.02);
            box-shadow: 0 15px 40px rgba(0,102,204,0.4);
        }
        
        .modern-submit-btn:hover::before {
            left: 100%;
        }
        
        .modern-submit-btn:active {
            transform: translateY(-2px) scale(1.01);
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
