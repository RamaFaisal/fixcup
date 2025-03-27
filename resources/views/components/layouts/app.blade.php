<!DOCTYPE html>
<html lang="en">
<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="p-4">
    <header class="text-center">
        <h1 class="text-4xl font-bold p-2">Pendaftaran FIXCUP 6.0 SMA</h1>
    </header>
    {{ $slot }}
    @livewireScripts
</body>
</html>
