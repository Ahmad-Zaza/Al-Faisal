@if ($paginator->hasPages())
    @if ($paginator->onFirstPage())
        <span class="previous-link-disable">
            <i class="fa fa-long-arrow-left" aria-hidden="true"></i>
        </span>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" class="previous-link">
            <i class="fa fa-long-arrow-left" aria-hidden="true"></i>
        </a>
    @endif
    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" class="next-link">
            <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
        </a>
    @else
        <span class="next-link-disable">
            <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
        </span>
    @endif
@endif
