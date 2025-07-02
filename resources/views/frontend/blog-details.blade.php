<x-frontend.layout>


    <div class="max-w-6xl mx-auto px-4 py-12">
        <!-- Blog Header -->
        <div class="mb-8">
            <div class="flex items-center text-sm text-gray-500 mb-4 mt-6">
                <a href="javascript:history.back()"
                    class="inline-block bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded">
                    ⬅ Back
                </a>
                <span class="mx-2">•</span>
                <span id="case-date"> {{ $blog->updated_at->format('M H , Y') }}</span>
            </div>
            <h1 id="blog-title" class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
                {{ $blog->title }}
            </h1>
            <div class="flex items-center">
                <div class="w-10 h-10 rounded-full bg-gray-300 overflow-hidden mr-3">
                    <img id="doctor-image"
                        src="{{ $blog->doctor ? asset('storage/' . $blog->doctor->image) : asset('adminAssets/images/avatar/user.jpeg') }}"
                        alt="{{ $blog->doctor->name ?? $blog->doctor_name }}" class="w-full h-full object-cover" />
                </div>
                <div>
                    <p id="doctor-name" class="font-medium text-gray-800">
                        {{ $blog->doctor->name ?? $blog->doctor_name }}
                    </p>
                    <p id="doctor-specialty" class="text-sm text-gray-500">
                        {{ $blog->doctor->experince ?? '' }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Blog Main Image (Full Width, Same Design) -->
        <div class="mb-8  overflow-hidden flex justify-center">
            <img src="{{asset('storage/'. $blog->image)}}" alt="Dental Health"
                class=" md:w-[70%] md:h-[70vh]   sm:w-full sm:h-screen object-cover rounded-lg shadow-lg">
        </div>

        <!-- Blog Content -->
        <div class="prose max-w-none mb-12">
            {!! $blog->content !!}
        </div>
    </div>
</x-frontend.layout>
