@if ($paginator->hasPages())
    <div class="col-lg-12">
        <div class="product__pagination">
            {{-- Попередня --}}
            @if ($paginator->onFirstPage())
                <span>&laquo;</span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}">&laquo;</a>
            @endif

            @php
                $total = $paginator->lastPage();
                $current = $paginator->currentPage();

                $visible = [];

                // завжди перші 2
                $visible = array_merge($visible, [1, 2]);

                // кілька перед поточною
                for ($i = $current - 2; $i < $current; $i++) {
                    if ($i > 2) $visible[] = $i;
                }

                // поточна + кілька після
                for ($i = $current; $i <= $current + 2 && $i < $total; $i++) {
                    $visible[] = $i;
                }

                // останні 2
                $visible = array_merge($visible, [$total - 1, $total]);

                // прибрати дублі
                $visible = array_unique($visible);
                sort($visible);
            @endphp

            {{-- Вивід з "..." --}}
            @php $prev = 0; @endphp
            @foreach ($visible as $page)
                @if ($prev && $page - $prev > 1)
                    <span>...</span>
                @endif

                @if ($page == $current)
                    <a class="active" href="#">{{ $page }}</a>
                @else
                    <a href="{{ $paginator->url($page) }}">{{ $page }}</a>
                @endif

                @php $prev = $page; @endphp
            @endforeach

            {{-- Наступна --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}">&raquo;</a>
            @else
                <span>&raquo;</span>
            @endif
        </div>
    </div>
@endif
