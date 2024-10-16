@foreach ($catalogosCardsData as $card)
    <div
        class="transition duration-300 transform bg-white shadow-sm rounded-xl xl:px-3 xl:py-3 dark:border-strokedark dark:bg-boxdark hover:scale-105">
        {{-- link --}}
        <a href="{{ $card['href'] }}" class="text-lg">

            <div class="flex flex-col items-center">

                <div class="mx-auto rounded-full xl:h-15 xl:w-20 md:h-25 ">
                    <img src="https://picsum.photos/200/300" alt="">
                </div>
                {{-- title --}}
                <h4 class="my-3 font-medium leading-6">
                    {{ $card['titulo'] }}
                </h4>
            </div>
        </a>

    </div>
@endforeach
