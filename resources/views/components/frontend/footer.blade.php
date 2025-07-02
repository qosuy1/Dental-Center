<footer class="bg-indigo-800 text-white py-12">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- About Section -->
            <div>
                <h3 class="text-xl font-bold mb-4" data-i18n="footer.about">
                    About Us
                </h3>
                <p class="mb-4" data-i18n="footer.description">
                    Providing exceptional dental and beauty services since 2010.
                </p>
                <div class="flex space-x-6 justify-center">
                    <a href="{{ $settings->facebook ?? '#' }}" class="text-white hover:text-indigo-400 text-2xl"><i
                            class="fab fa-facebook-f"></i></a>
                    {{-- <a href="#" class="text-white hover:text-green-200"><i class="fab fa-twitter"></i></a> --}}
                    <a href="{{ $settings->instagram ?? '#' }}" class="text-white hover:text-indigo-400 text-2xl"><i
                            class="fab fa-instagram"></i></a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-xl font-bold mb-4" data-i18n="footer.links">
                    Quick Links
                </h3>
                <ul class="space-y-2">
                    <li>
                        <a href="{{route('index')}}" class="hover:text-indigo-200 transition" data-i18n="menu.home">Home</a>
                    </li>
                    <li>
                        <a href="{{route('about')}}" class="hover:text-indigo-200 transition"
                            data-i18n="menu.services">About</a>
                    </li>
                    <li>
                        <a href="{{route('cases')}}" class="hover:text-indigo-200 transition"
                            data-i18n="menu.departments">Cases</a>
                    </li>
                    <li>
                        <a href="{{route('blogs')}}" class="hover:text-indigo-200 transition" data-i18n="menu.contact">Blogs</a>
                    </li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div>
                <h3 class="text-xl font-bold mb-4" data-i18n="footer.contact">
                    Contact Us
                </h3>
                <div class="space-y-2">
                    <p>
                        <i class="fas fa-map-marker-alt mr-2"></i>
                        <span data-i18n="footer.address">{{ $settings->address ?? "--" }}</span>
                    </p>
                    <p>
                        <i class="fas fa-phone mr-2"></i>
                        <span data-i18n="footer.phone">{{ $settings->number ?? "--" }}</span>
                    </p>

                    <p>
                        <i class="fas fa-envelope mr-2"></i>
                        <span data-i18n="footer.email">{{$settings->email ?? "--"}}</span>
                    </p>
                    <p>
                        <i class="fas fa-clock mr-2"></i>
                        <span data-i18n="footer.hours">Mon-Fri: 9AM-6PM</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="border-t border-indigo-700 mt-6 pt-8  text-center">
            <p data-i18n="footer.copyright">
                © 2025 , All rights reserved.
            </p>
        </div>
    </div>
</footer>
