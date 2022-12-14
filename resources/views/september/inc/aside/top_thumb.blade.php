@foreach ($top['data'] ?? [] as $movie)
    <a href="{{ $movie->getUrl() }}" title="{{ $movie->name }}" class="group">
        <div
            class="flex justify-start items-center space-x-1 py-1 border-b-[1px] border-main-secondary border-dashed border-opacity-25">
            <div class="w-6 text-center bg-main-primary group-hover:text-main-warning bg-opacity-10 text-main-primary font-bold">{{ $loop->index + 1 }}</div>
            <div class="w-[45px] h-[57px]">
                <img src="{{ $movie->thumb_url }}" alt="{{ $movie->origin_name }} ({{ $movie->publish_year }})"
                    class="group-hover:opacity-60 w-full h-full transition duration-300 ease-in-out" />
            </div>
            <div class="basis-4/6 flex-grow px-2 space-y-2 overflow-hidden">
                <div
                  class="font-bold text-main-primary text-sm group-hover:text-main-warning transition duration-300 ease-in-out overflow-hidden overflow-ellipsis whitespace-nowrap">{{ $movie->name }}</div>
                <div class="italic text-xs text-gray-400 overflow-hidden overflow-ellipsis whitespace-nowrap">{{ $movie->origin_name }} ({{ $movie->publish_year }})</div>
              </div>
            <div class="flex gap-x-0.5 items-center text-gray-400">
                <i class="fa-regular fa-eye text-xs"></i>
                <span class="text-xs">
                    {{ $movie->view_week ?? 0 }}
                </span>
            </div>
        </div>
    </a>
@endforeach
