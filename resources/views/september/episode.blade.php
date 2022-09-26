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
                <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                    <a class="text-main-primary hover:text-main-warning" itemprop="item"
                        href="{{ $currentMovie->getUrl() }}" title="{{ $currentMovie->name }}">
                        <span itemprop="name">
                            {{ $currentMovie->name }}
                        </span>
                    </a>
                    <i class="fa-thin fa-chevron-right text-xs"></i>
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
                        <i class="fa-solid fa-bug"></i> Báo lỗi
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
                                        @if ($episode->server == $server) <i class="fa-solid fa-server"></i> @endif {{ $server }}
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
            <img style="aspect-ratio: 266/400" src="{{ $currentMovie->thumb_url }}" alt="{{ $currentMovie->name }}"
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
                                <i class="fa-solid fa-triangle-exclamation text-red-600"></i>
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
        const wrapper = document.getElementById('player-wrapper');
        const vastAds = "{{ Setting::get('jwplayer_advertising_file') }}";

        function chooseStreamingServer(el) {
            const type = el.dataset.type;
            const link = el.dataset.link;
            const id = el.dataset.id;

            const newUrl =
                location.protocol +
                "//" +
                location.host +
                location.pathname +
                "?id=" + id;

            history.pushState({
                path: newUrl
            }, "", newUrl);


            Array.from(document.getElementsByClassName('streaming-server')).forEach(server => {
                server.classList.remove('bg-main-primary');
            })
            el.classList.add('bg-main-primary');
            document.getElementById('stream-server-active')?.remove();

            el.innerHTML +=
                `<span id="stream-server-active" class="flex absolute h-3 w-3 top-0 right-0 -mt-1 -mr-1"><span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-purple-400 opacity-75"></span><span class="relative inline-flex rounded-full h-3 w-3 bg-purple-500"></span></span>`;


            link.replace('http://', 'https://');
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
                    image: "{{ $currentMovie->poster_url ?: $currentMovie->thumb_url }}",
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

                player.setup(objSetup);
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
            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);
            const episode = urlParams.get('id')
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
            fetch("{{ route('episodes.report', ['movie' => $currentMovie->slug, 'episode' => $episode->slug]) }}", {
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
