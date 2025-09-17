@extends('admin.master_layout')
@section('title')
    <title>{{ __('Assign Course') }}</title>
@endsection
@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Assign Course') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('admin.course-assignments.index') }}">{{ __('Course Assignments') }}</a></div>
                    <div class="breadcrumb-item">{{ __('Assign Course') }}</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ __('Assign Course to Student') }}</h4>
                            </div>
                            <div class="card-body">
                                <form id="assignment-form" action="{{ route('admin.course-assignments.store') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="user_id">{{ __('Select Student') }} <span class="text-danger">*</span></label>
                                                <select class="form-control select2" id="user_id" name="user_id" required>
                                                    <option value="">{{ __('Choose a student...') }}</option>
                                                    @foreach($students as $student)
                                                        <option value="{{ $student->id }}" data-email="{{ $student->email }}">
                                                            {{ $student->name }} ({{ $student->email }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="course_id">{{ __('Select Course') }} <span class="text-danger">*</span></label>
                                                <select class="form-control select2" id="course_id" name="course_id" required>
                                                    <option value="">{{ __('Choose a course...') }}</option>
                                                    @foreach($courses as $course)
                                                        <option value="{{ $course->id }}">
                                                            {{ $course->title }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="notes">{{ __('Notes (Optional)') }}</label>
                                                <textarea class="form-control" id="notes" name="notes" rows="3" 
                                                          placeholder="{{ __('Add any notes about this assignment...') }}"></textarea>
                                                <small class="form-text text-muted">{{ __('Maximum 500 characters') }}</small>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Student's Current Assignments -->
                                    <div id="student-assignments" class="mt-4" style="display: none;">
                                        <h5>{{ __("Student's Current Assignments") }}</h5>
                                        <div class="table-responsive">
                                            <table class="table table-sm table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>{{ __('Course') }}</th>
                                                        <th>{{ __('Status') }}</th>
                                                        <th>{{ __('Assigned Date') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="assignments-list">
                                                    <!-- Dynamic content -->
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group mt-4">
                                        <button type="submit" class="btn btn-primary" id="submit-btn">
                                            <i class="fas fa-save"></i> {{ __('Assign Course') }}
                                        </button>
                                        <a href="{{ route('admin.course-assignments.index') }}" class="btn btn-secondary">
                                            <i class="fas fa-arrow-left"></i> {{ __('Back to List') }}
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('backend/css/select2.min.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('backend/js/select2.min.js') }}"></script>
<script>
    $(document).ready(function() {
        console.log('Course Assignment Create Page - JavaScript Loaded');
        
        // Configure toastr for better notifications
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
        
        // Initialize Select2
        $('.select2').select2({
            placeholder: function() {
                return $(this).data('placeholder');
            },
            allowClear: true
        });
        
        console.log('Select2 initialized for', $('.select2').length, 'elements');
        
        // Test toastr notification system
        setTimeout(function() {
            toastr.info('Course Assignment page loaded successfully!', 'System Ready');
        }, 1000);
        
        // Load student assignments when student is selected
        $('#user_id').change(function() {
            const studentId = $(this).val();
            console.log('Student selected:', studentId);
            if (studentId) {
                loadStudentAssignments(studentId);
            } else {
                $('#student-assignments').hide();
            }
        });
        
        // Handle form submission
        $('#assignment-form').submit(function(e) {
            e.preventDefault();
            console.log('Form submission started');
            
            const form = $(this);
            const formData = new FormData(form[0]);
            
            // Log form data
            console.log('Form data:');
            for (let [key, value] of formData.entries()) {
                console.log(key, value);
            }
            
            // Show loading state
            const submitBtn = $('#submit-btn');
            submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Creating Assignment...');
            
            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function() {
                    console.log('Form submission AJAX started');
                },
                success: function(response) {
                    console.log('Form submission successful:', response);
                    if (response.status === 'success') {
                        toastr.success(response.message, 'Success!', {
                            timeOut: 3000,
                            onHidden: function() {
                                if (response.redirect) {
                                    window.location.href = response.redirect;
                                } else {
                                    window.location.href = '{{ route("admin.course-assignments.index") }}';
                                }
                            }
                        });
                    } else {
                        toastr.error(response.message || 'An error occurred while creating the assignment.', 'Error!');
                        submitBtn.prop('disabled', false).html('<i class="fas fa-save"></i> {{ __("Assign Course") }}');
                    }
                },
                error: function(xhr) {
                    console.error('Form submission error:');
                    console.error('Status:', xhr.status);
                    console.error('Response:', xhr.responseText);
                    
                    submitBtn.prop('disabled', false).html('<i class="fas fa-save"></i> {{ __("Assign Course") }}');
                    
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        Object.keys(errors).forEach(function(key) {
                            toastr.error(errors[key][0], 'Validation Error!');
                        });
                    } else if (xhr.status === 500) {
                        toastr.error('Server error occurred. Please try again later.', 'Server Error!');
                    } else if (xhr.status === 419) {
                        toastr.error('Session expired. Please refresh the page and try again.', 'Session Expired!');
                    } else {
                        toastr.error('An unexpected error occurred while creating the assignment.', 'Error!');
                    }
                }
            });
        });
    });
    
    function loadStudentAssignments(studentId) {
        console.log('Loading assignments for student ID:', studentId);
        $.ajax({
            url: '{{ url("admin/course-assignments/student") }}/' + studentId,
            method: 'GET',
            beforeSend: function() {
                console.log('AJAX request started');
                const tbody = $('#assignments-list');
                tbody.empty();
                tbody.append(`
                    <tr>
                        <td colspan="3" class="text-center">Loading assignments...</td>
                    </tr>
                `);
                $('#student-assignments').show();
            },
            success: function(assignments) {
                console.log('Assignments loaded successfully:', assignments);
                const tbody = $('#assignments-list');
                tbody.empty();
                
                if (assignments.length > 0) {
                    $.each(assignments, function(index, assignment) {
                        const statusBadge = getStatusBadge(assignment.status);
                        const assignedDate = new Date(assignment.assigned_at).toLocaleDateString();
                        
                        tbody.append(`
                            <tr>
                                <td>${assignment.course.title}</td>
                                <td>${statusBadge}</td>
                                <td>${assignedDate}</td>
                            </tr>
                        `);
                    });
                    $('#student-assignments').show();
                } else {
                    tbody.append(`
                        <tr>
                            <td colspan="3" class="text-center text-muted">{{ __('No assignments found for this student') }}</td>
                        </tr>
                    `);
                    $('#student-assignments').show();
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error Details:');
                console.error('Status:', status);
                console.error('Error:', error);
                console.error('Response:', xhr.responseText);
                console.error('Status Code:', xhr.status);
                const tbody = $('#assignments-list');
                tbody.empty();
                tbody.append(`
                    <tr>
                        <td colspan="3" class="text-center text-danger">Error loading assignments. Check console for details.</td>
                    </tr>
                `);
                $('#student-assignments').show();
                toastr.error('Failed to load student assignments. Please try again.', 'Loading Error!');
            }
        });
    }
    
    function getStatusBadge(status) {
        const badges = {
            'assigned': '<span class="badge badge-info">Assigned</span>',
            'in_progress': '<span class="badge badge-warning">In Progress</span>',
            'completed': '<span class="badge badge-success">Completed</span>',
            'revoked': '<span class="badge badge-danger">Revoked</span>'
        };
        return badges[status] || '<span class="badge badge-secondary">' + status + '</span>';
    }
</script>
@endpush