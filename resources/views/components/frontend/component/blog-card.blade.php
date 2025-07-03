@props(['blog' => null])


<div class="blog-card bg-white rounded-lg overflow-hidden shadow-md transition duration-300">
    <div class="h-48 overflow-hidden">
        <img src="{{ $blog->image }}" alt="{{ $blog->title }}" class="w-full h-full object-cover" loading="lazy">
    </div>
    <div class="p-6">
        <div class="flex items-center text-sm text-gray-500 mb-2">
            @if (isset($blog->doctor))
                <span
                    class="bg-indigo-100 text-indigo-800 text-xs px-2 py-1 rounded">{{ $blog->doctor->department->name }}
                </span>
                <span class="mx-2">•</span>
            @endif
            <span>{{ $blog->updated_at->format('M H , Y') }}</span>
        </div>
        <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $blog->title }}</h3>
        <p class="text-gray-600 mb-4">{{ $blog->smallDesc }}</p>
        <div class="flex items-center">
            <div class="w-8 h-8 rounded-full bg-gray-300 overflow-hidden mr-2">
                <img src="{{ $blog->doctor ?  $blog->doctor->image : asset('adminAssets/images/avatar/user.jpeg') }}"
                    alt="{{ $blog->doctor_name }}" class="w-full h-full object-cover" loading="lazy">
            </div>
            <span class="text-sm text-gray-600">{{ $blog->doctor_name }}</span>
        </div>
        <a href="{{ route('blog-details' , $blog->id) }}"
            class="block mt-4 text-indigo-600 font-semibold hover:text-indigo-800 transition duration-300">Read
            more
            →</a>
    </div>
</div>
