<section class="breadcrumb__area" style="background: linear-gradient(135deg, #1e40af 0%, #3b82f6 50%, #60a5fa 100%); padding: 40px 0; position: relative; margin-bottom: 0;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb__content text-white">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <!-- Page Title -->
                        <div class="breadcrumb__title-section">
                            <h1 class="breadcrumb__title mb-0" style="font-size: 2rem; font-weight: 600; color: white;">
                                {{ $title }}
                            </h1>
                        </div>
                        
                        <!-- Breadcrumb Navigation -->
                        <nav class="breadcrumb__nav">
                            <div class="breadcrumb__links" style="display: flex; align-items: center; gap: 8px;">
                                @foreach ($links as $key => $link)
                                    <a href="{{ $loop->last ? 'javascript:;' : $link['url'] }}" 
                                       class="breadcrumb__link" 
                                       style="color: {{ $loop->last ? '#fbbf24' : 'rgba(255, 255, 255, 0.8)' }}; text-decoration: none; font-size: 14px; font-weight: 500; transition: color 0.3s ease;">
                                        @if ($loop->first)
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" style="margin-right: 6px; vertical-align: middle;">
                                                <path d="M3 9L12 2L21 9V20C21 20.5304 20.7893 21.0391 20.4142 21.4142C20.0391 21.7893 19.5304 22 19 22H5C4.46957 22 3.96086 21.7893 3.58579 21.4142C3.21071 21.0391 3 20.5304 3 20V9Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M9 22V12H15V22" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        @endif
                                        {{ $link['text'] }}
                                    </a>
                                    @if (!$loop->last)
                                        <span class="breadcrumb__separator" style="color: rgba(255, 255, 255, 0.6); margin: 0 4px; font-size: 12px;">
                                            /
                                        </span>
                                    @endif
                                @endforeach
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
@media (max-width: 768px) {
    .breadcrumb__content .d-flex {
        flex-direction: column;
        align-items: flex-start !important;
        gap: 15px;
    }
    
    .breadcrumb__title {
        font-size: 1.5rem !important;
    }
    
    .breadcrumb__nav {
        width: 100%;
    }
}
</style>
