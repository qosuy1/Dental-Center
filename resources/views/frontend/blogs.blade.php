</<x-frontend.layout>

<x-frontend.component.head title="Our Latest Blogs"
    description="Stay updated with the latest in dental and beauty care from our experts." />


{{-- filltring the data --}}
<x-frontend.component.filtering :route="route('blogs') " />

<!-- Blog Posts Section -->
<div class="max-w-6xl mx-auto px-4 py-12">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

        @forelse ($blogs as $blog)
            <x-frontend.component.blog-card :$blog />
        @empty
            <x-frontend.component.no-data-card />
        @endforelse

    </div>
    <x-admin.pagination :attribute="$blogs" />
</div>


</x-frontend.layout>
