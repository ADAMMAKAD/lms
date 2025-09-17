<div class="qna-content">
    <div class="qna-header">
        <h3>{{ __('Questions & Answers') }}</h3>
        <button type="button" class="btn btn-primary ask-question-btn" data-bs-toggle="modal" data-bs-target="#askQuestionModal">
            <i class="fas fa-plus"></i>
            {{ __('Ask a Question') }}
        </button>
    </div>

    <div class="qna-filters">
        <div class="search-box">
            <input type="text" placeholder="{{ __('Search questions...') }}" class="search-input">
            <button type="button" class="search-btn">
                <i class="fas fa-search"></i>
            </button>
        </div>
        <div class="filter-dropdown">
            <select class="filter-select">
                <option value="current_lecture">{{ __('Current lecture') }}</option>
                <option value="all_lectures">{{ __('All lectures') }}</option>
            </select>
        </div>
    </div>

    <div class="questions-list">
        <div class="loading-state text-center">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">{{ __('Loading') }}...</span>
            </div>
        </div>
        
        <div class="empty-state" style="display: none;">
            <i class="fas fa-question-circle"></i>
            <h4>{{ __('No questions yet') }}</h4>
            <p>{{ __('Be the first to ask a question about this lesson.') }}</p>
        </div>
    </div>

    <div class="load-more-section text-center">
        <button type="button" class="btn btn-outline-primary load-more-btn">
            {{ __('Load More Questions') }}
        </button>
    </div>
</div>

<!-- Ask Question Modal -->
<div class="modal fade" id="askQuestionModal" tabindex="-1" aria-labelledby="askQuestionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="askQuestionModalLabel">{{ __('Ask a Question') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="askQuestionForm">
                    @csrf
                    <div class="mb-3">
                        <label for="questionTitle" class="form-label">{{ __('Question Title') }}</label>
                        <input type="text" class="form-control" id="questionTitle" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="questionContent" class="form-label">{{ __('Question Details') }}</label>
                        <textarea class="form-control" id="questionContent" name="content" rows="5" required></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                <button type="button" class="btn btn-primary" id="submitQuestion">{{ __('Submit Question') }}</button>
            </div>
        </div>
    </div>
</div>