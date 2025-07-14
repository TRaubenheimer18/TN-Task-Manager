<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'PinkTask' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js']) <!-- Ensure Tailwind is compiled -->
</head>
<body class="bg-pink-100 flex flex-col min-h-screen font-sans">

    <!-- Navbar -->
    <nav class="bg-pink-400 text-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
            <h1 class="text-xl font-bold">PinkTask</h1>

            <!-- Kebab Dropdown -->
            <div class="relative group">
                <button class="text-xl font-bold focus:outline-none">⋮</button>
                <div class="absolute right-0 mt-2 w-32 bg-white text-black rounded-md shadow-lg opacity-0 group-hover:opacity-100 transition-opacity duration-150 z-50">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full px-4 py-2 text-left text-red-600 hover:bg-gray-100">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <main class="flex-grow max-w-7xl mx-auto w-full p-6">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-pink-300 text-center py-3 text-sm text-gray-800 shadow-inner">
        Developed by <strong>Naqeebah</strong> and <strong>Teyanah</strong> © {{ date('Y') }}
    </footer>

</body>
</html>
