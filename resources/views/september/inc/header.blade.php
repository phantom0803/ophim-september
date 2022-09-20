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
                <i class="fa-thin fa-magnifying-glass absolute ml-3 mt-2 text-xl"></i>
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
            <i id="header-search-button"
                class="fa-light fa-magnifying-glass block xl:hidden cursor-pointer text-2xl"></i>
            <i id="header-menu-button" class="fa-light fa-bars block xl:hidden cursor-pointer text-3xl"></i>
        </div>
    </div>
</header>
<!-- END HEADER -->
