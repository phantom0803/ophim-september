@foreach ($top['data'] ?? [] as $movie)
    @if ($loop->first)
        <a href="{{ $movie->getUrl() }}" title="{{ $movie->name }}" class="overflow-hidden relative group">
            <img src="{{ $movie->poster_url }}" class="group-hover:opacity-60 transition-all duration-500 w-full h-full"
                alt="" />
            <span class="absolute bottom-0 px-2 pb-2 pt-16 bg-gradient-to-t from-main-900 w-full text-main-warning">
                <div class="font-bold overflow-hidden overflow-ellipsis whitespace-nowrap">{{ $movie->name }}</div>
                <div class="text-sm text-gray-300 italic overflow-hidden overflow-ellipsis whitespace-nowrap">
                    {{ $movie->origin_name }} ({{ $movie->publish_year }})
                </div>
            </span>

            <div class="absolute top-0 right-0 bg-main-800/80 p-2 flex gap-x-1 items-center text-main-success">
                <i class="fa-regular fa-eye text-xs"></i>
                <span class="text-xs">
                    {{ $movie->view_week ?? 0 }}
                </span>
            </div>

        </a>
    @else
        <a href="{{ $movie->getUrl() }}" title="{{ $movie->name }}" class="group">
            <div
                class="flex justify-start items-center space-x-1 py-1 border-b-[1px] border-main-secondary border-dashed border-opacity-25">
                <div
                    class="bg-main-primary group-hover:text-main-warning bg-opacity-10 px-2 text-main-primary font-bold">
                    {{ $loop->index + 1 }}</div>
                <div class="flex-grow px-2 space-y-2 overflow-hidden overflow-ellipsis whitespace-nowrap">
                    <div
                        class="font-bold text-main-primary text-sm group-hover:text-main-warning transition duration-300 ease-in-out">
                        {{ $movie->name }}</div>
                </div>
                <div class="flex gap-x-0.5 items-center text-gray-400">
                    <i class="fa-regular fa-eye text-xs"></i>
                    <span class="text-xs">
                        {{ $movie->view_week ?? 0 }}
                    </span>
                </div>
            </div>
        </a>
    @endif
@endforeach
