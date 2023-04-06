@php
$logo = setting('site_logo', '');
$brand = setting('site_brand', '');
$title = isset($title) ? $title : setting('site_homepage_title', '');
@endphp

<!-- BEGIN HEADER -->
<header class="w-full bg-main-800 px-1 xl:px-7 py-3 shadow-md">
    <div class="container mx-auto flex justify-between items-center">
        <div id="header-search-form" class="relative w-96 hidden xl:block">
            <form id="form-search" method="GET" action="/">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 absolute ml-3 mt-2 text-xl">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 15.75l-2.489-2.489m0 0a3.375 3.375 0 10-4.773-4.773 3.375 3.375 0 004.774 4.774zM21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <input
                    class="appearance-none border border-input-border rounded-3xl w-full py-2 px-3 bg-main-700 text-gray-300 leading-tight focus: focus:outline-none focus:shadow-outline focus:border-input-focus pl-10"
                    type="text" name="search" placeholder="Tìm kiếm phim..." value="{{ request('search') }}" />
            </form>
        </div>
        <div>
            <a href="/" class="navbar-brand">
                @if ($logo)
                    {!! $logo !!}
                @else
                    {!! $brand !!}
                @endif
            </a>
        </div>
        <div></div>
        <div></div>
        <div class="flex xl:hidden gap-x-4 px-2">
            <svg id="header-search-button" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 block xl:hidden cursor-pointer">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
            </svg>
            <svg id="header-menu-button" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 block xl:hidden cursor-pointer">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 5.25h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5" />
            </svg>
        </div>
    </div>
</header>
<!-- END HEADER -->
