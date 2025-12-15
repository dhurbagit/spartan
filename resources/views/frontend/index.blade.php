@extends('frontend.layout.main')
@section('content')
    <section id="slider_wrapper">
        <div id="Hero_carousel" class="carousel slide carousel-fade">
            <div class="carousel-inner">
                @foreach ($sliders as $key => $slider)
                    <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                        @php
                            // detect file extension
                            $extension = pathinfo($slider->media, PATHINFO_EXTENSION);
                        @endphp
                        @if (in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                            <img src="{{ asset('storage/' . $slider->media) }}" alt="slider image" class="d-block w-100">
                        @elseif(strtolower($extension) === 'mp4')
                            <video class="d-block w-100" muted playsinline autoplay loop preload="none" poster="">
                                <source src="{{ asset('storage/' . $slider->media) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        @endif
                        <div class="carousle_caption_wrapper">
                            <span>{{ $slider->title_1 }}</span>
                            <h2>{{ $slider->title_2 }}</h2>
                            <div class="inside_caption_text">
                                {!! $slider->description !!}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#Hero_carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#Hero_carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>
    <section id="about_wrapper">
        <div class="container scroll-reveal from-left">
            <div class="row">
                <div class="col-lg-7 col-md-7">
                    <div class="about_content">
                        <h1>{{ strtoupper($welcome_message->main_title ?? '') }}</h1>
                        <h3 class="text_gradient">{{ $welcome_message->sub_title ?? '' }}</h3>
                        {!! Str::limit($welcome_message->description ?? '', 412) !!}
                    </div>
                </div>
                <div class="col-lg-5 col-md-5">
                    <div class="about_product_img">
                        <div class="img_cover">
                            <img src="{{ asset('storage/' . ($welcome_message->media ?? '')) }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="company_overview scroll-reveal from-right">
            <div class="container">
                <div class="row">
                    @foreach ($over_view as $record)
                        <div class="col-lg-3 col-sm-6">
                            <div class="message_card">
                                <div class="message_card_flex">
                                    <img src="{{ asset('storage/' . $record->media) }}" alt="">
                                    <span>{{ $record->name }}</span>
                                </div>
                                <div class="message_card_counter_value">
                                    {{ $record->counters_number }}
                                </div>
                                <div class="message_purpose">
                                    {{ $record->message }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
        <div class="link_button_wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-xl-7 m-auto col-lg-9">
                        <div class="d-flex justify-content-around">
                            <a class="btn btn-danger" href="{{ route('category', ['category' => 'about_us']) }}">More about
                                company
                                <span class="material-symbols-outlined">
                                    arrow_right_alt
                                </span>
                            </a>
                            <a class="btn btn-link text_gradient"
                                href="{{ route('category', ['category' => 'our_products']) }}">Explore our products
                                <span class="material-symbols-outlined">
                                    arrow_right_alt
                                </span>
                            </a>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="world_map_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section_header text-center">
                        <h2 class="text_gradient_header">Taking Nepal to the world</h2>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div id="map" style="height:720px;"></div>
                </div>
            </div>
        </div>
    </section>
    <section id="product_list_wrapper" style="background-image: url('{{ asset('frontend/img/shape4.png') }}')">
        <div class="container">
            <div class="row scroll-reveal from-left">
                <div class="col-lg-12">
                    <div class="section_header header_margin_1">
                        <h2 class="text_gradient_header">Our Products</h2>
                        <span>We are spreading our products throughout the world</span>
                    </div>
                </div>
                @php
                    $bgCount = $backgroundImage->count();
                @endphp

                @foreach ($our_products->take(3) as $index => $record)
                    @php
                        // Cycle background images using modulus
                        $image = $backgroundImage[$index % $bgCount];
                    @endphp

                    <div class="col-lg-4">
                        <div class="product_card" style="background-image: url('{{ asset('storage/' . $image->media) }}')">
                            <div class="product_img_wrappper">
                                <img src="{{ asset('storage/' . $record->media) }}" alt="">
                            </div>
                            <div class="product_card_caption">
                                <h4>{{ $record->name }}</h4>
                                {!! \Illuminate\Support\Str::limit($record->description, 100) !!}
                            </div>
                        </div>
                    </div>
                @endforeach




            </div>
            <div class="product_in_half scroll-reveal from-right">
                <div class="row">
                    @foreach ($our_products->skip(3)->take(2) as $index => $record)
                        @php
                            // Cycle background images using modulus
                            $image = $backgroundImage[$index % $bgCount];
                        @endphp
                        <div class="col-lg-6">
                            <div class="product_half_wrapper"
                                style="background-image: url('{{ asset('storage/' . $image->media) }}')">
                                <div class="product_card">
                                    <img src="{{ asset('storage/' . $record->media) }}" alt="">
                                    <div class="product_card_caption">
                                        <h4>{{ $record->name }}</h4>
                                        {!! \Illuminate\Support\Str::limit($record->description, 100) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <a class="btn btn-link text_gradient"
                            href="{{ route('category', ['category' => 'our_products']) }}">View all products
                            <span class="material-symbols-outlined">
                                arrow_right_alt
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="customer_says_wrapper"
        style="background-image: url('{{ asset('frontend/img/shape6.png') }}'), url('{{ asset('frontend/img/shape7.png') }}')">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section_header header_margin_1">
                        <h2 class="text_gradient_header">What our Customers says</h2>
                        <span>We are spreading our products throughout the world</span>
                    </div>
                </div>
                <div class="col-lg-12 scroll-reveal from-left">
                    <div class="tcl" role="region" aria-label="Testimonials">
                        <!-- LEFT: fixed slots -->
                        <div class="tc-stack">
                            <div id="slotPrev" class="tc-slot prev"></div>
                            <div id="slotCenter" class="tc-slot center"></div>
                            <div id="slotNext" class="tc-slot next"></div>
                        </div>

                        <!-- RIGHT: description of current (center) -->
                        <div class="tc-description_info">
                            <div class="tc-card">
                                <p id="tcQuote" class="tc-quote"></p>

                            </div>
                            <div class="tc-nav">
                                <button class="tc-btn tc-prev" aria-label="Previous">←</button>
                                <button class="tc-btn tc-next" aria-label="Next">→</button>
                            </div>
                        </div>

                    </div>

                    <!-- SOURCE LIST (real items live here; JS clones from here) -->
                    <div id="tcSource" hidden>

                        @foreach ($customersSays as $index => $record)
                            <div class="tc-item" data-index="{{ $index }}">
                                <a class="tc-avatar"><img src="{{ asset('storage/' . $record->media) }}"
                                        alt="Sophia Lee"></a>
                                <div class="tc-meta">
                                    <p class="tc-name">{{ $record->name }}</p>
                                    <p class="tc-role">{{ $record->position }}</p>
                                </div>
                                <div class="tc-desc" hidden>
                                    {!! \Illuminate\Support\Str::limit($record->message, 300) !!}
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="video_and_partner">
        <div class="container scroll-reveal from-right">
            <div class="row">
                <div class="col-lg-12">
                    <div class="video_cover_wrapper">
                        <div class="video-cover" id="cover1">
                            <!-- Play button overlay -->
                            @php
                                // detect file extension
                                $extension = pathinfo($promotionMedia->media ?? '', PATHINFO_EXTENSION);
                            @endphp
                            @if (in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                <img src="{{ asset('storage/' . $promotionMedia->media) }}" alt="Promotion image"
                                    class="d-block w-100">
                            @elseif(strtolower($extension) === 'mp4')
                                <button class="play" type="button" aria-label="Play video">
                                    <span class="material-symbols-outlined">play_circle</span>
                                </button>
                                <video class="d-block w-100" muted playsinline loop preload="none"
                                    poster="{{ asset('storage/' . $promotionMedia->cover_image) }}">
                                    <source src="{{ asset('storage/' . $promotionMedia->media) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="partner_cover_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section_header header_margin_1">
                        <h2 class="text_gradient_header">Our Partners</h2>
                        <span>We have been connected with the top companies around the country</span>
                    </div>
                </div>
                <div class="col-lg-12 scroll-reveal from-left" style="z-index: 9">
                    <div class="owl-carousel partnerlogo_carousel">
                        @foreach ($partners as $record)
                            <div class="logo_wrapper">
                                <div class="client_logo_wrapper">
                                    <img src="{{ asset('storage/' . $record->media) }}" alt="">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="sister_company_link">
        <div class="container">
            <div class="outside_wrapper scroll-reveal from-right">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="business_wrapper">
                            <div class="business_header">
                                <h2 class="text_gradient_header">{{ $sisterCompany->title ?? '' }}</h2>
                                <p>{{ $sisterCompany->subtitle ?? '' }}</p>
                            </div>
                            {!! \Illuminate\Support\Str::limit($sisterCompany->description ?? '', 400) !!}
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="sister_business_images">
                                    <img src="{{ asset('storage/' . ($sisterCompany->cover_image_one ?? '')) }}"
                                        alt="">
                                    <div class="sister_business_caption">
                                        <span>{{ $sisterCompany->cover_title_one ?? '' }}</span>
                                        <a class="btn btn-danger" href="{{ $sisterCompany->link_one ?? '' }}">
                                            Visit Us
                                            <span class="material-symbols-outlined">
                                                open_in_new
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <br>
                                <div class="sister_business_images">
                                    <img src="{{ asset('storage/' . ($sisterCompany->cover_image_two ?? '')) }}"
                                        alt="">
                                    <div class="sister_business_caption">
                                        <span>{{ $sisterCompany->cover_title_two ?? '' }}</span>
                                        <a class="btn btn-danger" href="{{ $sisterCompany->link_two ?? '' }}">
                                            Visit Us
                                            <span class="material-symbols-outlined">
                                                open_in_new
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        // --- Helper: decide text color based on image brightness ---
        function getTextColorBasedOnImage(img, targetElements) {
            if (!img || !targetElements || !targetElements.length) return;

            const width = img.naturalWidth;
            const height = img.naturalHeight;

            if (!width || !height) return; // image not ready

            const canvas = document.createElement('canvas');
            const ctx = canvas.getContext('2d');

            canvas.width = width;
            canvas.height = height;

            ctx.drawImage(img, 0, 0, width, height);

            let pixelData;
            try {
                pixelData = ctx.getImageData(0, 0, width, height).data;
            } catch (e) {
                console.error('Cannot read image pixels (CORS or security issue):', e);
                return;
            }

            let r = 0,
                g = 0,
                b = 0;
            let count = 0;

            for (let i = 0; i < pixelData.length; i += 16) {
                r += pixelData[i];
                g += pixelData[i + 1];
                b += pixelData[i + 2];
                count++;
            }

            if (!count) return;

            r /= count;
            g /= count;
            b /= count;

            const brightness = (r * 0.299 + g * 0.587 + b * 0.114);

            const color = brightness > 130 ? 'black' : 'white';

            // 🔥 Apply color to ALL nav links
            targetElements.forEach(el => {
                el.style.color = color;
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            const sliderImg = document.querySelector('#slider_wrapper .carousel-item img');

            // 👇 Select ALL nav links in navbar
            const navLinks = Array.from(
                document.querySelectorAll('.navbar-nav > .nav-item > .nav-link')
            );

            if (!sliderImg || navLinks.length === 0) {
                console.warn('Slider image or nav links not found.');
                return;
            }

            const run = function() {
                getTextColorBasedOnImage(sliderImg, navLinks);
            };

            if (sliderImg.complete && sliderImg.naturalWidth) {
                run();
            } else {
                sliderImg.addEventListener('load', run, {
                    once: true
                });
            }
        });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const carousel = document.getElementById('Hero_carousel');

            function runCaptionAnimation(item) {
                // find the caption in this slide
                const cap = item.querySelector('.carousle_caption_wrapper');
                if (!cap) return;

                // reset previous animation state
                cap.classList.remove('is-animating');
                // force reflow so re-adding the class restarts animation
                void cap.offsetWidth;

                // apply staggered delays to each direct child
                const kids = Array.from(cap.children);
                kids.forEach((el, i) => {
                    el.style.animationDelay = (i * 240) + 'ms'; // 0ms,120ms,240ms...
                });

                // trigger animation
                cap.classList.add('is-animating');
            }

            // Animate the initially active slide on load
            const initial = carousel.querySelector('.carousel-item.active');
            if (initial) runCaptionAnimation(initial);

            // On every slide change (after it finishes), animate the new one
            carousel.addEventListener('slid.bs.carousel', function(e) {
                // e.relatedTarget is the newly active .carousel-item
                runCaptionAnimation(e.relatedTarget);
            });

            // Optional: clean up the outgoing slide immediately as it starts sliding
            carousel.addEventListener('slide.bs.carousel', function(e) {
                const prev = e.from != null ?
                    carousel.querySelectorAll('.carousel-item')[e.from] :
                    carousel.querySelector('.carousel-item.active');

                if (prev) {
                    const capPrev = prev.querySelector('.carousle_caption_wrapper');
                    if (capPrev) {
                        capPrev.classList.remove('is-animating');
                        Array.from(capPrev.children).forEach(el => el.style.animationDelay = '10ms');
                    }
                }
            });
        });
    </script>

    <script>
        (function() {
            const el = document.getElementById('Hero_carousel');
            if (!el) return;

            const MAX_DEG = 70; // how much to flip (0–90)
            const MAX_PUSH_Z = -120; // push slightly “into” the screen as it flips
            const MAX_SHIFT_Y = -20; // tiny upward nudge while flipping
            const DIM_OPACITY = 0.15; // slight dim while exiting (0.0 = no dim)

            let ticking = false;

            function clamp(v, a, b) {
                return Math.max(a, Math.min(b, v));
            }

            function update() {
                ticking = false;
                const rect = el.getBoundingClientRect();
                const vh = window.innerHeight || 800;

                // Only start flipping after the section's top has moved above the viewport top
                if (rect.top < 0) {
                    // progress 0 → 1 as it scrolls up by ~80% of its height (or up to 75% viewport)
                    const base = Math.min(rect.height, vh * 0.75) * 0.8;
                    const p = clamp((-rect.top) / (base || 1), 0, 1);

                    const angle = p * MAX_DEG;
                    const tz = p * MAX_PUSH_Z;
                    const ty = p * MAX_SHIFT_Y;
                    const fade = 1 - p * DIM_OPACITY;

                    el.style.transform =
                        `perspective(1200px) rotateX(${angle}deg) translateY(${ty}px) translateZ(${tz}px)`;
                    el.style.opacity = fade;
                } else {
                    // fully reset while in/entering viewport
                    el.style.transform = `perspective(1200px) rotateX(0deg) translateY(0) translateZ(0)`;
                    el.style.opacity = 1;
                }
            }

            function onScroll() {
                if (!ticking) {
                    ticking = true;
                    requestAnimationFrame(update);
                }
            }

            window.addEventListener('scroll', onScroll, {
                passive: true
            });
            window.addEventListener('resize', onScroll, {
                passive: true
            });
            onScroll(); // initial
        })();
    </script>

    <script>
        (async () => {
            const topology = await fetch(
                'https://code.highcharts.com/mapdata/custom/world-highres.topo.json'
            ).then(response => response.json());

            // Country color data (join by hc-key)
            const data = [{
                    'hc-key': 'np',
                    color: '#ffa500',
                    info: 'Nepal distribution hub'
                },
                {
                    'hc-key': 'au',
                    color: '#9ccef9',
                    info: 'Australia distribution hub'
                },
                {
                    'hc-key': 'gb',
                    color: '#9ccef9',
                    info: 'UK distribution hub'
                },
                {
                    'hc-key': 'jp',
                    color: '#9ccef9',
                    info: 'Japan distribution hub'
                },
                {
                    'hc-key': 'dk',
                    color: '#9ccef9',
                    info: 'Denmark distribution hub'
                },
                {
                    'hc-key': 'mt',
                    color: '#9ccef9',
                    info: 'Malta distribution hub'
                },
                {
                    'hc-key': 'hk',
                    color: '#9ccef9',
                    info: 'Hong Kong distribution hub'
                },
                {
                    'hc-key': 'ae',
                    color: '#9ccef9',
                    info: 'Dubai/UAE distribution hub'
                },
                {
                    'hc-key': 'kr',
                    color: '#9ccef9',
                    info: 'South Korea distribution hub'
                },
                {
                    'hc-key': 'cy',
                    color: '#9ccef9',
                    info: 'Cyprus distribution hub'
                },
                {
                    'hc-key': 'ca',
                    color: '#9ccef9',
                    info: 'Canada distribution hub'
                },
                {
                    'hc-key': 'us',
                    color: '#9ccef9',
                    info: 'USA distribution hub'
                }
            ];

            const origin = [85.32, 27.71]; // Nepal
            const USA = [-100.4, 39.7];
            const CAN = [-106.3, 56.1];

            function lineString(coords) {
                return {
                    geometry: {
                        type: 'LineString',
                        coordinates: coords
                    },
                    className: 'animated-line'
                };
            }

            function viaAtlantic(from, to) {
                const [lon2, lat2] = to;
                const cp1 = [30, 45]; // यूरोप नजिक (इटाली/बाल्कन माथि झैँ)
                const cp2 = [-20, 40]; // एटलान्टिकको बीचतिर
                return [from, cp1, cp2, [lon2, lat2]];
            }

            // --- Important fix ---
            // Instead of trying to "unwrap" Americas with a single segment (which overflows/crosses the seam),
            // we split any seam-crossing route into TWO segments so it never overflows or vanishes at ±180°.

            // Build route segments (list of LineStrings)
            function lineString(coords) {
                return {
                    geometry: {
                        type: 'LineString',
                        coordinates: coords
                    },
                    className: 'animated-line'
                };
            }

            const routes = [
                lineString([origin, [133, -25]]), // Australia
                lineString([origin, [139.69, 35.68]]), // Japan
                lineString([origin, [10, 56]]), // Denmark
                lineString([origin, [14.5, 35.9]]), // Malta
                lineString([origin, [114.2, 22.3]]), // Hong Kong
                lineString([origin, [54.3, 24.4]]), // UAE/Dubai
                lineString([origin, [127.9, 36]]), // South Korea
                lineString([origin, [33, 35]]), // Cyprus
                lineString([origin, [-3, 55]]), // UK

                lineString(viaAtlantic(origin, USA)), // Nepal → Atlantic → USA
                lineString(viaAtlantic(origin, CAN)) // Nepal → Atlantic → Canada
            ];


            Highcharts.mapChart('map', {
                chart: {
                    map: topology
                },
                title: {
                    text: 'We are spreading our products throughout the world'
                },
                legend: {
                    enabled: false
                },

                tooltip: {
                    headerFormat: '<b>{point.name}</b><br/>',
                    pointFormat: '{point.info}'
                },

                mapView: {
                    fitToGeometry: {
                        type: 'MultiPoint',
                        coordinates: [
                            [-25, 133], // Australia
                            [55, -3], // UK
                            [36, 139], // Japan
                            [56, 10], // Denmark
                            [35.9, 14.5], // Malta
                            [22.3, 114.2], // Hong Kong
                            [24.4, 54.3], // UAE/Dubai
                            [36, 127.9], // South Korea
                            [35, 33], // Cyprus
                            [56.1, -106.3], // Canada
                            [39.7, -100.4], // USA
                            [0, 85] // Arctic frame
                        ]
                    }
                },

                series: [
                    // Base map layer with your colored countries
                    {
                        type: 'map',
                        name: 'Distribution Countries',
                        mapData: topology,
                        data,
                        joinBy: 'hc-key',
                        states: {
                            hover: {
                                color: '#e8f9ef'
                            }
                        }
                    },

                    // Animated route lines (brown)
                    {
                        type: 'mapline',
                        name: 'Routes',
                        lineWidth: 2,
                        color: '#8B4513',
                        enableMouseTracking: false,
                        data: routes
                    },

                    // Markers (origin + destinations)
                    {
                        type: 'mappoint',
                        color: '#333',
                        enableMouseTracking: false,
                        dataLabels: {
                            format: '<b>{point.name}</b><br><span style="opacity:.6">{point.custom.arrival}</span>',
                            align: 'left',
                            verticalAlign: 'middle'
                        },
                        data: [{
                                name: 'Nepal (Origin)',
                                geometry: {
                                    type: 'Point',
                                    coordinates: origin
                                },
                                custom: {
                                    arrival: 2025
                                },
                                dataLabels: {
                                    align: 'right'
                                }
                            },
                            {
                                name: 'Australia',
                                geometry: {
                                    type: 'Point',
                                    coordinates: [133, -25]
                                },
                                custom: {
                                    arrival: 2025
                                }
                            },
                            {
                                name: 'UK',
                                geometry: {
                                    type: 'Point',
                                    coordinates: [-3, 55]
                                },
                                custom: {
                                    arrival: 2025
                                }
                            },
                            {
                                name: 'Japan',
                                geometry: {
                                    type: 'Point',
                                    coordinates: [139.69, 35.68]
                                },
                                custom: {
                                    arrival: 2025
                                }
                            },
                            {
                                name: 'Denmark',
                                geometry: {
                                    type: 'Point',
                                    coordinates: [10, 56]
                                },
                                custom: {
                                    arrival: 2025
                                }
                            },
                            {
                                name: 'Malta',
                                geometry: {
                                    type: 'Point',
                                    coordinates: [14.5, 35.9]
                                },
                                custom: {
                                    arrival: 2025
                                }
                            },
                            {
                                name: 'Hong Kong',
                                geometry: {
                                    type: 'Point',
                                    coordinates: [114.2, 22.3]
                                },
                                custom: {
                                    arrival: 2025
                                }
                            },
                            {
                                name: 'UAE/Dubai',
                                geometry: {
                                    type: 'Point',
                                    coordinates: [54.3, 24.4]
                                },
                                custom: {
                                    arrival: 2025
                                }
                            },
                            {
                                name: 'South Korea',
                                geometry: {
                                    type: 'Point',
                                    coordinates: [127.9, 36]
                                },
                                custom: {
                                    arrival: 2025
                                }
                            },
                            {
                                name: 'Cyprus',
                                geometry: {
                                    type: 'Point',
                                    coordinates: [33, 35]
                                },
                                custom: {
                                    arrival: 2025
                                }
                            },
                            {
                                name: 'Canada',
                                geometry: {
                                    type: 'Point',
                                    coordinates: [-106.3, 56.1]
                                },
                                custom: {
                                    arrival: 2025
                                }
                            },
                            {
                                name: 'USA',
                                geometry: {
                                    type: 'Point',
                                    coordinates: [-100.4, 39.7]
                                },
                                custom: {
                                    arrival: 2025
                                }
                            }
                        ]
                    }
                ]
            });
        })();
    </script>



    <script>
        (function() {
            document.querySelectorAll('.video-cover').forEach(wrapper => {
                const btn = wrapper.querySelector('.play');
                const video = wrapper.querySelector('video');

                // Start playback from the beginning on click
                btn.addEventListener('click', () => {
                    wrapper.classList.add('is-playing');
                    try {
                        video.currentTime = 0; // ensure from start
                    } catch (e) {}
                    const p = video.play();
                    if (p && typeof p.catch === 'function') {
                        p.catch(err => {
                            // If the browser blocked it for some reason, show the button again
                            wrapper.classList.remove('is-playing');
                            console.error('Playback failed:', err);
                        });
                    }
                });

                // When video ends, reset to poster + show button again
                video.addEventListener('ended', () => {
                    video.pause();
                    // Reset to first frame
                    try {
                        video.currentTime = 0;
                    } catch (e) {}
                    // Re-assert poster (some browsers need a reflow to show poster again)
                    const poster = video.getAttribute('poster');
                    video.removeAttribute('poster');
                    // small async tick to force repaint
                    requestAnimationFrame(() => {
                        video.setAttribute('poster', poster);
                        wrapper.classList.remove('is-playing');
                    });
                });
            });
        })();
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', () => {

            // Only enable scroll reveal on large screens
            if (window.innerWidth < 1200) {
                // For small devices instantly show elements
                document.querySelectorAll('.scroll-reveal').forEach(el => {
                    el.classList.add('show');
                });
                return; // Stop the animation code
            }

            // --- Animation for screens 1200px and above ---
            const els = document.querySelectorAll('.scroll-reveal');

            const io = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('show');
                    } else {
                        entry.target.classList.remove('show');
                    }
                });
            }, {
                threshold: 0.30,
                rootMargin: '0px 0px -15% 0px'
            });

            els.forEach(el => io.observe(el));
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Grab source items (real data only lives here)
            const source = document.getElementById('tcSource');
            if (!source) {
                console.warn('tcSource not found in DOM.');
                return;
            }

            const items = Array.from(source.querySelectorAll('.tc-item'));
            if (!items.length) {
                console.warn('No .tc-item elements found inside #tcSource.');
                return;
            }

            // Helpers
            const wrap = (i, len) => (i % len + len) % len;

            // Slots (we will insert CLONES here each time)
            const slotPrev = document.getElementById('slotPrev');
            const slotCenter = document.getElementById('slotCenter');
            const slotNext = document.getElementById('slotNext');

            // UI
            const quoteEl = document.getElementById('tcQuote');
            const prevBtn = document.querySelector('.tc-prev');
            const nextBtn = document.querySelector('.tc-next');

            if (!slotPrev || !slotCenter || !slotNext || !quoteEl || !prevBtn || !nextBtn) {
                console.warn('Testimonial carousel: required elements missing.');
                return;
            }

            // Default center: middle of first three (index 1) if >=3, else 0
            let current = items.length >= 3 ? 1 : 0;

            function cloneInto(slotEl, itemIdx, makeFocusable = false) {
                slotEl.innerHTML = ''; // clear old
                const clone = items[itemIdx].cloneNode(true);

                // Clicking avatar in any slot should re-center to THAT real index
                const avatar = clone.querySelector('.tc-avatar');
                if (avatar) {
                    if (!avatar.getAttribute('href')) {
                        avatar.setAttribute('role', 'button');
                        avatar.setAttribute('tabindex', '0');
                    }
                    avatar.addEventListener('click', () => render(itemIdx));
                    avatar.addEventListener('keydown', (e) => {
                        if (e.key === 'Enter' || e.key === ' ') {
                            e.preventDefault();
                            render(itemIdx);
                        }
                    });
                }
                slotEl.appendChild(clone);

                if (makeFocusable && avatar) {
                    requestAnimationFrame(() => {
                        avatar.focus({
                            preventScroll: true
                        });
                    });
                }
            }

            function render(centerIdx) {
                if (!items.length) return;
                current = wrap(centerIdx, items.length);

                const prevIdx = wrap(current - 1, items.length);
                const nextIdx = wrap(current + 1, items.length);

                // Fill fixed slots with CLONES so order is always prev / center / next
                cloneInto(slotPrev, prevIdx, false);
                cloneInto(slotCenter, current, true);
                cloneInto(slotNext, nextIdx, false);

                // Description from the REAL center item
                const desc = items[current].querySelector('.tc-desc');
                if (quoteEl) {
                    quoteEl.textContent = desc ? desc.textContent.trim() : '';
                }
            }

            // Controls (wrap-around → first/last also land center-active)
            prevBtn.addEventListener('click', () => render(current - 1));
            nextBtn.addEventListener('click', () => render(current + 1));

            // Keyboard arrows
            document.addEventListener('keydown', (e) => {
                if (e.key === 'ArrowRight') render(current + 1);
                if (e.key === 'ArrowLeft') render(current - 1);
            });

            // Init
            render(current);
        });
    </script>
@endpush
