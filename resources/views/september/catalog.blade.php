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
    <div class="w-full container mx-auto mt-2 bg-main-800/40">
        <div class="text-gray-50">
            <form id="form-filter" class="lg:flex gap-2 items-center">
                <div class="p-2 flex justify-between">
                    Lọc Phim
                </div>
                <div class="p-2">
                    <select class="scroll bg-main-700 p-2 outline-none">
                        <option class="py-2">1</option>
                        <option class="py-2">2</option>
                        <option class="py-2">3</option>
                        <option class="py-2">4</option>
                        <option class="py-2">5</option>
                    </select>
                </div>
                <div class="p-2">
                    <button type="submit"
                        class="w-content text-center bg-main-labelbgSecondary text-white hover:shadow-menu hover:bg-main-primary duration-150 p-1.5 overflow-hidden overflow-ellipsis whitespace-nowrap">
                        <span>Duyệt phim</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
