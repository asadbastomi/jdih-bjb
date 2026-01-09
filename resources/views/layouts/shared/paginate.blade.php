<?php
// config
$link_limit = 7; // maximum number of links (a little bit inaccurate, but will be ok for now)
?>
<div class="fixed-table-pagination">
   <div class="float-right pagination">
    @if ($paginator->lastPage() > 1)
        <ul class="pagination">
            <li class="page-item page-pre first {{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}">
                <a class="page-link" aria-label="previous page" href="{{ $paginator->url(1) }}"><i class="fas fa-angle-double-left"></i></a>
            </li>
            <li class="page-item page-pre previews {{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}">
                <a class="page-link" aria-label="previous page" href="{{ $paginator->url($paginator->currentPage() - 1) }}"><i class="fas fa-angle-left"></i></a>
            </li>
            @for ($i = 1; $i <= $paginator->lastPage(); $i++)
                <?php
                $half_total_links = floor($link_limit / 2);
                $from = $paginator->currentPage() - $half_total_links;
                $to = $paginator->currentPage() + $half_total_links;
                if ($paginator->currentPage() < $half_total_links) {
                    $to += $half_total_links - $paginator->currentPage();
                }
                if ($paginator->lastPage() - $paginator->currentPage() < $half_total_links) {
                    $from -= $half_total_links - ($paginator->lastPage() - $paginator->currentPage()) - 1;
                }
                ?>
                @if ($from < $i && $i < $to)
                    <li class="page-item {{ ($paginator->currentPage() == $i) ? ' active' : '' }}">
                        <a class="page-link" aria-label="to page 2" href="{{ $paginator->url($i) }}">{{ $i }}</a>
                    </li>
                @endif
            @endfor
            <li class="page-item page-next next {{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">
                <a class="page-link" aria-label="next page" href="{{ $paginator->url($paginator->currentPage() + 1) }}"><i class="fas fa-angle-right"></i></a>
            </li>
            <li class="page-item page-next last {{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">
                <a class="page-link" aria-label="next page" href="{{ $paginator->url($paginator->lastPage()) }}"><i class="fas fa-angle-double-right"></i></a>
            </li>
        </ul>
    @endif
    </div>
</div>
