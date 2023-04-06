@extends('themes::september.layout')

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
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                        <meta itemProp="position" content="1" />
                    </a>
                </li>
                @foreach ($currentMovie->regions as $region)
                    <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                        <a class="text-main-primary hover:text-main-warning" itemprop="item" href="{{ $region->getUrl() }}"
                            title="{{ $region->name }}">
                            <span itemprop="name">
                                {{ $region->name }}
                            </span>
                        </a>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
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
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                        <meta itemprop="position" content="3">
                    </li>
                @endforeach
                <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                    <a class="text-main-primary hover:text-main-warning" itemprop="item"
                        href="{{ $currentMovie->getUrl() }}" title="{{ $currentMovie->name }}">
                        <span itemprop="name">
                            {{ $currentMovie->name }}
                        </span>
                    </a>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                    <meta itemprop="position" content="4">
                </li>
                <li class="inline text-gray-400" itemprop="itemListElement" itemscope=""
                    itemtype="http://schema.org/ListItem">
                    <a itemprop="item" href="{{ url()->current() }}" title="Tập {{ $episode->name }}">
                        <span itemprop="name">
                            Tập {{ $episode->name }}
                        </span>
                    </a>
                    <meta itemprop="position" content="5">
                </li>
            </ol>
        </div>
    </div>
@endsection

@section('player_wraper')
    <div class="w-full table relative container mx-auto my-2 px-2 lg:px-0">
        <div class="relative table-cell bg-main-800/40">
            <div class="relative iframe w-full" style="aspect-ratio: 16 / 9;" id="player-wrapper">

            </div>
            <div class="flex justify-between justify-items-center items-center w-full h-[44px] p-1">
                <div class="flex items-center">
                    <div
                        class="text-sm md:text-base py-2.5 flex flex-wrap md:grid grid-flow-row grid-cols-5 gap-1 md:gap-2">
                        @foreach ($currentMovie->episodes->where('slug', $episode->slug)->where('server', $episode->server) as $server)
                            <a class="streaming-server relative w-content text-center bg-main-labelbgSecondary text-white hover:shadow-menu hover:bg-main-primary duration-150 px-2 md:px-3 py-1 cursor-pointer"
                                onclick="chooseStreamingServer(this)" data-type="{{ $server->type }}"
                                data-id="{{ $server->id }}" data-link="{{ $server->link }}">
                                <span>VIP #{{ $loop->index + 1 }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>

                <div class="block lg:flex items-center">
                    <span id="toggleModal-report"
                        class="w-content text-center bg-main-danger text-white hover:shadow-menu hover:bg-main-primary duration-150 px-2 md:px-3 py-1 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 12.75c1.148 0 2.278.08 3.383.237 1.037.146 1.866.966 1.866 2.013 0 3.728-2.35 6.75-5.25 6.75S6.75 18.728 6.75 15c0-1.046.83-1.867 1.866-2.013A24.204 24.204 0 0112 12.75zm0 0c2.883 0 5.647.508 8.207 1.44a23.91 23.91 0 01-1.152 6.06M12 12.75c-2.883 0-5.647.508-8.208 1.44.125 2.104.52 4.136 1.153 6.06M12 12.75a2.25 2.25 0 002.248-2.354M12 12.75a2.25 2.25 0 01-2.248-2.354M12 8.25c.995 0 1.971-.08 2.922-.236.403-.066.74-.358.795-.762a3.778 3.778 0 00-.399-2.25M12 8.25c-.995 0-1.97-.08-2.922-.236-.402-.066-.74-.358-.795-.762a3.734 3.734 0 01.4-2.253M12 8.25a2.25 2.25 0 00-2.248 2.146M12 8.25a2.25 2.25 0 012.248 2.146M8.683 5a6.032 6.032 0 01-1.155-1.002c.07-.63.27-1.222.574-1.747m.581 2.749A3.75 3.75 0 0115.318 5m0 0c.427-.283.815-.62 1.155-.999a4.471 4.471 0 00-.575-1.752M4.921 6a24.048 24.048 0 00-.392 3.314c1.668.546 3.416.914 5.223 1.082M19.08 6c.205 1.08.337 2.187.392 3.314a23.882 23.882 0 01-5.223 1.082" />
                        </svg>
                        Báo lỗi
                    </span>
                </div>
            </div>
        </div>
        <div class="episode relative table-row lg:table-cell overflow-hidden lg:w-1/4 bg-main-800/40">
            <div class="lg:absolute inset-0">
                <div class="hidden lg:block text-xl font-bold m-2">{{ $currentMovie->name }}</div>
                <div class="flex flex-wrap" id="tabs-id">
                    <div class="w-full">
                        <ul class="flex mb-0 list-none flex-wrap pt-3 flex-row p-1 lg:p-0">
                            @foreach ($currentMovie->episodes->sortBy([['server', 'asc']])->groupBy('server') as $server => $data)
                                <li class="-mb-px mr-2 last:mr-0 flex-auto text-center cursor-pointer">
                                    <a class="text-xs font-bold uppercase px-1 py-2 shadow-lg block leading-normal text-white bg-main-labelbgSecondary @if ($episode->server == $server) bg-main-primary @endif hover:shadow-menu hover:bg-main-primary"
                                        onclick="changeAtiveTab(event,'tab-server-{{ $loop->index }}')">
                                        @if ($episode->server == $server)
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 14.25h13.5m-13.5 0a3 3 0 01-3-3m3 3a3 3 0 100 6h13.5a3 3 0 100-6m-16.5-3a3 3 0 013-3h13.5a3 3 0 013 3m-19.5 0a4.5 4.5 0 01.9-2.7L5.737 5.1a3.375 3.375 0 012.7-1.35h7.126c1.062 0 2.062.5 2.7 1.35l2.587 3.45a4.5 4.5 0 01.9 2.7m0 0a3 3 0 01-3 3m0 3h.008v.008h-.008v-.008zm0-6h.008v.008h-.008v-.008zm-3 6h.008v.008h-.008v-.008zm0-6h.008v.008h-.008v-.008z" />
                                            </svg>
                                        @endif {{ $server }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        <div class="relative tab-content tab-space mt-1 p-2 scroll overflow-auto max-h-32 md:max-h-[345px] lg:max-h-[370px] xl:max-h-[475px] 2xl:max-h-[602px]">
                            @foreach ($currentMovie->episodes->sortBy([['server', 'asc']])->groupBy('server') as $server => $data)
                                <div class="@if ($episode->server != $server) hidden @endif grid grid-flow-row grid-cols-3 md:grid-cols-4 lg:grid-cols-4 xl:grid-cols-5 gap-2"
                                    id="tab-server-{{ $loop->index }}">
                                    @foreach ($data->sortByDesc('name', SORT_NATURAL)->groupBy('name') as $name => $item)
                                        <a class="relative w-content text-center bg-main-labelbgSecondary @if ($item->contains($episode)) bg-main-primary @endif text-white hover:shadow-menu hover:bg-main-primary duration-150 py-1 overflow-hidden overflow-ellipsis whitespace-nowrap"
                                            title="{{ $name }}" href="{{ $item->sortByDesc('type')->first()->getUrl() }}">
                                            {{ $name }}
                                            @if ($item->contains($episode))
                                                <span class="flex absolute h-3 w-3 top-0 right-0 -mt-1 -mr-1">
                                                    <span
                                                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
                                                    <span
                                                        class="relative inline-flex rounded-full h-3 w-3 bg-orange-500"></span>
                                                </span>
                                            @endif
                                        </a>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('content')
    <div class="bg-main-800/40 p-2 mt-2 md:flex flex-wrap">
        <div class="relative w-full h-full pt-0 md:w-1/3 lg:w-1/3 xl:w-1/6">
            <img style="aspect-ratio: 266/400" src="{{ $currentMovie->getThumbUrl() }}" alt="{{ $currentMovie->name }}"
                class="w-full h-auto max-h-96" />
        </div>

        <div class="w-full md:w-2/3 lg:w-2/3 xl:w-5/6 md:pl-2 pt-0 md:mt-0 text-sm">
            <div class="bg-main-800/40 text-center py-1">
                <h1 class="uppercase text-xl font-extrabold text-main-primary">Xem phim {{ $currentMovie->name }} Tập
                    {{ $episode->name }}</h1>
                <h2 class="italic text-main-orange">{{ $currentMovie->origin_name }}</h2>
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
            <article class="block bg-main-800/40 p-2 mt-2">
                <div class="border-b-[1px] border-main-secondary border-opacity-25 py-1 scroll overflow-auto max-h-32">
                    @if ($currentMovie->content)
                        {!! $currentMovie->content !!}
                    @else
                        <p>Đang cập nhật ...</p>
                    @endif
                </div>

                <div>
                    <ul class="flex flex-wrap gap-1 py-1">
                        @foreach ($currentMovie->tags as $tag)
                            <li class="bg-main-labelbgPrimary text-white hover:text-main-warning px-2">
                                <a href="{{ $tag->getUrl() }}" title="{{ $tag->name }}">{{ $tag->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </article>
        </div>
    </div>

    <div class="bg-white mt-2 w-full" style="background-color: #ffffff">
        <div class="fb-comments w-full" data-href="{{ $currentMovie->getUrl() }}" data-width="100%"
            data-numposts="5" data-colorscheme="light" data-lazy="true">
        </div>
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


    <div id="modal-report" class="relative z-10 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-black bg-opacity-75 transition-opacity"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div id="modal-report-form"
                    class="relative transform overflow-hidden text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                    <div class=" bg-main-800/60 p-2">
                        <div class="sm:flex sm:items-start">
                            <div
                                class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-red-600">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                                </svg>
                            </div>
                            <div class="w-full mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg font-medium leading-6 text-gray-100" id="modal-title">Báo lỗi phim</h3>
                                <div class="mt-2">
                                    <textarea id="report_message" class="w-full p-3 bg-main-900 text-white focus:outline-none" rows="5"
                                        placeholder="Hãy nhập nội dung lỗi để chúng mình sửa nhanh hơn...">Không tải được tập phim</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-main-900/60 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                        <button type="button" id="report_episode_btn"
                            class="inline-flex w-full justify-center border border-transparent bg-main-primary px-2 py-1 text-base font-medium text-white shadow-sm hover:bg-main-primary/80 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm">Gửi</button>
                        <button type="button" id="close-report-modal"
                            class="mt-3 inline-flex w-full justify-center border border-gray-300 bg-white px-2 py-1 text-base font-medium text-gray-700 shadow-sm hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Đóng</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

    <script src="/themes/september/player/js/p2p-media-loader-core.min.js"></script>
    <script src="/themes/september/player/js/p2p-media-loader-hlsjs.min.js"></script>

    <script src="/js/jwplayer-8.9.3.js"></script>
    <script src="/js/hls.min.js"></script>
    <script src="/js/jwplayer.hlsjs.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#toggleModal-report").click(() => {
                $("#modal-report").toggle("hidden");
                $("#modal-report-backdrop").toggle("hidden");
            })
            $('body').click(function(event) {
                if (($(event.target).closest("#modal-report").length && !$(event.target).closest(
                            "#modal-report-form")
                        .length) || $(event.target).closest("#close-report-modal").length) {
                    $("#modal-report").toggle("hidden");
                    $("#modal-report-backdrop").toggle("hidden");
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('html, body').animate({
                scrollTop: $('#player-wrapper').offset().top - 40
            }, 'slow');
        });
    </script>

    <script type="text/javascript">
        function changeAtiveTab(event, tabID) {
            let element = event.target;
            while (element.nodeName !== "A") {
                element = element.parentNode;
            }
            ulElement = element.parentNode.parentNode;
            aElements = ulElement.querySelectorAll("li > a");
            tabContents = document.getElementById("tabs-id").querySelectorAll(".tab-content > div");
            for (let i = 0; i < aElements.length; i++) {
                aElements[i].classList.remove("text-white");
                aElements[i].classList.remove("bg-main-primary");
                aElements[i].classList.add("text-white");
                aElements[i].classList.add("bg-main-labelbgSecondary");
                tabContents[i].classList.add("hidden");
                tabContents[i].classList.remove("block");
            }
            element.classList.remove("text-white");
            element.classList.remove("bg-main-labelbgSecondary");
            element.classList.add("text-white");
            element.classList.add("bg-main-primary");
            document.getElementById(tabID).classList.remove("hidden");
            document.getElementById(tabID).classList.add("block");
        }
    </script>

    <script>
        var episode_id = {{$episode->id}};
        const wrapper = document.getElementById('player-wrapper');
        const vastAds = "{{ Setting::get('jwplayer_advertising_file') }}";

        function chooseStreamingServer(el) {
            const type = el.dataset.type;
            const link = el.dataset.link.replace(/^http:\/\//i, 'https://');
            const id = el.dataset.id;

            const newUrl =
                location.protocol +
                "//" +
                location.host +
                location.pathname.replace(`-${episode_id}`, `-${id}`);

            history.pushState({
                path: newUrl
            }, "", newUrl);
            episode_id = id;


            Array.from(document.getElementsByClassName('streaming-server')).forEach(server => {
                server.classList.remove('bg-main-primary');
            })
            el.classList.add('bg-main-primary');
            document.getElementById('stream-server-active')?.remove();

            el.innerHTML +=
                `<span id="stream-server-active" class="flex absolute h-3 w-3 top-0 right-0 -mt-1 -mr-1"><span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-purple-400 opacity-75"></span><span class="relative inline-flex rounded-full h-3 w-3 bg-purple-500"></span></span>`;

            renderPlayer(type, link, id);
        }

        function renderPlayer(type, link, id) {
            if (type == 'embed') {
                if (vastAds) {
                    wrapper.innerHTML = `<div id="fake_jwplayer"></div>`;
                    const fake_player = jwplayer("fake_jwplayer");
                    const objSetupFake = {
                        key: "{{ Setting::get('jwplayer_license') }}",
                        aspectratio: "16:9",
                        width: "100%",
                        file: "/themes/september/player/1s_blank.mp4",
                        volume: 100,
                        mute: false,
                        autostart: true,
                        advertising: {
                            tag: "{{ Setting::get('jwplayer_advertising_file') }}",
                            client: "vast",
                            vpaidmode: "insecure",
                            skipoffset: {{ (int) Setting::get('jwplayer_advertising_skipoffset') ?: 5 }}, // Bỏ qua quảng cáo trong vòng 5 giây
                            skipmessage: "Bỏ qua sau xx giây",
                            skiptext: "Bỏ qua"
                        }
                    };
                    fake_player.setup(objSetupFake);
                    fake_player.on('complete', function(event) {
                        $("#fake_jwplayer").remove();
                        wrapper.innerHTML = `<iframe width="100%" height="100%" src="${link}" frameborder="0" scrolling="no"
                        allowfullscreen="" allow='autoplay'></iframe>`
                        fake_player.remove();
                    });

                    fake_player.on('adSkipped', function(event) {
                        $("#fake_jwplayer").remove();
                        wrapper.innerHTML = `<iframe width="100%" height="100%" src="${link}" frameborder="0" scrolling="no"
                        allowfullscreen="" allow='autoplay'></iframe>`
                        fake_player.remove();
                    });

                    fake_player.on('adComplete', function(event) {
                        $("#fake_jwplayer").remove();
                        wrapper.innerHTML = `<iframe width="100%" height="100%" src="${link}" frameborder="0" scrolling="no"
                        allowfullscreen="" allow='autoplay'></iframe>`
                        fake_player.remove();
                    });
                } else {
                    if (wrapper) {
                        wrapper.innerHTML = `<iframe width="100%" height="100%" src="${link}" frameborder="0" scrolling="no"
                        allowfullscreen="" allow='autoplay'></iframe>`
                    }
                }
                return;
            }

            if (type == 'm3u8' || type == 'mp4') {
                wrapper.innerHTML = `<div id="jwplayer"></div>`;
                const player = jwplayer("jwplayer");
                const objSetup = {
                    key: "{{ Setting::get('jwplayer_license') }}",
                    aspectratio: "16:9",
                    width: "100%",
                    image: "{{ $currentMovie->getPosterUrl() }}",
                    file: link,
                    playbackRateControls: true,
                    playbackRates: [0.25, 0.75, 1, 1.25],
                    sharing: {
                        sites: [
                            "reddit",
                            "facebook",
                            "twitter",
                            "googleplus",
                            "email",
                            "linkedin",
                        ],
                    },
                    volume: 100,
                    mute: false,
                    autostart: true,
                    logo: {
                        file: "{{ Setting::get('jwplayer_logo_file') }}",
                        link: "{{ Setting::get('jwplayer_logo_link') }}",
                        position: "{{ Setting::get('jwplayer_logo_position') }}",
                    },
                    advertising: {
                        tag: "{{ Setting::get('jwplayer_advertising_file') }}",
                        client: "vast",
                        vpaidmode: "insecure",
                        skipoffset: {{ (int) Setting::get('jwplayer_advertising_skipoffset') ?: 5 }}, // Bỏ qua quảng cáo trong vòng 5 giây
                        skipmessage: "Bỏ qua sau xx giây",
                        skiptext: "Bỏ qua"
                    }
                };

                if (type == 'm3u8') {
                    const segments_in_queue = 50;

                    var engine_config = {
                        debug: !1,
                        segments: {
                            forwardSegmentCount: 50,
                        },
                        loader: {
                            cachedSegmentExpiration: 864e5,
                            cachedSegmentsCount: 1e3,
                            requiredSegmentsPriority: segments_in_queue,
                            httpDownloadMaxPriority: 9,
                            httpDownloadProbability: 0.06,
                            httpDownloadProbabilityInterval: 1e3,
                            httpDownloadProbabilitySkipIfNoPeers: !0,
                            p2pDownloadMaxPriority: 50,
                            httpFailedSegmentTimeout: 500,
                            simultaneousP2PDownloads: 20,
                            simultaneousHttpDownloads: 2,
                            // httpDownloadInitialTimeout: 12e4,
                            // httpDownloadInitialTimeoutPerSegment: 17e3,
                            httpDownloadInitialTimeout: 0,
                            httpDownloadInitialTimeoutPerSegment: 17e3,
                            httpUseRanges: !0,
                            maxBufferLength: 300,
                            // useP2P: false,
                        },
                    };
                    if (Hls.isSupported() && p2pml.hlsjs.Engine.isSupported()) {
                        var engine = new p2pml.hlsjs.Engine(engine_config);
                        player.setup(objSetup);
                        jwplayer_hls_provider.attach();
                        p2pml.hlsjs.initJwPlayer(player, {
                            liveSyncDurationCount: segments_in_queue, // To have at least 7 segments in queue
                            maxBufferLength: 300,
                            loader: engine.createLoaderClass(),
                        });
                    } else {
                        player.setup(objSetup);
                    }
                } else {
                    player.setup(objSetup);
                }

                const resumeData = 'OPCMS-PlayerPosition-' + id;

                player.on('ready', function() {
                    if (typeof(Storage) !== 'undefined') {
                        if (localStorage[resumeData] == '' || localStorage[resumeData] == 'undefined') {
                            console.log("No cookie for position found");
                            var currentPosition = 0;
                        } else {
                            if (localStorage[resumeData] == "null") {
                                localStorage[resumeData] = 0;
                            } else {
                                var currentPosition = localStorage[resumeData];
                            }
                            console.log("Position cookie found: " + localStorage[resumeData]);
                        }
                        player.once('play', function() {
                            console.log('Checking position cookie!');
                            console.log(Math.abs(player.getDuration() - currentPosition));
                            if (currentPosition > 180 && Math.abs(player.getDuration() - currentPosition) >
                                5) {
                                player.seek(currentPosition);
                            }
                        });
                        window.onunload = function() {
                            localStorage[resumeData] = player.getPosition();
                        }
                    } else {
                        console.log('Your browser is too old!');
                    }
                });

                player.on('complete', function() {
                    if (typeof(Storage) !== 'undefined') {
                        localStorage.removeItem(resumeData);
                    } else {
                        console.log('Your browser is too old!');
                    }
                })

                function formatSeconds(seconds) {
                    var date = new Date(1970, 0, 1);
                    date.setSeconds(seconds);
                    return date.toTimeString().replace(/.*(\d{2}:\d{2}:\d{2}).*/, "$1");
                }
            }
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const episode = '{{$episode->id}}';
            let playing = document.querySelector(`[data-id="${episode}"]`);
            if (playing) {
                playing.click();
                return;
            }

            const servers = document.getElementsByClassName('streaming-server');
            if (servers[0]) {
                servers[0].click();
            }
        });
    </script>
    <script>
        $("#report_episode_btn").click(() => {
            fetch("{{ route('episodes.report', ['movie' => $currentMovie->slug, 'episode' => $episode->slug, 'id' => $episode->id]) }}", {
                method: 'POST',
                headers: {
                    "Content-Type": "application/json",
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content')
                },
                body: JSON.stringify({
                    message: document.getElementById('report_message')
                        .innerHTML ??
                        ''
                })
            });
            $("#modal-report").toggle("hidden");
            $("#modal-report-backdrop").toggle("hidden");
            $("#toggleModal-report").remove();
        })
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
