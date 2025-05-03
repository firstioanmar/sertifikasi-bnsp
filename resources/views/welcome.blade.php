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
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200 min-h-screen flex flex-col">

    <!-- Header dengan logo dan judul -->
    <header class="bg-red-600 text-white p-4 flex items-center justify-center space-x-4">
        <img src="{{ asset('assets/images/unbin.png') }}" alt="Logo UNBIN" class="h-12" />
        <h1 class="text-xl font-semibold">Website Sertifikasi</h1>
    </header>

    <!-- Navigasi utama -->
    <nav class="bg-white dark:bg-gray-800 shadow-md">
        <div class="max-w-7xl mx-auto px-4">
            <ul class="flex space-x-6 py-3 justify-center">
                <!-- Tautan navigasi -->
                <li><a href="#" class="nav-link hover:text-red-600 dark:hover:text-red-400 font-medium" data-target="home">Home</a></li>
                <li><a href="#" class="nav-link hover:text-red-600 dark:hover:text-red-400 font-medium" data-target="about">About</a></li>
                <li><a href="#" class="nav-link hover:text-red-600 dark:hover:text-red-400 font-medium" data-target="contact">Contact</a></li>

                <!-- Opsi autentikasi -->
                @if (Route::has('login'))
                    @auth
                        <!-- Jika user sudah login -->
                        <li><a href="{{ url('/dashboard') }}" class="hover:text-red-600 dark:hover:text-red-400 font-medium">Dashboard</a></li>
                        <li>
                            <!-- Tombol logout -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="hover:text-red-600 dark:hover:text-red-400 font-medium">Logout</button>
                            </form>
                        </li>
                    @else
                        <!-- Jika user belum login -->
                        <li><a href="{{ route('login') }}" class="hover:text-red-600 dark:hover:text-red-400 font-medium">Login</a></li>
                        @if (Route::has('register'))
                            <li><a href="{{ route('register') }}" class="hover:text-red-600 dark:hover:text-red-400 font-medium">Register</a></li>
                        @endif
                    @endauth
                @endif
            </ul>
        </div>
    </nav>

    <!-- Konten utama -->
    <main class="flex-grow max-w-7xl mx-auto p-6" id="page-content">
        <!-- Konten halaman akan dimuat secara dinamis melalui JavaScript -->
        <h2 class="text-2xl font-semibold mb-4">Memuat konten...</h2>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-200 dark:bg-gray-800 text-center p-4 text-sm text-gray-600 dark:text-gray-400">
        &copy; {{ date('Y') }} Website Sertifikasi
    </footer>
</body>
</html>
