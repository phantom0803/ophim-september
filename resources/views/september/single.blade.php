@extends('themes::september.layout')

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
                <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                    <a class="text-main-primary hover:text-main-warning" itemprop="item"
                        href="/danh-sach/{{ $currentMovie->type == 'single' ? 'phim-le' : 'phim-bo' }}"
                        title="{{ $currentMovie->type == 'single' ? 'Phim lẻ' : 'Phim bộ' }}">
                        <span itemprop="name">
                            {{ $currentMovie->type == 'single' ? 'Phim lẻ' : 'Phim bộ' }}
                        </span>
                    </a>
                    <i class="fa-thin fa-chevron-right text-xs"></i>
                    <meta itemprop="position" content="2">
                </li>


                @foreach ($currentMovie->regions as $region)
                    <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                        <a class="text-main-primary hover:text-main-warning" itemprop="item" href="{{ $region->getUrl() }}"
                            title="{{ $region->name }}">
                            <span itemprop="name">
                                {{ $region->name }}
                            </span>
                        </a>
                        <i class="fa-thin fa-chevron-right text-xs"></i>
                        <meta itemprop="position" content="3">
                    </li>
                @endforeach
                @foreach ($currentMovie->categories as $category)
                    <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                        <a class="text-main-primary hover:text-main-warning" itemprop="item"
                            href="{{ $category->getUrl() }}" title="{{ $category->name }}">
                            <span itemprop="name">
                                {{ $category->name }}
                            </span>
                        </a>
                        <i class="fa-thin fa-chevron-right text-xs"></i>
                        <meta itemprop="position" content="3">
                    </li>
                @endforeach
                <li class="inline text-gray-400" itemprop="itemListElement" itemscope=""
                    itemtype="http://schema.org/ListItem">
                    <a itemprop="item" href="{{ $currentMovie->getUrl() }}" title="{{ $currentMovie->name }}">
                        <span itemprop="name">
                            {{ $currentMovie->name }}
                        </span>
                    </a>
                    <meta itemprop="position" content="4">
                </li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    @if ($currentMovie->showtimes && $currentMovie->showtimes != '')
        <div class="mt-2.5 p-2 bg-main-800 mb-1 border-main-warning/60 border-[1px] border-dashed text-gray-300">
            <i class="fa-thin fa-calendar-days animate-pulse"></i>
            Lịch chiếu: <span class="text-yellow-500">{!! $currentMovie->showtimes !!}</span>
        </div>
    @endif

    @if ($currentMovie->notify && $currentMovie->notify != '')
        <div class="mt-2.5 p-2 bg-main-800 mb-1 border-main-warning/60 border-[1px] border-dashed text-gray-300">
            <i class="fa-thin fa-bell-on animate-pulse"></i>
            Thông báo: <span class="text-main-blue">{{ strip_tags($currentMovie->notify) }}</span>
        </div>
    @endif

    <div class="bg-main-800/40 p-2 mt-2 md:flex flex-wrap">
        <div class="relative overflow-hidden w-full h-full pt-0 md:w-1/3 lg:w-1/3 xl:w-1/4">
            <img style="aspect-ratio: 256/340" src="{{ $currentMovie->thumb_url }}"
                alt="{{ $currentMovie->name }} - {{ $currentMovie->origin_name }} ({{ $currentMovie->publish_year }})"
                class="w-full h-auto max-h-96" />

            @if ($currentMovie->is_copyright)
                <div
                    class="absolute top-[7%] -left-[34%] text-white uppercase py-[4px] px-0 text-[12px] w-full text-center -rotate-45 bg-gradient-to-r from-red-500">
                    bản quyền</div>
            @endif

            <div class="absolute top-0 right-0 bg-main-800/80 p-2 flex items-center gap-x-1 text-main-success">
                <i class="fa-regular fa-eye text-xs"></i>
                <span class="text-xs">
                    {{ $currentMovie->view_total }}
                </span>
            </div>

            <div class="absolute bottom-4 text-center w-full bg-main-700 bg-opacity-40 py-2 m-0">
                @if ($currentMovie->trailer_url)
                    <label id="toggleModal-trailer"
                        class="bg-main-blue text-gray-50 inline-block px-3 py-2 shadow-none hover:shadow-secondary duration-150 cursor-pointer">
                        <i class="fa-brands fa-youtube"></i>
                        Trailer
                    </label>
                @endif
                {{-- optimize sau --}}
                @if (!$currentMovie->is_copyright && count($currentMovie->episodes) && $currentMovie->episodes[0]['link'] != '')
                    <a href="{{ $currentMovie->episodes->sortBy([['server', 'asc']])->groupBy('server')->first()->sortByDesc('name', SORT_NATURAL)->groupBy('name')->last()->sortByDesc('type')->first()->getUrl() }}">
                        <div
                            class="bg-main-primary text-gray-50 inline-block px-3 py-2 shadow-none hover:shadow-primary duration-150">
                            <i class="fa-light fa-circle-play"></i>
                            Xem phim
                        </div>
                    </a>
                @else
                    <div class="text-white">Đang cập nhật...</div>
                @endif
            </div>
        </div>

        @if ($currentMovie->trailer_url)
            @php
                parse_str(parse_url($currentMovie->trailer_url, PHP_URL_QUERY), $parse_url);
                $trailer_id = $parse_url['v'];
            @endphp
            <div id="modal-trailer" class="relative z-10 hidden" aria-labelledby="modal-title" role="dialog"
                aria-modal="true">
                <div class="fixed inset-0 bg-black bg-opacity-75 transition-opacity"></div>
                <div class="fixed inset-0 z-10 overflow-y-auto">
                    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                        <div id="modal-trailer-iframe"
                            class="relative transform overflow-hidden text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                            <div class=" bg-main-800/60 p-2">
                                <iframe width="100%" height="315"
                                    src="https://www.youtube.com/embed/{{ $trailer_id }}" title="YouTube video player"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    frameborder="0" scrolling="no" allowfullscreen></iframe>
                            </div>
                            <div class="bg-main-900/60 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                                <button type="button" id="close-trailer-modal"
                                    class="mt-3 inline-flex w-full justify-center border border-gray-300 bg-white px-2 py-1 text-base font-medium text-gray-700 shadow-sm hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Đóng</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="w-full md:w-2/3 lg:w-2/3 xl:w-3/4 md:pl-2 pt-0 md:mt-0 text-sm">
            <div class="bg-main-700/40 text-center py-2">
                <h1 class="uppercase text-xl font-extrabold text-main-primary">{{ $currentMovie->name }}</h1>
                <h2 class="italic text-main-orange">{{ $currentMovie->origin_name ?? '' }}</h2>
                <div class="mt-2">
                    <div class="items-center text-center gap-x-2">
                        <div id="movies-rating-star" class="flex justify-center" style="height: 18px;"></div>
                        <div class="text-white align-middle">
                            ({{ number_format($currentMovie->rating_star ?? 0, 1) }}
                            sao
                            /
                            {{ $currentMovie->rating_count ?? 0 }} đánh giá)
                        </div>
                        <div id="movies-rating-msg" class="text-[#FDB813] mb-2 font-bold text-sm mt-2"></div>
                    </div>
                </div>
            </div>
            <ul class="grid grid-flow-row grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 mt-2 gap-2">
                <li>
                    <label class="font-bold text-white">Trạng thái: </label>
                    <span class="px-1 bg-main-labelbgWarning text-main-warning">{{ $currentMovie->getStatus() }}</span>
                </li>
                <li>
                    <label class="font-bold text-white">Tập hiện tại: </label>
                    <span class="px-1 bg-main-labelbgSuccess text-main-success">{{ $currentMovie->episode_current }} {{ $currentMovie->language }}</span>
                </li>
                <li>
                    <label class="font-bold text-white">Số tập: </label>
                    <span class="px-1 bg-main-labelbgInfo text-main-info">
                        {{ $currentMovie->episode_total ?? 'N/A' }}
                    </span>
                </li>
                <li>
                    <label class="font-bold text-white">Thời lượng: </label>
                    <span class="">{{ $currentMovie->episode_time ?? 'N/A' }}</span>
                </li>
                <li>
                    <label class="font-bold text-white">Năm phát hành: </label>
                    <span class="">{{ $currentMovie->publish_year }}</span>
                </li>
                <li>
                    <label class="font-bold text-white">Chất lượng: </label>
                    <span class="">{{ $currentMovie->quality }}</span>
                </li>

                <li class="col-span-1 md:col-span-2 lg:col-span-2 xl:col-span-3 line-clamp-2">
                    <label class="font-bold text-white">Thể loại: </label>
                    <span class="">
                        {!! $currentMovie->categories->map(function ($category) {
                                return '<a href="' .
                                    $category->getUrl() .
                                    '" title="' .
                                    $category->name .
                                    '" class="text-main-primary hover:text-main-orange">' .
                                    $category->name .
                                    '</a>';
                            })->implode(', ') !!}
                    </span>
                </li>

                <li class="col-span-1 md:col-span-2 lg:col-span-2 xl:col-span-3 line-clamp-2">
                    <label class="font-bold text-white">Quốc gia: </label>
                    <span class="">
                        {!! $currentMovie->regions->map(function ($region) {
                                return '<a href="' .
                                    $region->getUrl() .
                                    '" title="' .
                                    $region->name .
                                    '" class="text-main-primary hover:text-main-orange">' .
                                    $region->name .
                                    '</a>';
                            })->implode(', ') !!}
                    </span>
                </li>

                <li class="col-span-1 md:col-span-2 lg:col-span-2 xl:col-span-3 line-clamp-2">
                    <label class="font-bold text-white">Diễn viên: </label>
                    <span class="">
                        {!! $currentMovie->actors->map(function ($actor) {
                                return '<a href="' .
                                    $actor->getUrl() .
                                    '" tite="Diễn viên ' .
                                    $actor->name .
                                    '" class="text-main-primary hover:text-main-orange">' .
                                    $actor->name .
                                    '</a>';
                            })->implode(', ') !!}
                    </span>
                </li>

                <li class="col-span-1 md:col-span-2 lg:col-span-2 xl:col-span-3 line-clamp-2">
                    <label class="font-bold text-white">Đạo diễn: </label>
                    <span class="">
                        {!! $currentMovie->directors->map(function ($director) {
                                return '<a href="' .
                                    $director->getUrl() .
                                    '" tite="Đạo diễn ' .
                                    $director->name .
                                    '" class="text-main-primary hover:text-main-orange">' .
                                    $director->name .
                                    '</a>';
                            })->implode(', ') !!}
                    </span>
                </li>

                @if ($currentMovie->type === "series" && !$currentMovie->is_copyright && count($currentMovie->episodes) && $currentMovie->episodes[0]['link'] != '')
                    <li class="col-span-1 md:col-span-2 lg:col-span-2 xl:col-span-3">
                        <label class="font-bold text-white">Tập mới nhất: </label>
                        <span class="flex gap-1">
                            @php
                                $currentMovie->episodes
                                    ->sortBy([['name', 'desc'], ['type', 'desc']])
                                    ->sortByDesc('name', SORT_NATURAL)
                                    ->unique('name')
                                    ->take(3)
                                    ->map(function ($episode) {
                                        echo '<a href="' . $episode->getUrl() . '" class="w-content text-center bg-main-labelbgSecondary text-white hover:shadow-menu hover:bg-main-primary duration-150 px-4 py-1 overflow-hidden overflow-ellipsis whitespace-nowrap">' . $episode->name . '</a>';
                                    });
                            @endphp
                        </span>
                    </li>
                @endif
            </ul>
        </div>
    </div>

    <article class="block bg-main-800/40 p-2 mt-2 md:flex flex-wrap">
        <h3 class="font-medium text-xl pb-2">Nội dung phim</h3>
        <div class="border-b-[1px] border-main-secondary border-opacity-25 py-1">
            @if ($currentMovie->content)
                <div class="whitespace-pre-wrap">{!! $currentMovie->content !!}</div>
            @else
                <p>Đang cập nhật ...</p>
            @endif
        </div>

        <div>
            <h3 class="font-medium text-xl py-2">Tags</h3>
            <ul class="flex flex-wrap gap-1 py-1">
                @foreach ($currentMovie->tags as $tag)
                    <li class="bg-main-labelbgPrimary text-white hover:text-main-warning px-2">
                        <a href="{{ $tag->getUrl() }}" title="{{ $tag->name }}">{{ $tag->name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </article>

    <div class="fb-comments w-full bg-white mt-2" data-href="{{ $currentMovie->getUrl() }}" data-width="100%"
        data-numposts="5" data-colorscheme="light" data-lazy="true">
    </div>

    <section class="w-full mt-2">
        <div class="flex justify-between">
            <div class="py-2 w-max">
                <h3
                    class="text-base md:text-2xl uppercase font-semibold text-transparent bg-clip-text bg-gradient-to-r from-[#7367F0] to-[#8e84fc]">
                    Có thể bạn muốn xem</h3>
            </div>
        </div>
        @php
            $item['data'] = $movie_related;
        @endphp
        @include('themes::september.inc.section.section_thumb')
    </section>
@endsection

@push('scripts')
    <script type="text/javascript">
        $("#toggleModal-trailer").click(() => {
            $("#modal-trailer").toggle("hidden");
        })
        $('body').click(function(event) {
            if (($(event.target).closest("#modal-trailer").length && !$(event.target).closest(
                    "#modal-trailer-iframe").length) || $(event.target).closest("#close-trailer-modal").length) {
                $("#modal-trailer").toggle("hidden");
            }
        });
    </script>

    <script src="/themes/september/plugins/jquery-raty/jquery.raty.js"></script>
    <link href="/themes/september/plugins/jquery-raty/jquery.raty.css" rel="stylesheet" type="text/css" />

    <script>
        var rated = false;
        $('#movies-rating-star').raty({
            score: {{ number_format($currentMovie->rating_star ?? 0, 1) }},
            number: 10,
            numberMax: 10,
            hints: ['quá tệ', 'tệ', 'không hay', 'không hay lắm', 'bình thường', 'xem được', 'có vẻ hay', 'hay',
                'rất hay', 'siêu phẩm'
            ],
            starOff: '/themes/september/plugins/jquery-raty/images/star-off.png',
            starOn: '/themes/september/plugins/jquery-raty/images/star-on.png',
            starHalf: '/themes/september/plugins/jquery-raty/images/star-half.png',
            click: function(score, evt) {
                if (rated) return
                fetch("{{ route('movie.rating', ['movie' => $currentMovie->slug]) }}", {
                    method: 'POST',
                    headers: {
                        "Content-Type": "application/json",
                        'X-CSRF-TOKEN': document.querySelector(
                                'meta[name="csrf-token"]')
                            .getAttribute(
                                'content')
                    },
                    body: JSON.stringify({
                        rating: score
                    })
                });
                rated = true;
                $('#movies-rating-star').data('raty').readOnly(true);
                $('#movies-rating-msg').html(`Bạn đã đánh giá ${score} sao cho phim này!`);
            }
        });
    </script>

    {!! setting('site_scripts_facebook_sdk') !!}
@endpush
