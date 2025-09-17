@extends('frontend.pages.learning-player.master')

@section('contents')
    <section class="wsus__course_video">
        <div class="col-12">
            <div class="wsus__course_header">
                @if (Session::has('course_slug'))
                    <a href="{{ route('student.learning.index', Session::get('course_slug')) }}"><i
                            class="fas fa-angle-left"></i>{{ truncate(Session::get('course_title')) }}</a>
                @endif
            </div>
        </div>

        <div class="container">
            <div class="question-container">
                <div class="row">
                    <div class="col-12 mb-5">
                        <div class="card">
                            <div class="card-body text-center">
                                <div class="info-col text-center">
                                    <img src="{{ asset('uploads/website-images/good-score.png') }}">
                                </div>
                                <h5 class="card-title count">{{ __('Assessment Completed!') }}</h5>
                                <span>{{ __('Thank you for completing the assessment. Your responses have been recorded.') }}</span>

                                <div class="mt-3 mb-3">
                                    @if (Session::has('course_slug'))
                                        <a href="{{ route('student.learning.index', Session::get('course_slug')) }}"
                                            class="btn">{{ __('Go back to course page') }}</a>
                                    @else
                                        <a href="{{ route('student.enrolled-courses') }}"
                                            class="btn">{{ __('Go back to Dashboard') }}</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="card text-center">
                            <div class="info-col text-center">
                                <img src="{{ asset('uploads/website-images/test.png') }}">
                            </div>
                            <div class="card-body">
                                <h6 class="card-title count">{{ $attempt }}</h6>
                                <p class="card-text">{{ __('Assessment Attempts') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="card text-center">
                            <div class="info-col text-center">
                                <img src="{{ asset('uploads/website-images/trophy.png') }}">
                            </div>
                            <div class="card-body">
                                <h6 class="card-title count text-success">{{ __('Completed') }}</h6>
                                <p class="card-text">{{ __('Status') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-3">
                <form action="{{ route('student.quiz.store', request('id')) }}" method="POST">
                    @csrf
                    <div class="card-body">
                        @php
                            $result = $quizResult->result;
                        @endphp
                        @foreach ($quiz->questions as $question)
                            <div class="question-box mt-4">
                                <h6>{{ $loop->iteration }}. {{ $question->title }}</h6>
                                <div class="row">
                                    @foreach ($question->answers as $answer)
                                        <div class="col-md-6">
                                            <div class="card ans-body m-2">
                                                <label for="ans-{{ $answer->id }}" class="box first">
                                                    <div class="course">
                                                        <span class="circle">
                                                            <input disabled type="radio" @checked(@$result[$question->id]['answer'] ?? null == $answer->id)
                                                                name="question[{{ $question->id }}]"
                                                                id="ans-{{ $answer->id }}" value="{{ $answer->id }}">
                                                        </span>
                                                        <span class="subject">{{ $answer->title }}</span>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        @endforeach

                    </div>
                </form>
            </div>
        </div>

    </section>
@endsection

@push('scripts')
    <script src="{{ asset('frontend/js/default/quiz-page.js') }}"></script>
    <script>
        $(document).ready(function() {
            // reset quiz timer
            resetCountdown();
        })
    </script>
@endpush
