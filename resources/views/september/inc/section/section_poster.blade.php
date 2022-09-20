<div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 2xl:grid-cols-5 grid-flow-row gap-2">
    @foreach ($item['data'] ?? [] as $movie)
        @if ($loop->first)
            <a href="{{ $movie->getUrl() }}" title="{{ $movie->name ?? '' }}"
                class="row-span-1 col-span-2 md:row-span-2 md:col-span-2 overflow-hidden relative group">
                <img
                    src="{{ $movie->poster_url }}" alt="{{ $movie->name ?? '' }}"
                    class="group-hover:opacity-60 transition-all duration-500 transform group-hover:scale-110 w-full h-full" />
                <span class="absolute bottom-0 px-2 pb-2 pt-16 bg-gradient-to-t from-main-900 w-full text-main-warning">
                    <div class="font-bold overflow-hidden overflow-ellipsis whitespace-nowrap">{{ $movie->name }}</div>
                    <div class="text-sm text-gray-300 italic overflow-hidden overflow-ellipsis whitespace-nowrap">
                        {{ $movie->origin_name }} ({{ $movie->publish_year }})
                    </div>
                </span>
                <span class="absolute top-0 left-0 p-0.5 bg-main-primary text-sm">Tập
                    10</span>
            </a>
        @else
            <a href="{{ $movie->getUrl() }}" title="{{ $movie->name ?? '' }}" class="overflow-hidden relative group">
                <img src="{{ $movie->poster_url }}" alt="{{ $movie->name ?? '' }}"
                    class="group-hover:opacity-60 transition-all duration-500 transform group-hover:scale-110 w-full h-full" />
                <span class="absolute bottom-0 px-2 pb-2 pt-16 bg-gradient-to-t from-main-900 w-full text-main-warning">
                    <div class="font-bold overflow-hidden overflow-ellipsis whitespace-nowrap">{{ $movie->name }}</div>
                    <div class="text-sm text-gray-300 italic overflow-hidden overflow-ellipsis whitespace-nowrap">
                        {{ $movie->origin_name }} ({{ $movie->publish_year }})
                    </div>
                </span>
                <span class="absolute top-0 left-0 p-0.5 bg-main-primary text-sm">Tập
                    10</span>
            </a>
        @endif
    @endforeach
</div>
