@foreach ($top['data'] ?? [] as $movie)
    @if ($loop->first)
        <a href="{{ $movie->getUrl() }}" title="{{ $movie->name }}" class="block overflow-hidden relative group">
            <img src="{{ $movie->getPosterUrl() }}"
                class="group-hover:opacity-60 transition-all duration-500 w-full h-[200px]" alt="{{ $movie->name }}" />
            <span class="absolute bottom-0 px-2 pb-2 pt-16 bg-gradient-to-t from-main-900 w-full text-main-warning">
                <div class="font-bold overflow-hidden overflow-ellipsis whitespace-nowrap">{{ $movie->name }}</div>
                <div class="text-sm text-gray-300 italic overflow-hidden overflow-ellipsis whitespace-nowrap">
                    {{ $movie->origin_name }} ({{ $movie->publish_year }})
                </div>
            </span>

            <div class="absolute top-0 right-0 bg-main-800/40 p-2 flex gap-x-1 items-center text-main-success">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>

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
                    class="w-6 text-center bg-main-primary group-hover:text-main-warning bg-opacity-10 text-main-primary font-bold">
                    {{ $loop->index + 1 }}</div>
                <div class="basis-4/6 flex-grow px-2 space-y-2 overflow-hidden">
                    <div
                        class="font-bold text-main-primary text-sm group-hover:text-main-warning transition duration-300 ease-in-out overflow-hidden overflow-ellipsis whitespace-nowrap">
                        {{ $movie->name }}</div>
                </div>
                <div class="flex gap-x-0.5 items-center text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>

                    <span class="text-xs">
                        {{ $movie->view_week ?? 0 }}
                    </span>
                </div>
            </div>
        </a>
    @endif
@endforeach
