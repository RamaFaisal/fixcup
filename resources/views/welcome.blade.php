<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fixcup 6.0</title>
    @vite(['resources/css/app.css'])

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-white font-poppins">

    {{-- Navbar --}}
    <nav class="bg-[#7440B9] shadow-md w-full py-4 px-6 md:px-40 flex items-center justify-between text-white fixed top-0 left-0 z-50">
        <a href="#" class="flex items-center">
            <img src="LogoFixcupPutih.png" alt="Fixcup 6.0" class="h-12 md:h-16">
            <h1 class="text-lg font-semibold pl-4">FIX CUP 6.0</h1>
        </a>
        <div class="hidden md:flex space-x-8">
            <a href="#" class="hover:underline">Beranda</a>
            <a href="#" class="hover:underline">Pendaftaran</a>
            <a href="#" class="hover:underline">Guide Book</a>
            <a href="#" class="hover:underline">Contact</a>
        </div>
    </nav>

    {{-- Hero --}}
    <section class="hero bg-[#7440B9] flex flex-col md:flex-row items-center h-screen w-full px-6 md:px-40 mt-16">
        <div class="tulisan flex-1 space-y-8 text-center md:text-left">
            <p class="text-lg font-semibold text-black px-12 py-2 bg-[#F6D2FF] inline-block rounded-full">United Goals</p>
            <h1 class="text-5xl md:text-7xl font-black text-white italic">FIX CUP 6.0</h1>
            <h3 class="text-xl font-bold text-white">
                Presented by BEM Fakultas Ilmu Komputer Universitas Dian Nuswantoro
            </h3>
            <p class="text-white text-base">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti rerum omnis nobis blanditiis 
                maxime quas? Suscipit minima illum voluptatem accusantium placeat enim error nam voluptates, 
                dignissimos similique maxime sit minus.
            </p>
            <a href="#desc">
                <button class="px-6 py-2 bg-[#7F1999] text-white font-normal rounded-full flex items-center mx-auto md:mx-0">
                Start <i class="fa-solid fa-arrow-right ml-2"></i>
                </button>
            </a>
        </div>
        <div class="maskot flex-1 flex justify-center mt-8 md:mt-0">
            <img src="Pose3.png" alt="Maskot Fixcup 6.0" class="w-48 md:w-full drop-shadow-xl">
        </div>
    </section>

    {{-- Deskripsi --}}
    <section id="desc" class="desc text-center px-6 md:px-40 py-12 h-screen/2 flex flex-col justify-center">
        <h1 class="font-bold text-3xl md:text-4xl mb-4">Apa itu FIX CUP?</h1>
        <p class="text-lg md:text-xl text-gray-700 leading-relaxed">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus libero fuga praesentium nihil, 
            enim tempora possimus, deserunt architecto dolorum asperiores expedita! Quos architecto provident 
            ipsa aut nulla veniam saepe ea.
        </p>
    </section>

    {{-- Poster --}}
    <section class="post bg-[#7440B9] text-white px-6 md:px-40 py-12 h-auto flex items-center justify-center">
        <div class="">
            <h1 class="font-bold text-3xl md:text-4xl mb-8 text-center">FIX CUP 6.0</h1>
            <div class="flex flex-col md:flex-row gap-12 items-center w-full">
                <div class="poster">
                    <img src="Poster.png" alt="Poster Fixcup 6.0" class="w-80 shadow-2xl">
                </div>
                <div class="desc space-y-14 text-2xl pr-8 items-center">
                    <p><i class="fa-regular fa-calendar fa-lg mr-4"></i> 1 - 2 Februari 2004 (PENDAFTARAN)</p>
                    <p><i class="fa-regular fa-calendar-days fa-lg mr-4"></i> 1 - 2 Februari 2004 (MATCH DAY)</p>
                    <p><i class="fa-solid fa-location-dot fa-lg mr-4"></i> GOR UDINUS SATRIA SPORT CENTER</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Kategori --}}
    <section id="kategori" class="kategori px-6 md:px-40 py-12">
        <h1 class="font-bold text-4xl mb-12 text-center">Kategori</h1>
        <div class="container flex flex-row gap-12 w-full items-center justify-center">
            <div class="bg-white w-80 h-96 shadow-lg rounded-2xl items-center justify-center flex flex-col mr-8">
                <div class="w-52 h-56 bg-purple-400 rounded-full flex items-center justify-center">
                    <img src="poster.png" alt="SMA/SMK" class="w-20">
                </div>
                <p class="mt-8 font-bold text-xl">SMA/SMK</p>
            </div>

            <div class="bg-white w-80 h-96 shadow-lg rounded-2xl items-center justify-center flex flex-col ml-8">
                <div class="w-52 h-56 bg-purple-400 rounded-full flex items-center justify-center">
                    <img src="poster.png" alt="SMA/SMK" class="w-20">
                </div>
                <p class="mt-8 font-bold text-xl">Prodi FIK</p>
            </div>
        </div>
    </section>

</body>
</html>
