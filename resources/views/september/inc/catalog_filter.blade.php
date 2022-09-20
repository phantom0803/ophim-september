<div class="w-full container mx-auto mt-2 bg-main-800/40">
    <div class="text-gray-50">
        <form id="form-filter" class="lg:flex flex-wrap gap-1 items-center">
            <div class="p-2 flex justify-between">
                Lọc Phim
            </div>
            <div class="p-2">
                <select name="filter[sort]" form="form-search" class="scroll bg-main-700 p-2 outline-none">
                    <option value="">Sắp xếp</option>
                    <option value="update" @if (isset(request('filter')['sort']) && request('filter')['sort'] == 'update') selected @endif>Thời gian cập nhật</option>
                    <option value="create" @if (isset(request('filter')['sort']) && request('filter')['sort'] == 'create') selected @endif>Thời gian đăng</option>
                    <option value="year" @if (isset(request('filter')['sort']) && request('filter')['sort'] == 'year') selected @endif>Năm sản xuất</option>
                    <option value="view" @if (isset(request('filter')['sort']) && request('filter')['sort'] == 'view') selected @endif>Lượt xem</option>
                </select>
            </div>
            <div class="p-2">
                <select name="filter[type]" form="form-search" class="scroll bg-main-700 p-2 outline-none">
                    <option value="">Mọi định dạng</option>
                    <option value="series" @if (isset(request('filter')['type']) && request('filter')['type'] == 'series') selected @endif>Phim bộ</option>
                    <option value="single" @if (isset(request('filter')['type']) && request('filter')['type'] == 'single') selected @endif>Phim lẻ</option>
                </select>
            </div>
            <div class="p-2">
                <select name="filter[category]" form="form-search" class="scroll bg-main-700 p-2 outline-none">
                    <option value="">Tất cả thể loại</option>
                    @foreach (\Ophim\Core\Models\Category::fromCache()->all() as $item)
                        <option value="{{ $item->id }}" @if ((isset(request('filter')['category']) && request('filter')['category'] == $item->id) ||
                            (isset($category) && $category->id == $item->id)) selected @endif>
                            {{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="p-2">
                <select name="filter[region]" form="form-search" class="scroll bg-main-700 p-2 outline-none">
                    <option value="">Tất cả quốc gia</option>
                    @foreach (\Ophim\Core\Models\Region::fromCache()->all() as $item)
                        <option value="{{ $item->id }}" @if ((isset(request('filter')['region']) && request('filter')['region'] == $item->id) ||
                            (isset($region) && $region->id == $item->id)) selected @endif>
                            {{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="p-2">
                <select name="filter[year]" form="form-search" class="scroll bg-main-700 p-2 outline-none">
                    <option value="">Tất cả năm</option>
                    @foreach ($years as $year)
                        <option value="{{ $year }}" @if (isset(request('filter')['year']) && request('filter')['year'] == $year) selected @endif>
                            {{ $year }}</option>
                    @endforeach
                </select>
            </div>
            <div class="p-2">
                <button type="submit" form="form-search"
                    class="w-content text-center bg-main-labelbgSecondary text-white hover:shadow-menu hover:bg-main-primary duration-150 p-1.5 overflow-hidden overflow-ellipsis whitespace-nowrap">
                    <span>Duyệt phim</span>
                </button>
            </div>
        </form>
    </div>
</div>
