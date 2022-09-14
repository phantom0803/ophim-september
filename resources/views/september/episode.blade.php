@extends('themes::september.layout')

@section('content')
    <ul class="breadcrumb w-full px-2 py-2 mb-3 bg-[#151111] rounded-lg text-white">
        <li class="inline hover:text-yellow-400" itemprop="itemListElement" itemscope=""
            itemtype="http://schema.org/ListItem">
            <a itemprop="item" href="/" title="Xem phim">
                <span itemprop="name">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4 inline">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                    Xem phim »
                </span>
            </a>
            <meta itemprop="position" content="1">
        </li>
        <li class="inline hover:text-yellow-400" itemprop="itemListElement" itemscope=""
            itemtype="http://schema.org/ListItem">
            <a itemprop="item" href="/danh-sach/{{ $currentMovie->type == 'single' ? 'phim-le' : 'phim-bo' }}"
                title="{{ $currentMovie->type == 'single' ? 'Phim Lẻ' : 'Phim Bộ' }}">
                <span itemprop="name">
                    {{ $currentMovie->type == 'single' ? 'Phim Lẻ' : 'Phim Bộ' }} »
                </span>
            </a>
            <meta itemprop="position" content="2">
        </li>
        @foreach ($currentMovie->regions as $region)
            <li class="inline hover:text-yellow-400" itemprop="itemListElement" itemscope=""
                itemtype="http://schema.org/ListItem">
                <a itemprop="item" href="{{ $region->getUrl() }}" title="{{ $region->name }}">
                    <span itemprop="name">
                        {{ $region->name }} »
                    </span>
                </a>
                <meta itemprop="position" content="3">
            </li>
        @endforeach
        @foreach ($currentMovie->categories as $category)
            <li class="inline hover:text-yellow-400" itemprop="itemListElement" itemscope=""
                itemtype="http://schema.org/ListItem">
                <a itemprop="item" href="{{ $category->getUrl() }}" title="{{ $category->name }}">
                    <span itemprop="name">
                        {{ $category->name }} »
                    </span>
                </a>
                <meta itemprop="position" content="3">
            </li>
        @endforeach
        <li class="inline hover:text-yellow-400" itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
            <a itemprop="item" href="{{ $currentMovie->getUrl() }}" title="{{ $currentMovie->name }}">
                <span itemprop="name">
                    {{ $currentMovie->name }} »
                </span>
            </a>
            <meta itemprop="position" content="4">
        </li>
        <li class="inline text-gray-400" itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
            <a itemprop="item" href="{{ url()->current() }}" title="Xem phim">
                <span itemprop="name">
                    Xem phim
                </span>
            </a>
            <meta itemprop="position" content="5">
        </li>
    </ul>

    <div class="flex rounded-lg p-0 md:p-2 text-[#bbb] bg-[#1511116d] mb-2">
        <div class="w-[120px] md:w-[145px] pr-0">
            <div class="rounded-md w-full h-[fit-content] p-2">
                <img class="w-full cursor-pointer rounded-md" style="aspect-ratio: 256/340" src="{{ $currentMovie->thumb_url }}"
                    alt="" />
            </div>
        </div>

        <div class="w-full pr-2">
            <h1>
                <span class="uppercase text-sm xl:text-xl text-[#dacb46] block font-bold">
                    <a href="{{ URL::current() }}"
                        title="Xem phim {{ $currentMovie->name }} - Tập {{ $episode->name }}">Xem phim {{ $currentMovie->name }} - Tập {{ $episode->name }}</a>
                </span>
            </h1>

            <h2>
                <span class="text-gray-300 text-base">{{ $currentMovie->origin_name ?? '' }}</span>
                <span class="text-gray-300 text-base"> ({{ $currentMovie->publish_year ?? 'Đang cập nhật...' }})</span>
            </h2>

            <article
                class="w-auto h-[56px] md:h-[96px] overflow-y-auto rounded-lg text-[#bbb] bg-[#272727] bg-opacity-50 p-1 mt-1">
                @if ($currentMovie->content)
                    <div class="whitespace-pre-wrap">{!! $currentMovie->content !!}</div>
                @else
                    <p>Đang cập nhật ...</p>
                @endif
            </article>
        </div>
    </div>

    @if ($currentMovie->showtimes && $currentMovie->showtimes != '')
        <div class="mt-2.5 p-2 bg-[#1511116d] mb-1 rounded-lg text-gray-300">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6 inline animate-pulse">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
            </svg>
            Lịch chiếu: <span class="text-yellow-500">{!! $currentMovie->showtimes !!}</span>
        </div>
    @endif
    @if ($currentMovie->notify && $currentMovie->notify != '')
        <div class="mt-2.5 p-2 bg-[#1511116d] mb-2 rounded-lg text-gray-300">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6 inline animate-pulse">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0M3.124 7.5A8.969 8.969 0 015.292 3m13.416 0a8.969 8.969 0 012.168 4.5" />
            </svg>
            Thông báo: <span class="text-red-500">{{ strip_tags($currentMovie->notify) }}</span>
        </div>
    @endif

    <div class="h-content">
        <div class="flex iframe w-full" style="aspect-ratio: 16 / 9;" id="player-wrapper"></div>
    </div>

    <div class="flex justify-between mt-1">
        <div class="text-[#FDB813] mb-2 text-sm mt-2">Mẹo: Chọn Server hoặc Nguồn phát khác khi lỗi!</div>
        <div class="bg-[#151111] hover:bg-red-600 items-center text-sm text-white shadow text-center py-1 px-2 rounded cursor-pointer self-center"
            data-modal-toggle="report-modal">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                stroke="currentColor" aria-hidden="true" class="w-5 h-5 inline">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                </path>
            </svg><span class="hidden md:inline">Báo Lỗi</span>
        </div>
    </div>
    <div id="report-modal" tabindex="-1"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
        <div class="relative p-4 w-full max-w-md h-full md:h-auto">
            <!-- Modal content -->
            <div class="relative rounded-lg shadow bg-[#151111]">
                <!-- Modal header -->
                <div class="flex justify-between items-center p-5 rounded-t border-b border-gray-600">
                    <div class="text-xl font-medium text-red-600">
                        Báo lỗi phim
                        <p class="text-yellow-500">
                            {{ $currentMovie->name }}
                        </p>
                    </div>
                    <button type="button"
                        class="text-gray-400 bg-transparent rounded-lg text-sm p-1.5 ml-auto inline-flex items-center hover:bg-red-600 hover:text-white"
                        data-modal-toggle="report-modal" data>
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Đóng</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-6">
                    <p class="text-base leading-relaxed text-gray-400">
                        <textarea id="report_message" class="w-full p-3 bg-[#272727] text-white focus:outline-none" rows="5"
                            placeholder="Hãy nhập nội dung lỗi để chúng mình sửa nhanh hơn...">Không tải được tập phim</textarea>
                    </p>
                </div>
                <div class="flex justify-end p-6 space-x-2 rounded-b border-t border-gray-600">
                    <button data-modal-toggle="report-modal" type="button" id="report_episode_btn"
                        class="text-white bg-red-600 hover:bg-red-600/80 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 focus:z-10">Gửi</button>
                </div>
            </div>
        </div>
    </div>
    <div class="flex flex-wrap justify-center gap-1 py-3 text-white" id="stream-servers">
        @foreach ($currentMovie->episodes->where('slug', $episode->slug)->where('server', $episode->server) as $server)
            <a onclick="chooseStreamingServer(this)" data-type="{{ $server->type }}" data-id="{{ $server->id }}"
                data-link="{{ $server->link }}"
                class="streaming-server hover:cursor-pointer uppercase current bg-[#151111] hover:bg-red-600 hover:bg-opacity-80 shadow-md px-2 py-1 mr-1 rounded text-sm">Nguồn
                phát #{{ $loop->index }}
            </a>
        @endforeach
    </div>
    <div class="my-3 p-2 md:flex justify-center items-center gap-x-2 bg-[#272727] rounded-sm">
        <div id="movies-rating-star" class="flex"></div>
        <div class="text-xs text-white align-middle">
            ({{ number_format($currentMovie->rating_star ?? 0, 1) }}
            sao
            /
            {{ $currentMovie->rating_count ?? 0 }} đánh giá)
        </div>
        <div id="movies-rating-msg" class="text-[#FDB813] mb-2 font-bold text-sm mt-2"></div>
    </div>

    @foreach ($currentMovie->episodes->groupBy('server') as $server => $data)
        <div class="flex flex-col my-3 mt-6 p-2 bg-[#272727] bg-opacity-50">
            <h2 id="heading-{{ $loop->index }}">
                <button class="flex justify-between w-full py-2 font-medium text-left text-slate-200 rounded-sm"
                    data-accordion-target="#body-{{ $loop->index }}">
                    <span>Danh sách tập: <span class="text-red-600">{{ $server }}</span></span>
                    <svg data-accordion-icon class="w-6 h-6 shrink-0" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </h2>
            <div id="body-{{ $loop->index }}" class="mt-2">
                <div class="w-full grid grid-cols-4 md:grid-cols-6 lg:grid-cols-12 gap-2">
                    @foreach ($data->sortBy('name', SORT_NATURAL)->groupBy('name') as $name => $item)
                        <a class="episode grow text-center hover:cursor-pointer shadow text-white py-1 bg-[#151111] hover:bg-red-600 hover:bg-opacity-80 shadow-md rounded @if ($item->contains($episode)) bg-red-600 @endif"
                            title="{{ $name }}" href="{{ $item->first()->getUrl() }}">
                            {{ $name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach

    <div class="mt-1.5">{!! $currentMovie->tags->map(function ($tag) {
            return '<a class="bg-[#111] text-[#ccc] hover:text-white px-2 border-[#333] border-[1px]" href="' .
                $tag->getUrl() .
                '" title="' .
                $tag->name .
                '">' .
                $tag->name .
                '</a>';
        })->implode(', ') !!}</div>

    <div class="fb-comments w-full rounded-lg bg-white mt-2.5" data-href="{{ $currentMovie->getUrl() }}" data-width="100%"
        data-numposts="5" data-colorscheme="dark" data-lazy="true">
    </div>

    <div class="mt-2.5 p-3 bg-[#1511116d] mb-3 rounded-lg">
        <h3 class="text-sm font-bold text-[#dacb46] uppercase mt-1.5 mb-3">
            Có thể bản muốn xem
        </h3>
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-2">
            @foreach ($movie_related ?? [] as $movie)
                @include('themes::september.inc.movie_card')
            @endforeach
        </div>
    </div>

@endsection

@section('footer')
    @parent
    <script src="/js/jwplayer-8.9.3.js"></script>
    <script src="/js/hls.min.js"></script>
    <script src="/js/jwplayer.hlsjs.min.js"></script>

    {{-- Star Rating Plugins --}}
    <script src="/themes/september/js/plugins/jquery-raty/jquery.raty.js"></script>
    <link href="/themes/september/js/plugins/jquery-raty/jquery.raty.css" rel="stylesheet" type="text/css" />

    <script>
        var rated = false;
        $('#movies-rating-star').raty({
            score: {{ number_format($currentMovie->rating_star ?? 0, 1) }},
            number: 10,
            numberMax: 10,
            hints: ['quá tệ', 'tệ', 'không hay', 'không hay lắm', 'bình thường', 'xem được', 'có vẻ hay', 'hay',
                'rất hay', 'siêu phẩm'
            ],
            starOff: '/themes/september/js/plugins/jquery-raty/images/star-off.png',
            starOn: '/themes/september/js/plugins/jquery-raty/images/star-on.png',
            starHalf: '/themes/september/js/plugins/jquery-raty/images/star-half.png',
            click: function(score, evt) {
                if (rated) return
                fetch("{{ route('movie.rating', ['movie' => $currentMovie->slug, 'episode' => $episode->slug]) }}", {
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

    <script>
        $(document).ready(function() {
            $('html, body').animate({
                scrollTop: $('#player-wrapper').offset().top - 60
            }, 'slow');
        });
    </script>

    <script>
        const wrapper = document.getElementById('player-wrapper');

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
                server.classList.remove('bg-red-600');
            })
            el.classList.add('bg-red-600')

            link.replace('http://', 'https://');
            renderPlayer(type, link, id);
        }

        function renderPlayer(type, link, id) {
            if (type == 'embed') {
                if (wrapper) {
                    wrapper.innerHTML = `<iframe width="100%" height="100%" src="${link}" frameborder="0" scrolling="no"
                            allowfullscreen=""></iframe>;`
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
        document.getElementById('report_episode_btn').addEventListener('click', function() {
            fetch(location.href, {
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
        })
    </script>
@endsection

@push('scripts')
    {!! setting('site_scripts_facebook_sdk') !!}
@endpush
