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
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205l3 1m1.5.5l-1.5-.5M6.75 7.364V3h-3v18m3-13.636l10.5-3.819" />
                            </svg>
                            Xem phim
                        </span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
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
                        <img style="aspect-ratio: 256/340" data-src="{{ $movie->getThumbUrl() }}"
                            alt="{{ $movie->name ?? '' }}"
                            class="group-hover:opacity-60 transition-all duration-500 transform group-hover:scale-110 lazyload" />
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
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-16 h-16 text-main-warning">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.91 11.672a.375.375 0 010 .656l-5.603 3.113a.375.375 0 01-.557-.328V8.887c0-.286.307-.466.557-.327l5.603 3.112z" />
                            </svg>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="flex flex-row flex-wrap flex-grow h-50 mt-10">
                <p class="w-full text-center text-white">Rất tiếc, không có nội dung nào trùng khớp yêu cầu.</p>
            </div>
        @endif

        {{ $data->appends(request()->all())->links('themes::september.inc.pagination') }}
    </section>
@endsection
