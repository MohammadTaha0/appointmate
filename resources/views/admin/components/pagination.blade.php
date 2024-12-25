<div class="row row-cols-md-2 row-cols-1 m-0 p-0 align-items-center justify-content-between">
    <div class="col">
        <span class="h6 text-center">Page {{ $records->currentPage() }} of {{ $records->lastPage() }},
            displaying
            {{ $records->perPage() }} items per page, total {{ $records->total() }} items.</span>
    </div>
    <div class="col">
        <div class="input-group justify-content-end">
            @if ($records->onFirstPage())
                <span class="disabled btn btn-sm btn- btn-sm">&laquo; Previous</span>
            @else
                <a href="{{ $records->previousPageUrl() }}{{ isset($key) ? "&key=$key" : '' }}{{ isset($value) ? "&value=$value" : '' }}{{ isset($orderBy) ? "&orderBy=$orderBy" : '' }}{{ isset($orderType) ? "&orderType=$orderType" : '' }}"
                    class="btn btn-sm btn-outline-dark" rel="prev">&laquo;
                    Previous</a>
            @endif

            @for ($i = 1; $i <= $records->lastPage(); $i++)
                @if ($i == 1 || $i == 2 || $i == $records->lastPage() - 1 || $i == $records->lastPage())
                    <a href="{{ $records->url($i) }}{{ isset($key) ? "&key=$key" : '' }}{{ isset($value) ? "&value=$value" : '' }}{{ isset($orderBy) ? "&orderBy=$orderBy" : '' }}{{ isset($orderType) ? "&orderType=$orderType" : '' }}"
                        class="btn btn-sm btn-{{ $records->currentPage() == $i ? 'dark' : 'outline-dark' }}">{{ $i }}</a>
                @endif
            @endfor

            @if ($records->hasMorePages())
                <a href="{{ $records->nextPageUrl() }}{{ isset($key) ? "&key=$key" : '' }}{{ isset($value) ? "&value=$value" : '' }}{{ isset($orderBy) ? "&orderBy=$orderBy" : '' }}{{ isset($orderType) ? "&orderType=$orderType" : '' }}"
                    class="btn btn-sm btn-outline-dark" rel="next">Next
                    &raquo;</a>
            @else
                <span class="disabled btn btn-sm btn- btn-sm">Next &raquo;</span>
            @endif
        </div>
    </div>
</div>
