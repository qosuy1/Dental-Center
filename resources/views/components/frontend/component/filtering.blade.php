@props(['route', 'isItCase' => false])



{{-- filtering the data --}}
<form action="{{ $route }}" class="bg-white rounded-xl shadow-lg p-6 mb-8 flex items-center justify-center"
    id="caseFilterForm">
    <div class="grid grid-cols-1 md:grid-cols-{{ $isItCase == true ? '3' : '2' }} gap-4">

        <!-- Search Bar -->
        <div class="relative">
            <input type="text" id="searchInput" name="search" placeholder="Search..." value="{{ request('search') }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 pr-10">
            <i class="fas fa-search absolute right-3 top-3 text-gray-400 pointer-events-none"></i>
            @if(request('search'))
                <button type="button" onclick="document.getElementById('searchInput').value=''; this.form.submit();"
                    class="absolute right-9 top-2.5 text-gray-400 hover:text-gray-600 focus:outline-none"
                    style="background: transparent;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            @endif
        </div>

        <!-- Date Filter -->
        <div class="relative">
            <select id="dateFilter" name="date"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 appearance-none">
                <option value="all">All Dates</option>
                <option value="newest" {{ request('date') == 'newest' ? 'selected' : '' }}>Newest First</option>
                <option value="oldest" {{ request('date') == 'oldest' ? 'selected' : '' }}>Oldest First</option>
            </select>
            <i class="fas fa-chevron-down absolute right-3 top-3 text-gray-400"></i>
        </div>


        <!-- Case Type Filter -->
        @if ($isItCase)
            <div class="relative">
                <select id="caseTypeFilter" name="caseType"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 appearance-none">
                    <option value="all">All Cases</option>
                    <option value="special" {{ request('caseType') == 'special' ? 'selected' : '' }}>Special Cases Only
                    </option>
                </select>
                <i class="fas fa-chevron-down absolute right-3 top-3 text-gray-400"></i>
            </div>
        @endif
    </div>
    <div class="flex justify-end ml-6 ">
        <button type="submit"
            class="bg-indigo-600 text-white px-6 py-2 rounded-lg shadow hover:bg-indigo-700 transition font-semibold">
            Filter
        </button>
    </div>
</form>
