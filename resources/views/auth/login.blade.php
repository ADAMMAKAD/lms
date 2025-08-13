@extends('frontend.layouts.master')
@section('meta_title', 'Login'. ' || ' . $setting->app_name)
@section('contents')
    <!-- breadcrumb-area -->
    <x-frontend.breadcrumb
        :title="__('Login')"
        :subtitle="__('Sign in to access your learning dashboard and continue your journey')"
        :links="[
            ['url' => route('home'), 'text' => __('Home')],
            ['url' => route('login'), 'text' => __('Login')],
        ]"
    />
    <!-- breadcrumb-area-end -->

    <!-- singUp-area -->
    <section class="singUp-area section-py-120" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); min-height: 80vh; display: flex; align-items: center;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-5 col-lg-7 col-md-8">
                    <div class="singUp-wrap modern-login-card" style="background: #fff; border-radius: 20px; box-shadow: 0 20px 40px rgba(0,0,0,0.1); padding: 3rem; border: none; position: relative; overflow: hidden;">
                        <!-- Background decoration -->
                        <div style="position: absolute; top: -50px; right: -50px; width: 100px; height: 100px; background: linear-gradient(45deg, #0066cc, #004499); border-radius: 50%; opacity: 0.1;"></div>
                        <div style="position: absolute; bottom: -30px; left: -30px; width: 60px; height: 60px; background: linear-gradient(45deg, #0066cc, #004499); border-radius: 50%; opacity: 0.1;"></div>
                        
                        <!-- UNDP Branding -->
                        <div style="text-align: center; margin-bottom: 2rem;">
                            <h3 style="color: #0066cc; font-weight: 800; margin: 0; font-size: 1.8rem; letter-spacing: -0.5px;">UNDP LMS</h3>
                            <div style="width: 50px; height: 3px; background: linear-gradient(45deg, #0066cc, #004499); margin: 0.5rem auto;"></div>
                        </div>
                        
                        <h2 class="title" style="color: #333; font-weight: 700; font-size: 1.8rem; margin-bottom: 0.5rem; text-align: center;">{{ __('Welcome Back!') }}</h2>
                        <p style="color: #666; text-align: center; margin-bottom: 2rem; font-size: 1rem;">{{ __('Sign in to continue your learning journey with UNDP') }}
                        </p>
                        @if($setting->google_login_status == 'active')
                        <div class="account__social">
                            <a href="{{ route('auth.social', 'google') }}" class="account__social-btn">
                                <img src="{{ asset('frontend/img/icons/google.svg') }}" alt="img">
                                {{ __('Continue with google') }}
                            </a>
                        </div>
                        <div class="account__divider">
                            <span>{{ __('or') }}</span>
                        </div>
                        @endif
                        <form method="POST" action="{{ route('user-login') }}" class="account__form modern-form">
                            @csrf
                            <div class="form-grp modern-form-group" style="margin-bottom: 1.5rem;">
                                <label for="email" style="color: #333; font-weight: 600; margin-bottom: 0.5rem; display: block; font-size: 0.9rem;">{{ __('Email Address') }} <span style="color: #e74c3c;">*</span></label>
                                <input id="email" type="email" placeholder="Enter your email address" value="{{ old('email') }}" name="email" style="width: 100%; padding: 1rem; border: 2px solid #e9ecef; border-radius: 12px; font-size: 1rem; transition: all 0.3s ease; background: #f8f9fa;" onfocus="this.style.borderColor='#0066cc'; this.style.background='#fff'; this.style.boxShadow='0 0 0 3px rgba(0,102,204,0.1)'" onblur="this.style.borderColor='#e9ecef'; this.style.background='#f8f9fa'; this.style.boxShadow='none'">
                                <x-frontend.validation-error name="email" />
                            </div>
                            <div class="form-grp modern-form-group" style="margin-bottom: 1.5rem;">
                                <label for="password" style="color: #333; font-weight: 600; margin-bottom: 0.5rem; display: block; font-size: 0.9rem;">{{ __('Password') }} <span style="color: #e74c3c;">*</span></label>
                                <input id="password" type="password" placeholder="Enter your password" name="password" style="width: 100%; padding: 1rem; border: 2px solid #e9ecef; border-radius: 12px; font-size: 1rem; transition: all 0.3s ease; background: #f8f9fa;" onfocus="this.style.borderColor='#0066cc'; this.style.background='#fff'; this.style.boxShadow='0 0 0 3px rgba(0,102,204,0.1)'" onblur="this.style.borderColor='#e9ecef'; this.style.background='#f8f9fa'; this.style.boxShadow='none'">
                            </div>
                            <div class="account__check">
                                <div class="account__check-remember">
                                    <input type="checkbox" class="form-check-input" name="remember" value=""
                                        id="terms-check">
                                    <label for="terms-check" class="form-check-label">{{ __('Remember me') }}</label>
                                </div>
                                <div class="account__check-forgot">
                                    <a href="{{ route('password.request') }}">{{ __('Forgot Password?') }}</a>
                                </div>
                            </div>
                            <!-- g-recaptcha -->
                            @if (Cache::get('setting')->recaptcha_status === 'active')
                            <div class="form-grp mt-3">
                                <div class="g-recaptcha" data-sitekey="{{ Cache::get('setting')->recaptcha_site_key }}"></div>
                                <x-frontend.validation-error name="g-recaptcha-response" />
                            </div>
                            @endif
                            <button type="submit" class="btn modern-submit-btn" style="width: 100%; background: linear-gradient(45deg, #0066cc, #004499); color: #fff; padding: 1rem 2rem; border: none; border-radius: 12px; font-size: 1.1rem; font-weight: 600; cursor: pointer; transition: all 0.3s ease; margin-top: 1rem; display: flex; align-items: center; justify-content: center; gap: 0.5rem;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(0,102,204,0.3)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                                {{ __('Sign In to UNDP LMS') }}
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z"/>
                                </svg>
                            </button>
                        </form>
                        <div class="account__switch">
                            <p>{{ __('Dont have an account?') }}<a href="{{ route('register') }}">{{ __('Sign Up') }}</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- singUp-area-end -->
@endsection
