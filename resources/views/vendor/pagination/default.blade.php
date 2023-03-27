@if ($paginator->hasPages())
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            {{-- <li class="disabled pagination-li li-paginator-disabled"><span>&laquo;</span></li> --}}
            <li class="disabled pagination-li li-paginator-disabled">
                <span>
                    <i class="fa fa-long-arrow-left" aria-hidden="true"></i>
                </span>
            </li>
        @else
            <li class="pagination-li">
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev">
                    <i class="fa fa-long-arrow-left" aria-hidden="true"></i>
                </a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled pagination-li li-paginator-disabled"><span>{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active pagination-li li-active"><span>{{ $page }}</span></li>
                    @else
                        <li class="pagination-li"><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="pagination-li">
                <a href="{{ $paginator->nextPageUrl() }}" rel="next">
                    <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                </a>
            </li>
        @else
            {{-- <li class="disabled pagination-li li-paginator-disabled"><span>&raquo;</span></li> --}}
            <li class="disabled pagination-li li-paginator-disabled">
                <span>
                    <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                </span>
            </li>
        @endif
    </ul>
@endif
