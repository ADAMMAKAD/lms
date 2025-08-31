/**
 * Lazy Loading Implementation for Images
 * Optimizes page load performance by loading images only when they enter the viewport
 */

(function() {
    'use strict';

    // Check if Intersection Observer is supported
    if (!('IntersectionObserver' in window)) {
        // Fallback for older browsers - load all images immediately
        document.querySelectorAll('img[data-src]').forEach(function(img) {
            img.src = img.dataset.src;
            img.classList.remove('lazy');
        });
        return;
    }

    // Configuration for the observer
    const config = {
        root: null,
        rootMargin: '50px 0px', // Start loading 50px before the image enters viewport
        threshold: 0.01
    };

    // Create intersection observer
    const imageObserver = new IntersectionObserver(function(entries, observer) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                const img = entry.target;
                
                // Load the image
                img.src = img.dataset.src;
                img.classList.remove('lazy');
                img.classList.add('lazy-loaded');
                
                // Add fade-in effect
                img.addEventListener('load', function() {
                    img.style.opacity = '1';
                });
                
                // Stop observing this image
                observer.unobserve(img);
            }
        });
    }, config);

    // Start observing all lazy images
    function initLazyLoading() {
        const lazyImages = document.querySelectorAll('img[data-src]');
        lazyImages.forEach(function(img) {
            img.classList.add('lazy');
            img.style.opacity = '0';
            img.style.transition = 'opacity 0.3s';
            imageObserver.observe(img);
        });
    }

    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initLazyLoading);
    } else {
        initLazyLoading();
    }

    // Re-initialize for dynamically added content
    window.initLazyLoading = initLazyLoading;
})();