@extends('themes::layout')
@php
$menu = \Ophim\Core\Models\Menu::getTree();
$tops = Cache::remember('site.movies.tops', setting('site_cache_ttl', 5 * 60), function () {
    $lists = preg_split('/[\n\r]+/', get_theme_option('hotest'));
    $data = [];
    foreach ($lists as $list) {
        if (trim($list)) {
            $list = explode('|', $list);
            [$label, $relation, $field, $val, $sortKey, $alg, $limit, $template] = array_merge($list, ['Phim hot', '', 'type', 'series', 'view_total', 'desc', 4, 'top_thumb']);
            try {
                $data[] = [
                    'label' => $label,
                    'template' => $template,
                    'data' => \Ophim\Core\Models\Movie::when($relation, function ($query) use ($relation, $field, $val) {
                        $query->whereHas($relation, function ($rel) use ($field, $val) {
                            $rel->where($field, $val);
                        });
                    })
                        ->when(!$relation, function ($query) use ($field, $val) {
                            $query->where($field, $val);
                        })
                        ->orderBy($sortKey, $alg)
                        ->limit($limit)
                        ->get(),
                ];
            } catch (\Exception $e) {
                # code
            }
        }
    }

    return $data;
});
@endphp

@push('header')
    <link href="/themes/september/css/styles.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet" />
@endpush

@section('body')
    @include('themes::september.inc.header')
    @include('themes::september.inc.nav')
    @if (get_theme_option('ads_header'))
        <div class="container mx-auto items-center text-center mt-2">
            {!! get_theme_option('ads_header') !!}
        </div>
    @endif
    @yield('slider_recommended')
    @yield('breadcrumb')
    @yield('player_wraper')
    <div class="container mx-auto lg:flex px-2 md:px-0">
        <div class="lg:w-3/4 lg:pr-4">
            @yield('content')
        </div>
        <aside class="lg:w-1/4">
            @include('themes::september.inc.aside')
        </aside>
    </div>
@endsection

@section('footer')
    <footer class="bg-main-800 mt-2 relative bottom-0 clear-both">
        <div class="container mx-auto flex py-8">
            {!! get_theme_option('footer') !!}
        </div>
    </footer>
    @if (get_theme_option('ads_header'))
        <div class="relative">
            <div class="container mx-auto px-4 md:px-8 xl:px-40 fixed items-center text-center bottom-0 right-0 left-0 z-40">
                {!! get_theme_option('ads_catfish') !!}
            </div>
        </div>
    @endif
    <script src="/themes/september/js/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#header-search-button").click(() => {
                $("#header-search-form").toggle("fast", "swing");
            })

            $("#header-menu-button").click(() => {
                $("#nav-menu").toggle("fast", "swing");
            })
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js" integrity="sha512-q583ppKrCRc7N5O0n2nzUiJ+suUv7Et1JGels4bXOaMFQcamPk9HjdUknZuuFjBNs7tsMuadge5k9RzdmO+1GQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {!! setting('site_scripts_google_analytics') !!}
@endsection
