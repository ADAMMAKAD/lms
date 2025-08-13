/**
 * Modern SkillGro Admin Panel JavaScript
 * Handles interactive elements and modern UI functionality
 */

(function() {
    'use strict';
    
    // Wait for DOM to be ready
    document.addEventListener('DOMContentLoaded', function() {
        
        // Initialize sidebar dropdown functionality
        initSidebarDropdowns();
        
        // Initialize responsive sidebar
        initResponsiveSidebar();
        
        // Initialize smooth scrolling
        initSmoothScrolling();
        
        // Initialize card hover effects
        initCardEffects();
        
        // Initialize form enhancements
        initFormEnhancements();
    });
    
    /**
     * Initialize sidebar dropdown functionality
     */
    function initSidebarDropdowns() {
        const dropdownItems = document.querySelectorAll('.main-sidebar .nav-item.dropdown');
        
        dropdownItems.forEach(function(item) {
            // Handle both has-dropdown class and data-toggle="dropdown" systems
            const trigger = item.querySelector('.has-dropdown') || item.querySelector('[data-toggle="dropdown"]');
            const menu = item.querySelector('.dropdown-menu');
            
            if (trigger && menu) {
                trigger.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Close other dropdowns
                    dropdownItems.forEach(function(otherItem) {
                        if (otherItem !== item) {
                            otherItem.classList.remove('show', 'active');
                            const otherMenu = otherItem.querySelector('.dropdown-menu');
                            if (otherMenu) {
                                otherMenu.style.display = 'none';
                            }
                        }
                    });
                    
                    // Toggle current dropdown
                    const isOpen = item.classList.contains('show') || item.classList.contains('active');
                    if (isOpen) {
                        item.classList.remove('show', 'active');
                        menu.style.display = 'none';
                    } else {
                        item.classList.add('show', 'active');
                        menu.style.display = 'block';
                    }
                });
            }
        });
        
        // Close dropdowns when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.main-sidebar')) {
                dropdownItems.forEach(function(item) {
                    item.classList.remove('show', 'active');
                    const menu = item.querySelector('.dropdown-menu');
                    if (menu) {
                        menu.style.display = 'none';
                    }
                });
            }
        });
    }
    
    /**
     * Initialize responsive sidebar
     */
    function initResponsiveSidebar() {
        const sidebarToggle = document.querySelector('[data-toggle="sidebar"]');
        const sidebar = document.querySelector('.main-sidebar');
        const mainWrapper = document.querySelector('.main-wrapper');
        const sidebarOverlay = document.querySelector('.sidebar-overlay');
        
        if (sidebarToggle && sidebar) {
            sidebarToggle.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Toggle sidebar visibility
                sidebar.classList.toggle('sidebar-hidden');
                
                // Toggle navbar position
                const navbar = document.querySelector('.navbar');
                if (navbar) {
                    navbar.classList.toggle('sidebar-hidden');
                }
                
                // Show/hide overlay on mobile
                if (sidebarOverlay && window.innerWidth <= 992) {
                    sidebarOverlay.classList.toggle('show');
                }
            });
        }
        
        // Handle overlay click to close sidebar
        if (sidebarOverlay) {
            sidebarOverlay.addEventListener('click', function() {
                sidebar.classList.add('sidebar-hidden');
                sidebarOverlay.classList.remove('show');
                
                // Update navbar position
                const navbar = document.querySelector('.navbar');
                if (navbar) {
                    navbar.classList.add('sidebar-hidden');
                }
            });
        }
        
        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 992) {
                sidebar.classList.remove('sidebar-hidden');
                if (sidebarOverlay) {
                    sidebarOverlay.classList.remove('show');
                }
                
                // Reset navbar position
                const navbar = document.querySelector('.navbar');
                if (navbar) {
                    navbar.classList.remove('sidebar-hidden');
                }
            }
        });
    }
    
    /**
     * Initialize smooth scrolling
     */
    function initSmoothScrolling() {
        const links = document.querySelectorAll('a[href^="#"]');
        
        links.forEach(function(link) {
            link.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                const target = document.querySelector(href);
                
                if (target) {
                    e.preventDefault();
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    }
    
    /**
     * Initialize card hover effects
     */
    function initCardEffects() {
        const cards = document.querySelectorAll('.card-statistic-1, .card-hero');
        
        cards.forEach(function(card) {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-4px)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
    }
    
    /**
     * Initialize form enhancements
     */
    function initFormEnhancements() {
        // Add focus effects to form controls
        const formControls = document.querySelectorAll('.form-control');
        
        formControls.forEach(function(control) {
            control.addEventListener('focus', function() {
                this.parentElement.classList.add('form-group-focused');
            });
            
            control.addEventListener('blur', function() {
                this.parentElement.classList.remove('form-group-focused');
            });
        });
        
        // Enhance select elements
        const selects = document.querySelectorAll('select.form-control');
        
        selects.forEach(function(select) {
            select.addEventListener('change', function() {
                this.classList.add('has-value');
            });
        });
    }
    
    /**
     * Utility function to add loading state to buttons
     */
    window.addLoadingState = function(button, text = 'Loading...') {
        const originalText = button.innerHTML;
        button.innerHTML = `<i class="fas fa-spinner fa-spin"></i> ${text}`;
        button.disabled = true;
        
        return function() {
            button.innerHTML = originalText;
            button.disabled = false;
        };
    };
    
    /**
     * Utility function to show toast notifications
     */
    window.showToast = function(message, type = 'success') {
        const toast = document.createElement('div');
        toast.className = `toast toast-${type}`;
        toast.innerHTML = `
            <div class="toast-content">
                <i class="fas fa-${type === 'success' ? 'check' : type === 'error' ? 'times' : 'info'}-circle"></i>
                <span>${message}</span>
            </div>
        `;
        
        document.body.appendChild(toast);
        
        // Show toast
        setTimeout(() => toast.classList.add('show'), 100);
        
        // Hide toast after 3 seconds
        setTimeout(() => {
            toast.classList.remove('show');
            setTimeout(() => document.body.removeChild(toast), 300);
        }, 3000);
    };
    
    /**
     * Initialize modern search functionality
     */
    function initModernSearch() {
        const searchInput = document.getElementById('search_menu');
        const searchResults = document.getElementById('admin_menu_list');
        
        if (searchInput && searchResults) {
            // Enhanced search with debouncing and analytics
            let searchTimeout;
            let searchHistory = JSON.parse(localStorage.getItem('adminSearchHistory') || '[]');
            
            // Add search input animations
            searchInput.addEventListener('focus', function() {
                this.parentElement.classList.add('search-focused');
                if (this.value.trim() === '') {
                    showRecentSearches(searchResults, searchHistory);
                }
            });
            
            searchInput.addEventListener('blur', function() {
                setTimeout(() => {
                    this.parentElement.classList.remove('search-focused');
                }, 200);
            });
            
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                const query = this.value.toLowerCase().trim();
                
                // Add loading state
                if (query.length >= 1) {
                    searchResults.classList.add('loading');
                }
                
                searchTimeout = setTimeout(() => {
                    searchResults.classList.remove('loading');
                    if (query.length >= 2) {
                        performAdvancedSearch(query, searchResults);
                        // Track search analytics
                        trackSearchQuery(query);
                    } else if (query.length === 0) {
                        showRecentSearches(searchResults, searchHistory);
                    } else {
                        performQuickSearch(query, searchResults);
                    }
                }, 150);
            });
            
            // Hide search results when clicking outside
            document.addEventListener('click', function(e) {
                if (!e.target.closest('.modern-search-container')) {
                    searchResults.classList.remove('show');
                    setTimeout(() => {
                        if (!searchResults.classList.contains('show')) {
                            searchResults.classList.add('d-none');
                        }
                    }, 300);
                }
            });
            
            // Enhanced keyboard navigation with shortcuts
            searchInput.addEventListener('keydown', function(e) {
                const items = searchResults.querySelectorAll('.search-item:not(.d-none):not(.not-found-message)');
                let currentIndex = -1;
                
                // Find currently focused item
                items.forEach((item, index) => {
                    if (item.classList.contains('focused')) {
                        currentIndex = index;
                    }
                });
                
                switch(e.key) {
                    case 'ArrowDown':
                        e.preventDefault();
                        navigateSearchResults(items, currentIndex, 1);
                        break;
                    case 'ArrowUp':
                        e.preventDefault();
                        navigateSearchResults(items, currentIndex, -1);
                        break;
                    case 'Enter':
                        e.preventDefault();
                        const focusedItem = searchResults.querySelector('.search-item.focused');
                        if (focusedItem) {
                            addToSearchHistory(this.value.trim());
                            focusedItem.click();
                        }
                        break;
                    case 'Escape':
                        searchResults.classList.remove('show');
                        this.blur();
                        break;
                    case 'Tab':
                        if (items.length > 0 && currentIndex === -1) {
                            e.preventDefault();
                            items[0].classList.add('focused');
                        }
                        break;
                }
            });
            
            // Add search shortcuts (Ctrl/Cmd + K)
            document.addEventListener('keydown', function(e) {
                if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                    e.preventDefault();
                    searchInput.focus();
                    searchInput.select();
                }
            });
        }
    }
    
    /**
     * Navigate search results with keyboard
     */
    function navigateSearchResults(items, currentIndex, direction) {
        items.forEach(item => item.classList.remove('focused'));
        
        if (direction === 1) {
            currentIndex = (currentIndex + 1) % items.length;
        } else {
            currentIndex = currentIndex <= 0 ? items.length - 1 : currentIndex - 1;
        }
        
        if (items[currentIndex]) {
            items[currentIndex].classList.add('focused');
            items[currentIndex].scrollIntoView({ block: 'nearest' });
        }
    }
    
    /**
     * Show recent searches
     */
    function showRecentSearches(searchResults, history) {
        if (history.length === 0) {
            searchResults.classList.remove('show');
            return;
        }
        
        let html = '<div class="search-section-header">Recent Searches</div>';
        history.slice(0, 5).forEach(item => {
            html += `<div class="search-item recent-search" data-query="${item.query}">
                        <i class="fas fa-history mr-2"></i>
                        <span>${item.query}</span>
                        <small class="ml-auto text-muted">${item.count} times</small>
                     </div>`;
        });
        
        searchResults.innerHTML = html;
        searchResults.classList.add('show');
        searchResults.classList.remove('d-none');
        
        // Add click handlers for recent searches
        searchResults.querySelectorAll('.recent-search').forEach(item => {
            item.addEventListener('click', function() {
                const query = this.dataset.query;
                document.getElementById('search_menu').value = query;
                performAdvancedSearch(query, searchResults);
            });
        });
    }
    
    /**
     * Add to search history
     */
    function addToSearchHistory(query) {
        if (!query) return;
        
        let history = JSON.parse(localStorage.getItem('adminSearchHistory') || '[]');
        const existing = history.find(item => item.query === query);
        
        if (existing) {
            existing.count++;
            existing.lastUsed = Date.now();
        } else {
            history.push({
                query: query,
                count: 1,
                lastUsed: Date.now()
            });
        }
        
        // Keep only top 10 most used searches
        history.sort((a, b) => b.count - a.count);
        history = history.slice(0, 10);
        
        localStorage.setItem('adminSearchHistory', JSON.stringify(history));
    }
    
    /**
     * Track search analytics
     */
    function trackSearchQuery(query) {
        // Simple analytics tracking
        const analytics = JSON.parse(localStorage.getItem('adminSearchAnalytics') || '{}');
        const today = new Date().toISOString().split('T')[0];
        
        if (!analytics[today]) {
            analytics[today] = { queries: [], count: 0 };
        }
        
        analytics[today].queries.push({
            query: query,
            timestamp: Date.now()
        });
        analytics[today].count++;
        
        localStorage.setItem('adminSearchAnalytics', JSON.stringify(analytics));
    }
    
    /**
     * Perform quick search for single characters
     */
    function performQuickSearch(query, searchResults) {
        const quickResults = [
            { title: 'Dashboard', url: '/admin/dashboard', icon: 'fas fa-tachometer-alt', keywords: ['d', 'dash'] },
            { title: 'Users', url: '/admin/users', icon: 'fas fa-users', keywords: ['u', 'user'] },
            { title: 'Courses', url: '/admin/courses', icon: 'fas fa-book', keywords: ['c', 'course'] },
            { title: 'Settings', url: '/admin/settings', icon: 'fas fa-cog', keywords: ['s', 'setting'] }
        ];
        
        const filtered = quickResults.filter(item => 
            item.keywords.some(keyword => keyword.startsWith(query)) ||
            item.title.toLowerCase().startsWith(query)
        );
        
        displaySearchResults(filtered, searchResults, 'Quick Access');
    }
    
    /**
     * Perform advanced search with categorization
     */
    function performAdvancedSearch(query, searchResults) {
        // Show loading state
        searchResults.innerHTML = '<div class="search-loading"><i class="fas fa-spinner fa-spin mr-2"></i>Searching...</div>';
        searchResults.classList.add('show');
        searchResults.classList.remove('d-none');
        
        // Simulate API call with timeout
        setTimeout(() => {
            const results = getSearchResults(query);
            displayCategorizedResults(results, searchResults);
        }, 300);
    }
    
    /**
     * Get search results with categorization
     */
    function getSearchResults(query) {
        const allResults = [
            { title: 'Dashboard', url: '/admin/dashboard', icon: 'fas fa-tachometer-alt', category: 'Navigation', description: 'Admin dashboard overview' },
            { title: 'Users Management', url: '/admin/users', icon: 'fas fa-users', category: 'Management', description: 'Manage users and permissions' },
            { title: 'Course Management', url: '/admin/courses', icon: 'fas fa-book', category: 'Management', description: 'Manage courses and content' },
            { title: 'Categories', url: '/admin/categories', icon: 'fas fa-tags', category: 'Content', description: 'Manage course categories' },
            { title: 'Settings', url: '/admin/settings', icon: 'fas fa-cog', category: 'Configuration', description: 'System settings and configuration' },
            { title: 'Reports', url: '/admin/reports', icon: 'fas fa-chart-bar', category: 'Analytics', description: 'View reports and analytics' },
            { title: 'Announcements', url: '/admin/announcements', icon: 'fas fa-bullhorn', category: 'Communication', description: 'Manage announcements' },
            { title: 'Contact Messages', url: '/admin/contact-messages', icon: 'fas fa-envelope', category: 'Communication', description: 'View contact messages' }
        ];
        
        return allResults.filter(item => 
            item.title.toLowerCase().includes(query.toLowerCase()) ||
            item.description.toLowerCase().includes(query.toLowerCase()) ||
            item.category.toLowerCase().includes(query.toLowerCase())
        );
    }
    
    /**
     * Display categorized search results
     */
    function displayCategorizedResults(results, searchResults) {
        if (results.length === 0) {
            searchResults.innerHTML = '<div class="search-item not-found"><i class="fas fa-search mr-2"></i>No results found</div>';
            return;
        }
        
        // Group by category
        const grouped = results.reduce((acc, item) => {
            if (!acc[item.category]) acc[item.category] = [];
            acc[item.category].push(item);
            return acc;
        }, {});
        
        let html = '';
        Object.keys(grouped).forEach(category => {
            html += `<div class="search-section-header">${category}</div>`;
            grouped[category].forEach(item => {
                html += `<a href="${item.url}" class="search-item">
                            <i class="${item.icon} mr-2"></i>
                            <div class="search-item-content">
                                <div class="search-item-title">${item.title}</div>
                                <div class="search-item-description">${item.description}</div>
                            </div>
                         </a>`;
            });
        });
        
        searchResults.innerHTML = html;
    }
    
    /**
     * Display simple search results
     */
    function displaySearchResults(results, searchResults, sectionTitle = null) {
        let html = '';
        
        if (sectionTitle) {
            html += `<div class="search-section-header">${sectionTitle}</div>`;
        }
        
        if (results.length === 0) {
            html += '<div class="search-item not-found"><i class="fas fa-search mr-2"></i>No results found</div>';
        } else {
            results.forEach(item => {
                html += `<a href="${item.url}" class="search-item">
                            <i class="${item.icon} mr-2"></i>
                            <span>${item.title}</span>
                         </a>`;
            });
        }
        
        searchResults.innerHTML = html;
        searchResults.classList.add('show');
        searchResults.classList.remove('d-none');
    }
    
    function performSearch(query, searchResults) {
        const items = searchResults.querySelectorAll('a:not(.not-found-message)');
        let hasResults = false;
        
        items.forEach(function(item) {
            const text = item.textContent.toLowerCase();
            if (text.includes(query) || query === '') {
                item.style.display = 'flex';
                item.classList.remove('d-none');
                hasResults = true;
            } else {
                item.style.display = 'none';
                item.classList.add('d-none');
            }
            item.classList.remove('focused');
        });
        
        const notFound = searchResults.querySelector('.not-found-message');
        if (hasResults || query === '') {
            notFound.classList.add('d-none');
            searchResults.classList.add('show');
            searchResults.classList.remove('d-none');
        } else {
            notFound.classList.remove('d-none');
            searchResults.classList.add('show');
            searchResults.classList.remove('d-none');
        }
        
        if (query === '') {
            searchResults.classList.remove('show');
        }
    }
    
    /**
     * Perform backend search for dynamic results
     */
    function performBackendSearch(query, searchResults) {
        // Show loading state
        searchResults.innerHTML = '<div class="search-item text-center"><i class="fas fa-spinner fa-spin mr-2"></i>Searching...</div>';
        searchResults.classList.add('show');
        searchResults.classList.remove('d-none');
        
        // Fetch search results from backend
        fetch('/admin/search', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
            },
            body: JSON.stringify({
                query: query
            })
        })
        .then(response => response.json())
        .then(data => {
            displayBackendSearchResults(data.results || [], searchResults);
        })
        .catch(error => {
            console.error('Search error:', error);
            // Fallback to static results
            const staticResults = [
                { title: 'Dashboard', url: '/admin/dashboard', type: 'page', icon: 'fas fa-tachometer-alt' },
                { title: 'Users Management', url: '/admin/users', type: 'page', icon: 'fas fa-users' },
                { title: 'Course Management', url: '/admin/courses', type: 'page', icon: 'fas fa-book' },
                { title: 'Settings', url: '/admin/settings', type: 'page', icon: 'fas fa-cog' },
                { title: 'Reports', url: '/admin/reports', type: 'page', icon: 'fas fa-chart-bar' },
                { title: 'Categories', url: '/admin/categories', type: 'page', icon: 'fas fa-tags' },
                { title: 'Announcements', url: '/admin/announcements', type: 'page', icon: 'fas fa-bullhorn' },
                { title: 'Contact Messages', url: '/admin/contact-messages', type: 'page', icon: 'fas fa-envelope' }
            ].filter(item => item.title.toLowerCase().includes(query.toLowerCase()));
            
            displayBackendSearchResults(staticResults, searchResults);
        });
    }
    
    /**
     * Display backend search results
     */
    function displayBackendSearchResults(results, searchResults) {
        // Clear previous results
        searchResults.innerHTML = '';
        
        if (results.length > 0) {
            results.forEach(result => {
                const item = document.createElement('a');
                item.href = result.url;
                item.className = 'search-item';
                item.innerHTML = `
                    <i class="${result.icon || 'fas fa-file-alt'} mr-2"></i>
                    <div class="flex-grow-1">
                        <div class="font-weight-bold">${result.title}</div>
                        ${result.description ? `<div class="text-muted" style="font-size: 12px;">${result.description}</div>` : ''}
                    </div>
                    ${result.badge ? `<span class="badge badge-secondary ml-2">${result.badge}</span>` : ''}
                `;
                
                // Add click handler for analytics
                item.addEventListener('click', function(e) {
                    // Track search click if analytics available
                    if (typeof gtag !== 'undefined') {
                        gtag('event', 'search_click', {
                            'search_term': document.getElementById('search_menu').value,
                            'result_title': result.title
                        });
                    }
                });
                
                searchResults.appendChild(item);
            });
        } else {
            const noResults = document.createElement('div');
            noResults.className = 'not-found-message';
            noResults.innerHTML = '<i class="fas fa-search mr-2"></i>No results found';
            searchResults.appendChild(noResults);
        }
        
        searchResults.classList.add('show');
        searchResults.classList.remove('d-none');
    }
    
    /**
     * Initialize modern notifications system
     */
    function initNotifications() {
        const notificationBtn = document.querySelector('.notification-btn');
        const notificationMenu = document.querySelector('.notification-menu');
        const notificationBadge = document.querySelector('.notification-badge');
        
        if (!notificationBtn || !notificationMenu) return;
        
        // Initialize notification state
        let notifications = [];
        let unreadCount = 0;
        let isOpen = false;
        
        // Fetch notifications on page load
        loadNotifications();
        
        // Set up periodic refresh with exponential backoff
        let refreshInterval = 30000; // Start with 30 seconds
        const maxInterval = 300000; // Max 5 minutes
        
        function scheduleNextRefresh() {
            setTimeout(() => {
                loadNotifications().then(() => {
                    refreshInterval = 30000; // Reset on success
                }).catch(() => {
                    refreshInterval = Math.min(refreshInterval * 1.5, maxInterval); // Exponential backoff
                }).finally(() => {
                    scheduleNextRefresh();
                });
            }, refreshInterval);
        }
        
        scheduleNextRefresh();
        
        // Enhanced notification button click handler
        notificationBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            isOpen = !isOpen;
            
            if (isOpen) {
                openNotificationMenu();
            } else {
                closeNotificationMenu();
            }
        });
        
        // Close menu when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.notification-dropdown') && isOpen) {
                closeNotificationMenu();
            }
        });
        
        // Handle notification item clicks
        notificationMenu.addEventListener('click', function(e) {
            const notificationItem = e.target.closest('.notification-item');
            if (notificationItem) {
                const notificationId = notificationItem.dataset.id;
                if (notificationId) {
                    markNotificationAsRead(notificationId);
                    // Add visual feedback
                    notificationItem.classList.add('read');
                    updateUnreadCount();
                }
            }
        });
        
        // Keyboard navigation for notifications
        notificationMenu.addEventListener('keydown', function(e) {
            const items = this.querySelectorAll('.notification-item');
            let currentIndex = Array.from(items).findIndex(item => item.classList.contains('focused'));
            
            switch(e.key) {
                case 'ArrowDown':
                    e.preventDefault();
                    items.forEach(item => item.classList.remove('focused'));
                    currentIndex = (currentIndex + 1) % items.length;
                    items[currentIndex]?.classList.add('focused');
                    break;
                case 'ArrowUp':
                    e.preventDefault();
                    items.forEach(item => item.classList.remove('focused'));
                    currentIndex = currentIndex <= 0 ? items.length - 1 : currentIndex - 1;
                    items[currentIndex]?.classList.add('focused');
                    break;
                case 'Enter':
                    e.preventDefault();
                    const focusedItem = this.querySelector('.notification-item.focused');
                    if (focusedItem) {
                        focusedItem.click();
                    }
                    break;
                case 'Escape':
                    closeNotificationMenu();
                    break;
            }
        });
        
        function openNotificationMenu() {
            notificationMenu.classList.add('show');
            notificationBtn.classList.add('active');
            notificationBtn.setAttribute('aria-expanded', 'true');
            
            // Focus first notification item
            const firstItem = notificationMenu.querySelector('.notification-item');
            if (firstItem) {
                firstItem.classList.add('focused');
            }
            
            // Mark all as seen (not read, just seen)
            markAllAsSeen();
        }
        
        function closeNotificationMenu() {
            isOpen = false;
            notificationMenu.classList.remove('show');
            notificationBtn.classList.remove('active');
            notificationBtn.setAttribute('aria-expanded', 'false');
            
            // Remove focus from items
            notificationMenu.querySelectorAll('.notification-item').forEach(item => {
                item.classList.remove('focused');
            });
        }
        
        function updateUnreadCount() {
            unreadCount = notifications.filter(n => !n.read).length;
            
            if (notificationBadge) {
                if (unreadCount > 0) {
                    notificationBadge.textContent = unreadCount > 99 ? '99+' : unreadCount;
                    notificationBadge.style.display = 'flex';
                    notificationBadge.classList.add('pulse');
                } else {
                    notificationBadge.style.display = 'none';
                    notificationBadge.classList.remove('pulse');
                }
            }
        }
        
        function markAllAsSeen() {
            notifications.forEach(notification => {
                if (!notification.seen) {
                    notification.seen = true;
                    // Send to backend
                    fetch('/admin/notifications/mark-seen', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                        },
                        body: JSON.stringify({ id: notification.id })
                    }).catch(console.error);
                }
            });
        }
        
        // Expose functions for external use
        window.notificationSystem = {
            addNotification: addNotification,
            removeNotification: removeNotification,
            markAsRead: markNotificationAsRead,
            getUnreadCount: () => unreadCount,
            refresh: loadNotifications
        };
    }
    
    /**
     * Add a new notification to the system
     */
    function addNotification(notification) {
        const notificationMenu = document.querySelector('.notification-menu');
        if (!notificationMenu) return;
        
        // Create notification element
        const notificationElement = createNotificationElement(notification);
        
        // Add to the top of the list
        const firstItem = notificationMenu.querySelector('.notification-item');
        if (firstItem) {
            firstItem.parentNode.insertBefore(notificationElement, firstItem);
        } else {
            const divider = notificationMenu.querySelector('.dropdown-divider');
            if (divider) {
                divider.parentNode.insertBefore(notificationElement, divider.nextSibling);
            }
        }
        
        // Show toast notification
        showToastNotification(notification);
        
        // Update badge
        updateNotificationBadge();
        
        // Animate the new notification
        notificationElement.classList.add('notification-new');
        setTimeout(() => {
            notificationElement.classList.remove('notification-new');
        }, 3000);
    }
    
    /**
     * Remove notification from the system
     */
    function removeNotification(notificationId) {
        const notificationElement = document.querySelector(`[data-id="${notificationId}"]`);
        if (notificationElement) {
            notificationElement.classList.add('notification-removing');
            setTimeout(() => {
                notificationElement.remove();
                updateNotificationBadge();
            }, 300);
        }
    }
    
    /**
     * Create notification element
     */
    function createNotificationElement(notification) {
        const element = document.createElement('div');
        element.className = `notification-item ${notification.read ? 'read' : 'unread'}`;
        element.dataset.id = notification.id;
        
        const timeAgo = getTimeAgo(notification.created_at);
        const iconClass = getNotificationIcon(notification.type);
        
        element.innerHTML = `
            <div class="notification-icon">
                <i class="${iconClass}"></i>
            </div>
            <div class="notification-content">
                <div class="notification-title">${notification.title}</div>
                <div class="notification-message">${notification.message}</div>
                <div class="notification-time">${timeAgo}</div>
            </div>
            ${!notification.read ? '<div class="notification-unread-indicator"></div>' : ''}
        `;
        
        return element;
    }
    
    /**
     * Get notification icon based on type
     */
    function getNotificationIcon(type) {
        const icons = {
            'info': 'fas fa-info-circle',
            'success': 'fas fa-check-circle',
            'warning': 'fas fa-exclamation-triangle',
            'error': 'fas fa-times-circle',
            'user': 'fas fa-user',
            'course': 'fas fa-book',
            'system': 'fas fa-cog',
            'message': 'fas fa-envelope'
        };
        
        return icons[type] || 'fas fa-bell';
    }
    
    /**
     * Show toast notification
     */
    function showToastNotification(notification) {
        const toast = document.createElement('div');
        toast.className = `toast toast-${notification.type || 'info'}`;
        
        toast.innerHTML = `
            <div class="toast-content">
                <i class="${getNotificationIcon(notification.type)}"></i>
                <div class="toast-text">
                    <div class="toast-title">${notification.title}</div>
                    <div class="toast-message">${notification.message}</div>
                </div>
                <button class="toast-close" onclick="this.parentElement.parentElement.remove()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;
        
        document.body.appendChild(toast);
        
        // Show toast
        setTimeout(() => toast.classList.add('show'), 100);
        
        // Auto remove after 5 seconds
        setTimeout(() => {
            toast.classList.remove('show');
            setTimeout(() => toast.remove(), 300);
        }, 5000);
    }
    
    /**
     * Get time ago string
     */
    function getTimeAgo(timestamp) {
        const now = new Date();
        const time = new Date(timestamp);
        const diffInSeconds = Math.floor((now - time) / 1000);
        
        if (diffInSeconds < 60) return 'Just now';
        if (diffInSeconds < 3600) return `${Math.floor(diffInSeconds / 60)}m ago`;
        if (diffInSeconds < 86400) return `${Math.floor(diffInSeconds / 3600)}h ago`;
        if (diffInSeconds < 604800) return `${Math.floor(diffInSeconds / 86400)}d ago`;
        
        return time.toLocaleDateString();
    }
    
    /**
     * Load notifications from backend
     */
    function loadNotifications() {
        fetch('/admin/notifications')
            .then(response => response.json())
            .then(data => {
                updateNotificationUI(data.notifications, data.unread_count);
            })
            .catch(error => {
                console.error('Error loading notifications:', error);
            });
    }
    
    /**
     * Update notification UI
     */
    function updateNotificationUI(notifications, unreadCount) {
        const notificationBadge = document.querySelector('.notification-badge');
        const notificationMenu = document.querySelector('.notification-menu');
        
        // Update badge
        if (notificationBadge) {
            if (unreadCount > 0) {
                notificationBadge.textContent = unreadCount > 99 ? '99+' : unreadCount;
                notificationBadge.style.display = 'flex';
            } else {
                notificationBadge.style.display = 'none';
            }
        }
        
        // Update notification menu content
        if (notificationMenu && notifications) {
            const header = notificationMenu.querySelector('.dropdown-header h6');
            if (header) {
                header.textContent = `Notifications (${unreadCount})`;
            }
            
            // Remove existing notification items (keep header and footer)
            const existingItems = notificationMenu.querySelectorAll('.notification-item');
            existingItems.forEach(item => item.remove());
            
            // Add new notifications
            const divider = notificationMenu.querySelector('.dropdown-divider');
            if (notifications.length > 0) {
                notifications.forEach(notification => {
                    const notificationItem = createNotificationItem(notification);
                    notificationMenu.insertBefore(notificationItem, divider.nextSibling);
                });
            } else {
                const emptyItem = document.createElement('div');
                emptyItem.className = 'dropdown-item text-center text-muted notification-item';
                emptyItem.innerHTML = '<i class="fas fa-bell-slash mr-2"></i>No new notifications';
                notificationMenu.insertBefore(emptyItem, divider.nextSibling);
            }
        }
    }
    
    /**
     * Create notification item element
     */
    function createNotificationItem(notification) {
        const item = document.createElement('a');
        item.href = notification.url || '#';
        item.className = 'dropdown-item modern-dropdown-item notification-item';
        item.innerHTML = `
            <div class="d-flex align-items-start">
                <i class="${notification.icon} mr-3 mt-1" style="color: #6c757d;"></i>
                <div class="flex-grow-1">
                    <div class="font-weight-bold" style="font-size: 13px;">${notification.title}</div>
                    <div class="text-muted" style="font-size: 12px;">${notification.message}</div>
                    <div class="text-muted" style="font-size: 11px;">${notification.time}</div>
                </div>
            </div>
        `;
        
        // Add click handler to mark as read
        item.addEventListener('click', function() {
            markNotificationAsRead(notification.id);
        });
        
        return item;
    }
    
    /**
     * Mark notification as read
     */
    function markNotificationAsRead(notificationId) {
        fetch('/admin/notifications/mark-read', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
            },
            body: JSON.stringify({
                notification_id: notificationId
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Refresh notifications
                setTimeout(loadNotifications, 500);
            }
        })
        .catch(error => {
            console.error('Error marking notification as read:', error);
        });
    }
    
    /**
     * Initialize modern profile dropdown
     */
    function initProfileDropdown() {
        const profileBtn = document.querySelector('.user-profile-btn');
        const profileMenu = document.querySelector('.user-dropdown .dropdown-menu');
        const userDropdown = document.querySelector('.user-dropdown');
        
        if (!profileBtn || !profileMenu) return;
        
        let isOpen = false;
        let profileData = null;
        
        // Load user profile data
        loadProfileData();
        
        // Enhanced profile button click handler
        profileBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            isOpen = !isOpen;
            
            if (isOpen) {
                openProfileMenu();
            } else {
                closeProfileMenu();
            }
        });
        
        // Close menu when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.user-dropdown') && isOpen) {
                closeProfileMenu();
            }
        });
        
        // Keyboard navigation for profile menu
        profileMenu.addEventListener('keydown', function(e) {
            const items = this.querySelectorAll('.dropdown-item:not(.dropdown-header)');
            let currentIndex = Array.from(items).findIndex(item => item.classList.contains('focused'));
            
            switch(e.key) {
                case 'ArrowDown':
                    e.preventDefault();
                    items.forEach(item => item.classList.remove('focused'));
                    currentIndex = (currentIndex + 1) % items.length;
                    items[currentIndex]?.classList.add('focused');
                    break;
                case 'ArrowUp':
                    e.preventDefault();
                    items.forEach(item => item.classList.remove('focused'));
                    currentIndex = currentIndex <= 0 ? items.length - 1 : currentIndex - 1;
                    items[currentIndex]?.classList.add('focused');
                    break;
                case 'Enter':
                    e.preventDefault();
                    const focusedItem = this.querySelector('.dropdown-item.focused');
                    if (focusedItem && focusedItem.href) {
                        window.location.href = focusedItem.href;
                    } else if (focusedItem && focusedItem.onclick) {
                        focusedItem.click();
                    }
                    break;
                case 'Escape':
                    closeProfileMenu();
                    break;
            }
        });
        
        // Add hover effects for menu items
        profileMenu.addEventListener('mouseenter', function(e) {
            if (e.target.classList.contains('dropdown-item')) {
                // Remove focus from other items
                profileMenu.querySelectorAll('.dropdown-item').forEach(item => {
                    item.classList.remove('focused');
                });
                e.target.classList.add('focused');
            }
        }, true);
        
        // Profile shortcuts (Alt + P)
        document.addEventListener('keydown', function(e) {
            if (e.altKey && e.key === 'p') {
                e.preventDefault();
                if (isOpen) {
                    closeProfileMenu();
                } else {
                    openProfileMenu();
                }
            }
        });
        
        function openProfileMenu() {
            profileMenu.classList.add('show');
            profileBtn.classList.add('active');
            profileBtn.setAttribute('aria-expanded', 'true');
            
            // Focus first menu item
            const firstItem = profileMenu.querySelector('.dropdown-item:not(.dropdown-header)');
            if (firstItem) {
                firstItem.classList.add('focused');
            }
            
            // Update profile data if needed
            if (shouldRefreshProfile()) {
                loadProfileData();
            }
        }
        
        function closeProfileMenu() {
            isOpen = false;
            profileMenu.classList.remove('show');
            profileBtn.classList.remove('active');
            profileBtn.setAttribute('aria-expanded', 'false');
            
            // Remove focus from items
            profileMenu.querySelectorAll('.dropdown-item').forEach(item => {
                item.classList.remove('focused');
            });
        }
        
        function loadProfileData() {
            // Simulate loading profile data
            const userData = {
                name: profileBtn.querySelector('.user-name')?.textContent || 'Admin User',
                email: 'admin@example.com',
                role: 'Administrator',
                lastLogin: new Date().toISOString(),
                avatar: profileBtn.querySelector('.user-avatar img')?.src || null
            };
            
            profileData = userData;
            updateProfileDisplay(userData);
            
            // Store last refresh time
            localStorage.setItem('profileLastRefresh', Date.now().toString());
        }
        
        function shouldRefreshProfile() {
            const lastRefresh = localStorage.getItem('profileLastRefresh');
            if (!lastRefresh) return true;
            
            const timeDiff = Date.now() - parseInt(lastRefresh);
            return timeDiff > 300000; // 5 minutes
        }
        
        function updateProfileDisplay(userData) {
            // Update profile header in dropdown
            const profileHeader = profileMenu.querySelector('.dropdown-header');
            if (profileHeader) {
                const nameElement = profileHeader.querySelector('h6');
                const emailElement = profileHeader.querySelector('p');
                
                if (nameElement) nameElement.textContent = userData.name;
                if (emailElement) emailElement.textContent = userData.email;
            }
            
            // Add status indicator
            addOnlineStatus();
        }
        
        function addOnlineStatus() {
            const statusIndicator = document.createElement('div');
            statusIndicator.className = 'user-status-indicator online';
            statusIndicator.title = 'Online';
            
            const userAvatar = profileBtn.querySelector('.user-avatar');
            if (userAvatar && !userAvatar.querySelector('.user-status-indicator')) {
                userAvatar.appendChild(statusIndicator);
            }
        }
        
        // Add profile activity tracking
        function trackProfileActivity(action) {
            const activity = {
                action: action,
                timestamp: Date.now(),
                userAgent: navigator.userAgent,
                url: window.location.href
            };
            
            // Store in localStorage for analytics
            const activities = JSON.parse(localStorage.getItem('profileActivities') || '[]');
            activities.push(activity);
            
            // Keep only last 50 activities
            if (activities.length > 50) {
                activities.splice(0, activities.length - 50);
            }
            
            localStorage.setItem('profileActivities', JSON.stringify(activities));
        }
        
        // Track profile menu interactions
        profileMenu.addEventListener('click', function(e) {
            const item = e.target.closest('.dropdown-item');
            if (item) {
                const action = item.textContent.trim();
                trackProfileActivity(`clicked_${action.toLowerCase().replace(/\s+/g, '_')}`);
            }
        });
        
        // Expose profile functions
        window.profileSystem = {
            refresh: loadProfileData,
            getData: () => profileData,
            isOpen: () => isOpen,
            toggle: () => isOpen ? closeProfileMenu() : openProfileMenu()
        };
    }
    
    // Initialize all modern features when DOM is ready
    document.addEventListener('DOMContentLoaded', function() {
        initModernSearch();
        initNotifications();
        initProfileDropdown();
    });
    
})();

/**
 * Additional CSS for toast notifications
 */
const toastStyles = `
.toast {
    position: fixed;
    top: 20px;
    right: 20px;
    background: white;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    padding: 16px 20px;
    transform: translateX(100%);
    transition: transform 0.3s ease;
    z-index: 9999;
    min-width: 300px;
}

.toast.show {
    transform: translateX(0);
}

.toast-content {
    display: flex;
    align-items: center;
    gap: 12px;
}

.toast-success {
    border-left: 4px solid #10b981;
}

.toast-error {
    border-left: 4px solid #ef4444;
}

.toast-info {
    border-left: 4px solid #3b82f6;
}

.toast-success i {
    color: #10b981;
}

.toast-error i {
    color: #ef4444;
}

.toast-info i {
    color: #3b82f6;
}

.form-group-focused .form-control {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
}

@media (max-width: 768px) {
    .sidebar-show .main-sidebar {
        transform: translateX(0);
    }
    
    .main-sidebar {
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        z-index: 1000;
        transform: translateX(-100%);
        transition: transform 0.3s ease;
    }
    
    .sidebar-show::before {
        content: '';
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        z-index: 999;
    }
}
`;

// Inject toast styles
const styleSheet = document.createElement('style');
styleSheet.textContent = toastStyles;
document.head.appendChild(styleSheet);