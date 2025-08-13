<section class="features__area py-5" style="background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);">
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-xl-8 col-lg-10">
              <div class="section__title text-center mb-5">
                  <span class="sub-title d-inline-block px-4 py-2 mb-4 fw-semibold" style="background: linear-gradient(135deg, #8B5CF6, #A855F7); color: white; border-radius: 25px; font-size: 0.9rem; letter-spacing: 0.5px;">{{ __("Why Choose UNDO LMS") }}</span>
                  <h2 class="title fw-bold text-dark mb-4" style="font-size: 3rem; line-height: 1.2; font-family: 'Inter', sans-serif;">{{ __("Empowering SME Growth Through Learning") }}</h2>
                  <p class="lead text-muted mx-auto" style="max-width: 650px; line-height: 1.7; font-size: 1.1rem;">{{ __("Transform your organization with our comprehensive learning management system designed specifically for Small and Medium Enterprises. Build skills, drive growth, and achieve success.") }}</p>
              </div>
          </div>
      </div>
      <div class="row g-5 mt-4">
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="features__item h-100 bg-white rounded-4 p-5 border-0 position-relative overflow-hidden" style="transition: all 0.4s ease; cursor: pointer; box-shadow: 0 8px 30px rgba(139, 92, 246, 0.1);" onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='0 20px 40px rgba(139, 92, 246, 0.15)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 30px rgba(139, 92, 246, 0.1)'">
                <div class="features__icon mb-4 d-flex align-items-center justify-content-center" style="width: 90px; height: 90px; background: linear-gradient(135deg, #8B5CF6, #A855F7); border-radius: 24px; margin: 0 auto; box-shadow: 0 8px 25px rgba(139, 92, 246, 0.3);">
                    <img src="{{ asset($ourFeatures?->global_content?->image_one) }}" alt="SME Training" class="img-fluid" style="max-width: 45px; filter: brightness(0) invert(1);">
                </div>
                <div class="features__content text-center">
                    <h5 class="title fw-bold text-dark mb-3 lh-base" style="font-size: 1.3rem; font-family: 'Inter', sans-serif;">{{ $ourFeatures?->content?->title_one ?: 'Flexible Learning' }}</h5>
                    <p class="text-muted mb-0" style="line-height: 1.7; font-size: 0.95rem;">{{ $ourFeatures?->content?->sub_title_one ?: 'Learn at your own pace with our adaptive learning platform designed for busy professionals.' }}</p>
                </div>
                <div class="position-absolute top-0 end-0 p-4">
                    <div style="width: 35px; height: 35px; background: linear-gradient(135deg, #8B5CF6, #A855F7); border-radius: 50%; opacity: 0.1;"></div>
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