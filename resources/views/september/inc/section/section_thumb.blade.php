<div
    class="grid grid-flow-row grid-cols-2 sm:grid-cols-3 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-6 gap-2">
    @foreach ($item['data'] ?? [] as $movie)
        <a href="{{ $movie->getUrl() }}" class="overflow-hidden relative group" title="{{ $movie->name ?? '' }}">
            <img style="aspect-ratio: 256/340" data-src="{{ $movie->getThumbUrl() }}" alt="{{ $movie->name ?? '' }}"
                class="w-full group-hover:opacity-60 transition-all duration-500 transform group-hover:scale-110 lazyload" />
            <span class="absolute bottom-0 px-2 pb-2 pt-16 bg-gradient-to-t from-main-900 w-full text-main-warning">
                <div class="font-bold overflow-hidden overflow-ellipsis whitespace-nowrap">{{ $movie->name }}</div>
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
