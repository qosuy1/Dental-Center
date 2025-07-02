<x-frontend.layout>

    <main>
        <!-- Hero Section -->
        <section class="pt-32  bg-gradient-to-r from-indigo-50 to-indigo-50 relative overflow-hidden">
            <div
                class="w-screen h-100 absolute inset-0 animated-background bg-gradient-to-r from-blue-500 via-blue-500 to-indigo-500 z-0">
            </div>
            <div class="container mx-auto px-4 relative z-10">
                <div class="max-w-2xl mx-auto text-center">
                    <h1 class="text-4xl md:text-5xl font-bold text-indigo-50 mb-6" data-i18n="hero.title">
                        Welcome to Our Dental & Beauty Center
                    </h1>
                    <p class="text-lg text-white mb-8" data-i18n="hero.tagline">
                        Comprehensive care for your dental health and beauty needs
                    </p>
                </div>
            </div>
        </section>

        <!-- Services Section -->
        <section class="py-20 bg-white">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-bold text-indigo-800 mb-4" data-i18n="services.title">
                        Our Specialized Services
                    </h2>
                    <p class="text-gray-600 max-w-2xl mx-auto" data-i18n="services.subtitle">
                        Professional care for all your dental and beauty needs
                    </p>
                </div>

                <div class="flex flex-wrap justify-center gap-8">
                    @foreach ($departments as $department)
                        <div
                            class="department-card bg-white rounded-xl shadow-md overflow-hidden transition-all hover:shadow-lg flex flex-col items-center w-full md:w-[45%] lg:w-[22%]">
                            <div class="p-6 flex flex-col items-center">
                                <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center mb-4">
                                    <i class="{{ $department->icon ?? 'fas fa-tooth' }} text-2xl text-indigo-600"></i>
                                </div>
                                <h3 class="text-xl font-bold mb-2 text-center" data-i18n="services.children.title">
                                    {{ $department->name }}
                                </h3>
                                <p class="text-gray-600 mb-4 text-center" data-i18n="services.children.desc">
                                    {{ $department->smallDesc }}
                                </p>
                                <a href="{{route('department' , $department->name)}}" class="text-indigo-600 font-medium flex items-center justify-center"
                                    data-i18n="services.learn_more">
                                    Learn More <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Blog Section -->
        <section class="py-20 bg-gray-50">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-bold text-indigo-800 mb-4" data-i18n="blog.title">
                        Latest Articles
                    </h2>
                    <p class="text-gray-600 max-w-2xl mx-auto" data-i18n="blog.subtitle">
                        Read our latest news and dental care tips
                    </p>
                </div>

                <div class="flex flex-wrap justify-center gap-8">
                    @forelse ($blogs->take(3) as $blog)
                        <div
                            class="bg-white rounded-xl shadow-md overflow-hidden transition-all hover:shadow-lg flex flex-col items-center w-full md:w-[47%] lg:w-[31%]">
                            <img src="{{ asset('storage/' . $blog->image) }}" alt="Dental care"
                                class="w-full h-48 object-cover" />
                            <div class="p-6 flex flex-col items-center">
                                <div class="flex items-center text-sm text-gray-500 mb-2 justify-center">
                                    <span data-i18n="blog.posted">Posted</span>
                                    <span class="mx-2">•</span>
                                    <span>{{ $blog->updated_at->format('M d, Y') }}</span>
                                </div>
                                <h3 class="text-xl font-bold mb-2 text-center" data-i18n="blog.post1.title">
                                    {{ $blog->title }}
                                </h3>
                                <p class="text-gray-600 mb-4 text-center" data-i18n="blog.post1.excerpt">
                                    {{ $blog->smallDesc }}
                                </p>
                                <a href="{{route('blog-details' , $blog->id)}}" class="text-indigo-600 font-medium flex items-center justify-center"
                                    data-i18n="blog.read_more">
                                    Read More <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-12 w-full flex justify-center">
                            <div class="inline-block bg-white rounded-lg shadow p-8">
                                <i class="fas fa-info-circle text-4xl text-indigo-400 mb-4"></i>
                                <h4 class="text-xl font-semibold text-gray-700 mb-2" data-i18n="blog.no_blogs_title">
                                    No articles yet
                                </h4>
                                <p class="text-gray-500" data-i18n="blog.no_blogs_desc">
                                    There are no blog posts to display at the moment. Please check back soon!
                                </p>
                            </div>
                        </div>
                    @endforelse
                </div>

                @if ($blogs->count() >= 3)
                    <div class="text-center mt-12">
                        <a href="{{ route('blogs') }}"
                            class="inline-block bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition"
                            data-i18n="blog.view_all">
                            View All Articles
                        </a>
                    </div>
                @endif
            </div>
        </section>
    </main>

</x-frontend.layout>
