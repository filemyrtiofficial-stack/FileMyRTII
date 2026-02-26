
@if ($blogs->hasPages())

        {{-- Previous Page Link --}}
        @if ($blogs->onFirstPage())
        <li  class="disabled"><a href="javascript:void(0);"><</a></li>
        @else
        <li  ><a href="javascript:void(0);" class="go-to-page" data-page="{{ $blogs->currentPage() -1}}"><</a></li>
       
        @endif

        {{-- Pagination Elements --}}
        @php
            $start = max($blogs->currentPage() - 2, 1);
            $end = min($blogs->currentPage() + 2, $blogs->lastPage());
        @endphp

        {{-- First Page --}}
        @if ($start > 1)
        <li class="{{ isset($_GET['page']) && $_GET['page'] == 1 ? 'active' : '' }}"><a class="go-to-page" href="javascript: void(0)" data-page="1">1.</a></li>

            @if ($start > 2)
       <li  class="disabled"><a href="javascript:void(0);">...</a></li>

            @endif
        @endif

        {{-- Page Numbers --}}
        @for ($page = $start; $page <= $end; $page++)
            @if ($page == $blogs->currentPage())
            <li class=" active"><a href="javascript:void(0);">{{ $page < 10 ? "0".$page : $page}}.</a></li>

            @else
                <li class="{{ isset($_GET['page']) && $_GET['page'] == $page ? 'active' : '' }}"><a class="go-to-page" href="javascript: void(0)" data-page="{{$page}}">{{ $page < 10 ? "0".$page : $page}}.</a></li>

            @endif
        @endfor

        {{-- Last Page --}}
        @if ($end < $blogs->lastPage())
            @if ($end < $blogs->lastPage() - 1)
            <li class="disabled" aria-disabled="true"><span class="page-link">...</span></li> 
            @endif
            <li class="{{ isset($_GET['page']) && $_GET['page'] == $blogs->lastPage() ? 'active' : '' }}"><a class="go-to-page" href="javascript: void(0)" data-page="{{ $blogs->lastPage() }}">{{ $blogs->lastPage() }}.</a></li>

        @endif

        {{-- Next Page Link --}}
        @if ($blogs->hasMorePages())
         <!-- <li><a href="javascript:void(0);" data-page="{{isset($_GET['page']) && $_GET['page']+1}}">more...</a></li>  -->
        <li class=""><a class="go-to-page" href="javascript: void(0)" data-page="{{$blogs->currentPage()+1}}">></a></li>

        @else
        <li class="">
            <a href="javascript: void(0)" >></a>
        </li>

        @endif
@endif


<!-- <li class="active"><a >01.</a></li>
            <li><a href="javascript:void(0);">02.</a></li>
            <li><a href="javascript:void(0);">03.</a></li>
            <li><a href="javascript:void(0);">more...</a></li>  -->