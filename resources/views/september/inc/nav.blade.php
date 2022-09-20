<!-- BEGIN NAVBAR -->
<nav id="nav-menu"
    class="hidden xl:block container mx-auto py-0 px-2 bg-main-700 xl:bg-main-800 xl:mt-5 shadow-navbar rounded-md rounded-t-none xl:rounded-t">
    <ul class="w-full xl:flex items-center bg-main-700 xl:bg-main-800 px-1 py-1 xl:space-x-4 text-[#D0D2D6]">
        @foreach ($menu as $item)
            <li
                class="group leading-6 cursor-pointer hover:bg-[#161D31] transition duration-150 ease-in-out py-2 my-1 rounded-md px-4 xl:px-2 tracking-wide relative block xl:flex xl:justify-between items-center space-x-1">
                @if (count($item['children']))
                    <span>{{ $item->name }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M19 9l-7 7-7-7" />
                    </svg>
                    <div class="group-hover:block hidden top-full left-0 xl:absolute h-auto pt-4 z-20">
                        <ul
                            class="w-full xl:w-max grid grid-flow-rows grid-cols-2 md:grid-cols-4 gap-1 bg-main-700 xl:bg-main-800 rounded-md xl:shadow max-h-48 md:max-h-full overflow-auto">
                            @foreach ($item['children'] as $children)
                                <li class="py-1 px-2 xl:py-2 xl:px-4">
                                    <a href="{{ $children['link'] }}"
                                        class="block text-gray-300 text-base cursor-pointer hover:translate-x-1 transition duration-200">
                                        {{ $children['name'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @else
                    <a href="{{ $item['link'] }}"
                        class="block text-gray-300 text-base cursor-pointer transition duration-200">
                        {{ $item['name'] }}
                    </a>
                @endif
            </li>
        @endforeach
    </ul>
</nav>
<!-- END NAVBAR -->
