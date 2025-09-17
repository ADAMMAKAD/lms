<section class="features__area py-5" style="background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);">
  <!-- Animated Background Elements -->
  <div style="position: absolute; top: 10%; left: 5%; width: 100px; height: 100px; background: linear-gradient(135deg, rgba(30, 64, 175, 0.1), rgba(59, 130, 246, 0.05)); border-radius: 50%; animation: float 6s ease-in-out infinite;"></div>
  <div style="position: absolute; top: 60%; right: 8%; width: 80px; height: 80px; background: linear-gradient(135deg, rgba(245, 158, 11, 0.1), rgba(217, 119, 6, 0.05)); border-radius: 50%; animation: float 8s ease-in-out infinite reverse;"></div>
  <div style="position: absolute; top: 30%; right: 20%; width: 60px; height: 60px; background: linear-gradient(135deg, rgba(6, 182, 212, 0.1), rgba(8, 145, 178, 0.05)); border-radius: 50%; animation: float 7s ease-in-out infinite;"></div>
  
  <div class="container" style="position: relative; z-index: 2;">
      <div class="row justify-content-center">
          <div class="col-xl-8 col-lg-10">
              <div class="section__title text-center mb-5">
                  <span class="sub-title d-inline-block px-4 py-2 mb-4 fw-semibold" style="background: linear-gradient(135deg, #1e40af, #282f76); color: white; border-radius: 25px; font-size: 0.9rem; letter-spacing: 0.5px; box-shadow: 0 6px 20px rgba(30, 64, 175, 0.3); animation: pulse 2s infinite;">✨ {{ __("Why Choose IFL LMS") }}</span>
                  <h2 class="title fw-bold text-dark mb-4" style="font-size: 3.2rem; line-height: 1.1; font-family: 'Inter', sans-serif; background: linear-gradient(135deg, #1e293b, #1e40af); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">{{ __("Empowering SME Growth Through Learning") }}</h2>
                  <p class="lead text-muted mx-auto" style="max-width: 700px; line-height: 1.7; font-size: 1.25rem; font-weight: 400;">{{ __("Transform your organization with our comprehensive learning management system designed specifically for Small and Medium Enterprises. Build skills, drive growth, and achieve success.") }}</p>
              </div>
          </div>
      </div>
      <div class="row g-5 mt-4">
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="features__item h-100 bg-white rounded-4 p-5 border-0 position-relative overflow-hidden" style="transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); cursor: pointer; box-shadow: 0 8px 30px rgba(30, 64, 175, 0.1); animation: fadeInUp 0.6s ease-out 0s both;" onmouseover="this.style.transform='translateY(-15px) scale(1.02)'; this.style.boxShadow='0 20px 50px rgba(30, 64, 175, 0.2)'; this.querySelector('.features__icon').style.transform='scale(1.1) rotate(5deg)'; this.querySelector('.feature-bg').style.opacity='1'" onmouseout="this.style.transform='translateY(0) scale(1)'; this.style.boxShadow='0 8px 30px rgba(30, 64, 175, 0.1)'; this.querySelector('.features__icon').style.transform='scale(1) rotate(0deg)'; this.querySelector('.feature-bg').style.opacity='0'">
                <!-- Animated Background Gradient -->
                <div class="feature-bg" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(135deg, rgba(30, 64, 175, 0.05), rgba(59, 130, 246, 0.02)); opacity: 0; transition: opacity 0.4s ease; z-index: 1;"></div>
                
                <!-- Decorative Elements -->
                <div style="position: absolute; top: -20px; right: -20px; width: 40px; height: 40px; background: linear-gradient(135deg, rgba(30, 64, 175, 0.2), rgba(59, 130, 246, 0.1)); border-radius: 50%; animation: pulse 3s infinite;"></div>
                
                <div class="features__icon mb-4 d-flex align-items-center justify-content-center" style="width: 90px; height: 90px; background: linear-gradient(135deg, #1e40af, #282f76); border-radius: 24px; margin: 0 auto; box-shadow: 0 10px 30px rgba(30, 64, 175, 0.4); transition: all 0.4s ease; position: relative; overflow: hidden; z-index: 2;">
                    <img src="{{ asset($ourFeatures?->global_content?->image_one) }}" alt="SME Training" class="img-fluid" style="max-width: 45px; filter: brightness(0) invert(1); position: relative; z-index: 2;">
                    <!-- Icon Shimmer Effect -->
                    <div style="position: absolute; top: 0; left: -100%; width: 100%; height: 100%; background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent); animation: shimmer 2s infinite;"></div>
                </div>
                <div class="features__content text-center" style="position: relative; z-index: 2;">
                    <h5 class="title fw-bold text-dark mb-3 lh-base" style="font-size: 1.4rem; font-family: 'Inter', sans-serif; font-weight: 800; transition: color 0.3s ease;">{{ $ourFeatures?->content?->title_one ?: 'Flexible Learning' }}</h5>
                    <p class="text-muted mb-0" style="line-height: 1.7; font-size: 1rem; font-weight: 400;">{{ $ourFeatures?->content?->sub_title_one ?: 'Learn at your own pace with our adaptive learning platform designed for busy professionals.' }}</p>
                    
                    <!-- Progress Indicator -->
                    <div style="width: 60px; height: 3px; background: linear-gradient(135deg, #1e40af, #282f76); border-radius: 2px; margin: 1.5rem auto 0; opacity: 0; transition: opacity 0.3s ease;"></div>
                </div>
                <div class="position-absolute top-0 end-0 p-4">
                    <div style="width: 35px; height: 35px; background: linear-gradient(135deg, #1e40af, #282f76); border-radius: 50%; opacity: 0.1;"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="features__item h-100 bg-white rounded-4 p-5 border-0 position-relative overflow-hidden" style="transition: all 0.4s ease; cursor: pointer; box-shadow: 0 8px 30px rgba(6, 182, 212, 0.1);" onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='0 20px 40px rgba(6, 182, 212, 0.15)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 30px rgba(6, 182, 212, 0.1)'">
                <div class="features__icon mb-4 d-flex align-items-center justify-content-center" style="width: 90px; height: 90px; background: linear-gradient(135deg, #06B6D4, #0891B2); border-radius: 24px; margin: 0 auto; box-shadow: 0 8px 25px rgba(6, 182, 212, 0.3);">
                    <img src="{{ asset($ourFeatures?->global_content?->image_two) }}" alt="Offline Access" class="img-fluid" style="max-width: 45px; filter: brightness(0) invert(1);">
                </div>
                <div class="features__content text-center">
                    <h5 class="title fw-bold text-dark mb-3 lh-base" style="font-size: 1.3rem; font-family: 'Inter', sans-serif;">{{ $ourFeatures?->content?->title_two ?: 'Offline Access' }}</h5>
                    <p class="text-muted mb-0" style="line-height: 1.7; font-size: 0.95rem;">{{ $ourFeatures?->content?->sub_title_two ?: 'Download courses and continue learning even without internet connectivity.' }}</p>
                </div>
                <div class="position-absolute top-0 end-0 p-4">
                    <div style="width: 35px; height: 35px; background: linear-gradient(135deg, #06B6D4, #0891B2); border-radius: 50%; opacity: 0.1;"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="features__item h-100 bg-white rounded-4 p-5 border-0 position-relative overflow-hidden" style="transition: all 0.4s ease; cursor: pointer; box-shadow: 0 8px 30px rgba(245, 158, 11, 0.1);" onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='0 20px 40px rgba(245, 158, 11, 0.15)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 30px rgba(245, 158, 11, 0.1)'">
                <div class="features__icon mb-4 d-flex align-items-center justify-content-center" style="width: 90px; height: 90px; background: linear-gradient(135deg, #F59E0B, #D97706); border-radius: 24px; margin: 0 auto; box-shadow: 0 8px 25px rgba(245, 158, 11, 0.3);">
                    <img src="{{ asset($ourFeatures?->global_content?->image_three) }}" alt="Progress Tracking" class="img-fluid" style="max-width: 45px; filter: brightness(0) invert(1);">
                </div>
                <div class="features__content text-center">
                    <h5 class="title fw-bold text-dark mb-3 lh-base" style="font-size: 1.3rem; font-family: 'Inter', sans-serif;">{{ $ourFeatures?->content?->title_three ?: 'Progress Tracking' }}</h5>
                    <p class="text-muted mb-0" style="line-height: 1.7; font-size: 0.95rem;">{{ $ourFeatures?->content?->sub_title_three ?: 'Monitor learning progress with detailed analytics and performance insights.' }}</p>
                </div>
                <div class="position-absolute top-0 end-0 p-4">
                    <div style="width: 35px; height: 35px; background: linear-gradient(135deg, #F59E0B, #D97706); border-radius: 50%; opacity: 0.1;"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="features__item h-100 bg-white rounded-4 p-5 border-0 position-relative overflow-hidden" style="transition: all 0.4s ease; cursor: pointer; box-shadow: 0 8px 30px rgba(239, 68, 68, 0.1);" onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='0 20px 40px rgba(239, 68, 68, 0.15)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 30px rgba(239, 68, 68, 0.1)'">
                <div class="features__icon mb-4 d-flex align-items-center justify-content-center" style="width: 90px; height: 90px; background: linear-gradient(135deg, #EF4444, #DC2626); border-radius: 24px; margin: 0 auto; box-shadow: 0 8px 25px rgba(239, 68, 68, 0.3);">
                    <img src="{{ asset($ourFeatures?->global_content?->image_four) }}" alt="Expert Support" class="img-fluid" style="max-width: 45px; filter: brightness(0) invert(1);">
                </div>
                <div class="features__content text-center">
                    <h5 class="title fw-bold text-dark mb-3 lh-base" style="font-size: 1.3rem; font-family: 'Inter', sans-serif;">{{ $ourFeatures?->content?->title_four ?: 'Expert Support' }}</h5>
                    <p class="text-muted mb-0" style="line-height: 1.7; font-size: 0.95rem;">{{ $ourFeatures?->content?->sub_title_four ?: 'Get guidance from industry experts and dedicated support team.' }}</p>
                </div>
                <div class="position-absolute top-0 end-0 p-4">
                    <div style="width: 35px; height: 35px; background: linear-gradient(135deg, #EF4444, #DC2626); border-radius: 50%; opacity: 0.1;"></div>
                </div>
            </div>
        </div>
    </div>
    
  </div>
</section>

<style>
/* Enhanced Features Section Animations */
@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
}

@keyframes pulse {
    0%, 100% { transform: scale(1); opacity: 0.7; }
    50% { transform: scale(1.1); opacity: 1; }
}

@keyframes shimmer {
    0% { left: -100%; }
    100% { left: 100%; }
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

/* Feature Card Hover Effects */
.features__item:hover .features__content h5 {
    color: #1e40af !important;
}

.features__item:hover .features__content div:last-child {
    opacity: 1 !important;
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .features__item {
        margin-bottom: 2rem;
    }
    
    .features__item:hover {
        transform: translateY(-8px) !important;
    }
    
    .section__title h2 {
        font-size: 2.5rem !important;
    }
    
    .section__title p {
        font-size: 1.1rem !important;
    }
}

@media (max-width: 576px) {
    .section__title h2 {
        font-size: 2rem !important;
    }
    
    .features__icon {
        width: 70px !important;
        height: 70px !important;
    }
    
    .features__icon img {
        max-width: 35px !important;
    }
}
</style>