<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fixcup 6.0</title>
    @vite(['resources/css/app.css'])

    {{-- Poppins Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link rel="icon" sizes="32x32" href="/favicon.ico">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @livewireStyles
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>

</head>

<body class="bg-white font-poppins antialiased scroll-smooth">

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    {{-- Navbar --}}
    <nav class="bg-[#7440B9] shadow-md w-full py-4 px-6 md:px-40 md:flex items-center justify-between text-white fixed top-0 left-0 z-50 overflow-auto">
        <a href="#" class="flex items-center">
            <img src="LogoFixcupPutih.png" alt="Fixcup 6.0" class="h-12 md:h-16" />
            <h1 class="text-lg font-semibold pl-4">FIX CUP</h1>
        </a>
        <div class="hidden md:flex space-x-8">
            <a href="#hero" class="nav-link hover:underline">Beranda</a>
            <a href="#kategori" class="nav-link hover:underline">Pendaftaran</a>
            <a href="#guideBook" class="nav-link hover:underline">Guide Book</a>
            <a href="#footer" class="nav-link hover:underline">Contact Person</a>
        </div>
    </nav>

    {{-- Hero --}}
    <section id="hero" class="hero bg-[#7440B9] sm:py-20 sm:mt-0 sm:h-full sm:flex-col-reverse max-sm:flex-col-reverse flex max-sm:h-full flex-col md:flex-col-reverse lg:flex-row items-center h-screen w-full px-6 md:px-40 mt-16 gap-6">
        <div class="tulisan flex-1 space-y-8 text-center md:text-left max-sm:flex-col-reverse ">
            <p class="text-lg font-semibold text-black px-12 py-2 bg-[#F6D2FF] sm:mt-4 inline-block rounded-full max-sm:-mt-12 ">United Goals</p>
            <h1 class="text-5xl md:text-7xl sm:text-5xl font-black text-white italic">FIX CUP 6.0</h1>
            <h3 class="text-xl font-bold text-white hidden-mobile">
                Presented by BEM Fakultas Ilmu Komputer Universitas Dian Nuswantoro
            </h3>
            <p class="text-white text-base text-justify hidden sm:hidden md:hidden lg:flex">
                "United GOALS (Great Opportunity for Achievement, Learning, and Skill)" berarti setiap individu dalam tim saling mendukung dan bekerja bersama untuk mencapai tujuan bersama. Setiap anggota tim berkomitmen untuk memberikan yang terbaik bagi tim, sementara tim secara keseluruhan mendukung setiap anggota.
            </p>
            <a href="#kategori" class="nav-link">
                <button class="px-6 py-2 bg-[#7F1999] text-white font-normal rounded-full sm: flex items-center max-sm:mb-8 mx-auto md:mx-0">
                    Daftar <i class="fa-solid fa-arrow-right ml-2"></i>
                </button>
            </a>
        </div>
        <div class="maskot flex-1 flex justify-center mt-8 md:mt-0 max-sm:mt-10 max-sm:flex-0 w-full ">
            <img src="Pose3.png" alt="Maskot Fixcup 6.0" class="w-48 sm:w-48 md:w-64 lg:w-full sm:mt-12 drop-shadow-2xl ml-4 ">
        </div>
    </section>

    {{-- Deskripsi --}}
    <section id="desc" class="desc text-center px-6 md:px-40 py-28 h-screen/2 flex flex-col justify-center">
        <h1 class="font-bold text-[#7440B9] text-3xl md:text-4xl mb-8">Apa itu FIX CUP?</h1>
        <p class="text-xl md:text-2xl text-gray-700 text-justify md:text-center leading-relaxed">
            FIXCUP merupakan kegiatan untuk mewadahi minat dan bakat non akademik yang dimiliki oleh para Mahasiswa UDINUS FIK maupun calon Mahasiswa UDINUS, diperlukan adanya suatu kegiatan yang dapat menjadi wadah dan penyalur minat bakat para mahasiswa dengan berbagai talenta yang dapat dikompetisikan. Melalui kegiatan FIX CUP 2025 diharapkan mampu menemukan kemampuan di bidang selain akademis yaitu non akademis yang dapat disaingkan dengan mahasiswa di luar UDINUS serta para calon mahasiswa UDINUS.
        </p>
    </section>

    {{-- Poster --}}
    <section class="post bg-[#7440B9] text-white px-6 md:px-40 py-12 h-auto flex items-center justify-center">
        <div class="">
            <h1 class="font-bold text-3xl md:text-4xl mb-8 text-center">FIX CUP 6.0</h1>
            <div class="flex flex-col md:flex-row gap-12 md:gap-20 items-center w-full">
                <div class="poster">
                    <img src="Poster.png" alt="Poster Fixcup 6.0" class="w-80 shadow-2xl cursor-pointer transition-transform duration-300 hover:scale-105"
                        onclick="openModal()" loading="lazy">

                </div>
                <div class="desc space-y-6 md:space-y-14 text-lg md:text-2xl items-center">
                    <p><i class="fa-regular fa-calendar fa-lg mr-4"></i> 4 April - 2 Mei 2025 (PENDAFTARAN)</p>
                    <p><i class="fa-regular fa-calendar-days fa-lg mr-4"></i> 17 - 18 Mei 2025 (MATCH DAY)</p>
                    <p><i class="fa-solid fa-location-dot fa-lg mr-4"></i> GOR UDINUS SATRIA SPORT CENTER</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Kategori --}}
    <section id="kategori" class="kategori px-6 md:px-40 pt-28 pb-8">
        <h1 class="font-bold text-4xl mb-10 text-center text-[#7440B9]">Formulir Pendaftaran</h1>
        <p class="text-center text-lg text-gray-600 mb-10">Pilih salah satu kategori di bawah ini berdasarkan asal institusi
            tim Anda untuk melanjutkan ke tahap pendaftaran.</p>
        <div class="container flex flex-row gap gap-8 sm:gap-12md:gap-20 w-full items-center justify-center mt-8 max-sm:flex-col max-sm:justify-center max-sm:items-center">
            {{-- SMA --}}
            <a href="{{ route('pendaftaranSMA.index') }}">
                <div onclick="selectCategory('sma')"
                    class="cursor-pointer bg-white hover:bg-purple-300 w-80 h-12 md:h-96 sm:mr-0 shadow-lg max-sm:mx-auto rounded-2xl items-center justify-center flex flex-col mr-12 border-2 border-black md:border-0">
                    <div class="w-52 h-56 bg-[#7440B9] rounded-full hidden md:flex items-center justify-center">
                        <img src="undraw_junior-soccer_0lib.svg" alt="SMA/SMK" class="w-40">
                    </div>
                    <p class="mt-0 md:mt-8 font-bold text-xl">SMA / SMK</p>
                </div>
            </a>

            {{-- Prodi --}}
            <a href="{{ route('pendaftaranProdi.index') }}">
                <div onclick="selectCategory('prodi')"
                    class="cursor-pointer bg-white hover:bg-purple-300 w-80 h-12 md:h-96 sm:mr-0 shadow-lg max-sm:mx-auto rounded-2xl items-center justify-center flex flex-col mr-12 border-2 border-black md:border-0">
                    <div class="w-52 h-56 bg-[#7440B9] rounded-full hidden md:flex items-center justify-center">
                        <img src="undraw_junior-soccer_0lib.svg" alt="SMA/SMK" class="w-40">
                    </div>
                    <p class="mt-0 md:mt-8 font-bold text-xl">Prodi FIK</p>
                </div>
            </a>
        </div>
    </section>

    {{-- Guide Book --}}
    <section id="guideBook" class="w-full px-6 sm:px-6 md:px-40 py-20 flex justify-center items-center">
        <div class="container w-full flex flex-row max-sm:flex-col sm:flex-col md:flex-row lg:flex-row justify-center items-center gap-10 md:gap-14 sm:w-[70%] md:w-[90%]">
            <div class="maskot flex justify-center items-center lg:justify-center">
                <img src="Pose1.png" alt="Maskot Fixcup 1" class="w-36 sm:w-40 md:w-64 drop-shadow-2xl">
            </div>
            <div class="tulisan flex-1 flex flex-col sm:flex-col  w-full space-y-4 text-center">
                <h1 class="text-3xl sm:text-4xl font-bold text-[#7440B9]">Guide Book</h1>
                <p class="text-gray-700 text-base text-justify lg:text-lg">
                    Guide Book Fixcup 6.0 merupakan panduan lengkap berisi informasi teknis, aturan pertandingan, serta
                    tata tertib yang harus dipatuhi oleh seluruh peserta. Tersedia dua jenis panduan, masing-masing
                    disesuaikan untuk peserta dari tingkat SMA/SMK dan mahasiswa Prodi FIK. Pastikan untuk membaca
                    dengan saksama agar tidak ada informasi penting yang terlewat.
                </p>
                <div class="gb flex flex-row max-sm:justify-center sm:flex-col lg:flex-row lg:justify-center gap-4 sm:gap-8">
                    <a href="https://drive.google.com/drive/folders/1B61r8Z6S8i8o9snGlZvNEggk5enxS78i?usp=drive_link" target="_blank">
                        <button class="bg-[#7440B9] text-white max-sm:justify-center font-semibold px-5 py-3 sm:px-6 rounded-full shadow-lg hover:bg-purple-600 transition text-base md:text-lg">
                            Guide Book SMA/SMK <i class="fa-solid fa-arrow-right ml-2"></i>
                        </button>
                    </a>

                    <a href="https://drive.google.com/drive/folders/1rOWCG-I84YQA4WrbY3RjLYF09JKhrXgE?usp=drive_link" target="_blank">
                        <button class="bg-[#7440B9] text-white font-semibold max-sm:justify-center px-5 py-3 sm:px-10 rounded-full shadow-lg hover:bg-purple-600 transition text-base md:text-lg">
                            Guide Book Prodi FIK <i class="fa-solid fa-arrow-right ml-2"></i>
                        </button>
                    </a>
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
                <div class="w-1/4">
                    <img src="LogoFixcupPutih.png" alt="Logo Fixcup 6.0" class="h-48 md:h-56 w-auto max-w-none ">
                </div>
                <div class="flex flex-col justify-center items-center md:items-start md:ml-10 space-y-4">
                    <!-- Ikon Kecil -->
                    <div class="flex flex-row gap-3 md:gap-4 bg-purple-900 px-5 md:px-6 md:w-52 md:justify-center py-2 md:py-3 rounded-full">
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
                    <p class="text-sm sm:text-sm md:text-base lg:text-lg"><a href="https://www.instagram.com/fixcup.udinus/" target="_blank" class="hover:underline">@fixcup.udinus</a> / <a href="https://www.instagram.com/bemfikudinus/" target="_blank" class="hover:underline">@bemfikudinus</a></p>
                </div>
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-globe fa-xl"></i>
                    <p class="text-sm sm:text-sm md:text-base lg:text-lg"><a href="https://bemfikdinus.com/" target="_blank" class="hover:underline">bemfikdinus.com</a></p>
                </div>
                <div class="flex items-center gap-3">
                    <i class="fa-brands fa-whatsapp fa-xl"></i>
                    <p class="text-sm sm:text-sm md:text-base lg:text-lg"><a href="http://wa.me/6285141330040" target="_blank" class="hover:underline">0851-4133-0040</a> / <a href="http://wa.me/6285802900858" target="_blank" class="hover:underline">0858-0290-0858</a></p>
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
            <img src="Poster.png" class="max-w-[90vw] md:max-w-full max-h-[70vh] md:max-h-[90vh] shadow-lg rounded-lg flex items-center justify-center" alt="poster">
            <!-- Tombol Close -->
            <button onclick="closeModal()" class="absolute top-2 right-2 text-white text-3xl">&times;</button>
        </div>
    </div>

    {{-- Script Javascript --}}
    <script>
        document.querySelectorAll(".nav-link").forEach(link => {
            link.addEventListener("click", function(e) {
                e.preventDefault(); // Mencegah reload halaman
                const targetId = this.getAttribute("href").substring(1);
                const targetSection = document.getElementById(targetId);

                if (targetSection) {
                    targetSection.scrollIntoView({
                        behavior: "smooth"
                    });
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
    @livewireScripts
</body>

</html>
