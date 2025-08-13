<section class="faq__area" style="background: linear-gradient(135deg, #F8FAFC 0%, #E2E8F0 100%); padding: 100px 0; position: relative; overflow: hidden;">
  <!-- Background Pattern -->
  <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; opacity: 0.05; background-image: url('data:image/svg+xml,<svg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><g fill="%238B5CF6" fill-opacity="0.4"><circle cx="30" cy="30" r="4"/></g></svg>'); background-size: 60px 60px;"></div>
  
  <div class="container" style="position: relative; z-index: 2;">
      <div class="row align-items-center">
          <div class="col-lg-6">
              <div class="faq__img-wrap" style="position: relative; padding: 40px; text-align: center;">
                  <!-- Modern FAQ Illustration -->
                  <div style="background: linear-gradient(135deg, #8B5CF6, #A855F7); border-radius: 30px; padding: 60px 40px; box-shadow: 0 20px 60px rgba(139, 92, 246, 0.3); position: relative; overflow: hidden;">
                      <!-- Background Elements -->
                      <div style="position: absolute; top: 20px; right: 20px; width: 80px; height: 80px; background: rgba(255, 255, 255, 0.1); border-radius: 50%; animation: float 6s ease-in-out infinite;"></div>
                      <div style="position: absolute; bottom: 30px; left: 30px; width: 60px; height: 60px; background: rgba(255, 255, 255, 0.1); border-radius: 50%; animation: float 8s ease-in-out infinite reverse;"></div>
                      
                      <!-- FAQ Icon -->
                      <div style="background: rgba(255, 255, 255, 0.2); border-radius: 20px; padding: 30px; display: inline-block; margin-bottom: 20px;">
                          <svg width="80" height="80" fill="white" viewBox="0 0 24 24">
                              <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 17h-2v-2h2v2zm2.07-7.75l-.9.92C13.45 12.9 13 13.5 13 15h-2v-.5c0-1.1.45-2.1 1.17-2.83l1.24-1.26c.37-.36.59-.86.59-1.41 0-1.1-.9-2-2-2s-2 .9-2 2H8c0-2.21 1.79-4 4-4s4 1.79 4 4c0 .88-.36 1.68-.93 2.25z"/>
                          </svg>
                      </div>
                      
                      <!-- Text -->
                      <h3 style="color: white; font-size: 1.5rem; font-weight: 700; margin: 0; font-family: 'Inter', sans-serif;">{{ __('Frequently Asked Questions') }}</h3>
                      <p style="color: rgba(255, 255, 255, 0.8); margin: 15px 0 0 0; font-size: 1rem; line-height: 1.6;">{{ __('Find answers to common questions about our platform') }}</p>
                  </div>
              </div>
          </div>
          <div class="col-lg-6">
              <div class="faq__content" style="padding-left: 40px;">
                  <div class="section__title" style="margin-bottom: 30px;">
                      <span style="background: linear-gradient(135deg, #8B5CF6, #A855F7); color: white; padding: 8px 20px; border-radius: 25px; font-size: 0.9rem; font-weight: 600; letter-spacing: 0.5px; display: inline-block; margin-bottom: 20px; box-shadow: 0 4px 15px rgba(139, 92, 246, 0.3);">{{ $faqSection?->content?->short_title ?: 'FAQ' }}</span>
                      <h2 style="font-size: 2.5rem; color: #1E293B; line-height: 1.2; margin: 0; font-family: 'Inter', sans-serif; font-weight: 700;">
                          <span style="background: linear-gradient(135deg, #8B5CF6, #A855F7); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">{!! clean(processText($faqSection?->content?->title)) ?: 'Common Questions' !!}</span>
                      </h2>
                  </div>
                  <p style="color: #64748B; font-size: 1.1rem; line-height: 1.7; margin-bottom: 40px; max-width: 500px;">{!! clean(processText($faqSection?->content?->description)) ?: 'Get quick answers to the most frequently asked questions about our learning platform.' !!}</p>
                  <div class="faq__wrap">
                      <div class="accordion" id="accordionExample" style="border: none;">
                        @foreach($faqs as $faq)
                          <div class="accordion-item" style="background: white; border: none; border-radius: 16px; margin-bottom: 16px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08); overflow: hidden; transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 30px rgba(139, 92, 246, 0.15)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 20px rgba(0, 0, 0, 0.08)';">
                              <h2 class="accordion-header" style="border: none;">
                                  <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse"
                                      data-bs-target="#collapse{{ $faq->id }}" aria-expanded="{{ $loop->first ? 'true' : 'false' }}"
                                      aria-controls="collapse{{ $faq->id }}"
                                      style="background: transparent; border: none; padding: 24px 30px; font-size: 1.1rem; font-weight: 600; color: #1E293B; font-family: 'Inter', sans-serif; box-shadow: none; transition: all 0.3s ease;"
                                      onmouseover="this.style.color='#8B5CF6';"
                                      onmouseout="this.style.color='#1E293B';">
                                      {{ $faq?->question }}
                                      <span style="margin-left: auto; width: 24px; height: 24px; background: linear-gradient(135deg, #8B5CF6, #A855F7); border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: transform 0.3s ease;">
                                          <svg width="12" height="12" fill="white" viewBox="0 0 24 24">
                                              <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
                                          </svg>
                                      </span>
                                  </button>
                              </h2>
                              <div id="collapse{{ $faq->id }}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                                  data-bs-parent="#accordionExample">
                                  <div class="accordion-body" style="padding: 0 30px 30px 30px; border-top: 1px solid #F1F5F9;">
                                      <p style="color: #64748B; font-size: 1rem; line-height: 1.7; margin: 20px 0 0 0;">
                                        {{ $faq?->answer }}
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
  </div>
</section>

<style>
@keyframes float {
    0%, 100% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-20px);
    }
}

.accordion-button:not(.collapsed) .accordion-icon {
    transform: rotate(45deg);
}

.accordion-button .accordion-icon {
    transition: transform 0.3s ease;
}
</style>