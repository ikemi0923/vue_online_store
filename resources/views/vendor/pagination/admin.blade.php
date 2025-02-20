@if ($paginator->hasPages())
<nav class="admin-pagination-container">
    <ul class="admin-pagination">
        @if ($paginator->onFirstPage())
        <li class="disabled"><span>← 前へ</span></li>
        @else
        <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">← 前へ</a></li>
        @endif

        @foreach ($elements as $element)
        @if (is_string($element))
        <li class="disabled"><span>{{ $element }}</span></li>
        @endif

        @if (is_array($element))
        @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
        <li class="active"><span>{{ $page }}</span></li>
        @else
        <li><a href="{{ $url }}">{{ $page }}</a></li>
        @endif
        @endforeach
        @endif
        @endforeach

        @if ($paginator->hasMorePages())
        <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">次へ →</a></li>
        @else
        <li class="disabled"><span>次へ →</span></li>
        @endif
    </ul>
</nav>
@endif