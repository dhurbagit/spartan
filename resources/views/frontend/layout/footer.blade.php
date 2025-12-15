<section id="footer_above-ads-wrapper" class="Home-page-footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="ads-wrapper_1">
                    <div class="ads-image_1">
                        <img src="{{ asset('frontend/img/footer_above.png') }}"
                            alt="Barari – Nepal’s First Prawn Cracker &amp; Quality Foods">
                    </div>
                    <div class="footer-above-contact-link">
                        <span class="text_gradient">Let’s Work Together</span>
                        <p>Our door is always open contact anytime!</p>
                        @if (request()->segment(1) !== 'contact_us')
                            <a href="{{ route('category', ['category' => 'contact_us']) }}"
                                class="btn btn-danger">Contact
                                Us<i class="material-symbols-outlined">
                                    arrow_right_alt
                                </i></a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<footer id="site_footer_wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="footer_about_company">
                    <div class="footer_wrapper">
                        <img src="{{ asset('storage/' . ($site_setting->media ?? '')) }}" alt="">
                    </div>
                    <div class="footer_about">
                        <p>{{ \Illuminate\Support\Str::limit($site_setting->footer_message ?? '', 120) }}</p>
                    </div>
                    <div class="social_link">
                        <ul>
                            <li class="facebook"><a href="{{ $site_setting->facebook ?? '' }}"><i
                                        class="fa-brands fa-facebook-f"></i></a></li>
                            <li class="instagram"><a href="{{ $site_setting->instagram ?? '' }}"><i
                                        class="fa-brands fa-instagram"></i></a></li>
                            <li class="tiktok"><a href="{{ $site_setting->tiktok ?? '' }}"><i
                                        class="fa-brands fa-tiktok"></i></a></li>
                            <li class="youtube"><a href="{{ $site_setting->youtube ?? '' }}"><i
                                        class="fa-brands fa-youtube"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="contact_us_wrapper">
                            <h5>Contact Us</h5>
                            <ul>
                                <li>
                                    <span class="material-symbols-outlined">
                                        phone_callback
                                    </span>
                                    {{ $site_setting->phone_no ?? '' }}
                                </li>
                                <li>
                                    <span class="material-symbols-outlined">
                                        mobile
                                    </span>
                                    {{ $site_setting->mobile_no ?? '' }}
                                </li>
                                <li>
                                    <span class="material-symbols-outlined">
                                        mail
                                    </span>
                                    {{ $site_setting->email ?? '' }}
                                </li>
                                <li>
                                    <span class="material-symbols-outlined">
                                        location_on
                                    </span>
                                    {{ $site_setting->location ?? '' }}
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="footer_quicklink_wrapper">
                            <h5>Quick Link</h5>
                            @if (count($menus) > 0)
                                <ul>
                                    @foreach ($footermenus as $menu)
                                        @if (!$menu->status == 0)
                                            <li>
                                                <a class="nav-link"
                                                    @if ($menu->category_slug == 'page') href="{{ $menu->external_link ?? route('page', $menu->title_slug) }}"
                                                    @else
                                                        href="{{ $menu->external_link ?? route('category', $menu->category_slug) }}" @endif>{{ Str::ucfirst($menu->menu_name) }}</a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copy_right_wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <p><span id="year"></span> &copy; All right reserved. Design & develop by <a
                            href="https://dhurbadhakal.com.np/">Dhurba Dhakal</a></p>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="relative-division" style="position: relative;">
                    <div class="scene">
                        <div class="truck-wrap">
                            <!-- Simple Truck SVG (no wheel rotation) -->
                            <svg viewBox="0 0 360 160" xmlns="http://www.w3.org/2000/svg" width="100%">
                                <!-- Trailer -->
                                <rect x="20" y="60" width="200" height="70" rx="8" fill="#3F51B5" />
                                <!-- Cab -->
                                <rect x="230" y="80" width="90" height="50" rx="6" fill="#1E88E5" />
                                <rect x="250" y="65" width="50" height="30" rx="4" fill="#B3E5FC" />
                                <!-- Wheels -->
                                <circle cx="80" cy="130" r="20" fill="#333" />
                                <circle cx="160" cy="130" r="20" fill="#333" />
                                <circle cx="260" cy="130" r="20" fill="#333" />
                                {{-- <g class="rope" transform="translate(0,0)">
                    <!-- Curved rope to flag pole top -->
                    <path d="M 40 100 C -10 90, -60 88, -110 95" fill="none" stroke="#6b5b53" stroke-width="3"
                        stroke-linecap="round" />
                </g>

                <!-- FLAG (banner) positioned behind truck (left side, negative x) -->
                <g class="banner" transform="translate(-160,78)">
                    <!-- Pole top (where rope ties) -->
                    <circle cx="50" cy="17" r="3" fill="#6b5b53" />
                    <!-- Flag rectangle -->
                    <rect x="50" y="0" width="200" height="34" rx="4" fill="#ff5252" />
                    <!-- Flag edge shade for depth -->
                    <rect x="50" y="0" width="200" height="10" fill="rgba(0,0,0,0.08)" />
                    <!-- Text -->
                    <text x="150" y="22" font-family="system-ui, Arial, sans-serif" font-size="12"
                        text-anchor="middle" fill="#fff" font-weight="700" letter-spacing=".5">
                        WE ARE A TRADING COMPANY
                    </text>
                </g> --}}
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</footer>
