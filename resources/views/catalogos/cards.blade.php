@foreach ($catalogosCardsData as $card)
    <div
        class="transition duration-300 transform bg-white shadow-sm rounded-xl xl:px-3 xl:py-3 dark:border-strokedark dark:bg-boxdark hover:scale-105">
        
        {{-- link --}}
        <a href="{{ $card['href'] }}" class="text-lg" title="Catálogo de {{ $card['titulo'] }}">

            <div class="flex flex-col items-center">
                <div class="mx-auto rounded-full xl:h-15 xl:w-20 ">
                  <div class="px-3 mt-3 rounded-full ">
                    @if (isset($card['imagen']))
                    <img src="{{$card['imagen']}}" class="h-12 "  alt="">
                   @endif
                  </div>
                </div>
                {{-- title --}}
                <h4 class="my-3 font-medium leading-6">
                    {{ $card['titulo'] }}
                </h4>
            </div>
        </a>

    </div>
@endforeach
