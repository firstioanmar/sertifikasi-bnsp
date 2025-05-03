<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Website Sertifikasi</title>

    <!-- Import CSS dan JS menggunakan Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/index.js'])

    <!-- Import jQuery dari CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Import Font Awesome dari CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200 min-h-screen flex flex-col">

    <!-- Header dengan logo dan judul -->
    <header class="bg-blue-600 text-white p-4 flex items-center justify-between">
        <!-- Bagian kiri: logo dan judul -->
        <div class="flex items-center space-x-4">
            <div class="bg-white rounded-lg p-1">
                <img src="{{ asset('assets/images/unbin.png') }}" alt="Logo UNBIN" class="h-12" />
            </div>
            <h1 class="text-xl font-semibold">Website Sertifikasi</h1>
        </div>

        <!-- Bagian kanan: tombol Login/Register atau Dashboard/Logout -->
        <div class="flex items-center space-x-4">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="bg-white text-blue-600 font-semibold px-4 py-2 rounded shadow hover:bg-blue-50 transition">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="bg-white text-blue-600 font-semibold px-4 py-2 rounded shadow hover:bg-blue-50 transition">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="bg-white text-blue-600 font-semibold px-4 py-2 rounded shadow hover:bg-blue-50 transition">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="bg-blue-700 text-white font-semibold px-4 py-2 rounded shadow hover:bg-blue-800 transition">Register</a>
                    @endif
                @endauth
            @endif
        </div>
    </header>

    <!-- Navigasi utama -->
    <nav class="bg-white dark:bg-gray-800 shadow-md">
        <div class="max-w-7xl mx-auto px-4">
            <ul class="flex space-x-6 py-3 justify-center">
                <!-- Tautan navigasi -->
                <li><a href="#" class="nav-link hover:text-blue-600 dark:hover:text-blue-400 font-medium" data-target="home">Home</a></li>
                <li><a href="#" class="nav-link hover:text-blue-600 dark:hover:text-blue-400 font-medium" data-target="about">About</a></li>
                <li><a href="#" class="nav-link hover:text-blue-600 dark:hover:text-blue-400 font-medium" data-target="contact">Contact</a></li>
            </ul>
        </div>
    </nav>

    <!-- Konten utama -->
    <main class="flex-grow w-full p-6" id="page-content">
        <!-- Carousel akan dimuat di sini -->
        <div id="home-carousel" class="carousel relative w-full max-w-4xl mx-auto overflow-hidden rounded-lg shadow-lg hidden">
            <div class="carousel-inner relative w-full overflow-hidden">
                <!-- Slide akan dimasukkan secara dinamis -->
            </div>
            <!-- Kontrol navigasi dengan ikon Font Awesome -->
            <button class="carousel-prev absolute top-1/2 left-2 transform bg-blue-600 text-white p-4 text-5xl rounded-full hover:bg-blue-700" aria-label="Previous slide">
                <i class="fas fa-chevron-left text-xl"></i>
            </button>
            <button class="carousel-next absolute top-1/2 right-2 transform bg-blue-600 text-white p-4 text-5xl rounded-full hover:bg-blue-700" aria-label="Next slide">
                <i class="fas fa-chevron-right text-xl"></i>
            </button>
        </div>

        <!-- Konten halaman lain akan dimuat di sini -->
        <div id="page-content-text" class="mt-6 max-w-7xl mx-auto px-4"></div>

        <!-- Contoh section company profile dengan card -->
        <section id="company-profile" class="my-12 max-w-7xl mx-auto px-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 flex flex-col items-center text-center">
                <img src="{{ asset('assets/images/carousel1.jpg') }}" alt="Professional Certification" class="h-24 mb-4 rounded" />
                <h3 class="text-lg font-semibold mb-2">Professional Certification</h3>
                <p>Get certified with recognized professional standards to boost your career.</p>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 flex flex-col items-center text-center">
                <img src="{{ asset('assets/images/carousel2.jpg') }}" alt="Training Programs" class="h-24 mb-4 rounded" />
                <h3 class="text-lg font-semibold mb-2">Training Programs</h3>
                <p>Participate in comprehensive training sessions designed by industry experts.</p>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 flex flex-col items-center text-center">
                <img src="{{ asset('assets/images/carousel3.jpg') }}" alt="Consultation Services" class="h-24 mb-4 rounded" />
                <h3 class="text-lg font-semibold mb-2">Consultation Services</h3>
                <p>Receive expert advice to help you navigate certification processes smoothly.</p>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-200 dark:bg-gray-800 text-center p-4 text-sm text-gray-600 dark:text-gray-400">
        &copy; {{ date('Y') }} Website Sertifikasi
    </footer>
</body>
</html>
