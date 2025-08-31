@extends('frontend.layouts.master')

@section('meta_title', 'Start New Chat')

@section('contents')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow">
                <div class="card-header">
                    <h4 class="mb-0">
                        <i class="fas fa-comments me-2"></i>Start New Chat
                    </h4>
                    <p class="text-muted mb-0 mt-2">Get in touch with our support team</p>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('chat.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        @guest
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Your Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name" 
                                           value="{{ old('name') }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Your Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="email" name="email" 
                                           value="{{ old('email') }}" required>
                                </div>
                            </div>
                        @endguest

                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="subject" name="subject" 
                                   value="{{ old('subject') }}" placeholder="Brief description of your inquiry" required>
                        </div>

                        <div class="mb-3">
                            <label for="priority" class="form-label">Priority</label>
                            <select class="form-select" id="priority" name="priority">
                                <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low</option>
                                <option value="medium" {{ old('priority', 'medium') == 'medium' ? 'selected' : '' }}>Medium</option>
                                <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High</option>
                                <option value="urgent" {{ old('priority') == 'urgent' ? 'selected' : '' }}>Urgent</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="message" class="form-label">Message <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="message" name="message" rows="5" 
                                      placeholder="Please describe your question or issue in detail..." required>{{ old('message') }}</textarea>
                            <div class="form-text">Maximum 1000 characters</div>
                        </div>

                        <div class="mb-3">
                            <label for="attachment" class="form-label">Attachment (Optional)</label>
                            <input type="file" class="form-control" id="attachment" name="attachment" 
                                   accept=".jpg,.jpeg,.png,.gif,.pdf,.doc,.docx">
                            <div class="form-text">Supported formats: JPG, PNG, GIF, PDF, DOC, DOCX. Max size: 5MB</div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('chat.index') }}" class="btn btn-secondary me-md-2">
                                <i class="fas fa-arrow-left me-1"></i>Back to Chats
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane me-1"></i>Send Message
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Help Section -->
            <div class="card mt-4">
                <div class="card-body">
                    <h6 class="card-title">
                        <i class="fas fa-info-circle me-2 text-info"></i>Before you start...
                    </h6>
                    <ul class="mb-0 small text-muted">
                        <li>Please provide as much detail as possible about your question or issue</li>
                        <li>Include any relevant screenshots or documents that might help</li>
                        <li>Our support team typically responds within 24 hours</li>
                        <li>You'll receive email notifications when we reply to your chat</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Character counter for message textarea
document.getElementById('message').addEventListener('input', function() {
    const maxLength = 1000;
    const currentLength = this.value.length;
    const remaining = maxLength - currentLength;
    
    let helpText = this.nextElementSibling;
    if (remaining < 100) {
        helpText.textContent = `${remaining} characters remaining`;
        helpText.className = remaining < 0 ? 'form-text text-danger' : 'form-text text-warning';
    } else {
        helpText.textContent = 'Maximum 1000 characters';
        helpText.className = 'form-text';
    }
});

// File size validation
document.getElementById('attachment').addEventListener('change', function() {
    const file = this.files[0];
    if (file) {
        const maxSize = 5 * 1024 * 1024; // 5MB in bytes
        if (file.size > maxSize) {
            alert('File size must be less than 5MB');
            this.value = '';
        }
    }
});
</script>
@endpush