<!DOCTYPE html>
<html lang="en">
<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="p-4">
    <header class="text-center">
        <h1 class="text-4xl font-bold p-2">Pendaftaran FIXCUP 6.0</h1>
    </header>
    @yield('content')
</body>
</html>
