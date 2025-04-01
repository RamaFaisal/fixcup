<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FIXCUP 6.0 | @yield('title', 'Fixcup 6.0')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Poppins Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link rel="icon" sizes="32x32" href="/favicon.ico">
    
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="p-0 lg:p-4 font-poppins antialiased bg-[#F6D2FF] md:bg-white">

    {{-- navbar --}}
    <nav class="font-poppins bg-[#7440B9] shadow-md w-full py-4 px-6 md:px-40 flex items-center justify-between text-white fixed top-0 left-0 z-50">
        <a href="#" class="flex items-center">
            <img src="LogoFixcupPutih.png" alt="Fixcup 6.0" class="h-12 md:h-16">
            <h1 class="text-lg font-semibold pl-4">FIX CUP</h1>
        </a>
        <div class="flex space-x-8">
            <a href="{{ route('home') }}" class="nav-link hover:underline">Beranda</a>
        </div>
    </nav>

    {{-- Formulir --}}
    <div class="formulir" class="">
        @yield('content')
    </div>
</body>
</html>
