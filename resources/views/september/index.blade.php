@extends('themes::september.layout')

@php
use Ophim\Core\Models\Movie;

$recommendations = Cache::remember('site.movies.recommendations', setting('site_cache_ttl', 5 * 60), function () {
    return Movie::where('is_recommended', true)
        ->limit(setting('site.movies.recommendations.limit', 5))
        ->get()
        ->sortBy([
            function ($a, $b) {
                return $a['name'] <=> $b['name'];
            },
        ]);
});

$data = Cache::remember('site.movies.latest', setting('site_cache_ttl', 5 * 60), function () {
    $lists = preg_split('/[\n\r]+/', get_theme_option('latest'));
    $data = [];
    foreach ($lists as $list) {
        if (trim($list)) {
            $list = explode('|', $list);
            [$label, $relation, $field, $val, $limit, $link] = array_merge($list, ['Phim  mới cập nhật', '', 'type', 'series', 8, '/']);
            try {
                $data[] = [
                    'label' => $label,
                    'data' => Movie::when($relation, function ($query) use ($relation, $field, $val) {
                        $query->whereHas($relation, function ($rel) use ($field, $val) {
                            $rel->where($field, $val);
                        });
                    })
                        ->when(!$relation, function ($query) use ($field, $val) {
                            $query->where($field, $val);
                        })
                        ->limit($limit)
                        ->orderBy('updated_at', 'desc')
                        ->get(),
                    'link' => $link ?: '#',
                ];
            } catch (\Exception $e) {
            }
        }
    }
    return $data;
});

@endphp

@section('content')
    @if (count($recommendations))
        <div class="owl-carousel recommend-carousel owl-theme">
            @foreach ($recommendations as $movie)
                @include('themes::september.inc.movie_card_recommend')
            @endforeach
        </div>
    @endif

    @foreach ($data as $item)
        <div class="mb-5 ">
            <div class="section-heading flex bg-[#151111] rounded-lg p-0 mb-3 justify-between content-between">
                <h2 class="inline p-1.5 bg-red-600 to-red-600 rounded-l-lg">
                    <span class="h-text text-white uppercase">{{ $item['label'] }}</span>
                </h2>
                <a class="inline uppercase self-center pr-3" href="{{ $item['link'] }}"><span
                        class="text-white hover:text-yellow-300">Xem
                        Thêm</span>
                </a>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-2">
                @foreach ($item['data'] ?? [] as $movie)
                    @include('themes::september.inc.movie_card')
                @endforeach
            </div>
        </div>
    @endforeach
@endsection

@push("header")
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".recommend-carousel").owlCarousel({
                items: 1,
                center: false,
                loop: true,
                dots: false,
                nav:true,
                margin: 10,
                stagePadding:0,
                stageOuterClass: 'owl-stage-outer',
                responsive: {
                    1280: {
                        items: 4
                    },
                    1024: {
                        items: 3
                    },
                    768: {
                        items: 2
                    },
                },
                scrollPerPage: true,
                lazyLoad: true,
                slideSpeed: 800,
                paginationSpeed: 400,
                stopOnHover: true,
                autoplay: true,
                navText: [
                    `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="absolute top-1/3 left-0 text-red-500 bg-gradient-to-r from-[#151111] w-8 h-8"><path stroke-linecap="round" stroke-linejoin="round" d="M18.75 19.5l-7.5-7.5 7.5-7.5m-6 15L5.25 12l7.5-7.5" /></svg>`,
                    `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="absolute top-1/3 right-0 text-red-500 bg-gradient-to-l from-[#151111] w-8 h-8"><path stroke-linecap="round" stroke-linejoin="round" d="M11.25 4.5l7.5 7.5-7.5 7.5m-6-15l7.5 7.5-7.5 7.5" /></svg>`],
            });
        });
    </script>
@endpush

