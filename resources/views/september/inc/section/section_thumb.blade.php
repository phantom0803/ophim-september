<div
    class="grid grid-flow-row grid-cols-2 sm:grid-cols-3 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-6 gap-2">
    @foreach ($item['data'] ?? [] as $movie)
        <a href="{{ $movie->getUrl() }}" class="overflow-hidden relative group" title="{{ $movie->name ?? '' }}">
            <img style="aspect-ratio: 256/340" src="{{ $movie->thumb_url }}" alt="{{ $movie->name ?? '' }}"
                class="group-hover:opacity-60 transition-all duration-500 transform group-hover:scale-110" />
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
                <i class="fa-brands fa-google-play text-6xl text-main-warning"></i>
            </div>
        </a>
    @endforeach
</div>
