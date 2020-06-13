@if ($paginator->hasPages())
<div class="p-pagination">
    <ul class="p-pagination-container" role="navigation">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="p-pagination-list" aria-disabled="true" aria-label="@lang('pagination.previous')">
                «
            </li>
        @else
            <li class="p-pagination-list">
                <a class="p-pagination-list-item" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">«</a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="p-pagination-list" aria-disabled="true">{{ $element }}</li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="p-pagination-list" aria-current="page"><a class="active p-pagination-list-item" href="#">{{ $page }}</a></li>
                    @else
                        <li class="p-pagination-list"><a href="{{ $url }}" class="p-pagination-list-item">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="p-pagination-list">
                <a class="p-pagination-list-item" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">»</a>
            </li>
        @else
            <li class="p-pagination-list" aria-disabled="true" aria-label="@lang('pagination.next')">
            »
            </li>
        @endif
    </ul>
</div>
@endif
