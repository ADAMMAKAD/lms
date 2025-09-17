@extends('admin.master_layout')
@section('title')
    <title>{{ __('Course Analytics') }}</title>
@endsection
@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1 class="text-primary">{{ __('Course') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Course Analytics') }}</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @include('course::course.navigation')
                        <form action="{{ route('admin.courses.update') }}"
                            class="instructor__profile-form course-form d-none">
                            @csrf
                            <input type="hidden" name="course_id" id="" value="{{ $course?->id }}">
                            <input type="hidden" name="step" id="" value="4">
                            <input type="hidden" name="next_step" value="5">
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>{{ __('Study Progress Tracker') }}</h4>
                            </div>
                            <div class="card-body">
                                <div class="chart-area">
                                    <canvas id="student_progress_chart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>{{ __('Students Who Take the Course In') }}
                                    {{ request()->has('year') ? Carbon\Carbon::createFromFormat('Y', request('year'))->format('Y') : date('Y') }}
                                </h4>
                                <div class="form-inline">
                                    <form method="get" onchange="$(this).trigger('submit');">
                                        <select name="year" id="year" class="form-control mb-0">
                                            @php
                                                $currentYear = Carbon\Carbon::now()->year;
                                                $selectYear = request('year') ?? $currentYear;
                                            @endphp
                                            @for ($i = $oldestYear; $i <= $latestYear; $i++)
                                                <option value="{{ $i }}" @selected($selectYear == $i)>
                                                    {{ $i }}</option>
                                            @endfor
                                        </select>
                                    </form>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart-area">
                                    <canvas id="combined_monthly_chart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('css')
    <style>
        .chart-area {
            min-height: 300px;
            max-height: 400px;
        }
    </style>
@endpush

@php
    $translations = [
        'numberOfStudents' => __('Number of Students'),
        'completionPercentageRanges' => __('Completion Percentage Ranges'),
        'courseEnrollments' => __('Course Enrollments'),
        'totalStudentEnrollments' => __('Total Student Enrollments')
    ];
@endphp

<div id="chart-data" 
     data-progress-ranges="{{ htmlspecialchars(json_encode($progress_ranges)) }}"
     data-month-labels="{{ htmlspecialchars(json_encode($month_labels)) }}"
     data-commission-monthly="{{ htmlspecialchars(json_encode($commission_monthly_data)) }}"
     data-net-monthly="{{ htmlspecialchars(json_encode($net_monthly_data)) }}"
     data-order-monthly="{{ htmlspecialchars(json_encode($order_monthly_data)) }}"
     data-translations="{{ htmlspecialchars(json_encode($translations)) }}"
     style="display: none;"></div>

@push('js')
    <script src="{{ asset('backend/js/default/courses.js') }}"></script>
    <script src="{{ asset('backend/js/chart.umd.min.js') }}"></script>
    <script type="text/javascript">
        // Load data from HTML data attributes
        const chartDataElement = document.getElementById('chart-data');
        if (chartDataElement) {
            window.chartConfig = {
                progressRanges: JSON.parse(chartDataElement.dataset.progressRanges),
                monthLabels: JSON.parse(chartDataElement.dataset.monthLabels),
                commissionMonthlyData: JSON.parse(chartDataElement.dataset.commissionMonthly),
                netMonthlyData: JSON.parse(chartDataElement.dataset.netMonthly),
                orderMonthlyData: JSON.parse(chartDataElement.dataset.orderMonthly),
                translations: JSON.parse(chartDataElement.dataset.translations)
            };
        } else {
            console.error('Chart data element not found');
            window.chartConfig = {};
        }
        
        (function($) {
            "use strict";
            
            $(document).ready(function() {
                renderOrderProgressChart();
                renderStudentProgressChart();
            });
        })(jQuery);

        function renderStudentProgressChart() {
            if (!window.chartConfig || !window.chartConfig.progressRanges) {
                console.error('Chart configuration or progress ranges not available');
                return;
            }
            const labels = Object.keys(window.chartConfig.progressRanges).map(label => label + "%");
            const data = Object.values(window.chartConfig.progressRanges);

            var ctx = document.getElementById('student_progress_chart');
            var myLineChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: window.chartConfig.translations.numberOfStudents,
                        lineTension: 0.3,
                        backgroundColor: "rgba(75, 192, 192, 0.2)",
                        borderColor: "rgba(75, 192, 192, 1)",
                        pointRadius: 3,
                        pointBackgroundColor: "rgba(78, 115, 223, 1)",
                        pointBorderColor: "rgba(78, 115, 223, 1)",
                        pointHoverRadius: 3,
                        pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                        pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                        pointHitRadius: 10,
                        pointBorderWidth: 2,
                        data: data,
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    responsive: true,
                    layout: {
                        padding: {
                            left: 10,
                            right: 25,
                            top: 25,
                            bottom: 0
                        }
                    },
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: window.chartConfig.translations.completionPercentageRanges
                            }
                        },
                        y: {
                            min: 0,
                            max: Math.max(...data),
                            ticks: {
                                beginAtZero: true,
                                stepSize: 1,
                                callback: function(value) {
                                    return value.toFixed(0);
                                }
                            }
                        }
                    }
                }
            });
        }

        function renderOrderProgressChart() {
            if (!window.chartConfig || !window.chartConfig.monthLabels) {
                console.error('Chart configuration or month labels not available');
                return;
            }
            const date_labels = window.chartConfig.monthLabels;
            const commission_monthly_data = window.chartConfig.commissionMonthlyData;
            const net_monthly_data = window.chartConfig.netMonthlyData;
            const order_monthly_data = window.chartConfig.orderMonthlyData;

            var ctx = document.getElementById('combined_monthly_chart');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: date_labels,
                    datasets: [{
                            label: window.chartConfig.translations.totalStudentEnrollments,
                            type: 'bar',
                            backgroundColor: "rgba(78, 115, 223, 0.7)",
                            borderColor: "rgba(78, 115, 223, 1)",
                            data: order_monthly_data,
                        }
                    ],
                },
                options: {
                    maintainAspectRatio: false,
                    responsive: true,
                    layout: {
                        padding: {
                            left: 10,
                            right: 25,
                            top: 25,
                            bottom: 0
                        }
                    },
                    scales: {
                        y: {
                            min: 0,
                            ticks: {
                                beginAtZero: true,
                                color: "rgba(78, 115, 223, 1)",
                                callback: function(value) {
                                    return number_format(value, 0);
                                }
                            },
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                title: function(context) {
                                    return context[0].label;
                                },
                                label: function(context) {
                                    let enrollments = order_monthly_data[context.dataIndex] || 0;
                                    return window.chartConfig.translations.totalStudentEnrollments + ": " + number_format(enrollments, 0);
                                }
                            }
                        }
                    }
                }
            });
        }

        function number_format(number, decimals = 2, dec_point = '.', thousands_sep = ',') {
            number = parseFloat(number).toFixed(decimals);
            let parts = number.split('.');
            parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, thousands_sep);
            return parts.join(dec_point);
        }
    </script>
@endpush
