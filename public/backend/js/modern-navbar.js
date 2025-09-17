/**
 * Modern Navbar JavaScript
 * Handles search functionality, dropdown interactions, and responsive behavior
 */

(function($) {
    'use strict';

    // Initialize when document is ready
    $(document).ready(function() {
        initializeModernNavbar();
    });

    function initializeModernNavbar() {
        initializeSearch();
        initializeDropdowns();
        initializeSidebarToggle();
        initializeResponsiveNavbar();
        initializeNotifications();
    }

    // Enhanced Search Functionality
    function initializeSearch() {
        const searchInput = $('#search_menu');
        const searchDropdown = $('#admin_menu_list');
        const searchItems = searchDropdown.find('.search-item:not(.not-found-message)');
        const notFoundMessage = searchDropdown.find('.not-found-message');
        let searchTimeout;

        // Show dropdown on focus
        searchInput.on('focus', function() {
            if ($(this).val().trim() !== '') {
                searchDropdown.removeClass('d-none');
            }
        });

        // Hide dropdown when clicking outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.modern-search-container').length) {
                searchDropdown.addClass('d-none');
            }
        });

        // Enhanced search with debouncing
        searchInput.on('input', function() {
            const query = $(this).val().toLowerCase().trim();
            
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(function() {
                performSearch(query, searchItems, searchDropdown, notFoundMessage);
            }, 300);
        });

        // Keyboard navigation
        searchInput.on('keydown', function(e) {
            const visibleItems = searchDropdown.find('.search-item:visible:not(.not-found-message)');
            const currentActive = searchDropdown.find('.search-item.active');
            let nextActive;

            switch(e.keyCode) {
                case 40: // Arrow Down
                    e.preventDefault();
                    if (currentActive.length === 0) {
                        nextActive = visibleItems.first();
                    } else {
                        nextActive = currentActive.next('.search-item:visible:not(.not-found-message)');
                        if (nextActive.length === 0) {
                            nextActive = visibleItems.first();
                        }
                    }
                    updateActiveSearchItem(currentActive, nextActive);
                    break;

                case 38: // Arrow Up
                    e.preventDefault();
                    if (currentActive.length === 0) {
                        nextActive = visibleItems.last();
                    } else {
                        nextActive = currentActive.prev('.search-item:visible:not(.not-found-message)');
                        if (nextActive.length === 0) {
                            nextActive = visibleItems.last();
                        }
                    }
                    updateActiveSearchItem(currentActive, nextActive);
                    break;

                case 13: // Enter
                    e.preventDefault();
                    if (currentActive.length > 0) {
                        window.location.href = currentActive.attr('href');
                    }
                    break;

                case 27: // Escape
                    searchDropdown.addClass('d-none');
                    searchInput.blur();
                    break;
            }
        });

        // Click on search items
        searchDropdown.on('click', '.search-item:not(.not-found-message)', function(e) {
            const href = $(this).attr('href');
            if (href && href !== 'javascript:;') {
                window.location.href = href;
            }
        });
    }

    function performSearch(query, searchItems, searchDropdown, notFoundMessage) {
        let hasResults = false;

        if (query === '') {
            searchDropdown.addClass('d-none');
            return;
        }

        searchItems.each(function() {
            const item = $(this);
            const text = item.text().toLowerCase();
            
            if (text.includes(query)) {
                item.show();
                hasResults = true;
                // Highlight matching text
                highlightSearchText(item, query);
            } else {
                item.hide();
            }
        });

        // Show/hide not found message
        if (hasResults) {
            notFoundMessage.addClass('d-none');
        } else {
            notFoundMessage.removeClass('d-none');
        }

        searchDropdown.removeClass('d-none');
    }

    function highlightSearchText(item, query) {
        const text = item.text();
        const regex = new RegExp(`(${query})`, 'gi');
        const highlightedText = text.replace(regex, '<mark>$1</mark>');
        
        // Preserve the icon
        const icon = item.find('i').prop('outerHTML');
        item.html(icon + ' ' + highlightedText);
    }

    function updateActiveSearchItem(currentActive, nextActive) {
        currentActive.removeClass('active');
        nextActive.addClass('active');
        
        // Scroll into view if needed
        const dropdown = $('#admin_menu_list');
        const itemTop = nextActive.position().top;
        const itemHeight = nextActive.outerHeight();
        const dropdownHeight = dropdown.height();
        const scrollTop = dropdown.scrollTop();
        
        if (itemTop < 0) {
            dropdown.scrollTop(scrollTop + itemTop);
        } else if (itemTop + itemHeight > dropdownHeight) {
            dropdown.scrollTop(scrollTop + itemTop + itemHeight - dropdownHeight);
        }
    }

    // Enhanced Dropdown Functionality
    function initializeDropdowns() {
        // Custom dropdown behavior for better UX
        $('.dropdown-toggle').on('click', function(e) {
            e.preventDefault();
            const dropdown = $(this).next('.dropdown-menu');
            
            // Close other dropdowns
            $('.dropdown-menu').not(dropdown).removeClass('show');
            
            // Toggle current dropdown
            dropdown.toggleClass('show');
        });

        // Close dropdowns when clicking outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.dropdown').length) {
                $('.dropdown-menu').removeClass('show');
            }
        });

        // Prevent dropdown from closing when clicking inside
        $('.dropdown-menu').on('click', function(e) {
            e.stopPropagation();
        });
    }

    // Sidebar Toggle Functionality
    function initializeSidebarToggle() {
        $('.sidebar-toggle-btn').on('click', function() {
            $('body').toggleClass('sidebar-mini');
            
            // Store sidebar state in localStorage
            const isMini = $('body').hasClass('sidebar-mini');
            localStorage.setItem('sidebar-mini', isMini);
            
            // Trigger resize event for charts
            setTimeout(function() {
                $(window).trigger('resize');
            }, 300);
        });

        // Restore sidebar state from localStorage
        const savedState = localStorage.getItem('sidebar-mini');
        if (savedState === 'true') {
            $('body').addClass('sidebar-mini');
        }
    }

    // Responsive Navbar Behavior
    function initializeResponsiveNavbar() {
        let resizeTimeout;
        
        $(window).on('resize', function() {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(function() {
                handleResponsiveNavbar();
            }, 250);
        });

        // Initial call
        handleResponsiveNavbar();
    }

    function handleResponsiveNavbar() {
        const windowWidth = $(window).width();
        
        if (windowWidth < 768) {
            // Mobile adjustments
            $('.user-info').addClass('d-none');
            $('.navbar-controls .modern-select').addClass('d-none');
        } else {
            // Desktop adjustments
            $('.user-info').removeClass('d-none');
            $('.navbar-controls .modern-select').removeClass('d-none');
        }
    }

    // Notification System
    function initializeNotifications() {
        // Animate notification badge
        const notificationBadge = $('.notification-badge');
        if (notificationBadge.length > 0) {
            setInterval(function() {
                notificationBadge.addClass('animate__animated animate__pulse');
                setTimeout(function() {
                    notificationBadge.removeClass('animate__animated animate__pulse');
                }, 1000);
            }, 5000);
        }

        // Mark notifications as read (placeholder functionality)
        $('.notification-menu .dropdown-item').on('click', function() {
            $(this).addClass('read');
            updateNotificationCount();
        });
    }

    function updateNotificationCount() {
        const unreadCount = $('.notification-menu .dropdown-item:not(.read)').length;
        const badge = $('.notification-badge');
        
        if (unreadCount > 0) {
            badge.text(unreadCount).show();
        } else {
            badge.hide();
        }
    }

    // Language and Currency Change Handlers
    $('.change-language').on('change', function() {
        $('#setLanguageHeader').submit();
    });

    $('.change-currency').on('change', function() {
        $('.set-currency-header').submit();
    });

    // Smooth scrolling for anchor links
    $('a[href^="#"]').on('click', function(e) {
        const target = $(this.getAttribute('href'));
        if (target.length) {
            e.preventDefault();
            $('html, body').animate({
                scrollTop: target.offset().top - 100
            }, 500);
        }
    });

    // Add loading states for form submissions
    $('form').on('submit', function() {
        const submitBtn = $(this).find('button[type="submit"], input[type="submit"]');
        submitBtn.prop('disabled', true);
        submitBtn.html('<i class="fas fa-spinner fa-spin"></i> Loading...');
    });

    // Enhanced tooltips
    $('[title]').each(function() {
        $(this).attr('data-toggle', 'tooltip');
        $(this).attr('data-placement', 'bottom');
    });

    // Initialize Bootstrap tooltips if available
    if (typeof $().tooltip === 'function') {
        $('[data-toggle="tooltip"]').tooltip();
    }

    // Add smooth transitions to all interactive elements
    $('.navbar-action-btn, .modern-select, .modern-search-input, .user-profile-btn').each(function() {
        $(this).css('transition', 'all 0.3s ease');
    });

    // Performance optimization: Debounced scroll handler
    let scrollTimeout;
    $(window).on('scroll', function() {
        clearTimeout(scrollTimeout);
        scrollTimeout = setTimeout(function() {
            handleNavbarScroll();
        }, 10);
    });

    function handleNavbarScroll() {
        const scrollTop = $(window).scrollTop();
        const navbar = $('.modern-navbar');
        
        if (scrollTop > 50) {
            navbar.addClass('scrolled');
        } else {
            navbar.removeClass('scrolled');
        }
    }

})(jQuery);

// Export functions for external use if needed
window.ModernNavbar = {
    init: function() {
        // Re-initialize if needed
        $(document).ready(function() {
            initializeModernNavbar();
        });
    }
};