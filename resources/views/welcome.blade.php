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
            <h1 class="text-lg font-semibold pl-4">FIX CUP</h1>
        </a>
        <div class="hidden md:flex space-x-8">
            <a href="#" class="nav-link hover:underline">Beranda</a>
            <a href="#kategori" class="nav-link hover:underline">Pendaftaran</a>
            <a href="#guideBook" class="nav-link hover:underline">Guide Book</a>
            <a href="#footer" class="nav-link hover:underline">Contact Person</a>
        </div>
    </nav>

    {{-- Hero --}}
    <section class="hero bg-[#7440B9] flex flex-col md:flex-row items-center h-screen w-full px-6 md:px-40 mt-16 gap-6">
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
            <img src="Pose3.png" alt="Maskot Fixcup 6.0" class="w-40 md:w-full drop-shadow-2xl ml-4">
        </div>
    </section>

    {{-- Deskripsi --}}
    <section id="desc" class="desc text-center px-6 md:px-40 py-28 h-screen/2 flex flex-col justify-center">
        <h1 class="font-bold text-[#7440B9] text-3xl md:text-4xl mb-6">Apa itu FIX CUP?</h1>
        <p class="text-xl md:text-2xl text-gray-700 leading-relaxed">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
        </p>
    </section>

    {{-- Poster --}}
    <section class="post bg-[#7440B9] text-white px-6 md:px-40 py-12 h-auto flex items-center justify-center">
        <div class="">
            <h1 class="font-bold text-3xl md:text-4xl mb-8 text-center">FIX CUP 6.0</h1>
            <div class="flex flex-col md:flex-row gap-12 items-center w-full">
                <div class="poster">
                    <img src="Poster.png" alt="Poster Fixcup 6.0" class="w-80 shadow-2xl cursor-pointer transition-transform duration-300 hover:scale-105"
                    onclick="openModal()">
                </div>
                <div class="desc space-y-14 text-2xl pr-8 items-center">
                    <p><i class="fa-regular fa-calendar fa-lg mr-4"></i> 4 April - 2 Mei 2025 (PENDAFTARAN)</p>
                    <p><i class="fa-regular fa-calendar-days fa-lg mr-4"></i> 17 - 18 Mei 2025 (MATCH DAY)</p>
                    <p><i class="fa-solid fa-location-dot fa-lg mr-4"></i> GOR UDINUS SATRIA SPORT CENTER</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Kategori --}}
    <section id="kategori" class="kategori px-6 md:px-40 pt-28 pb-8">
        <h1 class="font-bold text-4xl mb-12 text-center">Kategori</h1>
        <div class="container flex flex-row gap-12 w-full items-center justify-center mt-8">
            <div class="bg-white hover:bg-purple-300 w-80 h-96 shadow-lg rounded-2xl items-center justify-center flex flex-col mr-12">
                <div class="w-52 h-56 bg-[#7440B9] rounded-full flex items-center justify-center">
                    <img src="poster.png" alt="SMA/SMK" class="w-20">
                </div>
                <p class="mt-8 font-bold text-xl">SMA/SMK</p>
            </div>

            <div class="bg-white hover:bg-purple-300 w-80 h-96 shadow-lg rounded-2xl items-center justify-center flex flex-col ml-12">
                <div class="w-52 h-56 bg-[#7440B9] rounded-full flex items-center justify-center">
                    <img src="poster.png" alt="SMA/SMK" class="w-20">
                </div>
                <p class="mt-8 font-bold text-xl">Prodi FIK</p>
            </div>
        </div>
    </section>

    {{-- Guide Book --}}
    <section id="guideBook" class="px-40 py-28 flex justify-center items-center">
        <div class="container flex flex-row justify-center items-center gap-16 w-[70%]">
            <div class="maskot justify-center items-center">
                <img src="Pose1.png" alt="Maskot Fixcup 1" class="w-72 drop-shadow-2xl self-center">
            </div>
            <div class="tulisan flex-1 space-y-4">
                <h1 class="text-4xl font-bold text-[#7440B9] mb-4 text-center">Guide Book</h1>
                <p class="text-gray-700 text-lg mb-6 text-justify">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente dolores, aut reiciendis exercitationem facere 
                    accusamus voluptate aliquam nulla dolore reprehenderit natus nemo. A incidunt accusamus doloremque fugit sint totam doloribus!
                </p>
                <div class="gb flex flex-col md:flex-row gap-4">
                    <a href="https://drive.google.com/drive/folders/1B61r8Z6S8i8o9snGlZvNEggk5enxS78i?usp=drive_link" target="_blank"><button class="bg-[#7440B9] text-white font-semibold px-5 py-3 rounded-full shadow-lg hover:bg-purple-600 transition">Guide Book SMA/SMK <i class="fa-solid fa-arrow-right ml-2"></i>
                    </button></a>

                    <a href="https://drive.google.com/drive/folders/1rOWCG-I84YQA4WrbY3RjLYF09JKhrXgE?usp=drive_link" target="_blank"><button class="bg-[#7440B9] text-white font-semibold px-5 py-3 rounded-full shadow-lg hover:bg-purple-600 transition">Guide Book Prodi FIK <i class="fa-solid fa-arrow-right ml-2"></i></button></a>
                </div>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <section id="footer" class="bg-[#7440B9] px-6 md:px-32 lg:px-56 pt-20 text-white">
        <div class="container flex flex-col md:flex-row justify-between items-center gap-12">
            <!-- Bagian Kiri: Logo dan Informasi -->
            <div class="flex flex-1 gap-4 md:gap-6 items-center">
                <!-- Logo Utama -->
                <div class="flex-1/4">
                    <img src="LogoFixcupPutih.png" alt="Logo Fixcup 6.0" class="h-48 md:h-56 w-full">
                </div>
                <div class="flex flex-col justify-center items-center md:items-start space-y-4">
                    <!-- Ikon Kecil -->
                    <div class="flex flex-row gap-3 md:gap-4 bg-purple-900 px-5 md:px-6 py-2 md:py-3 rounded-full">
                        <img src="LogoUdinus.PNG" alt="Logo Udinus" class="h-8 md:h-10">
                        <img src="Unggul.png" alt="Unggul" class="h-8 md:h-10">
                        <img src="BemFIK.png" alt="BEM FIK UDINUS" class="h-8 md:h-10">
                        <img src="LogoFixcupPutih.png" alt="Logo FIX CUP 6.0" class="h-8 md:h-10">
                    </div>
                    <!-- Judul dan Deskripsi -->
                    <h1 class="font-bold text-2xl md:text-4xl italic text-center md:text-left">FIX CUP 6.0</h1>
                    <p class="text-sm md:text-base font-medium text-center md:text-left leading-relaxed">
                        Presented by Badan Eksekutif Mahasiswa Fakultas Ilmu Komputer Universitas Dian Nuswantoro
                    </p>
                </div>
            </div>

            <!-- Garis Pemisah -->
            <div class="hidden md:block w-[2px] bg-white h-56"></div>

            <!-- Bagian Kanan: Sosial Media -->
            <div class="flex flex-col items-center md:items-start text-center md:text-left space-y-6 ml-8">
                <h2 class="font-bold text-lg md:text-xl mb-6">Ikuti Kami</h2>
                <div class="flex items-center gap-3">
                    <i class="fa-brands fa-instagram fa-xl"></i>
                    <p class="text-lg"><a href="https://www.instagram.com/fixcup.udinus/" target="_blank">@fixcup.udinus</a> / <a href="https://www.instagram.com/bemfikudinus/" target="_blank">@bemfikudinus</a></p>
                </div>
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-globe fa-xl"></i>
                    <p class="text-lg"><a href="https://bemfikdinus.com/" target="_blank">bemfikdinus.com</a></p>
                </div>
                <div class="flex items-center gap-3">
                    <i class="fa-brands fa-whatsapp fa-xl"></i>
                    <p class="text-lg"><a href="http://wa.me/6285141330040" target="_blank">0851-4133-0040</a> / <a href="http://wa.me/6285802900858" target="_blank">0858-0290-0858</a></p>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <p class="text-center text-xs md:text-sm mt-8 pb-4">&copy; 2025, All Rights Reserved.</p>
    </section>

    {{-- Added --}}
    {{-- Modal (Pop Up) --}}
    <div id="imageModal" class="fixed inset-0 backdrop-blur hidden flex items-center justify-center z-50">
        <div class="relative">
            <img src="Poster.png" class="max-w-full max-h-[90vh] shadow-lg rounded-lg">
            <!-- Tombol Close -->
            <button onclick="closeModal()" class="absolute top-2 right-2 text-white text-3xl">&times;</button>
        </div>
    </div>

    {{-- Script Javascript --}}
    <script>
        document.querySelectorAll(".nav-link").forEach(link => {
            link.addEventListener("click", function (e) {
                e.preventDefault(); // Mencegah reload halaman
                const targetId = this.getAttribute("href").substring(1);
                const targetSection = document.getElementById(targetId);
                
                if (targetSection) {
                    targetSection.scrollIntoView({ behavior: "smooth" });
                }
            });
        });
        function openModal() {
            document.getElementById('imageModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('imageModal').classList.add('hidden');
        }
    </script>
</body>
</html>
