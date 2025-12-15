@extends('frontend.layout.main')
@section('content')
    <section id="page_header" style="background: url('{{ asset('storage/' . ($menu->bannerImage ?? '')) }}')">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="page_header_content_wrapper">
                        <h2>{{ $menu->page_title ?? '' }}</h2>
                        {!! \Illuminate\Support\Str::limit($menu->content ?? '', 270) !!}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="vacancy_page_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="vacancy_page_header_wrapper">
                        <h1>Be part of <span class="text_gradient_header">OUR MISSION</span></h1>
                        <p>
                            We are looking forward towards dynamic and smart sales and marketing personnel. If you think you
                            are it, then apply below. We will respond soon.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                @if ($vacancy->count() > 0)
                    @foreach ($vacancy as $index => $record)
                        <div class="col-lg-12">
                            <div class="vacancy_page_content_wrapper">
                                <div class="vacancy_content_header">
                                    <h2>{{ $record->jobTitle }}</h2>
                                    <a href="" class="btn btn-link text_gradient" data-bs-toggle="modal"
                                        data-bs-target="#career{{ $record->id }}">Apply Now</a>
                                </div>
                                <div class="vacancy_content_schedule">
                                    <span><i class="fa-regular fa-paper-plane"></i>{{ $record->location }}</span>
                                    <span><i class="fa-solid fa-suitcase"></i>{{ $record->jobType }}</span>
                                    @php
                                        $today = \Carbon\Carbon::today();
                                        $expiry = \Carbon\Carbon::parse($record->expireDate);
                                        if ($expiry->isPast()) {
                                            $status = 'Expired';
                                        } else {
                                            $daysLeft = $today->diffInDays($expiry);
                                            $status = $daysLeft . ' days remaining';
                                        }
                                    @endphp
                                    <span><i class="fa-solid fa-calendar-days"></i>{{ $status }}</span>
                                </div>
                                <div class="vacancy_content_info">
                                    <div class="vacancy_text">
                                        {!! $record->description !!}
                                    </div>
                                    <a href="javascript:void(0)" class="read-more">Read More</a>
                                </div>
                            </div>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade career_modal" id="career{{ $record->id }}" tabindex="-1"
                            aria-labelledby="careerLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="careerLabel">Apply for {{ $record->jobTitle }}</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    @php
                                        $bagName = 'apply_' . $record->id;
                                        $bag = $errors->getBag($bagName);
                                    @endphp

                                    <div class="modal-body">
                                        @if (session('success_message') && session('open_modal') == $record->id)
                                            {{ session('success_message') }}
                                        @endif
                                        @if (!session('success_message') || session('open_modal') != $record->id)
                                            <form action="{{ route('application.store') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="vacancy_id" value="{{ $record->id }}">
                                                <input type="hidden" name="job_title" value="{{ $record->jobTitle }}">

                                                {{-- Full Name --}}
                                                <div class="mb-3">
                                                    <label for="name{{ $record->id }}" class="form-label">Full
                                                        Name</label>
                                                    <input type="text" id="name{{ $record->id }}" name="name"
                                                        class="form-control {{ $bag->has('name') ? 'is-invalid' : '' }}"
                                                        value="{{ old('name') }}" placeholder="Full Name">
                                                    @if ($bag->has('name'))
                                                        <div class="invalid-feedback d-block">
                                                            {{ $bag->first('name') }}
                                                        </div>
                                                    @endif
                                                </div>

                                                {{-- Email --}}
                                                <div class="mb-3">
                                                    <label for="email{{ $record->id }}" class="form-label">Email
                                                        address</label>
                                                    <input type="email" id="email{{ $record->id }}" name="email"
                                                        class="form-control {{ $bag->has('email') ? 'is-invalid' : '' }}"
                                                        value="{{ old('email') }}" placeholder="example@gmail.com">
                                                    @if ($bag->has('email'))
                                                        <div class="invalid-feedback d-block">
                                                            {{ $bag->first('email') }}
                                                        </div>
                                                    @endif
                                                </div>

                                                {{-- Phone --}}
                                                <div class="mb-3">
                                                    <label for="phone{{ $record->id }}" class="form-label">Phone</label>
                                                    <input type="text" id="phone{{ $record->id }}" name="phone"
                                                        class="form-control {{ $bag->has('phone') ? 'is-invalid' : '' }}"
                                                        value="{{ old('phone') }}" placeholder="+9841234567">
                                                    @if ($bag->has('phone'))
                                                        <div class="invalid-feedback d-block">
                                                            {{ $bag->first('phone') }}
                                                        </div>
                                                    @endif
                                                </div>

                                                {{-- Resume --}}
                                                <div class="mb-3">
                                                    <span>Please upload your resume file here</span>
                                                    @if ($bag->has('media'))
                                                        <div class="invalid-feedback d-block">
                                                            {{ $bag->first('media') }}
                                                        </div>
                                                    @endif
                                                </div>

                                                <div class="input-group mb-3">
                                                    <label class="input-group-text"
                                                        for="media{{ $record->id }}">Upload</label>
                                                    <input type="file"
                                                        class="form-control {{ $bag->has('media') ? 'is-invalid' : '' }}"
                                                        id="media{{ $record->id }}" name="media">
                                                </div>
                                                {{-- Google reCAPTCHA --}}
                                                <div class="mb-3 google_captcha_placeholder">
                                                    <div style="display: block;">
                                                        {!! NoCaptcha::display() !!}
                                                    </div>
                                                    @if ($bag->has('g-recaptcha-response'))
                                                        <div class="invalid-feedback d-block">
                                                            {{ $bag->first('g-recaptcha-response') }}
                                                        </div>
                                                    @endif
                                                </div>




                                                <div class="d-flex justify-content-center apply_button_wrapper">
                                                    <button type="submit" class="btn btn-danger">
                                                        Submit
                                                        <span class="material-symbols-outlined">arrow_right_alt</span>
                                                    </button>
                                                </div>
                                            </form>
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-lg-12">
                        <span class="no_vacancy">
                            No vacancy available
                        </span>
                    </div>
                @endif

            </div>
        </div>
    </section>

@endsection
@push('scripts')


    <script>
        $(document).on('click', '.read-more', function(e) {
            e.preventDefault();

            const $wrapper = $(this).closest('.vacancy_content_info');
            const $vacancyText = $wrapper.find('.vacancy_text');

            $vacancyText.toggleClass('expanded');

            $(this).text(
                $vacancyText.hasClass('expanded') ? 'Read Less' : 'Read More'
            );
        });
    </script>
    <script>
        document.addEventListener('shown.bs.modal', function(event) {
            grecaptcha.render(document.querySelector('.google_captcha_placeholder .g-recaptcha'), {
                sitekey: "{{ config('captcha.sitekey') }}"
            });
        });
    </script>

    @if (session('open_modal'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var id = @json(session('open_modal'));
                var modalEl = document.getElementById('career' + id);
                if (modalEl) {
                    var modal = new bootstrap.Modal(modalEl);
                    modal.show();
                }
            });
        </script>
    @endif


   

@endpush
