<div id="slider_poster_{{ $loop->index }}" class="owl-carousel owl-theme absolute">
    @foreach ($item['data'] ?? [] as $movie)
        <a href="{{ $movie->getUrl() }}" title="{{ $movie->name ?? '' }}"
            class="block row-span-1 col-span-1 md:row-span-2 md:col-span-2 overflow-hidden relative group">
            <img style="aspect-ratio: 16/9" src="{{ $movie->getPosterUrl() }}" alt="{{ $movie->name ?? '' }}"
                class="group-hover:opacity-60 transition-all duration-500 transform group-hover:bg-opacity-60" />
            <span class="absolute bottom-0 px-2 pb-2 pt-16 bg-gradient-to-t from-main-900 w-full text-main-warning">
                <div class="font-bold overflow-hidden overflow-ellipsis whitespace-nowrap">{{ $movie->name }}</div>
                <div class="text-sm text-gray-300 italic overflow-hidden overflow-ellipsis whitespace-nowrap">
                    {{ $movie->origin_name }} ({{ $movie->publish_year }})
                </div>
            </span>
            <span class="absolute top-0 left-0 p-0.5 bg-main-primary text-sm">{{ $movie->episode_current }}</span>
        </a>
    @endforeach
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $("#slider_poster_{{ $loop->index }}").owlCarousel({
                items: 1,
                center: false,
                loop: true,
                dots: false,
                nav: true,
                margin: 10,
                stagePadding: 0,
                stageOuterClass: 'owl-stage-outer',
                responsive: {
                    1400: {
                        items: 4
                    },
                    1280: {
                        items: 3
                    },
                    1024: {
                        items: 2
                    },
                    768: {
                        items: 2
                    },
                },
                scrollPerPage: true,
                lazyLoad: true,
                slideSpeed: 800,
                paginationSpeed: 400,
                stopOnHover: true,
                autoplay: true,
                navText: [
                    `<button class="block absolute top-0 left-0 text-white bg-main-900/60 h-[90%]">
                        <span style="display: none" aria-label="Previous">‹</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 px-1 top-0 text-2xl">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18.75 19.5l-7.5-7.5 7.5-7.5m-6 15L5.25 12l7.5-7.5" />
                        </svg>
                    </button>`,
                    `<button class="block absolute top-0 right-0 text-white bg-main-900/60 h-[90%]">
                        <span style="display: none" aria-label="Next">›</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 px-1 top-0 text-2xl">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 4.5l7.5 7.5-7.5 7.5m-6-15l7.5 7.5-7.5 7.5" />
                        </svg>
                    </button>`
                ],
            });
        });
    </script>
@endpush
