@extends('frontend.layouts.master')

@section('meta_title', $seo_setting['about_page']['seo_title'])
@section('meta_description', $seo_setting['about_page']['seo_description'])

@section('contents')
    <!-- breadcrumb-area -->
    <x-frontend.breadcrumb :title="__('About Us')" :subtitle="__('Discover our story, mission, and commitment to excellence in education')" :links="[['url' => route('home'), 'text' => __('Home')], ['url' => '', 'text' => __('about us')]]" />
    <!-- breadcrumb-area-end -->
    
    <style>
        .modern-about-area {
            background: #ffffff;
            padding: 80px 0;
        }
        
        .about-content-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            padding: 50px 40px;
            box-shadow: 0 8px 32px rgba(0, 102, 204, 0.1);
            transition: all 0.3s ease;
            margin-bottom: 40px;
        }
        
        .about-content-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 102, 204, 0.15);
        }
        
        .modern-section-title {
            color: #0066cc;
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 20px;
            text-align: center;
        }
        
        .modern-section-subtitle {
            color: #0066cc;
            font-size: 16px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 15px;
            text-align: center;
        }
        
        .modern-section-description {
            color: #666;
            font-size: 16px;
            line-height: 1.8;
            margin-bottom: 30px;
            text-align: center;
        }
        
        .modern-btn {
            background: #0066cc;
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
        }
        
        .modern-btn:hover {
            background: #0052a3;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 102, 204, 0.3);
            color: white;
            text-decoration: none;
        }
        
        .modern-btn img {
            width: 16px;
            height: 16px;
            filter: brightness(0) invert(1);
        }
        
        .features-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            padding: 40px 30px;
            box-shadow: 0 8px 32px rgba(0, 102, 204, 0.1);
            transition: all 0.3s ease;
            text-align: center;
            height: 100%;
            margin-bottom: 30px;
        }
        
        .features-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 102, 204, 0.2);
        }
        
        .features-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #0066cc, #004499);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
        }
        
        .features-icon img {
            width: 40px;
            height: 40px;
            filter: brightness(0) invert(1);
        }
        
        .features-title {
            color: #0066cc;
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 15px;
        }
        
        .features-description {
            color: #666;
            font-size: 14px;
            line-height: 1.6;
        }
        
        .faq-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            padding: 50px 40px;
            box-shadow: 0 8px 32px rgba(0, 102, 204, 0.1);
            margin-bottom: 40px;
        }
        
        .modern-accordion-item {
            border: 1px solid rgba(0, 102, 204, 0.1);
            border-radius: 12px;
            margin-bottom: 15px;
            overflow: hidden;
        }
        
        .modern-accordion-button {
            background: #ffffff;
            border: none;
            padding: 20px 25px;
            width: 100%;
            text-align: left;
            font-size: 16px;
            font-weight: 600;
            color: #0066cc;
            transition: all 0.3s ease;
        }
        
        .modern-accordion-button:hover {
            background: rgba(0, 102, 204, 0.05);
        }
        
        .modern-accordion-button:not(.collapsed) {
            background: #0066cc;
            color: white;
        }
        
        .modern-accordion-body {
            padding: 20px 25px;
            background: #ffffff;
            color: #666;
            line-height: 1.6;
        }
        
        .testimonial-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            padding: 40px 30px;
            box-shadow: 0 8px 32px rgba(0, 102, 204, 0.1);
            transition: all 0.3s ease;
            text-align: center;
            margin-bottom: 30px;
        }
        
        .testimonial-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 102, 204, 0.15);
        }
        
        .newsletter-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            padding: 50px 40px;
            box-shadow: 0 8px 32px rgba(0, 102, 204, 0.1);
            margin-bottom: 40px;
        }
        
        .newsletter-input {
            padding: 15px 20px;
            border: 2px solid #e1e5e9;
            border-radius: 12px;
            font-size: 16px;
            background: #ffffff;
            transition: all 0.3s ease;
            outline: none;
            flex: 1;
            margin-right: 15px;
        }
        
        .newsletter-input:focus {
            border-color: #0066cc;
            box-shadow: 0 0 0 3px rgba(0, 102, 204, 0.1);
        }
        
        .newsletter-btn {
            background: #0066cc;
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            white-space: nowrap;
        }
        
        .newsletter-btn:hover {
            background: #0052a3;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 102, 204, 0.3);
        }
        
        .newsletter-form {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        @media (max-width: 768px) {
            .modern-about-area {
                padding: 40px 0;
            }
            
            .about-content-card,
            .faq-card,
            .newsletter-card {
                padding: 30px 20px;
            }
            
            .features-card {
                padding: 30px 20px;
            }
            
            .newsletter-form {
                flex-direction: column;
                gap: 15px;
            }
            
            .newsletter-input {
                margin-right: 0;
                width: 100%;
            }
            
            .newsletter-btn {
                width: 100%;
            }
        }
    </style>

    <!-- about-area -->
    <section class="modern-about-area">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-6 col-md-9">
                    <div class="about-content-card">
                        <img src="{{ asset($aboutSection?->global_content?->image) }}" alt="img" class="img-fluid rounded-3 mb-4">
                        
                        @if($aboutSection?->global_content?->video_url)
                        <div class="text-center mb-4">
                            <a href="{{ $aboutSection?->global_content?->video_url }}" class="modern-btn popup-video" aria-label="Watch introductory video">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="28" viewBox="0 0 22 28" fill="none">
                                    <path d="M0.19043 26.3132V1.69421C0.190288 1.40603 0.245303 1.12259 0.350273 0.870694C0.455242 0.6188 0.606687 0.406797 0.79027 0.254768C0.973854 0.10274 1.1835 0.0157243 1.39936 0.00193865C1.61521 -0.011847 1.83014 0.0480663 2.02378 0.176003L20.4856 12.3292C20.6973 12.4694 20.8754 12.6856 20.9999 12.9535C21.1245 13.2214 21.1904 13.5304 21.1904 13.8456C21.1904 14.1608 21.1245 14.4697 20.9999 14.7376C20.8754 15.0055 20.6973 15.2217 20.4856 15.3619L2.02378 27.824C1.83056 27.9517 1.61615 28.0116 1.40076 27.9981C1.18536 27.9847 0.97607 27.8983 0.792638 27.7472C0.609205 27.596 0.457661 27.385 0.352299 27.1342C0.246938 26.8833 0.191236 26.6008 0.19043 26.3132Z" fill="currentcolor" />
                                </svg>
                                {{ __('Watch Video') }}
                            </a>
                        </div>
                        @endif
                        
                        @use(App\Enums\ThemeList)
                        @php
                            $theme = session()->has('demo_theme') ? session()->get('demo_theme') : DEFAULT_HOMEPAGE;
                        @endphp
                        @if (!in_array($theme, [ThemeList::BUSINESS->value, ThemeList::KINDERGARTEN->value]) && $hero?->content?->total_student)
                            <div class="text-center p-3 rounded-3" style="background: rgba(0, 102, 204, 0.1);">
                                <h5 class="text-primary mb-2">{{ $hero?->content?->total_student }}</h5>
                                <p class="mb-0 text-muted">{{ __('Enrolled Students') }}</p>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-content-card">
                        <span class="modern-section-subtitle">{{ __('Get More About Us') }}</span>
                        <h2 class="modern-section-title">
                            {!! clean(processText($aboutSection?->content?->title)) !!}
                        </h2>
                        
                        <div class="modern-section-description">
                            {!! clean(processText($aboutSection?->content?->description)) !!}
                        </div>
                        
                        @if ($aboutSection?->global_content?->button_url != null)
                            <div class="text-center">
                                <a href="{{ $aboutSection?->global_content?->button_url }}" class="modern-btn">
                                    {{ $aboutSection?->content?->button_text }}
                                    <img src="{{ asset('frontend/img/icons/right_arrow.svg') }}" alt="img">
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- about-area-end -->

    <!-- brand-area -->
    <div class="brand-area py-5" style="background: #f8f9fa;">
        <div class="container">
            <div class="text-center mb-5">
                <h3 class="modern-section-title">{{ __('Our Partners') }}</h3>
            </div>
            <div class="row justify-content-center align-items-center">
                @foreach ($brands as $brand)
                    <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-4">
                        <div class="brand-card text-center">
                            <a href="{{ $brand?->url }}" target="_blank">
                                <img src="{{ asset($brand?->image) }}" alt="brand" class="img-fluid" style="max-height: 80px; opacity: 0.7; transition: opacity 0.3s ease;">
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- brand-area-end -->


    <section class="modern-about-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="text-center">
                        <img src="{{ asset($faqSection?->global_content?->image) }}" alt="img" class="img-fluid rounded-3">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="faq-card">
                        <span class="modern-section-subtitle">{{ $faqSection?->content?->short_title }}</span>
                        <h2 class="modern-section-title">{!! clean(processText($faqSection?->content?->title)) !!}</h2>
                        <div class="modern-section-description">
                            {!! clean(processText($faqSection?->content?->description)) !!}
                        </div>
                        
                        <div class="modern-accordion mt-4">
                            @foreach ($faqs as $faq)
                                <div class="modern-accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="modern-accordion-button {{ $loop?->first ? '' : 'collapsed' }}"
                                            type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse{{ $faq?->id }}" aria-expanded="true"
                                            aria-controls="collapse{{ $faq?->id }}">
                                            {{ $faq?->translation?->question }}
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $faq?->id }}"
                                        class="accordion-collapse collapse {{ $loop?->first ? 'show' : '' }}"
                                        data-bs-parent="#accordionExample">
                                        <div class="modern-accordion-body">
                                            <p>
                                                {{ $faq?->translation?->answer }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @php
        $theme_name = session()->has('demo_theme') ? session()->get('demo_theme') : DEFAULT_HOMEPAGE;
    @endphp

    <!-- features-area -->
    <section class="modern-about-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8 col-lg-10">
                    <div class="text-center mb-5">
                        <span class="modern-section-subtitle">{{ __('How We Start Journey') }}</span>
                        <h2 class="modern-section-title">{{ __('Start your Learning Journey Today!') }}</h2>
                        <p class="modern-section-description">{{ __('Discover a World of Knowledge and Skills at Your Fingertips – Unlock Your Potential and Achieve Your Dreams with Our Comprehensive Learning Resources!') }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="features-card">
                        <div class="features-icon">
                            <img src="{{ asset($ourFeatures?->global_content?->image_one) }}" alt="img">
                        </div>
                        <h4 class="features-title">{{ $ourFeatures?->content?->title_one }}</h4>
                        <p class="features-description">{{ $ourFeatures?->content?->sub_title_one }}</p>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="features-card">
                        <div class="features-icon">
                            <img src="{{ asset($ourFeatures?->global_content?->image_two) }}" alt="img">
                        </div>
                        <h4 class="features-title">{{ $ourFeatures?->content?->title_two }}</h4>
                        <p class="features-description">{{ $ourFeatures?->content?->sub_title_two }}</p>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="features-card">
                        <div class="features-icon">
                            <img src="{{ asset($ourFeatures?->global_content?->image_three) }}" alt="img">
                        </div>
                        <h4 class="features-title">{{ $ourFeatures?->content?->title_three }}</h4>
                        <p class="features-description">{{ $ourFeatures?->content?->sub_title_three }}</p>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="features-card">
                        <div class="features-icon">
                            <img src="{{ asset($ourFeatures?->global_content?->image_four) }}" alt="img">
                        </div>
                        <h4 class="features-title">{{ $ourFeatures?->content?->title_four }}</h4>
                        <p class="features-description">{{ $ourFeatures?->content?->sub_title_four }}</p>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- features-area-end -->

    <!-- testimonial-area -->
    <section class="testimonial-card">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8">
                    <div class="text-center mb-5">
                        <span class="modern-section-subtitle">{{ __('Our Testimonials') }}</span>
                        <h2 class="modern-section-title">{{ __('What Students Think and Say About Us') }}</h2>
                        <p class="modern-section-description">{{ __('genuine feedback from our students about their experiences with our teaching') }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="testimonial-wrapper">
                        <div class="swiper-container testimonial-swiper-active">
                            <div class="swiper-wrapper">
                                @foreach ($reviews as $testimonial)
                                    <div class="swiper-slide">
                                        <div class="testimonial-item-card">
                                            <div class="testimonial-header">
                                                <div class="testimonial-author">
                                                    <div class="author-thumb">
                                                        <img src="{{ asset($testimonial?->image) }}" alt="img" class="rounded-circle">
                                                    </div>
                                                    <div class="author-info">
                                                        <div class="testimonial-rating mb-2">
                                                            @for ($i = 0; $i < $testimonial?->rating; $i++)
                                                                <i class="fas fa-star text-warning"></i>
                                                            @endfor
                                                        </div>
                                                        <h5 class="author-name">{{ $testimonial?->translation?->name }}</h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="testimonial-content">
                                                <p class="testimonial-text">" {{ $testimonial?->translation?->comment }} "</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="testimonial-navigation">
                            <button class="nav-btn nav-prev testimonial-button-prev">
                                <i class="flaticon-arrow-right"></i>
                            </button>
                            <button class="nav-btn nav-next testimonial-button-next">
                                <i class="flaticon-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- testimonial-area-end -->


    <!-- newsletter-area -->
    <section class="newsletter-card">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4">
                    <div class="text-center">
                        <img src="{{ asset($newsletterSection?->global_content?->image) }}" alt="img" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="newsletter-content">
                        <h2 class="modern-section-title">{{ __('Want to stay informed about') }} <br>
                            {{ __('new courses and study') }}?</h2>
                        <div class="newsletter-form mt-4">
                            <form action="" method="post" class="newsletter d-flex gap-3">
                                @csrf
                                <input type="email" placeholder="{{ __('Type your email') }}" name="email" class="form-control modern-form-input flex-grow-1">
                                <button type="submit" class="modern-btn">{{ __('Subscribe Now') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- newsletter-area-end -->
@endsection
