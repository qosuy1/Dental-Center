{{-- nav Bar --}}
<nav class="navbar">
    <div class="logo">
        <div class="flex items-center">
            <i class="fas fa-tooth text-2xl  mr-3"></i>
            <span class="text-xl font-bold ">City Smiles Clinic</span>
        </div>
    </div>
    <div class="menu-toggle" id="mobile-menu">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
    </div>
    <ul class="nav-menu">
        <li><a href="{{ route('index') }}" class="nav-link">Home</a></li>
        <li><a href="{{ route('about') }}" class="nav-link">About Us</a></li>
        <li class="dropdown">
            <p class="nav-link">Services <i class="fas fa-chevron-down"></i></p>
            <ul class="dropdown-menu">
                @foreach ($all_departments_names as $department)
                    <li><a href="{{ route('department', ['name' => $department]) }}">{{ $department }}</a></li>
                    {{-- <li><a href="services.html#cosmetic">Cosmetic Dentistry</a></li>
                    <li><a href="services.html#orthodontic">Orthodontic Treatment</a></li>
                    <li><a href="services.html#implant">Dental Implants</a></li> --}}
                @endforeach
            </ul>
        </li>
        <li><a href="{{ route('cases') }}" class="nav-link">Cases</a></li>
        <li><a href="{{ route('blogs') }}" class="nav-link">Blogs</a></li>
    </ul>
</nav>
