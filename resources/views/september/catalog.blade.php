@extends('themes::september.layout')

@php
$years = Cache::remember('all_years', \Backpack\Settings\app\Models\Setting::get('site_cache_ttl', 5 * 60), function () {
    return \Ophim\Core\Models\Movie::select('publish_year')
        ->distinct()
        ->pluck('publish_year')
        ->sortDesc();
});
@endphp

@section('breadcrumb')
    <div class="breadcrumb block md:flex items-center container mx-auto mt-2 w-full line-clamp-1">
        <div class="ml-2 md:ml-0">
            <ol class="flex flex-wrap items-center gap-1" itemScope itemType="https://schema.org/BreadcrumbList">
                <li itemProp="itemListElement" itemScope itemType="http://schema.org/ListItem">
                    <a class="flex items-center gap-x-1" itemProp="item" title="Xem phim" href="/">
                        <span class="flex items-center gap-x-1 text-main-primary hover:text-main-warning" itemProp="name">
                            <i class="fa-thin fa-house-heart text-base"></i>
                            Xem phim
                        </span>
                        <i class="fa-thin fa-chevron-right text-xs"></i>
                        <meta itemProp="position" content="1" />
                    </a>
                </li>
                <li class="inline text-gray-400" itemprop="itemListElement" itemscope=""
                    itemtype="http://schema.org/ListItem">
                    <a itemprop="item" href="{{ url()->current() }}" title="{{ $section_name ?? 'Danh Sách Phim' }}">
                        <span itemprop="name">
                            {{ $section_name ?? 'Danh Sách Phim' }}
                        </span>
                    </a>
                    <meta itemprop="position" content="2">
                </li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    @include('themes::september.inc.catalog_filter')
    <section class="w-full mt-2">
        <div class="flex justify-between">
            <div class="py-2 w-max">
                <h3
                    class="text-base md:text-2xl uppercase font-semibold text-transparent bg-clip-text bg-gradient-to-r from-[#7367F0] to-[#8e84fc]">
                    {{ $section_name }}</h3>
                <div class="w-full h-0.5 bg-main-indigo bg-gradient-to-r from-[#7367F0] to-[#8e84fc]"></div>
            </div>
        </div>
        @if (count($data))
            <div
                class="grid grid-flow-row grid-cols-2 sm:grid-cols-3 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-6 gap-2">
                @foreach ($data ?? [] as $movie)
                    <a href="{{ $movie->getUrl() }}" class="overflow-hidden relative group"
                        title="{{ $movie->name ?? '' }}">
                        <img style="aspect-ratio: 256/340" src="{{ $movie->thumb_url }}" alt="{{ $movie->name ?? '' }}"
                            class="group-hover:opacity-60 transition-all duration-500 transform group-hover:scale-110" />
                        <span
                            class="absolute bottom-0 px-2 pb-2 pt-16 bg-gradient-to-t from-main-900 w-full text-main-warning">
                            <div class="font-bold overflow-hidden overflow-ellipsis whitespace-nowrap">{{ $movie->name }}
                            </div>
                            <div class="text-sm text-gray-300 italic overflow-hidden overflow-ellipsis whitespace-nowrap">
                                {{ $movie->origin_name }} ({{ $movie->publish_year }})
                            </div>
                        </span>
                        <span class="absolute top-0 left-0 p-0.5 bg-main-primary text-sm">
                            {{ $movie->episode_current }}
                        </span>
                        <div class="absolute hidden top-1/3 left-1/3 animate-pulse group-hover:block">
                            <i class="fa-brands fa-google-play text-6xl text-main-warning"></i>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="flex flex-row flex-wrap flex-grow h-50 mt-10">
                <p class="w-full text-center text-white">Rất tiếc, không có nội dung nào trùng khớp yêu cầu.</p>
            </div>
        @endif

        {{ $data->appends(request()->all())->links("themes::september.inc.pagination") }}
    </section>
@endsection
