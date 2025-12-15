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
    <section id="our_product_page_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="mobile_view mb-3">
                        <select id="mobile_menu" class="form-select">
                            <option value="pills-home" data-bs-target="#pills-home">All ({{ $products->count() }})</option>
                            @foreach ($categories as $cat)
                                @php
                                    $catProducts = $products->where('category_id', $cat->id);
                                @endphp
                                @if ($catProducts->count() > 0)
                                    <option value="{{ Str::slug($cat->name, '-') }}"
                                        data-bs-target="#{{ Str::slug($cat->name, '-') }}">
                                        {{ $cat->name }} ({{ $catProducts->count() }})
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="product_tab_wrapper">
                        <ul class="nav nav-pills for_desktop" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                                    aria-selected="true">All
                                    <span
                                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        ({{ $products->count() }})
                                    </span>
                                </button>
                            </li>
                            @foreach ($categories as $cat)
                                @php
                                    $catProducts = $products->where('category_id', $cat->id);
                                @endphp
                                @if ($catProducts->count() > 0)
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="{{ Str::slug($cat->name, '-') }}-tab"
                                            data-bs-toggle="pill" data-bs-target="#{{ Str::slug($cat->name, '-') }}"
                                            type="button" role="tab" aria-controls="{{ Str::slug($cat->name, '-') }}"
                                            aria-selected="false">{{ $cat->name }}
                                            <span
                                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                                ({{ $catProducts->count() }})
                                            </span>
                                        </button>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            @php
                                $bgCount = $backgroundImage->count();
                            @endphp
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                aria-labelledby="pills-home-tab" tabindex="0">
                                <div class="product_list">
                                    <div class="row">

                                        @foreach ($products as $index => $item)
                                            @php
                                                // Cycle background images using modulus
                                                $image = $backgroundImage[$index % $bgCount];
                                            @endphp
                                            <div class="col-lg-3 col-md-4 col-sm-6">
                                                <div class="single_product_item">
                                                    <div class="product_img"
                                                        style="background-image: url('{{ asset('storage/' . $image->media) }}');">
                                                        <img src="{{ asset('storage/' . $item->media) }}"
                                                            alt="product image">
                                                    </div>
                                                    <div class="product_info">
                                                        <h3>{{ $item->name ?? '' }}</h3>
                                                        <p>{{ $item->gram ?? '' }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                            </div>
                            @foreach ($categories as $cat)
                                @php
                                    $catProducts = $products->where('category_id', $cat->id);
                                @endphp
                                @if ($catProducts->count() > 0)
                                    <div class="tab-pane fade" id="{{ Str::slug($cat->name, '-') }}" role="tabpanel"
                                        aria-labelledby="{{ Str::slug($cat->name, '-') }}-tab" tabindex="0">
                                        <div class="product_list">
                                            <div class="row">
                                                @foreach ($catProducts as $index => $item)
                                                    @php
                                                        // Cycle background images using modulus
                                                        $image = $backgroundImage[$index % $bgCount];
                                                    @endphp
                                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                                        <div class="single_product_item">
                                                            <div class="product_img"
                                                                style="background-image: url('{{ asset('storage/' . $image->media) }}');">
                                                                <img src="{{ asset('storage/' . $item->media) }}"
                                                                    alt="product image">
                                                            </div>
                                                            <div class="product_info">
                                                                <h3>{{ $item->name ?? '' }}</h3>
                                                                <p>{{ $item->gram ?? '' }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const select = document.getElementById('mobile_menu');
            if (!select) return;

            select.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                const targetSelector = selectedOption.getAttribute('data-bs-target');
                if (!targetSelector) return;

                // Find the corresponding tab button
                const tabTriggerEl = document.querySelector(
                    `[data-bs-toggle="pill"][data-bs-target="${targetSelector}"]`
                );

                if (tabTriggerEl) {
                    // Use Bootstrap's Tab API
                    const tab = new bootstrap.Tab(tabTriggerEl);
                    tab.show();
                }

                // (Optional) scroll to tab area on mobile
                // document.getElementById('pills-tabContent').scrollIntoView({ behavior: 'smooth' });
            });
        });
    </script>
@endpush
