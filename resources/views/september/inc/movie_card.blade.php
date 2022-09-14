<a href="{{ $movie->getUrl() }}" class="rounded-md overflow-hidden relative group" title="{{ $movie->name ?? '' }}">
    <img class="rounded-md group-hover:opacity-60 transition-all duration-500 transform group-hover:scale-110"
        style="aspect-ratio: 256/340" src="{{ $movie->thumb_url }}" alt="{{ $movie->name ?? '' }}" />

    <span
        class="absolute bottom-0 px-2 pb-2 pt-16 bg-gradient-to-t from-[#151111] rounded-md rounded-tl-none rounded-tr-none w-full text-white">
        <div class="font-bold text-sm overflow-hidden overflow-ellipsis whitespace-nowrap">{{ $movie->name ?? '' }}
        </div>
        <div class="text-xs text-gray-300 italic overflow-hidden overflow-ellipsis whitespace-nowrap">
            {{ $movie->origin_name }} ({{ $movie->publish_year }})
        </div>
    </span>
    @if ($movie->type == 'series' && $movie->status == 'ongoing')
        <span
            class="absolute top-0 left-0 p-0.5 bg-red-600 text-white text-sm rounded-md rounded-bl-none rounded-tr-none">{{ $movie->episode_current }}</span>
        <span
            class="absolute bottom-12 right-0 p-0.5 bg-gradient-to-r from-cyan-500/50 to-blue-500/50 text-white text-sm rounded-md rounded-br-none rounded-tr-none">Đang chiếu</span>
    @elseif ($movie->type == 'series' && $movie->status == 'completed')
        <div class="absolute top-[7%] -left-[34%] text-white uppercase py-[2px] px-0 text-[9px] w-full text-center -rotate-45 bg-gradient-to-r from-pink-500 to-yellow-500">Trọn Bộ</div>
    @endif
    @if ($movie->status == 'trailer')
        <div class="absolute top-[7%] -left-[34%] text-white uppercase py-[2px] px-0 text-[9px] w-full text-center -rotate-45 bg-gradient-to-r from-indigo-500">Sắp chiếu</div>
    @endif
    @if ($movie->is_recommended)
        <div class="absolute top-0.5 right-0.5 p-0.5 bg-red-600 text-white rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15.362 5.214A8.252 8.252 0 0112 21 8.25 8.25 0 016.038 7.048 8.287 8.287 0 009 9.6a8.983 8.983 0 013.361-6.867 8.21 8.21 0 003 2.48z" />
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 18a3.75 3.75 0 00.495-7.467 5.99 5.99 0 00-1.925 3.546 5.974 5.974 0 01-2.133-1A3.75 3.75 0 0012 18z" />
            </svg>
            <title>Phim hot</title>
        </div>
    @endif

    <div class="absolute hidden top-1/3 left-1/3 animate-pulse group-hover:block">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-red-600" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2}
                d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
    </div>
</a>
