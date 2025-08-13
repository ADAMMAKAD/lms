@extends('frontend.layouts.master')

@section('meta_title', $seo_setting['home_page']['seo_title'])
@section('meta_description', $seo_setting['home_page']['seo_description'])
@section('meta_keywords', '')

@push('styles')
<style>
/* Modern Pluralsight-style CSS */
.hero-gradient {
    background: linear-gradient(135deg, #6B46C1 0%, #EC4899 50%, #F59E0B 100%);
}

.skill-card {
    transition: all 0.3s ease;
    border: 1px solid #e5e7eb;
}

.skill-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

.tech-logo {
    width: 48px;
    height: 48px;
    object-fit: contain;
}

.testimonial-card {
    background: #ffffff;
    border-radius: 12px;
    padding: 24px;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
}

.step-number {
    background: linear-gradient(135deg, #6B46C1, #EC4899);
    color: white;
    width: 48px;
    height: 48px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 18px;
}

.video-thumbnail {
    position: relative;
    border-radius: 12px;
    overflow: hidden;
}

.play-button {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: rgba(255, 255, 255, 0.9);
    border-radius: 50%;
    width: 80px;
    height: 80px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
}

.play-button:hover {
    background: rgba(255, 255, 255, 1);
    transform: translate(-50%, -50%) scale(1.1);
}

.certification-badge {
    background: linear-gradient(135deg, #10B981, #059669);
    color: white;
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 14px;
    font-weight: 600;
}

.app-mockup {
    max-width: 300px;
    height: auto;
}

.dashboard-mockup {
    border-radius: 12px;
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
}

@media (max-width: 768px) {
    .hero-gradient {
        padding: 60px 0;
    }
    
    .tech-logo {
        width: 40px;
        height: 40px;
    }
    
    .step-number {
        width: 40px;
        height: 40px;
        font-size: 16px;
    }
}
</style>
@endpush

@section('contents')
    <!-- Hero Section -->
    <section class="hero-gradient py-20">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center text-white">
                <h1 class="text-5xl md:text-6xl font-bold mb-6 leading-tight">
                    Advance your skills with
                    <span class="block">skill assessments</span>
                </h1>
                <p class="text-xl md:text-2xl mb-8 opacity-90">
                    Measure your abilities, identify knowledge gaps, and grow with personalized learning paths
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="#assessments" class="bg-white text-purple-600 px-8 py-4 rounded-lg font-semibold text-lg hover:bg-gray-100 transition-colors">
                        Take a skill assessment
                    </a>
                    <a href="#how-it-works" class="border-2 border-white text-white px-8 py-4 rounded-lg font-semibold text-lg hover:bg-white hover:text-purple-600 transition-colors">
                        See how it works
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Video Introduction Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                <div class="grid md:grid-cols-2 gap-12 items-center">
                    <div>
                        <h2 class="text-4xl font-bold text-gray-900 mb-6">
                            Learn the skills you need to advance your career
                        </h2>
                        <p class="text-lg text-gray-600 mb-8">
                            Our skill assessments help you identify your current level and create a personalized learning path to reach your goals. Join thousands of professionals who have advanced their careers with SkillGro.
                        </p>
                        <div class="flex items-center gap-4">
                            <div class="text-center">
                                <div class="text-2xl font-bold text-purple-600">50K+</div>
                                <div class="text-sm text-gray-600">Assessments taken</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-purple-600">95%</div>
                                <div class="text-sm text-gray-600">Success rate</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-purple-600">4.8/5</div>
                                <div class="text-sm text-gray-600">User rating</div>
                            </div>
                        </div>
                    </div>
                    <div class="video-thumbnail">
                        <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=600&h=400&fit=crop" alt="Learning video" class="w-full h-80 object-cover">
                        <div class="play-button">
                            <svg class="w-8 h-8 text-purple-600 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M8 5v10l8-5-8-5z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Popular Skill Assessments Section -->
    <section id="assessments" class="py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold text-gray-900 mb-4">
                        Popular skill assessments
                    </h2>
                    <p class="text-lg text-gray-600">
                        Test your knowledge and get personalized recommendations
                    </p>
                </div>
                
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($assessments as $assessment)
                    <div class="skill-card bg-white rounded-lg p-6 hover:shadow-lg transition-all">
                        <div class="flex items-center mb-4">
                            <img src="{{ $assessment->logo_url }}" alt="{{ $assessment->technology }}" class="tech-logo mr-3">
                            <div>
                                <h3 class="font-semibold text-gray-900">{{ $assessment->technology }}</h3>
                                <p class="text-sm text-gray-600">{{ $assessment->skill_level }}</p>
                            </div>
                        </div>
                        <p class="text-gray-600 mb-4 text-sm">{{ $assessment->description }}</p>
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-sm text-gray-500">{{ $assessment->course_count }} courses</span>
                            @if($assessment->is_popular)
                            <span class="bg-orange-100 text-orange-600 px-2 py-1 rounded text-xs font-medium">Popular</span>
                            @endif
                        </div>
                        <a href="#" class="block w-full text-center bg-purple-600 text-white py-2 rounded-lg hover:bg-purple-700 transition-colors">
                            Take assessment
                        </a>
                    </div>
                    @endforeach
                </div>
                
                <div class="text-center mt-8">
                    <a href="#" class="text-purple-600 font-semibold hover:text-purple-700">
                        View all assessments →
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section id="how-it-works" class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold text-gray-900 mb-4">
                        How it works
                    </h2>
                    <p class="text-lg text-gray-600">
                        Three simple steps to advance your skills
                    </p>
                </div>
                
                <div class="grid md:grid-cols-3 gap-8">
                    <div class="text-center">
                        <div class="step-number mx-auto mb-4">1</div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">Take an assessment</h3>
                        <p class="text-gray-600">Choose from our library of skill assessments and test your current knowledge level.</p>
                    </div>
                    <div class="text-center">
                        <div class="step-number mx-auto mb-4">2</div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">Get your results</h3>
                        <p class="text-gray-600">Receive detailed feedback on your strengths and areas for improvement.</p>
                    </div>
                    <div class="text-center">
                        <div class="step-number mx-auto mb-4">3</div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">Start learning</h3>
                        <p class="text-gray-600">Follow your personalized learning path with curated courses and resources.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Customer Testimonials Section -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold text-gray-900 mb-4">
                        What our learners say
                    </h2>
                    <p class="text-lg text-gray-600">
                        Join thousands of professionals advancing their careers
                    </p>
                </div>
                
                <div class="grid md:grid-cols-3 gap-8">
                    @foreach($testimonials as $testimonial)
                    <div class="testimonial-card">
                        <div class="flex items-center mb-4">
                            <img src="{{ $testimonial->photo_url }}" alt="{{ $testimonial->customer_name }}" class="w-12 h-12 rounded-full mr-4">
                            <div>
                                <h4 class="font-semibold text-gray-900">{{ $testimonial->customer_name }}</h4>
                                <p class="text-sm text-gray-600">{{ $testimonial->customer_title }}</p>
                                @if($testimonial->company)
                                <p class="text-sm text-gray-500">{{ $testimonial->company }}</p>
                                @endif
                            </div>
                        </div>
                        <p class="text-gray-700 italic">"{{ $testimonial->quote }}"</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Certification Section -->
    <section class="py-16 bg-purple-50">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                <div class="grid md:grid-cols-2 gap-12 items-center">
                    <div>
                        <h2 class="text-4xl font-bold text-gray-900 mb-6">
                            Earn industry-recognized certifications
                        </h2>
                        <p class="text-lg text-gray-600 mb-8">
                            Validate your skills with certifications that employers trust. Our certificates are recognized by leading companies worldwide.
                        </p>
                        <div class="flex flex-wrap gap-3 mb-8">
                            <span class="certification-badge">JavaScript Certified</span>
                            <span class="certification-badge">React Expert</span>
                            <span class="certification-badge">Python Professional</span>
                        </div>
                        <a href="#" class="bg-purple-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-purple-700 transition-colors">
                            View all certifications
                        </a>
                    </div>
                    <div class="text-center">
                        <img src="https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=500&h=400&fit=crop" alt="Certification" class="rounded-lg shadow-lg">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Custom Learning Paths Section -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                <div class="grid md:grid-cols-2 gap-12 items-center">
                    <div class="text-center">
                        <img src="https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?w=300&h=600&fit=crop" alt="Mobile app" class="app-mockup mx-auto">
                    </div>
                    <div>
                        <h2 class="text-4xl font-bold text-gray-900 mb-6">
                            Personalized learning paths
                        </h2>
                        <p class="text-lg text-gray-600 mb-8">
                            Get a customized learning experience based on your assessment results, career goals, and learning preferences. Our AI-powered recommendations ensure you're always learning the most relevant skills.
                        </p>
                        <ul class="space-y-4 mb-8">
                            <li class="flex items-center">
                                <svg class="w-6 h-6 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-gray-700">AI-powered course recommendations</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="w-6 h-6 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-gray-700">Progress tracking and analytics</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="w-6 h-6 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-gray-700">Flexible learning schedule</span>
                            </li>
                        </ul>
                        <a href="#" class="bg-purple-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-purple-700 transition-colors">
                            Start your learning path
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Knowledge Gaps Identification Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                <div class="grid md:grid-cols-2 gap-12 items-center">
                    <div>
                        <h2 class="text-4xl font-bold text-gray-900 mb-6">
                            Identify and fill knowledge gaps
                        </h2>
                        <p class="text-lg text-gray-600 mb-8">
                            Our advanced analytics help you understand exactly where you stand and what you need to learn next. Get detailed insights into your skill development journey.
                        </p>
                        <div class="grid grid-cols-2 gap-4 mb-8">
                            <div class="text-center p-4 bg-white rounded-lg">
                                <div class="text-2xl font-bold text-purple-600 mb-2">85%</div>
                                <div class="text-sm text-gray-600">Skill Coverage</div>
                            </div>
                            <div class="text-center p-4 bg-white rounded-lg">
                                <div class="text-2xl font-bold text-orange-500 mb-2">12</div>
                                <div class="text-sm text-gray-600">Areas to Improve</div>
                            </div>
                        </div>
                        <a href="#" class="bg-purple-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-purple-700 transition-colors">
                            Analyze my skills
                        </a>
                    </div>
                    <div class="text-center">
                        <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=600&h=400&fit=crop" alt="Analytics dashboard" class="dashboard-mockup w-full">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
