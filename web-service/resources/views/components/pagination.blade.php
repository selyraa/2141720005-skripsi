@if ($paginator->hasPages() || isset($perPageOptions))
<div class="flex flex-col sm:flex-row items-center justify-between mt-4 gap-3">
    <!-- Per Page Selection -->
    @if(isset($perPageOptions) && is_array($perPageOptions) && count($perPageOptions) > 0)
        <div class="flex items-center">
            <span class="text-sm text-gray-600 dark:text-gray-400 mr-2">{{ __('app.show') }}:</span>
            <select id="per-page-select" class="rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:border-primary dark:focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 dark:focus:ring-opacity-50 dark:bg-gray-800 text-sm" 
                onchange="window.location.href = this.value;">
                @foreach($perPageOptions as $option)
                    <option value="{{ request()->url() }}?{{ http_build_query(array_merge(request()->query(), ['per_page' => $option])) }}" 
                        {{ $perPage == $option ? 'selected' : '' }}>
                        {{ $option }}
                    </option>
                @endforeach
            </select>
            <span class="text-sm text-gray-600 dark:text-gray-400 ml-2">{{ __('app.entries') }}</span>
        </div>
    @endif

    <!-- Pagination Info -->
    @if($paginator->hasPages())
        <div class="text-sm text-gray-600 dark:text-gray-400">
            {{ __('app.showing') }} 
            <span class="font-semibold">{{ $paginator->firstItem() }}</span> 
            {{ __('app.to') }} 
            <span class="font-semibold">{{ $paginator->lastItem() }}</span> 
            {{ __('app.of') }} 
            <span class="font-semibold">{{ $paginator->total() }}</span> 
            {{ __('app.entries') }}
        </div>
    @endif

    <!-- Pagination Links -->
    @if ($paginator->hasPages())
        <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-center">
            <ul class="pagination flex items-center space-x-1">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="disabled" aria-disabled="true">
                        <span class="px-3 py-1 rounded-md opacity-50 text-gray-500 dark:text-gray-400">
                            &laquo;
                        </span>
                    </li>
                @else
                    <li>
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" 
                           class="px-3 py-1 rounded-md bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-primary hover:text-white transition-all">
                            &laquo;
                        </a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($paginator->getUrlRange(max(1, $paginator->currentPage() - 2), min($paginator->lastPage(), $paginator->currentPage() + 2)) as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active" aria-current="page">
                            <span class="px-3 py-1 rounded-md bg-primary text-white">
                                {{ $page }}
                            </span>
                        </li>
                    @else
                        <li>
                            <a href="{{ $url }}" 
                               class="px-3 py-1 rounded-md bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-primary hover:text-white transition-all">
                                {{ $page }}
                            </a>
                        </li>
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li>
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next" 
                           class="px-3 py-1 rounded-md bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-primary hover:text-white transition-all">
                            &raquo;
                        </a>
                    </li>
                @else
                    <li class="disabled" aria-disabled="true">
                        <span class="px-3 py-1 rounded-md opacity-50 text-gray-500 dark:text-gray-400">
                            &raquo;
                        </span>
                    </li>
                @endif
            </ul>
        </nav>
    @endif
</div>
@endif
