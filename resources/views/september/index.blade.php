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

@section("footer")
    @parent
    <link rel="stylesheet" href="/themes/september/plugins/owlcarousel/owl.carousel.min.css">
    <link rel="stylesheet" href="/themes/september/plugins/owlcarousel/owl.theme.default.min.css">
    <script src="/themes/september/plugins/owlcarousel/owl.carousel.min.js"></script>
@endsection
