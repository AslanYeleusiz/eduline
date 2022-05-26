@if ($paginator->hasPages())
<nav>
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
        <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
            <span aria-hidden="true">&lsaquo;</span>
        </li>
        @else
        <li>
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">
                &lsaquo;
            </a>
        </li>
        @endif
        @foreach ($elements as $element)
        @foreach ($element as $page => $url)
        @if ($paginator->currentPage() > 3 && $page === 3)
        <li class="page-item disabled"><span>...</span></li>
        @endif
        @if ($page == $paginator->currentPage())
        <li class="page-item active"><span>{{ $page }}</span></li>
        @elseif ($page === $paginator->currentPage() + 1 || $page === $paginator->currentPage() + 1 || $page === $paginator->currentPage() - 1 || $page === $paginator->currentPage() - 1 || $page === $paginator->lastPage() || $page === 1)
        @if ($page === $paginator->lastPage()&&$paginator->currentPage()<$paginator->lastPage()-2)
            <li class="page-item disabled"><span>...</span></li>
            @endif
            <li class="page-item"><a href="{{ $url }}">{{ $page }}</a></li>
            @endif
            @endforeach
            @endforeach
            @if ($paginator->hasMorePages())
            <li>
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
            </li>
            @else
            <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <span aria-hidden="true">&rsaquo;</span>
            </li>
            @endif
    </ul>
</nav>
@endif
