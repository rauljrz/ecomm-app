@if ($paginator['last_page'] > 1)
<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">
        {{-- Previous Page Link --}}
        @if ($paginator['current_page'] > 1)
            <li class="page-item">
                <a class="page-link" href="{{ route('products.index', ['page' => $paginator['current_page'] - 1]) }}" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
        @else
            <li class="page-item disabled">
                <span class="page-link" aria-hidden="true">&laquo;</span>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @for ($i = 1; $i <= $paginator['last_page']; $i++)
            @if ($i == $paginator['current_page'])
                <li class="page-item active">
                    <span class="page-link">{{ $i }}</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ route('products.index', ['page' => $i]) }}">{{ $i }}</a>
                </li>
            @endif
        @endfor

        {{-- Next Page Link --}}
        @if ($paginator['current_page'] < $paginator['last_page'])
            <li class="page-item">
                <a class="page-link" href="{{ route('products.index', ['page' => $paginator['current_page'] + 1]) }}" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        @else
            <li class="page-item disabled">
                <span class="page-link" aria-hidden="true">&raquo;</span>
            </li>
        @endif
    </ul>
</nav>
@endif