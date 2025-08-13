<section class="modern-cards-section py-5" style="background: #f8fafc; position: relative;">
    <div class="container">
        <div class="row g-4">
            <!-- Left Card - Level Up Skills -->
            <div class="col-lg-6">
                <div class="gradient-card" style="background: linear-gradient(135deg, #8B5CF6 0%, #EC4899 100%); border-radius: 20px; padding: 3rem; position: relative; overflow: hidden; min-height: 300px; display: flex; align-items: center;">
                    <!-- Background Pattern -->
                    <div style="position: absolute; top: 0; right: 0; width: 100%; height: 100%; opacity: 0.1; background-image: radial-gradient(circle at 20% 80%, rgba(255,255,255,0.3) 0%, transparent 50%), radial-gradient(circle at 80% 20%, rgba(255,255,255,0.2) 0%, transparent 50%); z-index: 1;"></div>
                    
                    <div class="row align-items-center w-100" style="z-index: 2; position: relative;">
                        <div class="col-7">
                            <div class="card-content">
                                <h3 style="color: white; font-size: 1.8rem; font-weight: 700; line-height: 1.2; margin-bottom: 1rem;">
                                    Level - Up Your Raw Coding<br>
                                    Skills in Lockdown
                                </h3>
                                <p style="color: rgba(255,255,255,0.9); font-size: 1rem; line-height: 1.5; margin-bottom: 2rem; max-width: 280px;">
                                    With our interactive courses, you may explore an infinite array of learning possibilities from thought leadership.
                                </p>
                                <a href="{{ url('/courses') }}" 
                                   style="display: inline-block; background: rgba(255,255,255,0.2); color: white; padding: 0.75rem 1.5rem; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 0.9rem; backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.3); transition: all 0.3s ease;"
                                   onmouseover="this.style.background='rgba(255,255,255,0.3)'; this.style.transform='translateY(-2px)'"
                                   onmouseout="this.style.background='rgba(255,255,255,0.2)'; this.style.transform='translateY(0)'">
                                    Join now
                                </a>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="card-image" style="text-align: center;">
                                <img src="{{ asset($aboutSection?->global_content?->image ?: 'frontend/img/default-instructor.png') }}" 
                                     alt="Professional Developer" 
                                     style="max-width: 100%; height: auto; max-height: 200px; object-fit: cover; border-radius: 10px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Right Card - Become Instructor -->
            <div class="col-lg-6">
                <div class="gradient-card" style="background: linear-gradient(135deg, #06B6D4 0%, #10B981 100%); border-radius: 20px; padding: 3rem; position: relative; overflow: hidden; min-height: 300px; display: flex; align-items: center;">
                    <!-- Background Pattern -->
                    <div style="position: absolute; top: 0; right: 0; width: 100%; height: 100%; opacity: 0.1; background-image: radial-gradient(circle at 20% 80%, rgba(255,255,255,0.3) 0%, transparent 50%), radial-gradient(circle at 80% 20%, rgba(255,255,255,0.2) 0%, transparent 50%); z-index: 1;"></div>
                    
                    <div class="row align-items-center w-100" style="z-index: 2; position: relative;">
                        <div class="col-7">
                            <div class="card-content">
                                <div style="background: rgba(255,255,255,0.2); color: white; padding: 0.25rem 0.75rem; border-radius: 12px; font-size: 0.75rem; font-weight: 600; display: inline-block; margin-bottom: 1rem; backdrop-filter: blur(10px);">
                                    New Information
                                </div>
                                <h3 style="color: white; font-size: 1.8rem; font-weight: 700; line-height: 1.2; margin-bottom: 1rem;">
                                    Become a new instructor
                                </h3>
                                <p style="color: rgba(255,255,255,0.9); font-size: 1rem; line-height: 1.5; margin-bottom: 2rem; max-width: 280px;">
                                    With our interactive courses, you may explore an infinite array of learning possibilities from thought leadership.
                                </p>
                                <a href="{{ url('/instructor/register') }}" 
                                   style="display: inline-block; background: rgba(255,255,255,0.2); color: white; padding: 0.75rem 1.5rem; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 0.9rem; backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.3); transition: all 0.3s ease;"
                                   onmouseover="this.style.background='rgba(255,255,255,0.3)'; this.style.transform='translateY(-2px)'"
                                   onmouseout="this.style.background='rgba(255,255,255,0.2)'; this.style.transform='translateY(0)'">
                                    Join now
                                </a>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="card-image" style="text-align: center;">
                                <img src="{{ asset('frontend/img/default-instructor-2.png') }}" 
                                     alt="Professional Instructor" 
                                     style="max-width: 100%; height: auto; max-height: 200px; object-fit: cover; border-radius: 10px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
/* Modern Cards Section Styles */
.modern-cards-section .gradient-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    transition: all 0.3s ease;
}

.modern-cards-section .card-image img {
    transition: transform 0.3s ease;
}

.modern-cards-section .gradient-card:hover .card-image img {
    transform: scale(1.05);
}

@media (max-width: 991px) {
    .modern-cards-section .gradient-card {
        margin-bottom: 2rem;
        min-height: 250px !important;
    }
    
    .modern-cards-section .gradient-card h3 {
        font-size: 1.5rem !important;
    }
    
    .modern-cards-section .gradient-card p {
        font-size: 0.9rem !important;
        max-width: none !important;
    }
}

@media (max-width: 767px) {
    .modern-cards-section .gradient-card {
        padding: 2rem !important;
        min-height: 200px !important;
    }
    
    .modern-cards-section .gradient-card h3 {
        font-size: 1.3rem !important;
        margin-bottom: 0.75rem !important;
    }
    
    .modern-cards-section .gradient-card p {
        font-size: 0.85rem !important;
        margin-bottom: 1.5rem !important;
    }
    
    .modern-cards-section .card-image img {
        max-height: 150px !important;
    }
}

@media (max-width: 575px) {
    .modern-cards-section .row {
        flex-direction: column;
    }
    
    .modern-cards-section .gradient-card .row {
        flex-direction: row !important;
    }
    
    .modern-cards-section .gradient-card .col-7,
    .modern-cards-section .gradient-card .col-5 {
        flex: 1;
    }
}
</style>
