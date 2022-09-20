@foreach ($tops as $top)
    <div class="bg-main-800/40 p-2 mt-2">
        <div class="text-center">
            <h3 class="font-semibold uppercase">{{ $top['label'] }}</h3>
        </div>
        <div class="space-y-1 block">
            @include('themes::september.inc.aside.' . $top['template'])
        </div>
    </div>
@endforeach
