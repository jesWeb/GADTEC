@if ($paginator->hasPages())
    <div class="flex items-center justify-center py-4">
        <nav class="flex items-center space-x-4" aria-label="Pagination">
            {{-- Botón Anterior --}}
            @if ($paginator->onFirstPage())
                <button class="px-3 py-1 text-sm text-gray-500 border rounded-lg hover:bg-gray-100 disabled:opacity-50" disabled>
                    &larr; {!! __('Anterior') !!}
                </button>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="px-3 py-1 text-sm border rounded-lg hover:bg-gray-100">
                    &larr; {!! __('Anterior') !!}
                </a>
            @endif
            
            {{-- Números de Página --}}
            <ul class="flex space-x-2">
                @foreach ($elements as $element)
                    @if (is_string($element))
                        <li><span class="px-3 py-1 text-sm text-gray-500">{{ $element }}</span></li>
                    @endif
                    
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li>
                                    <span class="px-3 py-1 text-sm font-medium text-white bg-blue-500 border rounded-lg hover:bg-blue-600">
                                        {{ $page }}
                                    </span>
                                </li>
                            @else
                                <li>
                                    <a href="{{ $url }}" class="px-3 py-1 text-sm border rounded-lg hover:bg-gray-100">
                                        {{ $page }}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </ul>
            
            {{-- Botón Siguiente --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="px-3 py-1 text-sm border rounded-lg hover:bg-gray-100">
                    {!! __('Siguiente') !!} &rarr;
                </a>
            @else
                <button class="px-3 py-1 text-sm text-gray-500 border rounded-lg hover:bg-gray-100 disabled:opacity-50" disabled>
                    {!! __('Siguiente') !!} &rarr;
                </button>
            @endif
        </nav>
    </div>
@endif
