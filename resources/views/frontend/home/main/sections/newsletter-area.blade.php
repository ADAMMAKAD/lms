<section class="newsletter__area py-5" style="background: linear-gradient(135deg, #007bff 0%, #0056b3 100%); position: relative; overflow: hidden;">
    <!-- Background Pattern -->
    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0.1; background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="20" fill="white"/></svg>'); background-size: 60px 60px;"></div>
    
    <div class="container position-relative">
        <div class="row align-items-center g-5">
            <div class="col-lg-5">
                <div class="newsletter__img-wrap text-center" data-aos="fade-right">
                    <div class="modern-newsletter-visual" style="position: relative; display: inline-block;">
                        <div class="main-image-container" style="background: rgba(255, 255, 255, 0.15); border-radius: 20px; padding: 30px; backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2);">
                            <img src="{{ asset($newsletterSection?->global_content?->image) }}" alt="SME Training Newsletter" style="max-width: 200px; height: auto; border-radius: 15px; box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);">
                        </div>
                        
                        <!-- Floating Elements -->
                        <div class="floating-element" style="position: absolute; top: -10px; right: -10px; width: 60px; height: 60px; background: rgba(255, 255, 255, 0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; animation: float 3s ease-in-out infinite;">
                            <svg width="24" height="24" fill="white" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                        </div>
                        
                        <div class="floating-element" style="position: absolute; bottom: -15px; left: -15px; width: 50px; height: 50px; background: rgba(255, 255, 255, 0.15); border-radius: 50%; display: flex; align-items: center; justify-content: center; animation: float 3s ease-in-out infinite 1.5s;">
                            <svg width="20" height="20" fill="white" viewBox="0 0 24 24">
                                <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-7">
                <div class="newsletter__content" data-aos="fade-left">
                    <div class="mb-4">
                        <span class="modern-badge" style="display: inline-block; background: rgba(255, 255, 255, 0.2); color: white; padding: 8px 20px; border-radius: 25px; font-size: 0.9rem; font-weight: 600; margin-bottom: 20px; backdrop-filter: blur(10px);">
                            {{ __('Stay Updated') }}
                        </span>
                        <h2 class="title display-4 fw-bold text-white mb-4" style="line-height: 1.2;">
                            {{ __('Get the Latest') }} <br>
                            <span style="color: #ffc107;">{{ __('SME Training Updates') }}</span>
                        </h2>
                        <p class="lead text-white mb-4" style="opacity: 0.9; line-height: 1.6;">
                            {{ __('Stay informed about new training programs, industry insights, and exclusive resources designed for Ethiopian SMEs. Join our community of growing businesses.') }}
                        </p>
                    </div>
                    
                    <div class="newsletter__form">
                        <form action="{{route('newsletter-request')}}" method="post" class="newsletter modern-newsletter-form" style="background: rgba(255, 255, 255, 0.15); padding: 8px; border-radius: 50px; backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2);">
                            @csrf
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <input type="email" 
                                           placeholder="{{ __('Enter your business email') }}" 
                                           name="email" 
                                           required
                                           style="background: transparent; border: none; color: white; padding: 15px 25px; font-size: 1rem; width: 100%; outline: none;">
                                </div>
                                <button type="submit" 
                                        class="btn modern-subscribe-btn" 
                                        style="background: #ffc107; color: #2c3e50; padding: 15px 30px; border-radius: 40px; border: none; font-weight: 700; font-size: 1rem; transition: all 0.3s ease; white-space: nowrap;">
                                    {{ __('Subscribe Now') }}
                                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24" style="margin-left: 8px;">
                                        <path d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8z"/>
                                    </svg>
                                </button>
                            </div>
                        </form>
                        
                        <div class="newsletter-features mt-4">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <div class="feature-item d-flex align-items-center text-white" style="opacity: 0.9;">
                                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24" style="margin-right: 10px; flex-shrink: 0;">
                                            <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                                        </svg>
                                        <span style="font-size: 0.9rem;">{{ __('Weekly Updates') }}</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="feature-item d-flex align-items-center text-white" style="opacity: 0.9;">
                                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24" style="margin-right: 10px; flex-shrink: 0;">
                                            <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                                        </svg>
                                        <span style="font-size: 0.9rem;">{{ __('Exclusive Content') }}</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="feature-item d-flex align-items-center text-white" style="opacity: 0.9;">
                                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24" style="margin-right: 10px; flex-shrink: 0;">
                                            <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                                        </svg>
                                        <span style="font-size: 0.9rem;">{{ __('No Spam') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Floating Animation Styles -->
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        .modern-subscribe-btn:hover {
            background: #e0a800 !important;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(255, 193, 7, 0.3);
        }
        
        .newsletter__area input::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }
        
        .newsletter__area input:focus {
            outline: none;
            background: rgba(255, 255, 255, 0.1);
        }
    </style>
</section>