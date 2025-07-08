<x-frontend.layout>

    <x-frontend.component.head title="About Our Center"
        description="Committed to excellence in dental and beauty care since 2010" />

    <!-- About Content -->
    <div class="max-w-6xl mx-auto px-4 py-8 md:py-12">
        <!-- Our Story -->
        <div class="mb-12">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                <div>
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-4">
                        Our Story
                    </h2>
                    <p class="text-gray-700 mb-4 text-sm md:text-base">
                        {{ $settings->our_story ?? '' }}
                    </p>

                </div>
                <div class="rounded-lg overflow-hidden">
                    @if ($settings->about_us_image ?? null)
                        <img src="{{ asset( $settings->about_us_image) }}" alt="Our Clinic"
                            class="w-full h-auto object-cover" />
                    @else
                        <img src="https://www.spsagro.com/images/default_image.jpg" alt="Our Clinic"
                            class="w-full h-auto object-cover" />
                    @endif
                </div>
            </div>
        </div>

        <!-- Our Location -->
        <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-4">
            Our Location
        </h2>
        <div class="mb-12">
            <iframe
                src="{{ $settings->google_map_location ?? 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d404.32575089451785!2d36.56873832437571!3d32.712720588701224!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x151bd5fcce7fad77%3A0x69d3109244f6e114!2sCity%20Smiles%20Dental%20Clinic!5e1!3m2!1sar!2s!4v1745025536020!5m2!1sar!2s' }}"
                class="w-full h-64 md:h-96" style="border: 0" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

        <!-- Our Mission -->
        <div class="mb-12 bg-indigo-50 rounded-lg p-6 md:p-8">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-6 text-center">
                Our Mission & Values
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-4 md:p-6 rounded-lg shadow-sm">
                    <div class="text-indigo-800 text-2xl md:text-3xl mb-4">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h3 class="text-lg md:text-xl font-bold text-gray-800 mb-2">
                        Patient-Centered Care
                    </h3>
                    <p class="text-gray-700 text-sm md:text-base">
                        We prioritize your comfort and individual needs, creating
                        personalized treatment plans for optimal results.
                    </p>
                </div>
                <div class="bg-white p-4 md:p-6 rounded-lg shadow-sm">
                    <div class="text-indigo-800 text-2xl md:text-3xl mb-4">
                        <i class="fas fa-award"></i>
                    </div>
                    <h3 class="text-lg md:text-xl font-bold text-gray-800 mb-2">
                        Clinical Excellence
                    </h3>
                    <p class="text-gray-700 text-sm md:text-base">
                        Our team maintains the highest standards through continuous
                        education and state-of-the-art technology.
                    </p>
                </div>
                <div class="bg-white p-4 md:p-6 rounded-lg shadow-sm">
                    <div class="text-indigo-800 text-2xl md:text-3xl mb-4">
                        <i class="fas fa-hand-holding-heart"></i>
                    </div>
                    <h3 class="text-lg md:text-xl font-bold text-gray-800 mb-2">
                        Community Focus
                    </h3>
                    <p class="text-gray-700 text-sm md:text-base">
                        We're committed to improving oral health awareness and providing
                        accessible care to our community.
                    </p>
                </div>
            </div>
        </div>

        <!-- Our Team -->
        <div>
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-6 text-center">
                Meet Our Team
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Team Member 1 -->
                @foreach ($doctors as $doctor)
                    <div class="team-card bg-white rounded-lg overflow-hidden shadow-md transition duration-300">
                        <div class="h-48 sm:h-64 overflow-hidden">
                            <img src="{{ $doctor->image }}" alt="{{ $doctor->name }}"
                                class="w-full h-full object-cover" />
                        </div>
                        <div class="p-4 md:p-6">
                            <h3 class="text-lg md:text-xl font-bold text-gray-800 mb-1">
                                {{ $doctor->name }}
                            </h3>
                            <p class="text-indigo-600 font-medium mb-2 text-sm md:text-base">
                                {{ $doctor->department->name }}
                            </p>
                            <p class="text-gray-600 text-sm mb-4">
                                {{ $doctor->experince }}
                            </p>
                            <div class="flex items-center text-sm text-gray-500 mb-1">
                                <i class="fas fa-phone-alt mr-2"></i>
                                <span>{{ $doctor->phone }}</span>
                            </div>
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="fas fa-envelope mr-2"></i>
                                <span>{{ $doctor->email }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <x-admin.pagination :attribute="$doctors" />
        </div>
    </div>


</x-frontend.layout>
