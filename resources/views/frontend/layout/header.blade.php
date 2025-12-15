<header id="site_header_wrapper">
    <nav class="navbar navbar-expand-lg" id="menu">
        <div class="container">

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="mobile_logo" href="{{ url('/') }}">
                <img src="{{ asset('storage/' . ($site_setting->media ?? '')) }}" alt="">
            </a>
            <div class="collapse navbar-collapse {{ request()->is('/') ? '' : 'txt_color' }}"
                id="navbarSupportedContent">
                <div class="row w-100">
                    <div class="col-lg-5">
                        <div class="d-flex">

                            @if (count($menus) > 0)
                                <ul class="navbar-nav me-auto mb-2 mb-lg-0 left_ul_navigation menu_top_position">
                                    @foreach ($menus->take(3) as $menu)
                                        @if (!$menu->status == 0)
                                            <li class="nav-item">

                                                <a class="nav-link {{ isActiveMenu($menu->category_slug) }}"
                                                    @if ($menu->category_slug == 'page')
                                                        href="{{ $menu->external_link ?? route('page', $menu->title_slug) }}"
                                                    @else
                                                        href="{{ $menu->external_link ?? route('category', $menu->category_slug) }}"
                                                    @endif>{{ Str::ucfirst($menu->menu_name) }}</a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <a class="custom_navbar_brand" href="{{ url('/') }}">
                            <img src="{{ asset('storage/' . ($site_setting->media ?? '')) }}" alt="">
                        </a>
                    </div>
                    <div class="col-lg-5">
                        <div class="d-flex">
                            @if (count($menus) > 0)
                                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 right_ul_navigation menu_top_position">
                                    @foreach ($menus->skip(3)->take(3) as $menu)
                                        @if (!$menu->status == 0)
                                            <li class="nav-item">

                                                <a class="nav-link {{ isActiveMenu($menu->category_slug) }}"
                                                    @if ($menu->category_slug == 'page')
                                                        href="{{ $menu->external_link ?? route('page', $menu->title_slug) }}"
                                                    @else
                                                        href="{{ $menu->external_link ?? route('category', $menu->category_slug) }}"
                                                    @endif>{{ Str::ucfirst($menu->menu_name) }}</a>
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
    </nav>

</header>
@push('scripts')
    <script>
        window.addEventListener("scroll", function() {
            let menu = document.getElementById("menu");

            if (window.scrollY > 50) {
                // Add class when scroll is more than 50px
                menu.classList.add("scrolled");
            } else {
                // Remove class when back to top
                menu.classList.remove("scrolled");
            }
        });
    </script>
    <script>
        (() => {
            const OUTSET = 6; // outside distance
            const THICK = 2.5; // stroke width
            const SEG = 42; // segment length (px)
            const LAP = 3600; // ms per lap

            function roundedPath(w, h, r) {
                r = Math.max(0, Math.min(r, Math.min(w, h) / 2));
                const x0 = 0,
                    y0 = 0,
                    x1 = w,
                    y1 = h;
                return `M ${x0+r},${y0} H ${x1-r} A ${r},${r} 0 0 1 ${x1},${y0+r} V ${y1-r} A ${r},${r} 0 0 1 ${x1-r},${y1} H ${x0+r} A ${r},${r} 0 0 1 ${x0},${y1-r} V ${y0+r} A ${r},${r} 0 0 1 ${x0+r},${y0} Z`;
            }

            function mount(link) {
                const ns = 'http://www.w3.org/2000/svg';
                const svg = document.createElementNS(ns, 'svg');
                svg.classList.add('pill-trace-svg');

                const path = document.createElementNS(ns, 'path');
                path.classList.add('pill-path');

                const stroke = document.createElementNS(ns, 'path');
                stroke.classList.add('pill-stroke');

                svg.append(path, stroke);
                link.appendChild(svg);

                function layout() {
                    const w = link.offsetWidth,
                        h = link.offsetHeight;
                    svg.style.inset = `-${OUTSET}px`;
                    svg.style.width = `${w + OUTSET*2}px`;
                    svg.style.height = `${h + OUTSET*2}px`;

                    const cs = getComputedStyle(link);
                    const r = Math.max(
                        parseFloat(cs.borderTopLeftRadius) || 0,
                        parseFloat(cs.borderTopRightRadius) || 0,
                        parseFloat(cs.borderBottomRightRadius) || 0,
                        parseFloat(cs.borderBottomLeftRadius) || 0
                    ) + OUTSET;

                    const pw = w + OUTSET * 2,
                        ph = h + OUTSET * 2;
                    const d = roundedPath(pw, ph, Math.min(r, Math.min(pw, ph) / 2));
                    path.setAttribute('d', d);
                    stroke.setAttribute('d', d);
                    stroke.setAttribute('stroke-width', THICK);

                    const len = stroke.getTotalLength();
                    // segment + gap pattern; tiny epsilon prevents “wrap blip”
                    const gap = Math.max(1, len - SEG) + 0.1;
                    stroke.style.setProperty('--lap', LAP + 'ms');
                    stroke.style.setProperty('--negLen', -len);

                    stroke.setAttribute('stroke-dasharray', `${SEG} ${gap}`);
                    stroke.setAttribute('stroke-dashoffset', '0');
                }

                const ro = new ResizeObserver(layout);
                ro.observe(link);
                layout();
            }

            document.querySelectorAll('.pill-trace').forEach(mount);
        })();
    </script>
@endpush
