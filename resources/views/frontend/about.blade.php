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
    <section id="our_story_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="our_story_content_wrapper">
                        <h1 class="text_gradient_header">{{$story->title ?? ''}}</h1>
                        {!! \Illuminate\Support\Str::limit(
                            $story->content ?? '',
                            670,
                            '[<a href="" data-bs-toggle="modal" data-bs-target="#ourStory">Read More</a>]',
                        ) !!}
                    </div>
                    <a class="btn btn-link text_gradient"
                        href="{{ route('category', ['category' => 'contact_us']) }}">Become a dealer
                        <span class="material-symbols-outlined">
                            arrow_right_alt
                        </span>
                    </a>
                </div>
                <div class="offset-lg-1 col-lg-5">
                    <div class="our_story_img_wrapper">
                        <!-- Replace images/photo.jpg with your image -->
                        <div class="mosaic" style="--img: url('{{ asset('storage/' . ($story->media ?? '')) }}')">
                            <div class="piece tl"></div>
                            <div class="piece tr"></div>
                            <div class="piece bl"></div>
                            <div class="piece br"></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="about_page_product">
        <div class="container">
            <div class="row">
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
            <div class="product_in_half">
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
    <section id="deliverTogether_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="side_info_wrapper">
                        <h3>Together,<br>
                            We Deliver
                        </h3>
                        <p>Expanding our reach with quality products, trusted dealers, and valued partnerships.</p>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="owl-carousel partnerlogo_carousel">
                                @foreach ($partners as $record)
                                    <div class="logo_wrapper">
                                        <div class="client_logo_wrapper blur_background">
                                            <img src="{{ asset('storage/' . $record->media) }}" alt="">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="in_about_counter">
                        <div class="row">
                            @foreach ($over_view as $record)
                                <div class="col-lg-3">
                                    <div class="about_message_card">
                                        <div class="message_card">
                                            <div class="message_card_counter_value">
                                                {{ $record->counters_number }}
                                            </div>
                                            <div class="message_purpose">
                                                {{ $record->message }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <section id="about_customer_says_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section_header header_margin_1">
                        <h2 class="text_gradient_header">What our Customers says</h2>
                        <span>We are spreading our products throughout the world</span>
                    </div>
                </div>
                <div class="col-lg-12">
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
@endsection


<!-- our Story Modal -->
<div class="modal fade" id="ourStory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body">
                <div class="modal-header text-center">
                    <h1 class="modal-title fs-5 " id="exampleModalLabel">{{ $story->title ?? ''}}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                 {!! $story->content ?? '' !!}
            </div>

        </div>
    </div>
</div>
@push('scripts')
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
