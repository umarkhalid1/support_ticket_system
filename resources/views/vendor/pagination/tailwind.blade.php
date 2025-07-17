@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="mt-6">
        <ul class="inline-flex items-center justify-center space-x-2">

            @if ($paginator->onFirstPage())
                <li>
                    <span class="px-4 py-2 text-sm bg-gray-200 text-gray-500 rounded cursor-not-allowed">
                        « Previous
                    </span>
                </li>
            @else
                <li>
                    <button wire:click="previousPage"
                        class="px-4 py-2 text-sm bg-white text-gray-700 rounded border hover:bg-gray-100 transition">
                        « Previous
                    </button>
                </li>
            @endif
            @foreach ($elements as $element)
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li>
                                <span
                                    class="px-4 py-2 text-sm bg-gray-100 rounded font-semibold shadow cursor-not-allowed">
                                    {{ $page }}
                                </span>
                            </li>
                        @else
                            <li>
                                <button wire:click="gotoPage({{ $page }})"
                                    class="px-4 py-2 text-sm bg-white text-gray-700 rounded border hover:bg-gray-100 transition">
                                    {{ $page }}
                                </button>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <li>
                    <button wire:click="nextPage"
                        class="px-4 py-2 text-sm bg-white text-gray-700 rounded border hover:bg-gray-100 transition">
                        Next »
                    </button>
                </li>
            @else
                <li>
                    <span class="px-4 py-2 text-sm bg-gray-200 text-gray-500 rounded cursor-not-allowed">
                        Next »
                    </span>
                </li>
            @endif
        </ul>
    </nav>
@endif
