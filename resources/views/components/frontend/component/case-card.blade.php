@props(['case' => null])



<div class="case-card bg-white rounded-lg overflow-hidden shadow-md transition duration-300">
    <div class="h-48 overflow-hidden relative">
        <img src="{{ asset('storage/' . $case->after_image) }}" alt="{{ $case->title }}"
            class="w-full h-full object-cover" loading="lazy"/>
        @if ($case->is_special_case == 1)
            <div class="absolute bottom-2 left-2">
                <span class="badge bg-indigo-100 text-indigo-800 text-xs px-2 py-1 rounded-full">
                    special case</span>
            </div>
        @endif
    </div>
    <div class="p-6">

        <div class="flex justify-center text-sm text-gray-500 mb-2">
            <span>{{ $case->updated_at->format('M H , Y') }}</span>
        </div>

        <h3 class="text-xl font-bold text-gray-800 mb-2">
            {{ $case->title }}
        </h3>

        <p class="text-gray-600 mb-4">
            {{ $case->overview }}
        </p>

        <div class="flex items-center">
            <div class="w-8 h-8 rounded-full bg-gray-300 overflow-hidden mr-2">
                <img src="{{ $case->doctor ? asset('storage/' . $case->doctor->image) : asset('adminAssets/images/avatar/user.jpeg') }}"
                    alt="{{ $case->doctor->name ?? $case->doctor_name }}" class="w-full h-full object-cover" loading="lazy"/>
            </div>
            <span class="text-sm text-gray-600">{{ $case->doctor->name ?? $case->doctor_name }}</span>
        </div>

        <a href="{{ route('case-details', $case->id) }}"
            class="block mt-4 text-indigo-600 font-semibold hover:text-indigo-800 transition duration-300">View
            details →</a>
    </div>
</div>
