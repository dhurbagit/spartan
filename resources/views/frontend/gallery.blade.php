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

    <section id="gallery_page_wrapper">
        <div class="container">
            <div id="static-thumbnails">
                <div class="row">
                    @if ($gallery->count() > 0)
                        @foreach ($gallery as $record)
                            <div class="col-lg-4 col-md-4 col-sm-6">
                                <div class="gallery_page_content_wrapper">
                                    <a href="{{ asset('storage/'. $record->media) }}">
                                        <img src="{{ asset('storage/'. $record->media) }}" alt="{{ $record->title }}">
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <span class="no_vacancy">
                            No gallery available
                        </span>
                    @endif

                </div>
            </div>
        </div>
    </section>
@endsection
