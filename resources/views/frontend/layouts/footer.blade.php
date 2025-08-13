@php
    $footerSetting = \Modules\FooterSetting\app\Models\FooterSetting::first();
    $footer_menu_one = menu_get_by_slug('footer-col-one');
    $footer_menu_two = menu_get_by_slug('footer-col-two-1PiTN');
    $footer_menu_three = menu_get_by_slug('footer-col-three');
@endphp

<style>
    .footer__widget {
        margin-bottom: 30px;
    }
    
    .footer__widget-title {
        color: white;
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 20px;
        position: relative;
        padding-bottom: 10px;
    }
    
    .footer__widget-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 40px;
        height: 2px;
        background: linear-gradient(135deg, #8b5cf6, #a855f7);
    }
    
    .footer__widget-desc {
        color: rgba(255,255,255,0.8);
        font-size: 14px;
        line-height: 1.6;
        margin-bottom: 15px;
    }
    
    .footer__widget ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .footer__widget ul li {
        margin-bottom: 8px;
    }
    
    .footer__widget ul li a {
        color: rgba(255,255,255,0.8);
        text-decoration: none;
        font-size: 14px;
        transition: all 0.3s ease;
        display: inline-block;
    }
    
    .footer__widget ul li a:hover {
        color: #ffd700;
        padding-left: 5px;
    }
    
    .footer__contact-item {
        display: flex;
        align-items: flex-start;
        margin-bottom: 15px;
        gap: 10px;
    }
    
    .footer__contact-icon {
        width: 20px;
        height: 20px;
        background: rgba(139, 92, 246, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        margin-top: 2px;
    }
    
    .footer__contact-icon i {
        color: #8b5cf6;
        font-size: 12px;
    }
    
    .footer__contact-text {
        color: rgba(255,255,255,0.8);
        font-size: 14px;
        line-height: 1.5;
    }
    
    .footer__newsletter-form {
        display: flex;
        gap: 10px;
        margin-top: 15px;
    }
    
    .footer__newsletter-input {
        flex: 1;
        padding: 12px 15px;
        border: 1px solid rgba(255,255,255,0.2);
        border-radius: 25px;
        background: rgba(255,255,255,0.1);
        color: white;
        font-size: 14px;
        transition: all 0.3s ease;
    }
    
    .footer__newsletter-input:focus {
        outline: none;
        border-color: #8b5cf6;
        box-shadow: 0 0 10px rgba(139, 92, 246, 0.2);
    }
    
    .footer__newsletter-input::placeholder {
        color: rgba(255,255,255,0.7);
    }
    
    .footer__newsletter-btn {
        padding: 12px 20px;
        background: linear-gradient(135deg, #8b5cf6, #a855f7);
        border: none;
        border-radius: 25px;
        color: white;
        cursor: pointer;
        transition: all 0.3s ease;
        font-weight: 600;
    }
    
    .footer__newsletter-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(139, 92, 246, 0.3);
    }
    
    .footer__social-links {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        margin-top: 15px;
    }
    
    .footer__social-link {
        display: inline-block;
        width: 42px;
        height: 42px;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        text-decoration: none;
    }
    
    .footer__social-link:hover {
        background: linear-gradient(135deg, #8b5cf6, #a855f7);
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(139, 92, 246, 0.3);
    }
    
    .footer__social-link i {
        color: white;
        font-size: 16px;
        transition: color 0.3s ease;
    }
    
    .footer__social-link:hover i {
        color: #333;
    }
    
    @media (max-width: 768px) {
        .footer__widget {
            margin-bottom: 25px;
        }
        
        .footer__newsletter-form {
            flex-direction: column;
            gap: 15px;
        }
        
        .footer__social-links {
            justify-content: center;
        }
    }
</style>

<footer class="footer__area modern-footer" style="background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #a855f7 100%); color: white;">

    <div class="footer__top" style="padding: 60px 0 40px;">
        <div class="container">
            <div class="row">
                <!-- Company Info Widget -->
                <div class="col-xl-3 col-lg-6 col-md-6">
                    <div class="footer__widget">
                        <div class="logo mb-35">
                            <a href="{{ route('home') }}"><img src="{{ !empty($footerSetting?->logo) ? asset($footerSetting?->logo) : asset($setting?->logo) }}" alt="img"></a>
                        </div>
                        <div class="footer__content">
                            <p style="color: rgba(255,255,255,0.9); margin-bottom: 20px; line-height: 1.6;">{{ $footerSetting?->footer_text ?: 'Empowering SMEs with world-class training programs and professional development opportunities.' }}</p>
                            <div class="company-stats" style="margin-top: 20px;">
                                <div style="display: flex; gap: 20px; flex-wrap: wrap;">
                                    <div style="text-align: center;">
                                        <h5 style="color: #a855f7; font-size: 20px; font-weight: 700; margin: 0;">500+</h5>
                                        <span style="color: rgba(255,255,255,0.8); font-size: 12px;">{{ __('Courses') }}</span>
                                    </div>
                                    <div style="text-align: center;">
                                        <h5 style="color: #a855f7; font-size: 20px; font-weight: 700; margin: 0;">10K+</h5>
                                        <span style="color: rgba(255,255,255,0.8); font-size: 12px;">{{ __('Students') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Quick Links Widget -->
                <div class="col-xl-2 col-lg-6 col-md-6 col-sm-6">
                    <div class="footer__widget">
                        <h4 class="footer__widget-title">
                            {{ __('Quick Links') }}
                        </h4>
                        <div class="footer__link">
                            <ul class="list-wrap">
                                <li style="margin-bottom: 10px;">
                                    <a href="{{ route('home') }}" style="color: rgba(255,255,255,0.8); text-decoration: none; transition: all 0.3s ease; display: inline-block;" 
                                       onmouseover="this.style.color='#a855f7'; this.style.paddingLeft='5px'" 
                                       onmouseout="this.style.color='rgba(255,255,255,0.8)'; this.style.paddingLeft='0'"><i class="fas fa-home" style="margin-right: 8px;"></i>{{ __('Home') }}</a>
                                </li>
                                <li style="margin-bottom: 10px;">
                                    <a href="{{ route('courses') }}" style="color: rgba(255,255,255,0.8); text-decoration: none; transition: all 0.3s ease; display: inline-block;" 
                                       onmouseover="this.style.color='#a855f7'; this.style.paddingLeft='5px'" 
                                       onmouseout="this.style.color='rgba(255,255,255,0.8)'; this.style.paddingLeft='0'"><i class="fas fa-book" style="margin-right: 8px;"></i>{{ __('Courses') }}</a>
                                </li>
                                <li style="margin-bottom: 10px;">
                                    <a href="{{ route('all-instructors') }}" style="color: rgba(255,255,255,0.8); text-decoration: none; transition: all 0.3s ease; display: inline-block;" 
                                       onmouseover="this.style.color='#a855f7'; this.style.paddingLeft='5px'" 
                                       onmouseout="this.style.color='rgba(255,255,255,0.8)'; this.style.paddingLeft='0'"><i class="fas fa-chalkboard-teacher" style="margin-right: 8px;"></i>{{ __('Instructors') }}</a>
                                </li>
                                <li style="margin-bottom: 10px;">
                                    <a href="{{ route('about-us') }}" style="color: rgba(255,255,255,0.8); text-decoration: none; transition: all 0.3s ease; display: inline-block;" 
                                       onmouseover="this.style.color='#a855f7'; this.style.paddingLeft='5px'" 
                                       onmouseout="this.style.color='rgba(255,255,255,0.8)'; this.style.paddingLeft='0'"><i class="fas fa-info-circle" style="margin-right: 8px;"></i>{{ __('About Us') }}</a>
                                </li>
                                <li style="margin-bottom: 10px;">
                                    <a href="{{ route('contact.index') }}" style="color: rgba(255,255,255,0.8); text-decoration: none; transition: all 0.3s ease; display: inline-block;" 
                                       onmouseover="this.style.color='#a855f7'; this.style.paddingLeft='5px'" 
                                       onmouseout="this.style.color='rgba(255,255,255,0.8)'; this.style.paddingLeft='0'"><i class="fas fa-envelope" style="margin-right: 8px;"></i>{{ __('Contact') }}</a>
                                </li>
                                @if($footer_menu_one && $footer_menu_one->menuItems && count($footer_menu_one->menuItems) > 0)
                                    @foreach ($footer_menu_one->menuItems as $footerMenuOne)
                                        <li style="margin-bottom: 10px;">
                                            <a href="{{ url($footerMenuOne?->link) }}" style="color: rgba(255,255,255,0.8); text-decoration: none; transition: all 0.3s ease; display: inline-block;" 
                                               onmouseover="this.style.color='#a855f7'; this.style.paddingLeft='5px'" 
                                               onmouseout="this.style.color='rgba(255,255,255,0.8)'; this.style.paddingLeft='0'">{{ $footerMenuOne?->label }}</a>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Contact Information Widget -->
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                    <div class="footer__widget">
                        <h4 class="footer__widget-title">
                            {{ __('Contact Info') }}
                        </h4>
                        <div class="contact-info">
                            <div style="margin-bottom: 15px;">
                                <div style="display: flex; align-items: flex-start; margin-bottom: 12px;">
                                    <i class="fas fa-map-marker-alt" style="color: #a855f7; margin-right: 12px; margin-top: 4px; font-size: 16px;"></i>
                                    <div>
                                        <strong style="color: white; display: block; margin-bottom: 4px;">{{ __('Address') }}</strong>
                                        <span style="color: rgba(255,255,255,0.8); line-height: 1.5;">{{ $footerSetting?->address ?: 'UNDP Building, Addis Ababa, Ethiopia' }}</span>
                                    </div>
                                </div>
                                <div style="display: flex; align-items: center; margin-bottom: 12px;">
                                    <i class="fas fa-phone" style="color: #a855f7; margin-right: 12px; font-size: 16px;"></i>
                                    <div>
                                        <strong style="color: white; display: block; margin-bottom: 4px;">{{ __('Phone') }}</strong>
                                        <a href="tel:{{ $footerSetting?->phone }}" style="color: rgba(255,255,255,0.8); text-decoration: none;">{{ $footerSetting?->phone ?: '+251-11-XXX-XXXX' }}</a>
                                    </div>
                                </div>
                                <div style="display: flex; align-items: center; margin-bottom: 12px;">
                                    <i class="fas fa-envelope" style="color: #a855f7; margin-right: 12px; font-size: 16px;"></i>
                                    <div>
                                        <strong style="color: white; display: block; margin-bottom: 4px;">{{ __('Email') }}</strong>
                                        <a href="mailto:info@undplms.et" style="color: rgba(255,255,255,0.8); text-decoration: none;">info@undplms.et</a>
                                    </div>
                                </div>
                                <div style="display: flex; align-items: flex-start;">
                                    <i class="fas fa-clock" style="color: #a855f7; margin-right: 12px; margin-top: 4px; font-size: 16px;"></i>
                                    <div>
                                        <strong style="color: white; display: block; margin-bottom: 4px;">{{ __('Business Hours') }}</strong>
                                        <span style="color: rgba(255,255,255,0.8); line-height: 1.5;">{{ __('Mon - Fri: 8:00 AM - 6:00 PM') }}<br>{{ __('Sat: 9:00 AM - 4:00 PM') }}</span>
                                    </div>
                                </div>
                            </div>
                            @if($footer_menu_two && $footer_menu_two->menuItems && count($footer_menu_two->menuItems) > 0)
                            <div class="company-links" style="margin-top: 20px;">
                                <h6 style="color: white; font-size: 14px; margin-bottom: 10px;">{{ __('Company Links') }}</h6>
                                <ul class="list-wrap" style="display: flex; flex-wrap: wrap; gap: 15px;">
                                    @foreach ($footer_menu_two->menuItems as $footerMenuTwo)
                                        <li>
                                            <a href="{{ url($footerMenuTwo?->link) }}" style="color: rgba(255,255,255,0.8); text-decoration: none; font-size: 13px; transition: all 0.3s ease;" 
                                               onmouseover="this.style.color='#a855f7'" 
                                               onmouseout="this.style.color='rgba(255,255,255,0.8)'">{{ $footerMenuTwo?->label }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="footer__widget">
                        <h4 class="footer__widget-title">
                            {{ __('Newsletter') }}
                        </h4>
                        <div class="newsletter-content">
                            <p style="color: rgba(255,255,255,0.9); margin-bottom: 20px;">{{ __('Stay updated with our latest training programs and industry insights.') }}</p>
                            <form class="newsletter-form" style="margin-bottom: 25px;">
                                <div style="position: relative; margin-bottom: 15px;">
                                    <input type="email" placeholder="{{ __('Enter your email') }}" 
                                           style="width: 100%; padding: 12px 15px; border: none; border-radius: 25px; background: rgba(255,255,255,0.1); color: white; font-size: 14px; backdrop-filter: blur(10px);" 
                                           onfocus="this.style.background='rgba(255,255,255,0.2)'" 
                                           onblur="this.style.background='rgba(255,255,255,0.1)'">
                                </div>
                                <button type="submit" 
                                        style="width: 100%; padding: 12px 20px; background: linear-gradient(45deg, #8b5cf6, #a855f7); color: white; border: none; border-radius: 25px; font-weight: 600; cursor: pointer; transition: all 0.3s ease;" 
                                        onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 5px 15px rgba(139, 92, 246, 0.4)'" 
                                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                                    {{ __('Subscribe Now') }}
                                </button>
                            </form>
                            <div class="social-links">
                                <p style="color: rgba(255,255,255,0.9); margin-bottom: 15px; font-size: 14px;">{{ __('Connect with us on social media') }}</p>
                                <ul class="list-wrap footer__social" style="display: flex; gap: 12px; flex-wrap: wrap;">
                                    @foreach (getSocialLinks() as $socialLink)
                                        <li>
                                            <a href="{{ $socialLink->link }}" target="_blank" title="{{ $socialLink->name }}" 
                                               style="display: inline-block; width: 42px; height: 42px; background: rgba(255,255,255,0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: all 0.3s ease;" 
                                               onmouseover="this.style.background='linear-gradient(135deg, #8b5cf6, #a855f7)'; this.style.transform='translateY(-3px)'; this.style.boxShadow='0 5px 15px rgba(139, 92, 246, 0.3)'" 
                                               onmouseout="this.style.background='rgba(255,255,255,0.1)'; this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                                                <img src="{{ asset($socialLink->icon) }}" alt="{{ $socialLink->name }}" style="width: 22px; height: 22px;">
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer__bottom" style="background: rgba(0,0,0,0.2); padding: 25px 0; border-top: 1px solid rgba(255,255,255,0.1);">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-7">
                    <div class="copy-right-text">
                        @if(Cache::get('setting')->copyright_text)
                        <p style="color: rgba(255,255,255,0.8); margin: 0; font-size: 14px;">© {{ Cache::get('setting')->copyright_text }}</p>
                        @endif
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="footer__bottom-menu">
                        <ul class="list-wrap" style="display: flex; justify-content: flex-end; gap: 20px; margin: 0;">
                            @if($footer_menu_three && $footer_menu_three->menuItems)
                                @foreach ($footer_menu_three->menuItems as $footerMenuThree)
                                    <li>
                                        <a href="{{ url($footerMenuThree?->link) }}" 
                                           style="color: rgba(255,255,255,0.8); text-decoration: none; font-size: 14px; transition: all 0.3s ease;" 
                                           onmouseover="this.style.color='#ffd700'" 
                                           onmouseout="this.style.color='rgba(255,255,255,0.8)'">{{ $footerMenuThree?->label }}</a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
