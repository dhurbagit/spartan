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
    <section id="contact_page_wrapper">
        <div class="container">
            <div class="inner_contact_background_wrapper">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="contact_detial_wrapper">
                            <div class="contact_header_wrapper">
                                <h2 class="text_gradient_header"><u>Connect with us</u></h2>
                                <p>If you'd like to talk get a dealership, wholesellership or anything else then lets get in
                                    touch.</p>
                            </div>
                            <div class="contact_detail_wrapper">
                                <h3>Head Office Address</h3>
                                <ul>
                                    <li><span class="material-symbols-outlined">
                                            near_me
                                        </span>
                                        {{ $site_setting->location ?? '' }}
                                    </li>
                                    <li><span class="material-symbols-outlined">
                                            call
                                        </span>
                                        {{ $site_setting->phone_no ?? '' }}
                                    </li>
                                    <li><span class="material-symbols-outlined">
                                            mobile
                                        </span>
                                        {{ $site_setting->mobile_no ?? '' }}
                                    </li>
                                    <li><span class="material-symbols-outlined">
                                            location_on
                                        </span>
                                        {{ $site_setting->zip_code ?? '' }}
                                    </li>
                                </ul>
                            </div>
                            <div class="google_map_wrapper">
                                {!! $site_setting->google_map ?? '' !!}
                            </div>
                            <div class="social_icon_wrapper">
                                <div class="text_label">
                                    <h3>Follow us on:</h3>
                                </div>
                                <div class="social_icon_list">
                                    <ul>
                                        <li>
                                            <a href=" {{ $site_setting->facebook ?? '' }}"><i
                                                    class="fa-brands fa-facebook-f"></i></a>
                                        </li>
                                        <li>
                                            <a href=" {{ $site_setting->instagram ?? '' }}"><i
                                                    class="fa-brands fa-instagram"></i></a>
                                        </li>
                                        <li>
                                            <a href=" {{ $site_setting->tiktok ?? '' }}"><i
                                                    class="fa-brands fa-tiktok"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="col-lg-5">



                        <div class="contact_form_wrapper">
                            <form action="{{ route('customer.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" value="{{ old('name') }}"
                                        placeholder="Enter your name">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" value="{{ old('email') }}"
                                        placeholder="name@example.com">

                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="number" class="form-control @error('phone') is-invalid @enderror"
                                        id="phone" name="phone" value="{{ old('phone') }}"
                                        placeholder="+977-9800000000">

                                </div>
                                <div class="mb-3">
                                    <label for="message" class="form-label">Message</label>
                                    <textarea placeholder="Write Message" class="form-control @error('message') is-invalid @enderror" id="message"
                                        rows="3" name="message" value="{{ old('message') }}"></textarea>

                                </div>
                                {{-- Google reCAPTCHA --}}
                                <div class="mb-3 google_captcha_placeholder">
                                    <div style="display: block;">
                                        {!! NoCaptcha::display() !!}
                                    </div>
                                    @error('g-recaptcha-response')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-danger">Send Message
                                        <span class="material-symbols-outlined">
                                            near_me
                                        </span>
                                    </button>
                                </div>
                            </form>
                            @if (session('success_message'))
                                <div class="flash_message_contact_us"> {{ session('success_message') }}</div>
                            @endif
                        </div>


                    </div>
                </div>
            </div>
    </section>
@endsection
