// Modern Learning Player JavaScript
document.addEventListener('DOMContentLoaded', function() {
    // Initialize learning player
    initializeLearningPlayer();
});

function initializeLearningPlayer() {
    // Sidebar functionality
    initializeSidebar();
    
    // Tab functionality
    initializeTabs();
    
    // Chapter accordion
    initializeChapterAccordion();
    
    // Video controls
    initializeVideoControls();
    
    // Q&A functionality
    initializeQnA();
    
    // Progress tracking
    initializeProgressTracking();
    
    // Integrate with existing video loading system
    integrateVideoSystem();
}

// Integration with existing video loading system
function integrateVideoSystem() {
    // Create a compatibility layer for the existing video system
    // The original system looks for .video-payer, so we need to bridge this
    const videoPlayer = document.querySelector('.video-player');
    if (videoPlayer) {
        // Add the class that the original system expects
        videoPlayer.classList.add('video-payer');
    }
    
    // Handle lesson item clicks to work with new design
    const lessonItems = document.querySelectorAll('.lesson-item');
    lessonItems.forEach(item => {
        item.addEventListener('click', function(e) {
            // Prevent default if clicking on checkbox
            if (e.target.type === 'checkbox') {
                return;
            }
            
            // Remove active class from all items
            lessonItems.forEach(li => li.classList.remove('active'));
            // Add active class to clicked item
            this.classList.add('active');
            
            // Hide sidebar on mobile
            hideSidebar();
            
            // Get lesson data from the lesson-link element
            const lessonLink = this.querySelector('.lesson-link');
            if (lessonLink) {
                const lessonId = lessonLink.getAttribute('data-lesson-id');
                const chapterId = lessonLink.getAttribute('data-chapter-id');
                const courseId = lessonLink.getAttribute('data-course-id');
                const type = lessonLink.getAttribute('data-type');
                
                // Copy data attributes to the lesson-item for jQuery compatibility
                this.setAttribute('data-lesson-id', lessonId);
                this.setAttribute('data-chapter-id', chapterId);
                this.setAttribute('data-course-id', courseId);
                this.setAttribute('data-type', type);
                
                // Trigger the original jQuery click handler
                if (window.jQuery) {
                    window.jQuery(this).trigger('click');
                }
            }
        });
    });
}

// Sidebar Management
function initializeSidebar() {
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('courseSidebar');
    const sidebarClose = document.getElementById('sidebarClose');
    const sidebarOverlay = document.getElementById('sidebarOverlay');
    
    if (sidebarToggle && sidebar) {
        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.add('show');
            sidebarOverlay.classList.add('show');
            document.body.style.overflow = 'hidden';
        });
    }
    
    function closeSidebar() {
        if (sidebar) {
            sidebar.classList.remove('show');
            sidebarOverlay.classList.remove('show');
            document.body.style.overflow = '';
        }
    }
    
    if (sidebarClose) {
        sidebarClose.addEventListener('click', closeSidebar);
    }
    
    if (sidebarOverlay) {
        sidebarOverlay.addEventListener('click', closeSidebar);
    }
    
    // Close sidebar on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeSidebar();
        }
    });
}

// Tab Management
function initializeTabs() {
    const tabButtons = document.querySelectorAll('.tab-button');
    const tabPanels = document.querySelectorAll('.tab-panel');
    
    tabButtons.forEach(button => {
        button.addEventListener('click', function() {
            const targetTab = this.getAttribute('data-tab');
            
            // Remove active class from all buttons and panels
            tabButtons.forEach(btn => btn.classList.remove('active'));
            tabPanels.forEach(panel => panel.classList.remove('active'));
            
            // Add active class to clicked button and corresponding panel
            this.classList.add('active');
            const targetPanel = document.getElementById(targetTab);
            if (targetPanel) {
                targetPanel.classList.add('active');
            }
        });
    });
}

// Chapter Accordion
function initializeChapterAccordion() {
    const chapterHeaders = document.querySelectorAll('.chapter-header');
    
    chapterHeaders.forEach(header => {
        header.addEventListener('click', function() {
            const chapterId = this.getAttribute('data-chapter');
            const chapterContent = document.getElementById(`chapter-${chapterId}`);
            const chapterItem = this.closest('.chapter-item');
            
            if (chapterContent) {
                const isExpanded = chapterContent.classList.contains('show');
                
                if (isExpanded) {
                    chapterContent.classList.remove('show');
                    chapterItem.classList.remove('expanded');
                } else {
                    chapterContent.classList.add('show');
                    chapterItem.classList.add('expanded');
                }
            }
        });
    });
}

// Video Controls
function initializeVideoControls() {
    const prevButton = document.querySelector('.prev-lesson');
    const nextButton = document.querySelector('.next-lesson');
    const speedButton = document.querySelector('.playback-speed');
    const fullscreenButton = document.querySelector('.fullscreen');
    
    if (prevButton) {
        prevButton.addEventListener('click', function() {
            // Navigate to previous lesson
            navigateToLesson('prev');
        });
    }
    
    if (nextButton) {
        nextButton.addEventListener('click', function() {
            // Navigate to next lesson
            navigateToLesson('next');
        });
    }
    
    if (speedButton) {
        speedButton.addEventListener('click', function() {
            // Toggle playback speed
            togglePlaybackSpeed();
        });
    }
    
    if (fullscreenButton) {
        fullscreenButton.addEventListener('click', function() {
            // Toggle fullscreen
            toggleFullscreen();
        });
    }
}

// Q&A Functionality
function initializeQnA() {
    const askQuestionBtn = document.querySelector('.ask-question-btn');
    const submitQuestionBtn = document.getElementById('submitQuestion');
    const searchInput = document.querySelector('.search-input');
    const filterSelect = document.querySelector('.filter-select');
    const loadMoreBtn = document.querySelector('.load-more-btn');
    
    if (submitQuestionBtn) {
        submitQuestionBtn.addEventListener('click', function() {
            submitQuestion();
        });
    }
    
    if (searchInput) {
        let searchTimeout;
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                searchQuestions(this.value);
            }, 300);
        });
    }
    
    if (filterSelect) {
        filterSelect.addEventListener('change', function() {
            filterQuestions(this.value);
        });
    }
    
    if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', function() {
            loadMoreQuestions();
        });
    }
}

// Progress Tracking
function initializeProgressTracking() {
    const lessonCheckboxes = document.querySelectorAll('.lesson-completed-checkbox');
    
    lessonCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const lessonId = this.getAttribute('data-lesson-id');
            const type = this.getAttribute('data-type');
            const isCompleted = this.checked;
            
            updateLessonProgress(lessonId, type, isCompleted);
        });
    });
}

// Helper Functions
function navigateToLesson(direction) {
    const currentLessonItem = document.querySelector('.lesson-item.active');
    if (!currentLessonItem) return;
    
    const allLessonItems = document.querySelectorAll('.lesson-item');
    const currentIndex = Array.from(allLessonItems).indexOf(currentLessonItem);
    
    let targetIndex;
    if (direction === 'prev') {
        targetIndex = currentIndex - 1;
    } else {
        targetIndex = currentIndex + 1;
    }
    
    if (targetIndex >= 0 && targetIndex < allLessonItems.length) {
        const targetLesson = allLessonItems[targetIndex];
        const lessonLink = targetLesson.querySelector('.lesson-link');
        if (lessonLink && lessonLink.href) {
            window.location.href = lessonLink.href;
        }
    }
}

function togglePlaybackSpeed() {
    const speedButton = document.querySelector('.playback-speed span');
    if (!speedButton) return;
    
    const speeds = ['1x', '1.25x', '1.5x', '2x'];
    const currentSpeed = speedButton.textContent;
    const currentIndex = speeds.indexOf(currentSpeed);
    const nextIndex = (currentIndex + 1) % speeds.length;
    
    speedButton.textContent = speeds[nextIndex];
    
    // Apply speed to video player if available
    const video = document.querySelector('video');
    if (video) {
        video.playbackRate = parseFloat(speeds[nextIndex]);
    }
}

function toggleFullscreen() {
    const videoContainer = document.querySelector('.video-player-container');
    if (!videoContainer) return;
    
    if (!document.fullscreenElement) {
        videoContainer.requestFullscreen().catch(err => {
            console.log('Error attempting to enable fullscreen:', err);
        });
    } else {
        document.exitFullscreen();
    }
}

function submitQuestion() {
    const form = document.getElementById('askQuestionForm');
    const formData = new FormData(form);
    
    // Add CSRF token
    const csrfToken = document.querySelector('meta[name="csrf-token"]');
    if (csrfToken) {
        formData.append('_token', csrfToken.getAttribute('content'));
    }
    
    // Submit question via AJAX
    fetch('/learning/questions', {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Close modal and refresh questions
            const modal = bootstrap.Modal.getInstance(document.getElementById('askQuestionModal'));
            modal.hide();
            form.reset();
            loadQuestions();
            
            // Show success message
            showToast('Question submitted successfully!', 'success');
        } else {
            showToast('Error submitting question. Please try again.', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('Error submitting question. Please try again.', 'error');
    });
}

function searchQuestions(query) {
    // Implement question search
    console.log('Searching questions:', query);
}

function filterQuestions(filter) {
    // Implement question filtering
    console.log('Filtering questions:', filter);
}

function loadMoreQuestions() {
    // Implement load more functionality
    console.log('Loading more questions...');
}

function updateLessonProgress(lessonId, type, isCompleted) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]');
    
    fetch('/learning/progress', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken ? csrfToken.getAttribute('content') : '',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify({
            lesson_id: lessonId,
            type: type,
            completed: isCompleted
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update progress indicators
            updateProgressIndicators(data.progress);
        }
    })
    .catch(error => {
        console.error('Error updating progress:', error);
    });
}

function updateProgressIndicators(progress) {
    // Update header progress
    const progressText = document.querySelector('.progress-text');
    const progressFill = document.querySelector('.progress-bar-fill');
    
    if (progressText) {
        progressText.textContent = `${progress.percentage}% Complete`;
    }
    
    if (progressFill) {
        progressFill.style.width = `${progress.percentage}%`;
    }
    
    // Update sidebar progress
    const sidebarProgress = document.querySelector('.progress-percentage');
    const progressRing = document.querySelector('.progress-ring-circle');
    
    if (sidebarProgress) {
        sidebarProgress.textContent = `${progress.percentage}%`;
    }
    
    if (progressRing) {
        const circumference = 2 * Math.PI * 26;
        const offset = circumference * (1 - progress.percentage / 100);
        progressRing.style.strokeDashoffset = offset;
    }
    
    // Update lessons completed count
    const lessonsCompleted = document.querySelector('.lessons-completed');
    if (lessonsCompleted) {
        lessonsCompleted.textContent = `${progress.completed} / ${progress.total} lessons completed`;
    }
}

function loadQuestions() {
    // Load questions for current lesson
    const loadingState = document.querySelector('.loading-state');
    const questionsList = document.querySelector('.questions-list');
    
    if (loadingState) {
        loadingState.style.display = 'block';
    }
    
    // Simulate loading questions
    setTimeout(() => {
        if (loadingState) {
            loadingState.style.display = 'none';
        }
        
        // Show empty state if no questions
        const emptyState = document.querySelector('.empty-state');
        if (emptyState) {
            emptyState.style.display = 'block';
        }
    }, 1000);
}

function showToast(message, type = 'info') {
    // Use existing toastr if available, otherwise create simple toast
    if (typeof toastr !== 'undefined') {
        toastr[type](message);
    } else {
        console.log(`${type.toUpperCase()}: ${message}`);
    }
}

// Auto-expand current chapter
document.addEventListener('DOMContentLoaded', function() {
    const activeLesson = document.querySelector('.lesson-item.active');
    if (activeLesson) {
        const chapterContent = activeLesson.closest('.chapter-content');
        const chapterItem = activeLesson.closest('.chapter-item');
        
        if (chapterContent && chapterItem) {
            chapterContent.classList.add('show');
            chapterItem.classList.add('expanded');
        }
    }
});

// Keyboard shortcuts
document.addEventListener('keydown', function(e) {
    // Space bar to play/pause video
    if (e.code === 'Space' && e.target.tagName !== 'INPUT' && e.target.tagName !== 'TEXTAREA') {
        e.preventDefault();
        const video = document.querySelector('video');
        if (video) {
            if (video.paused) {
                video.play();
            } else {
                video.pause();
            }
        }
    }
    
    // Arrow keys for navigation
    if (e.code === 'ArrowLeft' && e.ctrlKey) {
        e.preventDefault();
        navigateToLesson('prev');
    }
    
    if (e.code === 'ArrowRight' && e.ctrlKey) {
        e.preventDefault();
        navigateToLesson('next');
    }
    
    // F key for fullscreen
    if (e.code === 'KeyF' && !e.ctrlKey && !e.altKey && !e.metaKey) {
        e.preventDefault();
        toggleFullscreen();
    }
});