<x-frontend.layout>


    <div class="max-w-6xl mx-auto px-4 py-12">
        <div class="mb-8">
            <div class="flex items-center text-sm text-gray-500 mb-4 mt-6">
                <a href="javascript:history.back()"
                    class="inline-block bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded">
                    ⬅ Back
                </a>
                <span class="mx-2">•</span>
                <span id="case-date"> {{ $case->updated_at->format('M H , Y') }}</span>
            </div>
            <h1 id="case-title" class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
                {{ $case->title }}
            </h1>
            <div class="flex items-center">
                <div class="w-10 h-10 rounded-full bg-gray-300 overflow-hidden mr-3">
                    <img id="doctor-image"
                        src="{{ $case->doctor ? asset('storage/' . $case->doctor->image) : asset('adminAssets/images/avatar/user.jpeg') }}"
                        alt="{{ $case->doctor->name ?? $case->doctor_name }}" class="w-full h-full object-cover" />
                </div>
                <div>
                    <p id="doctor-name" class="font-medium text-gray-800">
                        {{ $case->doctor->name ?? $case->doctor_name }}
                    </p>
                    <p id="doctor-specialty" class="text-sm text-gray-500">
                        {{ $case->doctor->experince ?? '' }}
                    </p>
                </div>
            </div>
        </div>

        <main class="container mx-auto px-6 py-12">
            <div class="max-w-4xl mx-auto">
                <h1 class="text-3xl font-bold text-gray-900 mb-8 text-center">
                    Treatment Results Comparison
                </h1>

                <div class="text-center mb-6">
                    <p class="text-gray-600">
                        <i class="fas fa-hand-pointer mr-2"></i>
                        Drag the slider left and right to compare before and after results
                    </p>
                </div>

                <div
                    class="comparison-slider mb-8 rounded-lg overflow-hidden relative bg-gray-100 shadow-xl hover:shadow-2xl transition-shadow duration-300"
                    style="
                        height: 60vw;
                        min-height: 250px;
                        max-height: 800px;
                        width: 100%;
                        max-width: 100%;
                    "
                >
                    <div class="after-image absolute inset-0 flex items-center justify-center bg-gray-50">
                        <a href="after-preview.html" class="block w-full h-full relative">
                            <img
                                src="{{ asset('storage/' . $case->after_image) }}"
                                alt="After Treatment"
                                class="absolute inset-0 w-full h-full object-cover"
                                onerror="this.src='https://via.placeholder.com/800x600?text=After+Image+Not+Available'"
                                style="width: 100%; height: 100%; object-fit: cover; max-width: 100%; max-height: 100%;"
                            />
                            <div class="absolute bottom-2 right-2 sm:bottom-4 sm:right-4 bg-black bg-opacity-50 text-white px-2 py-1 sm:px-3 sm:py-1 rounded text-xs sm:text-base">
                                After
                            </div>
                        </a>
                    </div>
                    <div class="before-image absolute inset-0 flex items-center justify-center bg-gray-50">
                        <img
                            src="{{ asset('storage/' . $case->before_image) }}"
                            alt="Before Treatment"
                            class="absolute inset-0 w-full h-full object-cover"
                            onerror="this.src='https://via.placeholder.com/800x600?text=Before+Image+Not+Available'"
                            style="width: 100%; height: 100%; object-fit: cover; max-width: 100%; max-height: 100%;"
                        />
                        <div class="absolute bottom-2 left-2 sm:bottom-4 sm:left-4 bg-black bg-opacity-50 text-white px-2 py-1 sm:px-3 sm:py-1 rounded text-xs sm:text-base">
                            Before
                        </div>
                    </div>
                    <div class="slider-handle absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-20"
                        style="touch-action: none;">
                        <div class="slider-button w-8 h-8 sm:w-10 sm:h-10 flex items-center justify-center bg-white bg-opacity-80 rounded-full shadow border border-gray-300">
                            <i class="fas fa-arrows-alt-h text-gray-600 text-lg sm:text-xl"></i>
                        </div>
                    </div>
                </div>
                <style>
                    @media (max-width: 1024px) {
                        .comparison-slider {
                            height: 50vw !important;
                            min-height: 200px !important;
                            max-height: 400px !important;
                        }
                    }
                    @media (max-width: 768px) {
                        .comparison-slider {
                            height: 60vw !important;
                            min-height: 150px !important;
                            max-height: 300px !important;
                        }
                        .slider-handle .slider-button {
                            width: 32px !important;
                            height: 32px !important;
                            font-size: 1rem !important;
                        }
                    }
                    @media (max-width: 480px) {
                        .comparison-slider {
                            height: 48vw !important;
                            min-height: 120px !important;
                            max-height: 200px !important;
                            margin-left: -16px;
                            margin-right: -16px;
                        }
                        .slider-handle .slider-button {
                            width: 28px !important;
                            height: 28px !important;
                            font-size: 0.9rem !important;
                        }
                        .after-image div, .before-image div {
                            font-size: 0.75rem !important;
                            padding: 0.25rem 0.5rem !important;
                        }
                    }
                </style>

                <div class="text-center bg-white p-6 rounded-lg shadow-md">
                    <p class="text-gray-600 mb-2">Want to see the full result?</p>
                    <a href="after-preview.html"
                        class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                        <span>View full size image</span>
                        <i class="fas fa-external-link-alt ml-2"></i>
                    </a>
                </div>
            </div>
            <style>
                @media (max-width: 768px) {
                    .comparison-slider {
                        height: 350px !important;
                        min-height: 250px !important;
                        max-height: 400px !important;
                        width: 100% !important;
                    }

                    .comparison-slider img {
                        height: 100% !important;
                        width: 100% !important;
                        object-fit: cover !important;
                    }

                    .slider-handle {
                        width: 36px !important;
                        height: 36px !important;
                    }

                    .slider-button {
                        width: 36px !important;
                        height: 36px !important;
                        font-size: 1.2rem !important;
                    }
                }

                @media (max-width: 480px) {
                    .comparison-slider {
                        height: 220px !important;
                        min-height: 150px !important;
                        max-height: 250px !important;
                        width: 100vw !important;
                        margin-left: -24px;
                        margin-right: -24px;
                    }
                }
            </style>
        </main>

        <!-- Case Details -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
            <div class="lg:col-span-2">
                <div class="prose max-w-none">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Case Overview</h2>
                    <p class="text-gray-700 mb-4">
                        {{ $case->overview }}
                    </p>

                    <div>
                        <h2 class="text-2xl font-bold text-gray-800 mb-4">
                            Treatment Plan
                        </h2>
                        @push('styles')
                            <style>
                                .prose>ul {
                                    list-style: disc !important;
                                    margin-right: 18px;
                                }

                                .prose>ol {
                                    list-style: decimal !important;
                                    margin-right: 18px;
                                }
                            </style>
                        @endpush
                        <div class="prose max-w-none text-gray-700 mb-4" style="direction: rtl;">

                            {!! $case->treatment_plan !!}
                        </div>
                    </div>

                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Results</h2>
                    <p class="text-gray-700">
                        {{ $case->result }}
                    </p>
                </div>
            </div>

            <div>
                <div class="bg-indigo-50 rounded-lg p-6 mb-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Case Details</h3>
                    <div class="space-y-4">
                        <div>
                            <p class="text-sm text-gray-500">Patient Age</p>
                            <p class="font-medium">{{ $case->patient_age }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Treatment Duration</p>
                            <p class="font-medium">{{ $case->treatment_duration }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Procedures</p>
                            <p class="font-medium">
                                {{ $case->procedures }}
                            </p>
                        </div>

                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">
                        Patient Testimonial
                    </h3>
                    <div class="flex items-start mb-4">
                        <div class="text-indigo-600 text-2xl mr-3">
                            <i class="fas fa-quote-left"></i>
                        </div>
                        <p class="text-gray-700 italic">
                            "{{ $case->feedback }}"
                        </p>
                    </div>

                </div>
            </div>
        </div>

    </div>
</x-frontend.layout>
