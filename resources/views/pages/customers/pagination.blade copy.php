<!-- {{ $list->links('pagination::bootstrap-4') }}

{{$_GET['page']}}
<ul class="pagination">
@if ($list->onFirstPage())
        <li class="page-item disabled">
            <span class="page-link" aria-hidden="true">‹</span>
        </li>
    @else
        <li class="page-item">
        <a class="page-link " href="javascript: void(0)" data-page="{{$_GET['page']-1}}">‹</a>
        </li>
    @endif

@foreach ($list->getUrlRange(1, $list->lastPage()) as $page => $url)
<li class="page-item {{ $_GET['page'] == $page ? 'active' : '' }}"><a class="page-link " href="javascript: void(0)" data-page="{{$page}}">{{ $page }}</a></li>
@endforeach
</ul> -->

@if ($list->hasPages())
<ul class="pagination">

        {{-- Previous Page Link --}}
        @if ($list->onFirstPage())
        <li class="page-item disabled">
            <!-- <span class="page-link" aria-hidden="true">‹</span> -->
        <a class="page-link " href="javascript: void(0)" >‹</a>

        </li>
        @else
        <li class="page-item">
        <a class="page-link go-to-page" href="javascript: void(0)" data-page="{{$_GET['page']-1}}">‹</a>
        </li>
        @endif

        {{-- Pagination Elements --}}
        @php
            $start = max($list->currentPage() - 2, 1);
            $end = min($list->currentPage() + 2, $list->lastPage());
        @endphp

        {{-- First Page --}}
        @if ($start > 1)
        <li class="page-item {{ $_GET['page'] == 1 ? 'active' : '' }}"><a class="page-link go-to-page" href="javascript: void(0)" data-page="1">1</a></li>

            @if ($start > 2)
            <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>

            @endif
        @endif

        {{-- Page Numbers --}}
        @for ($page = $start; $page <= $end; $page++)
            @if ($page == $list->currentPage())
            <li class="page-item  active"> <span class="page-link" aria-hidden="true">{{ $page }}</span></li>

            @else
                <li class="page-item {{ $_GET['page'] == $page ? 'active' : '' }}"><a class="page-link go-to-page" href="javascript: void(0)" data-page="{{$page}}">{{ $page }}</a></li>

            @endif
        @endfor

        {{-- Last Page --}}
        @if ($end < $list->lastPage())
            @if ($end < $list->lastPage() - 1)
            <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li> 
            @endif
            <li class="page-item {{ $_GET['page'] == $list->lastPage() ? 'active' : '' }}"><a class="page-link go-to-page" href="javascript: void(0)" data-page="{{ $list->lastPage() }}">{{ $list->lastPage() }}</a></li>

        @endif

        {{-- Next Page Link --}}
        @if ($list->hasMorePages())
        <li class="page-item "><a class="page-link go-to-page" href="javascript: void(0)" data-page="{{$_GET['page']+1}}">›</a></li>

        @else
        <li class="page-item ">
            <a class="page-link " href="javascript: void(0)" >›</a>
        </li>

        @endif
</ul>
@endif
