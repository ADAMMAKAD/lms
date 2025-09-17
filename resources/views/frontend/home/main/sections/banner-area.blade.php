<section class="ultra-modern-about py-5" style="background: url('{{ asset('uploads/website-images/Addis_in_night-scaled.jpg') }}') center/cover no-repeat; position: relative; overflow: hidden; min-height: 75vh; display: flex; align-items: center;">
    <!-- Dark Overlay for Text Readability -->
    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 1;"></div>
    
    <!-- Dynamic Background Elements -->
    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0.1; z-index: 2;">
        <div style="position: absolute; top: 20%; left: 10%; width: 300px; height: 300px; background: rgba(255,255,255,0.1); border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%; animation: morphingAbout 20s ease-in-out infinite;"></div>
        <div style="position: absolute; bottom: 10%; right: 15%; width: 200px; height: 200px; background: rgba(255,255,255,0.08); border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%; animation: morphingAbout 25s ease-in-out infinite reverse;"></div>
        <div style="position: absolute; top: 50%; right: 5%; width: 150px; height: 150px; background: rgba(255,255,255,0.06); border-radius: 40% 60% 60% 40% / 60% 30% 70% 40%; animation: morphingAbout 18s ease-in-out infinite;"></div>
    </div>
    
    <div class="container position-relative" style="z-index: 3;">
        <div class="row align-items-center g-5">
            <!-- Content Section - Full Width -->
            <div class="col-lg-12 order-1">
                <div class="ultra-modern-content" style="color: white;">
                    <!-- Animated Badge -->
                    <div style="display: inline-flex; align-items: center; background: rgba(255,255,255,0.15); border-radius: 50px; padding: 0.9rem 1.8rem; margin-bottom: 2.5rem; backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.2); box-shadow: 0 8px 25px rgba(0, 102, 204, 0.4);">
                        <div style="width: 14px; height: 14px; background: #777ec8; border-radius: 50%; margin-right: 0.9rem; animation: pulseGlow 2s infinite;"></div>
                        <span style="color: white; font-size: 1rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.2px;">{{ $aboutSection?->content?->short_title ?: '🌟 IFL CERTIFIED EXCELLENCE' }}</span>
                    </div>
                    
                    <!-- Main Title -->
                    <h2 style="font-size: 3.8rem; font-weight: 900; line-height: 1.05; margin-bottom: 2rem; color: white; font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif; text-shadow: 0 4px 8px rgba(0,0,0,0.1); letter-spacing: -0.02em;">
                        Transform Your Future with 
                        <span style="background: linear-gradient(135deg, #FFD700, #FFA500); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">IFL</span><br>
                        Excellence
                    </h2>
                    
                    <!-- Description -->
                    <p style="font-size: 1.35rem; line-height: 1.7; margin-bottom: 3rem; opacity: 0.95; color: white; font-weight: 400; max-width: 650px;">
                        {!! clean(processText($aboutSection?->content?->description ?: 'Empower your career with IFL Programme\'s world-class learning platform. Join a global community of professionals advancing sustainable development goals through innovative digital solutions.')) !!}
                    </p>
                    
                    <!-- Interactive Stats Grid -->
                    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 2rem; margin-bottom: 2.5rem; max-width: 450px;">
                        <!-- <div style="text-align: center; padding: 1.5rem 1rem; background: rgba(255,255,255,0.12); border-radius: 16px; backdrop-filter: blur(15px); border: 1px solid rgba(255,255,255,0.25); transition: all 0.3s ease; position: relative; overflow: hidden;" onmouseover="this.style.transform='translateY(-5px)'; this.style.background='rgba(255,255,255,0.18)'" onmouseout="this.style.transform='translateY(0)'; this.style.background='rgba(255,255,255,0.12)'">
                            <div style="font-size: 2.2rem; font-weight: 900; color: #FFD700; margin-bottom: 0.5rem; text-shadow: 0 2px 4px rgba(0,0,0,0.1);">{{ number_format($hero?->content?->total_student ?? 5000) }}+</div>
                            <div style="font-size: 0.9rem; color: rgba(255,255,255,0.9); font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Learners</div>
                            <div style="position: absolute; top: 0; left: 0; width: 100%; height: 2px; background: linear-gradient(90deg, #FFD700, #FFA500);"></div>
                        </div>
                        
                        <div style="text-align: center; padding: 1.5rem 1rem; background: rgba(255,255,255,0.12); border-radius: 16px; backdrop-filter: blur(15px); border: 1px solid rgba(255,255,255,0.25); transition: all 0.3s ease; position: relative; overflow: hidden;" onmouseover="this.style.transform='translateY(-5px)'; this.style.background='rgba(255,255,255,0.18)'" onmouseout="this.style.transform='translateY(0)'; this.style.background='rgba(255,255,255,0.12)'">
                            <div style="font-size: 2.2rem; font-weight: 900; color: #FFD700; margin-bottom: 0.5rem; text-shadow: 0 2px 4px rgba(0,0,0,0.1);">50+</div>
                            <div style="font-size: 0.9rem; color: rgba(255,255,255,0.9); font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Courses</div>
                            <div style="position: absolute; top: 0; left: 0; width: 100%; height: 2px; background: linear-gradient(90deg, #FFD700, #FFA500);"></div>
                        </div>
                        
                        <div style="text-align: center; padding: 1.5rem 1rem; background: rgba(255,255,255,0.12); border-radius: 16px; backdrop-filter: blur(15px); border: 1px solid rgba(255,255,255,0.25); transition: all 0.3s ease; position: relative; overflow: hidden;" onmouseover="this.style.transform='translateY(-5px)'; this.style.background='rgba(255,255,255,0.18)'" onmouseout="this.style.transform='translateY(0)'; this.style.background='rgba(255,255,255,0.12)'">
                            <div style="font-size: 2.2rem; font-weight: 900; color: #FFD700; margin-bottom: 0.5rem; text-shadow: 0 2px 4px rgba(0,0,0,0.1);">100+</div>
                            <div style="font-size: 0.9rem; color: rgba(255,255,255,0.9); font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Experts</div>
                            <div style="position: absolute; top: 0; left: 0; width: 100%; height: 2px; background: linear-gradient(90deg, #FFD700, #FFA500);"></div>
                        </div> -->
                    </div>
                    
                    <!-- CTA Button -->
                    <div style="display: flex; gap: 1rem; align-items: center; margin-bottom: 2rem;">
                        <a href="{{ url($aboutSection?->global_content?->button_url ?: '/courses') }}" 
                           style="display: inline-flex; align-items: center; background: linear-gradient(135deg, #777ec8, #777ec8); color: white; padding: 1.2rem 2.5rem; border-radius: 15px; text-decoration: none; font-weight: 700; font-size: 1.15rem; box-shadow: 0 10px 30px rgba(0, 102, 204, 0.4); transition: all 0.3s ease; border: none; cursor: pointer; position: relative; overflow: hidden;" 
                           onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 15px 40px rgba(0, 102, 204, 0.5)'" 
                           onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 30px rgba(0, 102, 204, 0.4)'">
                            <span style="margin-right: 0.75rem; position: relative; z-index: 2;">{{ $aboutSection?->content?->button_text ?: 'Explore Courses' }}</span>
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="position: relative; z-index: 2;">
                                <path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <div style="position: absolute; top: 0; left: -100%; width: 100%; height: 100%; background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent); animation: shimmer 3s infinite;"></div>
                        </a>
                        <a href="{{ url('/about') }}" 
                           style="display: inline-flex; align-items: center; background: rgba(255,255,255,0.1); color: white; padding: 1.2rem 2rem; border-radius: 15px; text-decoration: none; font-weight: 600; font-size: 1.1rem; backdrop-filter: blur(10px); border: 2px solid rgba(255,255,255,0.2); transition: all 0.3s ease;" 
                           onmouseover="this.style.background='rgba(255,255,255,0.2)'; this.style.transform='translateY(-2px)'" 
                           onmouseout="this.style.background='rgba(255,255,255,0.1)'; this.style.transform='translateY(0)'">
                            Learn More
                        </a>
                    </div>
                </div>
            </div>
            

        </div>
    </div>
</section>

<style>
@keyframes morphingAbout {
    0%, 100% {
        border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
        transform: rotate(0deg) scale(1);
    }
    25% {
        border-radius: 58% 42% 75% 25% / 76% 46% 54% 24%;
        transform: rotate(90deg) scale(1.1);
    }
    50% {
        border-radius: 50% 50% 33% 67% / 55% 27% 73% 45%;
        transform: rotate(180deg) scale(0.9);
    }
    75% {
        border-radius: 33% 67% 58% 42% / 63% 68% 32% 37%;
        transform: rotate(270deg) scale(1.05);
    }
}

@keyframes pulseGlow {
    0%, 100% {
        opacity: 1;
        transform: scale(1);
        box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
    }
    50% {
        opacity: 0.8;
        transform: scale(1.1);
        box-shadow: 0 0 0 10px rgba(16, 185, 129, 0);
    }
}

@keyframes floatGentle {
    0%, 100% {
        transform: translateY(0px) rotate(0deg);
    }
    33% {
        transform: translateY(-10px) rotate(1deg);
    }
    66% {
        transform: translateY(-5px) rotate(-1deg);
    }
}

@keyframes progressGrow {
    0% {
        width: 0%;
    }
    50% {
        width: 85%;
    }
    100% {
        width: 85%;
    }
}

.ultra-play-btn:hover {
    transform: translate(-50%, -50%) scale(1.1) !important;
    box-shadow: 0 20px 50px rgba(102, 126, 234, 0.6) !important;
}

.ultra-modern-about {
    position: relative;
}

.ultra-modern-about::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, 
        rgba(102, 126, 234, 0.1) 0%, 
        rgba(118, 75, 162, 0.1) 50%, 
        rgba(240, 147, 251, 0.1) 100%);
    z-index: 1;
}

@media (max-width: 768px) {
    .ultra-modern-content h2 {
        font-size: 2.5rem !important;
    }
    
    .ultra-modern-content p {
        font-size: 1.1rem !important;
    }
    
    .ultra-modern-visual {
        padding: 1rem !important;
    }
    
    .ultra-modern-about {
        min-height: auto !important;
        padding: 3rem 0 !important;
    }
}

@media (max-width: 576px) {
    .ultra-modern-content h2 {
        font-size: 2rem !important;
    }
    
    .ultra-modern-content div[style*="grid-template-columns"] {
        grid-template-columns: 1fr !important;
    }
}
</style>
