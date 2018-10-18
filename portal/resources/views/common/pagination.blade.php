<nav aria-label="...">
    <ul class="pagination justify-content-center">
        {{-- Add different styling to pagination if there are more than 6 pages--}}
        @if($pageCount > 6)
            {{-- Show back arrow only if we are not on first page --}}
            @if($currentPage > 1)
                <li class="page-item">
                    <a class="page-link" href="{!! request()->fullUrlWithQuery(['p' => $currentPage-1]) !!}" tabindex="-1">&lt;</a>
                </li>
            @endif
            {{-- Display different markup for different use cases --}}
            @if($currentPage < 3)
                @for ($i = 1; $i < 4 ; $i++)
                    <li class="page-item{{ $currentPage === $i ? ' active': '' }}"><a class="page-link" href="{!! request()->fullUrlWithQuery(['p' => $i]) !!}">{{$i}}</a></li>
                @endfor
                <li class="page-item disabled"><a class="page-link" href="#">...</a></li>
                <li class="page-item{{ $currentPage === $pageCount ? ' active': '' }}"><a class="page-link" href="{!! request()->fullUrlWithQuery(['p' => $pageCount]) !!}">{{$pageCount}}</a></li>
            @elseif ($currentPage >= 3 && $currentPage <= $pageCount - 2)
                <li class="page-item{{ $currentPage === $pageCount ? ' active': '' }}"><a class="page-link" href="{!! request()->fullUrlWithQuery(['p' => 1]) !!}">1</a></li>
                @if($currentPage > 3) <li class="page-item disabled"><a class="page-link" href="#">...</a></li> @endif
                @for ($i = $currentPage -1; $i <= $currentPage + 1; $i++)
                    <li class="page-item{{ $currentPage === $i ? ' active': '' }}"><a class="page-link" href="{!! request()->fullUrlWithQuery(['p' => $i]) !!}">{{$i}}</a></li>
                @endfor
                @if($currentPage <= $pageCount - 3) <li class="page-item disabled"><a class="page-link" href="#">...</a></li> @endif
                <li class="page-item{{ $currentPage === $pageCount ? ' active': '' }}"><a class="page-link" href="{!! request()->fullUrlWithQuery(['p' => $pageCount]) !!}">{{$pageCount}}</a></li>
            @elseif  ($currentPage >= $pageCount - 3 && $currentPage <= $pageCount)
                <li class="page-item{{ $currentPage === 1 ? ' active': '' }}"><a class="page-link" href="{!! request()->fullUrlWithQuery(['p' => 1]) !!}">1</a></li>
                <li class="page-item disabled"><a class="page-link" href="#">...</a></li>
                @for ($i = $pageCount - 3; $i <= $pageCount ; $i++)
                    <li class="page-item{{ $currentPage === $i ? ' active': '' }}"><a class="page-link" href="{!! request()->fullUrlWithQuery(['p' => $i]) !!}">{{$i}}</a></li>
                @endfor
            @endif

            {{-- Show back arrow only if we are not on last page --}}
            @if($currentPage < $pageCount)
                <li class="page-item">
                    <a class="page-link" href="{!! request()->fullUrlWithQuery(['p' => $currentPage+1]) !!}" tabindex="-1">&gt;</a>
                </li>
            @endif
            {{-- Add simple styling to pagination if there are less than 6 pages--}}
        @else
            @for ($i = 1; $i <= $pageCount; $i++)
                <li class="page-item{{ $currentPage === $i ? ' active': '' }}"><a class="page-link" href="{!! request()->fullUrlWithQuery(['p' => $i]) !!}">{{$i}}</a></li>
            @endfor
        @endif
    </ul>
</nav>