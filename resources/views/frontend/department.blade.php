<x-frontend.layout>

    <x-frontend.component.head title="{{$department->name}}" description="{{$department->smallDesc}}" />


    <!-- services -->
    <div class="container_c">
        <div class="concept-map" role="region" aria-label="خريطة خدمات قسم الجراحة والتعويضات السنية">
            <h2 class="department">الخدمات</h2>

            <div class="services">

                @foreach ($department->services as $service)
                    <div class="service" tabindex="0" role="button" aria-describedby="desc1" aria-expanded="false">
                        {{ $service->name }}
                        @if ($service->smallDesc)
                            <div class="details-popup" id="desc1" role="region">
                                {{ $service->smallDesc }}
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>


    <!-- Dental Services Section -->
    <div class="max-w-6xl mx-auto px-4 py-12 text-center">
        <h1 class="text-4xl font-bold text-gray-800 my-12 text-indigo-800 ">Our Department Cases </h1>
        <!-- <hr> -->

        {{-- filltring the data--}}
        <form class="bg-white rounded-xl shadow-lg p-6 mb-8" id="caseFilterForm">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Search Bar -->
                <div class="relative">
                    <input type="text" id="searchInput" name="search" placeholder="Search cases..."
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    <i class="fas fa-search absolute right-3 top-3 text-gray-400"></i>
                </div>

                <!-- Date Filter -->
                <div class="relative">
                    <select id="dateFilter" name="date"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 appearance-none">
                        <option value="all">All Dates</option>
                        <option value="newest">Newest First</option>
                        <option value="oldest">Oldest First</option>
                        <option value="lastMonth">Last Month</option>
                        <option value="lastYear">Last Year</option>
                    </select>
                    <i class="fas fa-chevron-down absolute right-3 top-3 text-gray-400"></i>
                </div>

                <!-- Case Type Filter -->
                <div class="relative">
                    <select id="caseTypeFilter" name="caseType"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 appearance-none">
                        <option value="all">All Cases</option>
                        <option value="special">Special Cases Only</option>
                        <option value="general">General Cases</option>
                    </select>
                    <i class="fas fa-chevron-down absolute right-3 top-3 text-gray-400"></i>
                </div>
            </div>
            <div class="flex justify-end mt-6">
                <button type="submit"
                    class="bg-indigo-600 text-white px-6 py-2 rounded-lg shadow hover:bg-indigo-700 transition font-semibold">
                    Filter
                </button>
            </div>
        </form>

        <!-- Cases Section -->
        <div class="max-w-6xl mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($cases as $case)
                    <x-frontend.component.case-card :case="$case" />
                @empty
                    <div class="col-span-full text-center py-12 w-full flex justify-center">
                        <div class="inline-block bg-white rounded-lg shadow p-8">
                            <i class="fas fa-info-circle text-4xl text-indigo-400 mb-4"></i>
                            <h4 class="text-xl font-semibold text-gray-700 mb-2" data-i18n="blog.no_blogs_title">
                                No cases yet
                            </h4>
                            <p class="text-gray-500" data-i18n="blog.no_blogs_desc">
                                There are no cases to display at the moment. Please check back soon!
                            </p>
                        </div>
                    </div>
                @endforelse
            </div>
            <x-admin.pagination :attribute="$cases" />

</x-frontend.layout>



@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const dateFilter = document.getElementById('dateFilter');
            const caseTypeFilter = document.getElementById('caseTypeFilter');
            const casesGrid = document.getElementById('casesGrid');
            const noResults = document.getElementById('noResults');
            const cards = document.querySelectorAll('.service-card');

            function filterCases() {
                const searchTerm = searchInput.value.toLowerCase();
                const dateValue = dateFilter.value;
                const caseType = caseTypeFilter.value;
                let visibleCount = 0;

                cards.forEach(card => {
                    const title = card.querySelector('h3').textContent.toLowerCase();
                    const description = card.querySelector('p').textContent.toLowerCase();
                    const cardDate = new Date(card.dataset.date);
                    const cardType = card.dataset.type;

                    let showCard = true;

                    // Search filter
                    if (searchTerm && !title.includes(searchTerm) && !description.includes(searchTerm)) {
                        showCard = false;
                    }

                    // Date filter
                    if (dateValue !== 'all') {
                        const now = new Date();
                        const lastMonth = new Date(now.getFullYear(), now.getMonth() - 1, 1);
                        const lastYear = new Date(now.getFullYear() - 1, 0, 1);

                        switch (dateValue) {
                            case 'newest':
                                // Already sorted by date in HTML
                                break;
                            case 'oldest':
                                // Reverse the order
                                break;
                            case 'lastMonth':
                                if (cardDate < lastMonth) showCard = false;
                                break;
                            case 'lastYear':
                                if (cardDate < lastYear) showCard = false;
                                break;
                        }
                    }

                    // Case type filter
                    if (caseType !== 'all' && cardType !== caseType) {
                        showCard = false;
                    }

                    // Show/hide card
                    card.style.display = showCard ? 'block' : 'none';
                    if (showCard) visibleCount++;
                });

                // Show/hide no results message
                noResults.classList.toggle('hidden', visibleCount > 0);
            }

            // Add event listeners
            searchInput.addEventListener('input', filterCases);
            dateFilter.addEventListener('change', filterCases);
            caseTypeFilter.addEventListener('change', filterCases);
        });
    </script>
@endpush
