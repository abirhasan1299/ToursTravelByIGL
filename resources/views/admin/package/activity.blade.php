@extends('layout.admin')
@section('title', 'Activity')
@push('css')
    <style>
        .day-card {
            transition: all 0.3s ease;
            border: none;
            border-radius: 15px;
            overflow: hidden;
            margin-bottom: 25px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }

        .day-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        .day-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px 20px;
            font-size: 1.2rem;
            font-weight: 600;
            display: flex;
            align-items: center;
        }

        .day-number {
            background: rgba(255,255,255,0.2);
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            font-weight: bold;
        }

        .card-body {
            padding: 25px;
            background: #fff;
        }

        .form-floating {
            margin-bottom: 20px;
        }

        .floating-label {
            position: relative;
        }

        .floating-label input,
        .floating-label textarea {
            border: 2px solid #eef2f6;
            border-radius: 12px;
            padding: 12px 15px;
            transition: all 0.3s ease;
            background: #f8fafc;
        }

        .floating-label input:focus,
        .floating-label textarea:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.1);
            background: #fff;
        }

        .floating-label label {
            font-weight: 500;
            color: #4a5568;
            margin-bottom: 8px;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .submit-section {
            text-align: center;
            margin-top: 30px;
            padding: 20px;
            background: #f8fafc;
            border-radius: 15px;
        }

        .btn-submit {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 12px 40px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
            color: white;
        }

        .btn-submit i {
            margin-right: 8px;
        }

        .activity-icon {
            color: #667eea;
            margin-right: 8px;
        }

        .page-header {
            margin-bottom: 30px;
            position: relative;
        }

        .page-header h2 {
            font-weight: 700;
            color: #2d3748;
            position: relative;
            display: inline-block;
            padding-bottom: 10px;
        }

        .page-header h2:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 2px;
        }

        .summernote {
            border-radius: 12px !important;
        }

        .note-editor.note-frame {
            border: 2px solid #eef2f6 !important;
            border-radius: 12px !important;
        }

        .note-editor.note-frame .note-toolbar {
            background: #f8fafc !important;
            border-radius: 12px 12px 0 0 !important;
        }

        .note-editor.note-frame .note-statusbar {
            background: #f8fafc !important;
            border-radius: 0 0 12px 12px !important;
        }

        .progress-steps {
            display: flex;
            justify-content: center;
            margin-bottom: 30px;
        }

        .step {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #eef2f6;
            color: #4a5568;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 5px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .step.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .step.completed {
            background: #48bb78;
            color: white;
        }

        .card-footer-info {
            background: #f8fafc;
            padding: 10px 25px;
            border-top: 1px solid #eef2f6;
            color: #718096;
            font-size: 0.9rem;
        }

        .info-icon {
            margin-right: 5px;
            color: #667eea;
        }

        @media (max-width: 768px) {
            .day-header {
                font-size: 1rem;
            }

            .btn-submit {
                width: 100%;
            }
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-header text-center">
                    <h2>
                        <i class="fas fa-calendar-alt activity-icon"></i>
                        Add Activity for Package
                    </h2>
                    <p class="text-muted">Fill in the details for each day of your package</p>
                </div>


                <div style="max-width: 800px; margin: 0 auto;">
                    <form action="{{route('company.package.activity.store')}}" method="post" autocomplete="off" id="activityForm">

                        @csrf

                        <input type="hidden" name="package_id" value="{{$data->id}}">

                        @for($i = 1; $i <= $data->day; $i++)
                            <div class="day-card" id="day-{{ $i }}">
                                <div class="day-header">
                                    <span class="day-number">{{ $i }}</span>
                                    <span>Day {{ $i }} Activities</span>
                                </div>
                                <input type="hidden" name="day_no[]" value="{{$i}}">

                                <div class="card-body">
                                    <div class="floating-label">
                                        <label for="title_{{ $i }}">
                                            <i class="fas fa-heading info-icon"></i>
                                            Title for Day {{ $i }}
                                        </label>
                                        <input
                                            name="title[]"
                                            id="title_{{ $i }}"
                                            class="form-control"
                                            type="text"
                                            placeholder="e.g., Arrival & City Tour, Safari Adventure, Beach Day..."
                                            value="{{ old('title.' . ($i-1),$activity[$i-1]->title??'') }}"
                                        >
                                        <small class="text-muted">Give a catchy title for this day's activities</small>
                                    </div>

                                    <div class="floating-label mt-4">
                                        <label for="detail_{{ $i }}">
                                            <i class="fas fa-align-left info-icon"></i>
                                            Detailed Activities for Day {{ $i }}
                                        </label>
                                        <textarea
                                            name="detail[]"
                                            id="detail_{{ $i }}"
                                            class="form-control summernote"
                                            rows="6"
                                            placeholder="Describe the activities, timings, highlights, meals included..."
                                        >{{ old('detail.' . ($i-1),$activity[$i-1]->detail??'') }}</textarea>
                                        <small class="text-muted">Include timing, locations, meals, and special highlights</small>
                                    </div>
                                </div>

                                <div class="card-footer-info">
                                    <i class="fas fa-info-circle info-icon"></i>
                                    Fill in all details for Day {{ $i }}
                                </div>
                            </div>
                        @endfor

                        <div class="submit-section">
                            <div class="row align-items-center">
                                <div class="col-md-6 text-md-start mb-3 mb-md-0">
                                <span class="text-muted">
                                    <i class="fas fa-tag info-icon"></i>
                                    Total Days: <strong>{{ $data->day }}</strong>
                                </span>
                                </div>
                                <div class="col-md-6 text-md-end">
                                    <button type="submit" class="btn btn-submit">
                                        <i class="fas fa-save"></i>
                                        Save All Activities
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {

            // Update active step on scroll
            $(window).scroll(function() {
                var scrollPosition = $(window).scrollTop();

                $('.day-card').each(function(index) {
                    var cardPosition = $(this).offset().top;
                    var cardHeight = $(this).outerHeight();

                    if (scrollPosition >= cardPosition - 100 && scrollPosition < cardPosition + cardHeight - 100) {
                        var stepNumber = index + 1;
                        $('.step').removeClass('active');
                        $('#step-' + stepNumber).addClass('active');
                    }
                });
            });

            // Form validation
            $('#activityForm').on('submit', function(e) {
                var isValid = true;

                $('input[name="title[]"]').each(function() {
                    if ($(this).val().trim() === '') {
                        $(this).addClass('is-invalid');
                        isValid = false;
                    } else {
                        $(this).removeClass('is-invalid');
                    }
                });

                if (!isValid) {
                    e.preventDefault();
                    alert('Please fill in all titles before submitting.');
                }
            });

            // Remove invalid class on input
            $('input[name="title[]"]').on('input', function() {
                $(this).removeClass('is-invalid');
            });

            // Add smooth scroll to cards
            $('.step').on('click', function() {
                var stepNum = $(this).text();
                $('html, body').animate({
                    scrollTop: $('#day-' + stepNum).offset().top - 50
                }, 500);
            });
        });
    </script>
@endpush
