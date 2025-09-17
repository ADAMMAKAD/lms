@extends('admin.master_layout')
@section('title')
    <title>{{ __('Course Assignments') }}</title>
@endsection
@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Course Assignments') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
                    <div class="breadcrumb-item">{{ __('Course Assignments') }}</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ __('Manage Course Assignments') }}</h4>
                                <div class="card-header-action">
                                    <a href="{{ route('admin.course-assignments.create') }}" class="btn btn-primary">
                                        <i class="fas fa-plus"></i> {{ __('Assign Course') }}
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- Filters -->
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <select class="form-control" id="student-filter">
                                            <option value="">{{ __('All Students') }}</option>
                                            @foreach($students as $student)
                                                <option value="{{ $student->id }}" {{ request('student_id') == $student->id ? 'selected' : '' }}>
                                                    {{ $student->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <select class="form-control" id="course-filter">
                                            <option value="">{{ __('All Courses') }}</option>
                                            @foreach($courses as $course)
                                                <option value="{{ $course->id }}" {{ request('course_id') == $course->id ? 'selected' : '' }}>
                                                    {{ $course->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <select class="form-control" id="status-filter">
                                            <option value="">{{ __('All Status') }}</option>
                                            <option value="assigned" {{ request('status') == 'assigned' ? 'selected' : '' }}>{{ __('Assigned') }}</option>
                                            <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>{{ __('In Progress') }}</option>
                                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>{{ __('Completed') }}</option>
                                            <option value="revoked" {{ request('status') == 'revoked' ? 'selected' : '' }}>{{ __('Revoked') }}</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <button class="btn btn-primary" id="apply-filters">{{ __('Apply Filters') }}</button>
                                        <a href="{{ route('admin.course-assignments.index') }}" class="btn btn-secondary">{{ __('Clear') }}</a>
                                    </div>
                                </div>

                                <!-- Assignments Table -->
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>{{ __('Student') }}</th>
                                                <th>{{ __('Course') }}</th>
                                                <th>{{ __('Status') }}</th>
                                                <th>{{ __('Assigned By') }}</th>
                                                <th>{{ __('Assigned Date') }}</th>
                                                <th>{{ __('Completed Date') }}</th>
                                                <th>{{ __('Actions') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($assignments as $assignment)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <img src="{{ $assignment->user->image ? asset($assignment->user->image) : asset('backend/images/avatar-1.png') }}" 
                                                                 class="rounded-circle mr-2" width="40" height="40">
                                                            <div>
                                                                <strong>{{ $assignment->user->name }}</strong><br>
                                                                <small class="text-muted">{{ $assignment->user->email }}</small>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <strong>{{ $assignment->course->title }}</strong>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-{{ $assignment->status == 'completed' ? 'success' : ($assignment->status == 'in_progress' ? 'warning' : ($assignment->status == 'revoked' ? 'danger' : 'info')) }}">
                                                            {{ ucfirst(str_replace('_', ' ', $assignment->status)) }}
                                                        </span>
                                                    </td>
                                                    <td>{{ $assignment->assigned_by_name }}</td>
                                                    <td>{{ $assignment->assigned_at->format('M d, Y') }}</td>
                                                    <td>
                                                        {{ $assignment->completed_at ? $assignment->completed_at->format('M d, Y') : '-' }}
                                                    </td>
                                                    <td>
                                                        <div class="dropdown action-dropdown">
                                                            <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                {{ __('Actions') }}
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                @if($assignment->status != 'completed')
                                                                    <a class="dropdown-item" href="#" onclick="updateStatus('{{ $assignment->id }}', 'in_progress')">
                                                                        <i class="fas fa-play"></i> {{ __('Mark In Progress') }}
                                                                    </a>
                                                                    <a class="dropdown-item" href="#" onclick="updateStatus('{{ $assignment->id }}', 'completed')">
                                                                        <i class="fas fa-check"></i> {{ __('Mark Completed') }}
                                                                    </a>
                                                                @endif
                                                                @if($assignment->status != 'revoked')
                                                                    <a class="dropdown-item" href="#" onclick="updateStatus('{{ $assignment->id }}', 'revoked')">
                                                                        <i class="fas fa-ban"></i> {{ __('Revoke Access') }}
                                                                    </a>
                                                                @endif
                                                                <div class="dropdown-divider"></div>
                                                                <a class="dropdown-item text-danger" href="#" onclick="deleteAssignment('{{ $assignment->id }}')">
                                                                    <i class="fas fa-trash"></i> {{ __('Delete') }}
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7" class="text-center">{{ __('No assignments found') }}</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Pagination -->
                                <div class="d-flex justify-content-center">
                                    {{ $assignments->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('js')
<script>
    // Global functions for onclick handlers
    window.updateStatus = function(assignmentId, status) {
        if (confirm('Are you sure you want to update this assignment status?')) {
            $.ajax({
                url: '{{ url("admin/course-assignments") }}/' + assignmentId + '/status',
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                data: JSON.stringify({
                    status: status
                }),
                success: function(response) {
                    if (response.status === 'success') {
                        toastr.success(response.message);
                        location.reload();
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function(xhr) {
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        toastr.error(xhr.responseJSON.message);
                    } else {
                        toastr.error('An error occurred while updating the status.');
                    }
                }
            });
        }
    };
    
    window.deleteAssignment = function(assignmentId) {
        if (confirm('Are you sure you want to delete this assignment?')) {
            $.ajax({
                url: '{{ url("admin/course-assignments") }}/' + assignmentId,
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                success: function(response) {
                    if (response.status === 'success') {
                        toastr.success(response.message);
                        location.reload();
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function(xhr) {
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        toastr.error(xhr.responseJSON.message);
                    } else {
                        toastr.error('An error occurred while deleting the assignment.');
                    }
                }
            });
        }
    };

    // Document ready functions
    $(document).ready(function() {
        // Initialize Bootstrap dropdowns for action menus
        $('.action-dropdown .dropdown-toggle').dropdown();
        
        // Apply filters
        $('#apply-filters').click(function() {
            var studentId = $('#student-filter').val();
            var courseId = $('#course-filter').val();
            var status = $('#status-filter').val();
            
            var url = '{{ route("admin.course-assignments.index") }}';
            var params = [];
            
            if (studentId) {
                params.push('student_id=' + studentId);
            }
            if (courseId) {
                params.push('course_id=' + courseId);
            }
            if (status) {
                params.push('status=' + status);
            }
            
            if (params.length > 0) {
                url += '?' + params.join('&');
            }
            
            window.location.href = url;
        });
        
        // Clear filters
        $('#clear-filters').click(function() {
            window.location.href = '{{ route("admin.course-assignments.index") }}';
        });
    });
    // Handle Enter key press on filter inputs
    $('#student-filter, #course-filter, #status-filter').keypress(function(e) {
        if (e.which == 13) {
            $('#apply-filters').click();
        }
    });
</script>
@endpush

@push('css')
<style>
    .table-responsive {
        overflow: visible !important;
    }
    
    .dropdown-menu {
        z-index: 1050 !important;
        position: absolute !important;
        min-width: 160px;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
    }
    
    .dropdown-menu-right {
        right: 0;
        left: auto;
    }
    
    .table td {
        position: relative;
    }
</style>
@endpush