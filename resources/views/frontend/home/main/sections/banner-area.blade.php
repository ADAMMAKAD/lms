<section class="ultra-modern-about py-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%); position: relative; overflow: hidden; min-height: 75vh; display: flex; align-items: center;">
    <!-- Dynamic Background Elements -->
    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0.1; z-index: 1;">
        <div style="position: absolute; top: 20%; left: 10%; width: 300px; height: 300px; background: rgba(255,255,255,0.1); border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%; animation: morphingAbout 20s ease-in-out infinite;"></div>
        <div style="position: absolute; bottom: 10%; right: 15%; width: 200px; height: 200px; background: rgba(255,255,255,0.08); border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%; animation: morphingAbout 25s ease-in-out infinite reverse;"></div>
        <div style="position: absolute; top: 50%; right: 5%; width: 150px; height: 150px; background: rgba(255,255,255,0.06); border-radius: 40% 60% 60% 40% / 60% 30% 70% 40%; animation: morphingAbout 18s ease-in-out infinite;"></div>
    </div>
    
    <div class="container position-relative" style="z-index: 2;">
        <div class="row align-items-center g-5">
            <!-- Content Section - Left Side -->
            <div class="col-lg-6 order-lg-1 order-2">
                <div class="ultra-modern-content" style="color: white;">
                    <!-- Animated Badge -->
                    <div style="display: inline-flex; align-items: center; background: rgba(255,255,255,0.15); border-radius: 50px; padding: 0.75rem 1.5rem; margin-bottom: 2rem; backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.2);">
                        <div style="width: 12px; height: 12px; background: #10B981; border-radius: 50%; margin-right: 0.75rem; animation: pulseGlow 2s infinite;"></div>
                        <span style="color: white; font-size: 0.9rem; font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">{{ $aboutSection?->content?->short_title ?: 'TRANSFORMING SMES' }}</span>
                    </div>
                    
                    <!-- Main Title -->
                    <h2 style="font-size: 3.2rem; font-weight: 800; line-height: 1.1; margin-bottom: 1.5rem; color: white; font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;">
                        Building Tomorrow's 
                        <span style="background: linear-gradient(135deg, #FFD700, #FFA500); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Workforce</span><br>
                        Today
                    </h2>
                    
                    <!-- Description -->
                    <p style="font-size: 1.2rem; line-height: 1.7; margin-bottom: 2.5rem; opacity: 0.9; color: white; font-weight: 400; max-width: 500px;">
                        {!! clean(processText($aboutSection?->content?->description ?: 'We bridge the skills gap in Ethiopian SMEs through innovative digital learning solutions that work offline, ensuring every business can access world-class training regardless of connectivity.')) !!}
                    </p>
                    
                    <!-- Interactive Stats Grid -->
                    <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem; margin-bottom: 2.5rem;">
                        <div style="background: rgba(255,255,255,0.1); border-radius: 16px; padding: 1.5rem; backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.2); transition: all 0.3s ease;" onmouseover="this.style.background='rgba(255,255,255,0.2)'; this.style.transform='translateY(-5px)'" onmouseout="this.style.background='rgba(255,255,255,0.1)'; this.style.transform='translateY(0)'">
                            <div style="display: flex; align-items: center; gap: 1rem;">
                                <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #10B981, #059669); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                    <svg width="24" height="24" fill="white" viewBox="0 0 24 24"><path d="M16 4v4h4V4h-4zm-2-2h8v8h-8V2zM4 4v4h4V4H4zM2 2h8v8H2V2zm2 12v4h4v-4H4zm-2-2h8v8H2v-8zm11 2h2v2h-2v-2zm0 4h2v2h-2v-2zm4-4h2v2h-2v-2zm0 4h2v2h-2v-2z"/></svg>
                                </div>
                                <div>
                                    <div style="font-size: 1.8rem; font-weight: 700; color: white; margin-bottom: 0.25rem;">{{ number_format($hero?->content?->total_student ?? 5000) }}+</div>
                                    <div style="font-size: 0.9rem; color: rgba(255,255,255,0.8);">Professionals Trained</div>
                                </div>
                            </div>
                        </div>
                        
                        <div style="background: rgba(255,255,255,0.1); border-radius: 16px; padding: 1.5rem; backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.2); transition: all 0.3s ease;" onmouseover="this.style.background='rgba(255,255,255,0.2)'; this.style.transform='translateY(-5px)'" onmouseout="this.style.background='rgba(255,255,255,0.1)'; this.style.transform='translateY(0)'">
                            <div style="display: flex; align-items: center; gap: 1rem;">
                                <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #f093fb, #f5576c); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                    <svg width="24" height="24" fill="white" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
                                </div>
                                <div>
                                    <div style="font-size: 1.8rem; font-weight: 700; color: white; margin-bottom: 0.25rem;">100%</div>
                                    <div style="font-size: 0.9rem; color: rgba(255,255,255,0.8);">Offline Compatible</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- CTA Button -->
                    <div>
                        <a href="{{ url($aboutSection?->global_content?->button_url ?: '/courses') }}" 
                           style="display: inline-flex; align-items: center; background: rgba(255,255,255,0.15); color: white; padding: 1.2rem 2.5rem; border-radius: 50px; text-decoration: none; font-weight: 600; font-size: 1.1rem; transition: all 0.3s ease; backdrop-filter: blur(10px); border: 2px solid rgba(255,255,255,0.2); gap: 0.75rem;" 
                           onmouseover="this.style.background='rgba(255,255,255,0.25)'; this.style.borderColor='rgba(255,255,255,0.4)'; this.style.transform='translateY(-3px)'" 
                           onmouseout="this.style.background='rgba(255,255,255,0.15)'; this.style.borderColor='rgba(255,255,255,0.2)'; this.style.transform='translateY(0)'">
                            <span style="color: white;">{{ $aboutSection?->content?->button_text ?: 'Start Your Journey' }}</span>
                            <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Visual Section - Right Side -->
            <div class="col-lg-6 order-lg-2 order-1">
                <div class="ultra-modern-visual" style="position: relative; padding: 2rem;">
                    <!-- Main Visual Container -->
                    <div style="position: relative; max-width: 550px; margin: 0 auto;">
                        <!-- Central Hub -->
                        <div style="position: relative; background: rgba(255,255,255,0.95); border-radius: 24px; padding: 2.5rem; backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.3); box-shadow: 0 30px 80px rgba(0,0,0,0.2);">
                            
                            <!-- Main Image with Modern Frame -->
                            <div style="position: relative; border-radius: 20px; overflow: hidden; margin-bottom: 2rem;">
                                <img src="{{ asset($aboutSection?->global_content?->image) }}" 
                                     alt="UNCO LMS - Empowering SME Training" 
                                     style="width: 100%; height: 300px; object-fit: cover; border-radius: 20px;">
                                
                                @if($aboutSection?->global_content?->video_url)
                                <!-- Ultra Modern Play Button -->
                                <a href="{{ $aboutSection?->global_content?->video_url }}" 
                                   class="ultra-play-btn popup-video" 
                                   style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 70px; height: 70px; background: linear-gradient(135deg, #667eea, #764ba2); border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 15px 40px rgba(102, 126, 234, 0.4); transition: all 0.3s ease; text-decoration: none;">
                                    <svg width="24" height="24" fill="white" viewBox="0 0 24 24">
                                        <path d="M8 5v14l11-7z"/>
                                    </svg>
                                </a>
                                @endif
                                
                                <!-- Overlay Badge -->
                                <div style="position: absolute; top: 15px; left: 15px; background: rgba(16, 185, 129, 0.9); color: white; padding: 0.5rem 1rem; border-radius: 20px; font-size: 0.8rem; font-weight: 600; backdrop-filter: blur(10px);">
                                    ✓ SME Certified
                                </div>
                            </div>
                            
                            <!-- Interactive Learning Interface -->
                            <div style="background: #f8fafc; border-radius: 16px; padding: 1.5rem;">
                                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1rem;">
                                    <div style="display: flex; align-items: center; gap: 1rem;">
                                        <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #667eea, #764ba2); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                            <svg width="20" height="20" fill="white" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/></svg>
                                        </div>
                                        <div>
                                            <div style="font-size: 1rem; font-weight: 600; color: #1f2937;">Digital Skills Mastery</div>
                                            <div style="font-size: 0.8rem; color: #6b7280;">Progress: 85% Complete</div>
                                        </div>
                                    </div>
                                    <div style="font-size: 1.5rem;">📊</div>
                                </div>
                                
                                <!-- Progress Visualization -->
                                <div style="width: 100%; height: 8px; background: #e5e7eb; border-radius: 4px; overflow: hidden; margin-bottom: 1rem;">
                                    <div style="width: 85%; height: 100%; background: linear-gradient(135deg, #667eea, #764ba2); border-radius: 4px; animation: progressGrow 3s ease-in-out infinite;"></div>
                                </div>
                                
                                <!-- Achievement Badges -->
                                <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                                    <span style="background: rgba(16, 185, 129, 0.1); color: #059669; padding: 0.25rem 0.75rem; border-radius: 12px; font-size: 0.75rem; font-weight: 500;">Leadership</span>
                                    <span style="background: rgba(102, 126, 234, 0.1); color: #667eea; padding: 0.25rem 0.75rem; border-radius: 12px; font-size: 0.75rem; font-weight: 500;">Digital Marketing</span>
                                    <span style="background: rgba(240, 147, 251, 0.1); color: #f093fb; padding: 0.25rem 0.75rem; border-radius: 12px; font-size: 0.75rem; font-weight: 500;">Analytics</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Floating Achievement Cards -->
                        <div style="position: absolute; top: -10px; right: -20px; background: rgba(255,255,255,0.95); border-radius: 16px; padding: 1rem; box-shadow: 0 15px 40px rgba(0,0,0,0.1); animation: floatGentle 6s ease-in-out infinite; backdrop-filter: blur(10px); min-width: 140px;">
                            <div style="text-align: center;">
                                <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #10B981, #059669); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 0.5rem;">
                                    <svg width="20" height="20" fill="white" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                </div>
                                <div style="font-size: 0.8rem; color: #1f2937; font-weight: 600;">Excellence Award</div>
                                <div style="font-size: 0.7rem; color: #6b7280;">Top Performer</div>
                            </div>
                        </div>
                        
                        <div style="position: absolute; bottom: -10px; left: -20px; background: rgba(255,255,255,0.95); border-radius: 16px; padding: 1rem; box-shadow: 0 15px 40px rgba(0,0,0,0.1); animation: floatGentle 8s ease-in-out infinite reverse; backdrop-filter: blur(10px); min-width: 140px;">
                            <div style="text-align: center;">
                                <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #f093fb, #f5576c); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 0.5rem;">
                                    <svg width="20" height="20" fill="white" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm3.5 6L12 10.5 8.5 8 12 5.5 15.5 8zM12 19c-3.87 0-7-3.13-7-7s3.13-7 7-7 7 3.13 7 7-3.13 7-7 7z"/></svg>
                                </div>
                                <div style="font-size: 0.8rem; color: #1f2937; font-weight: 600;">Skill Certified</div>
                                <div style="font-size: 0.7rem; color: #6b7280;">Verified Skills</div>
                            </div>
                        </div>
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
