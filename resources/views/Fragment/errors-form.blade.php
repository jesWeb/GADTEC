@if ($errors->any())
    @foreach ($errors->all() as $e)
        <div class="p-4 text-white bg-red-500 rounded">
            {{ $e }}
        </div>
    @endforeach
@endif
