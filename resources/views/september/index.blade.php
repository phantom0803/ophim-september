@extends('themes::september.layout')

@php
use Ophim\Core\Models\Movie;

$recommendations = Cache::remember('site.movies.recommendations', setting('site_cache_ttl', 5 * 60), function () {
    return Movie::where('is_recommended', true)
        ->limit(get_theme_option('recommendations_limit', 10))
        ->orderBy('updated_at', 'desc')
        ->get();
});

$data = Cache::remember('site.movies.latest', setting('site_cache_ttl', 5 * 60), function () {
    $lists = preg_split('/[\n\r]+/', get_theme_option('latest'));
    $data = [];
    foreach ($lists as $list) {
        if (trim($list)) {
            $list = explode('|', $list);
            [$label, $relation, $field, $val, $limit, $link, $template] = array_merge($list, ['Phim mới cập nhật', '', 'type', 'series', 8, '/', 'section_thumb']);
            try {
                $data[] = [
                    'label' => $label,
                    'template' => $template,
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

@section('slider_recommended')
    @if (count($recommendations))
        <div class="container mx-auto px-2 md:px-0">
            <section class="w-full mt-2">
                <div class="flex justify-between">
                    <div class="py-2 w-max">
                        <h3
                            class="text-base md:text-2xl uppercase font-semibold text-transparent bg-clip-text bg-gradient-to-r from-[#7367F0] to-[#8e84fc]">
                            Phim HOT</h3>
                    </div>
                </div>

                <div id="slider_recommend" class="owl-carousel owl-theme absolute">
                    @foreach ($recommendations ?? [] as $movie)
                        <a href="{{ $movie->getUrl() }}" title="{{ $movie->name ?? '' }}"
                            class="row-span-1 col-span-1 md:row-span-2 md:col-span-2 overflow-hidden relative group">
                            <img style="aspect-ratio: 256/340" src="{{ $movie->thumb_url }}" alt="{{ $movie->name ?? '' }}"
                                class="group-hover:opacity-60 transition-all duration-500 transform group-hover:bg-opacity-60" />
                            <span
                                class="absolute bottom-0 px-2 pb-2 pt-16 bg-gradient-to-t from-main-900 w-full text-main-warning">
                                <div class="font-bold overflow-hidden overflow-ellipsis whitespace-nowrap">
                                    {{ $movie->name }}
                                </div>
                                <div
                                    class="text-sm text-gray-300 italic overflow-hidden overflow-ellipsis whitespace-nowrap">
                                    {{ $movie->origin_name }} ({{ $movie->publish_year }})
                                </div>
                            </span>
                            <span
                                class="absolute top-0 left-0 p-0.5 bg-main-primary text-sm">{{ $movie->episode_current }}</span>
                        </a>
                    @endforeach
                </div>
            </section>
        </div>
    @endif
@endsection

@section('content')
    @foreach ($data as $item)
        <section class="w-full mt-2">
            <div class="flex justify-between">
                <div class="py-2 w-max">
                    <h3
                        class="text-base md:text-2xl uppercase font-semibold text-transparent bg-clip-text bg-gradient-to-r from-[#7367F0] to-[#8e84fc]">
                        {{ $item['label'] }}</h3>
                    <div class="w-full h-0.5 bg-main-indigo bg-gradient-to-r from-[#7367F0] to-[#8e84fc]"></div>
                </div>

                <a href="{{ $item['link'] }}" title="{{ $item['label'] }}">
                    <div class="px-2 py-2 flex gap-x-2 text-md text-main-purple hover:text-main-orange items-center">
                        <span>Xem thêm</span>
                        <i class="fa-light fa-chevrons-right"></i>
                    </div>
                </a>
            </div>
            @include('themes::september.inc.section.' . $item['template'])
        </section>
    @endforeach
@endsection

@section('footer')
    @parent
    <link rel="stylesheet" href="/themes/september/plugins/owlcarousel/owl.carousel.min.css">
    <link rel="stylesheet" href="/themes/september/plugins/owlcarousel/owl.theme.default.min.css">
    <script src="/themes/september/plugins/owlcarousel/owl.carousel.min.js"></script>
    @if (count($recommendations))
        <script>
            $(document).ready(function() {
                $("#slider_recommend").owlCarousel({
                    items: 2,
                    center: false,
                    loop: true,
                    dots: false,
                    nav: true,
                    margin: 10,
                    stagePadding: 0,
                    stageOuterClass: 'owl-stage-outer',
                    responsive: {
                        1400: {
                            items: 8
                        },
                        1280: {
                            items: 6
                        },
                        1024: {
                            items: 4
                        },
                        768: {
                            items: 3
                        },
                    },
                    scrollPerPage: true,
                    // lazyLoad: true,
                    slideSpeed: 800,
                    paginationSpeed: 400,
                    stopOnHover: true,
                    autoplay: true,
                    navText: [
                        `<button class="block absolute top-0 left-0 text-white bg-main-900/60 h-[90%]">
                        <i class="fa-light px-1 fa-angles-left top-0 text-2xl"></i>
                    </button>`,
                        `<button class="block absolute top-0 right-0 text-white bg-main-900/60 h-[90%]">
                        <i class="fa-light px-1 fa-angles-right top-0 text-2xl"></i>
                    </button>`
                    ],
                });
            });
        </script>
    @endif
@endsection
