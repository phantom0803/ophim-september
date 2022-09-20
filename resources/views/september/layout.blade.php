@extends('themes::layout')
@php
$menu = \Ophim\Core\Models\Menu::getTree();
$tops = Cache::remember('site.movies.tops', setting('site_cache_ttl', 5 * 60), function () {
    $lists = preg_split('/[\n\r]+/', get_theme_option('hotest'));
    $data = [];
    foreach ($lists as $list) {
        if (trim($list)) {
            $list = explode('|', $list);
            [$label, $relation, $field, $val, $sortKey, $alg, $limit] = array_merge($list, ['Phim hot', '', 'type', 'series', 'view_total', 'desc', 4]);
            try {
                $data[] = [
                    'label' => $label,
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
    <link href="/themes/september/css/styles.css" rel="stylesheet">
    <link href="/themes/september/plugins/fontawesome/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
        rel="stylesheet" />
@endpush

@section('body')
    @include('themes::september.inc.header')
    @include('themes::september.inc.nav')
    <div class="container mx-auto lg:flex px-2 md:px-0">
        <div class="lg:w-3/4 lg:pr-4">
            <section class="w-full mt-2">
                <div class="flex justify-between">
                    <div class="py-2 w-max">
                        <h3
                            class="text-base md:text-2xl uppercase font-semibold text-transparent bg-clip-text bg-gradient-to-r from-[#7367F0] to-[#8e84fc]">
                            SECTION THUMB</h3>
                        <div class="w-full h-0.5 bg-main-indigo bg-gradient-to-r from-[#7367F0] to-[#8e84fc]"></div>
                    </div>
                    <a href="" title="">
                        <div class="px-2 py-2 flex gap-x-2 text-md text-main-purple hover:text-main-orange items-center">
                            <span>Xem thêm</span>
                            <i class="fa-light fa-chevrons-right"></i>
                        </div>
                    </a>
                </div>
                @include('themes::september.inc.section_thumb')
            </section>
        </div>
        <aside class="lg:w-1/4">
            @include('themes::september.inc.aside')
        </aside>
    </div>
@endsection

@section('footer')
    <!-- BEGIN FOOTER -->
    <footer class="bg-main-800 mt-2 relative bottom-0 clear-both">
        <div class="container mx-auto flex py-8">
            {!! get_theme_option('footer') !!}
        </div>
    </footer>
    <!-- END FOOTER -->

    <!-- BEGIN BASE SCRIPT -->
    <script src="/themes/september/js/jquery-3.6.0.min.js"></script>
    <!-- END BASE SCRIPT -->
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
@endsection
