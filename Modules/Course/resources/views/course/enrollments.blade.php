@extends('admin.master_layout')
@section('title')
    <title>{{ __('Course Enrollments') }} - {{ $course->title }}</title>
@endsection
@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Course Enrollments') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('admin.course.index') }}">{{ __('Courses') }}</a></div>
                    <div class="breadcrumb-item">{{ __('Enrollments') }}</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ __('Users Taking Course') }}: {{ truncate($course->title, 50) }}</h4>
                                <div class="card-header-action">
                                    <span class="badge badge-primary">{{ $enrolledUsers->total() }} {{ __('Total Enrollments') }}</span>
                                </div>
                            </div>
                            <div class="card-body">
                                @if($enrolledUsers->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>{{ __('SN') }}</th>
                                                    <th>{{ __('Student Name') }}</th>
                                                    <th>{{ __('Email') }}</th>
                                                    <th>{{ __('Progress') }}</th>
                                                    <th>{{ __('Completed Items') }}</th>
                                                    <th>{{ __('Last Activity') }}</th>
                                                    <th>{{ __('Enrollment Date') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($enrolledUsers as $user)
                                                    @php
                                                        $progressClass = 'bg-danger';
                                                        if ($user->progress_percentage >= 80) {
                                                            $progressClass = 'bg-success';
                                                        } elseif ($user->progress_percentage >= 50) {
                                                            $progressClass = 'bg-warning';
                                                        }
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $loop->iteration + ($enrolledUsers->currentPage() - 1) * $enrolledUsers->perPage() }}</td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                @if($user->image)
                                                                    <img src="{{ asset($user->image) }}" alt="{{ $user->name }}" class="rounded-circle mr-2" width="40" height="40">
                                                                @else
                                                                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mr-2" style="width: 40px; height: 40px; font-size: 16px;">
                                                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                                                    </div>
                                                                @endif
                                                                <div>
                                                                    <strong>{{ $user->name }}</strong>
                                                                    @if($user->user_type === 'admin')
                                                                        <span class="badge badge-danger ml-1">{{ __('Admin') }}</span>
                                                                    @elseif($user->user_type === 'instructor')
                                                                        <span class="badge badge-warning ml-1">{{ __('Instructor') }}</span>
                                                                    @else
                                                                        <span class="badge badge-info ml-1">{{ __('Student') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>
                                                            <div class="progress progress-custom">
                                                                <div class="progress-bar {{ $progressClass }}" role="progressbar" style="width: {{ $user->progress_percentage }}%">
                                                                    {{ $user->progress_percentage }}%
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <span class="badge badge-secondary">
                                                                {{ $user->completed_items }}/{{ $user->total_items }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            @if($user->progresses->isNotEmpty())
                                                                {{ $user->progresses->sortByDesc('updated_at')->first()->updated_at->diffForHumans() }}
                                                            @else
                                                                <span class="text-muted">{{ __('No activity') }}</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($user->progresses->isNotEmpty())
                                                                {{ $user->progresses->sortBy('created_at')->first()->created_at->format('M d, Y') }}
                                                            @else
                                                                <span class="text-muted">{{ __('Unknown') }}</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="float-right">
                                        {{ $enrolledUsers->links() }}
                                    </div>
                                @else
                                    <div class="text-center py-5">
                                        <i class="fas fa-users fa-3x text-muted mb-3"></i>
                                        <h5 class="text-muted">{{ __('No enrollments found') }}</h5>
                                        <p class="text-muted">{{ __('No users have enrolled in this course yet.') }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('style')
<style>
.progress-custom {
    height: 20px;
    border-radius: 10px;
}
.progress-bar {
    border-radius: 10px;
    font-size: 12px;
    font-weight: bold;
}
</style>
@endpush