@extends('layouts.app')

@section('title', 'Daftar Tim SMA')

@section('content')
    <div
        class="w-full md:w-3/4 mx-auto p-6 md:p-8 lg:p-9 mt-24 bg-none md:bg-[#F6D2FF] rounded-none md:rounded-3xl drop-shadow-lg font-poppins">

        {{-- Header --}}
        <div class="header pb-6">
            <h1 class="text-2xl font-extrabold mb-2 text-center">PENDAFTARAN FIX CUP 6.0</h1>
            <p class="text-center font-normal sm:font-normal md:font-semibold lg:font-semibold italic">Kategori SMA/SMK</p>
        </div>

        @if (session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        // html: `{!! session('success') !!} <br><br>
            //     <a href="https://wa.me/6281234567890" target="_blank" style="color:#1DA1F2; text-decoration:underline;">
            //         Hubungi kami via WhatsApp
            //     </a>`,
                        timer: 5000,
                        showConfirmButton: false,
                    });
                });
            </script>
        @endif

        <!-- Stepper Bulat -->
        <div class="overflow-x-auto mb-6">
            <div class="flex flex-nowrap justify-start md:justify-center items-center mb-8 px-2 sm:px-0">
                @foreach ([1 => 'Tim', 2 => 'Kontak', 3 => 'Pemain', 4 => 'Official', 5 => 'Dokumen', 6 => 'Payment', 7 => 'Review'] as $num => $label)
                    <div class="flex items-center relative flex-shrink-0">
                        <!-- Lingkaran + Label -->
                        <div class="flex flex-col items-center relative">
                            <div id="circle-{{ $num }}"
                                class="w-8 h-8 sm:w-8 sm:h-8 md:w-10 md:h-10 lg:w-12 lg:h-12 
                                    flex items-center justify-center rounded-full 
                                    border-2 border-purple-500 font-bold text-white
                                    bg-white transition duration-300 shadow-md relative text-sm sm:text-sm md:text-base lg:text-lg">
                                <span class="step-number block">{{ $num }}</span>
                                <span id="check-{{ $num }}"
                                    class="absolute hidden text-white text-lg font-bold">✓</span>
                            </div>

                            <!-- Label di bawah -->
                            <span
                                class="absolute top-full mt-1 text-[10px] sm:text-xs md:text-sm lg:text-base text-purple-700 font-medium text-center w-max mb-3">
                                {{ $label }}
                            </span>
                        </div>

                        @if ($num < 7)
                            <div class="w-6 md:w-10 lg:w-14 h-0.5 bg-purple-400"></div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Formulir --}}
        <form id="pendaftaranForm" action="{{ route('pendaftaranSMA.store') }}" method="POST" enctype="multipart/form-data"
            class="mx-auto max-w-sm sm:max-w-md md:max-w-2xl lg:max-w-3xl border-t-2 border-purple-400 py-2 sm:py-4 md:px-6 md:py-4">
            @csrf

            {{-- STEP 1 --}}
            <div id="step-1" class="step">
                <p
                    class="text-gray-400 text-xs md:text-sm lg:text-base font-poppins text-center pb-2 sm:pb-2 md:pb-3.5 lg:pb-3.5">
                    *Format file jpg, jpeg, png*</p>
                <div class="mb-4">
                    <label class="block font-bold text-lg mb-1 p-2">Nama Sekolah</label>
                    <input type="text" name="nama"
                        class="w-full border-2 border-purple-500 rounded-full py-3 px-5 bg-white drop-shadow-lg"
                        value="{{ old('nama') }}" required>
                </div>
                <div class="mb-4">
                    <label class="block font-bold text-lg mb-1 p-2">Logo Sekolah<span class="text-gray-400 font-normal">(jpg, jpeg, png)</span></label>
                    <input type="file" name="logo"
                        class="block border-2 border-purple-500 rounded-full p-2 bg-white text-sm text-gray-500 drop-shadow-lg file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-600 file:text-white hover:file:bg-gray-500 w-full"
                        required>
                </div>
            </div>

            {{-- STEP 2 --}}
            <div id="step-2" class="step hidden">
                <p
                    class="text-gray-400 text-xs md:text-sm lg:text-base font-poppins text-center pb-2 sm:pb-2 md:pb-3.5 lg:pb-3.5">
                    *Nama dan Kontak Capo opsional*</p>
                <h2 class="text-xl font-bold mb-4">Contact Person</h2>
                <div class="bg-white rounded-2xl p-3">
                    <div class="mb-12 p-3">
                        <h3 class="block font-semibold text-lg mb-1 p-2">Kapten</h3>
                        <label class="block font-normal text-lg mb-1 p-2">Nama</label>
                        <input type="text" name="captain_nama"
                            class="w-full border-2 border-purple-500 rounded-full py-3 px-5 bg-white drop-shadow-lg"
                            value="{{ old('captain_nama') }}" required>
                        <label class="block font-normal text-lg mb-1 p-2">No Telepon</label>
                        <input type="text" name="captain_wa"
                            class="w-full border-2 border-purple-500 rounded-full py-3 px-5 bg-white drop-shadow-lg"
                            value="{{ old('captain_wa') }}" required>
                    </div>

                    <div class="mb-12 p-3">
                        <h3 class="block font-semibold text-lg mb-1 p-2">Official</h3>
                        <label class="block font-normal text-lg mb-1 p-2">Nama</label>
                        <input type="text" name="official_nama"
                            class="w-full border-2 border-purple-500 rounded-full py-3 px-5 bg-white drop-shadow-lg"
                            value="{{ old('official_nama') }}" required>
                        <label class="block font-normal text-lg mb-1 p-2">No WA</label>
                        <input type="text" name="official_wa"
                            class="w-full border-2 border-purple-500 rounded-full py-3 px-5 bg-white drop-shadow-lg"
                            value="{{ old('official_wa') }}" required>
                    </div>

                    <div class="mb-12 p-3">
                        <h3 class="block font-semibold text-lg mb-1 p-2">Capo (Opsional)</h3>
                        <label class="block font-normal text-lg mb-1 p-2">Nama Capo</label>
                        <input type="text" name="capo_nama"
                            class="w-full border-2 border-purple-500 rounded-full py-3 px-5 bg-white drop-shadow-lg"
                            value="{{ old('capo_nama') }}">
                        <label class="block font-normal text-lg mb-1 p-2">No WA Capo</label>
                        <input type="text" name="capo_wa"
                            class="w-full border-2 border-purple-500 rounded-full py-3 px-5 bg-white drop-shadow-lg"
                            value="{{ old('capo_wa') }}">
                    </div>
                </div>
            </div>

            {{-- STEP 3 --}}
            <div id="step-3" class="step hidden">
                <p
                    class="text-gray-400 text-xs md:text-sm lg:text-base font-poppins text-center pb-2 sm:pb-2 md:pb-3.5 lg:pb-3.5">
                    *Minimal 7 pemain dalam setiap tim dan Format file jpg, jpeg, png*</p>
                <h2 class="text-xl font-bold mb-4">Data Pemain</h2>
                @for ($i = 1; $i <= 12; $i++)
                    <div class="mb-6 border p-5 rounded-xl shadow-sm bg-gray-50">
                        <h3 class="block font-semibold text-lg mb-1 p-2">Pemain {{ $i }}</h3>
                        <div class="mb-2">
                            <label class="block font-normal text-lg mb-1 p-2">Nama</label>
                            <input type="text" name="players[{{ $i }}][nama]"
                                class="w-full border-2 border-purple-500 rounded-full py-3 px-5 bg-white drop-shadow-lg"
                                {{ $i <= 7 ? 'required' : '' }}>
                        </div>
                        <div class="mb-2">
                            <label class="block font-normal text-lg mb-1 p-2">Pas Foto <span class="text-gray-400 font-normal">(jpg, jpeg, png)</span></label>
                            <input type="file" name="players[{{ $i }}][pas_foto]" accept="image/*"
                                class="block border-2 border-purple-500 rounded-full p-2 bg-white text-sm text-gray-500 drop-shadow-lg file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-600 file:text-white hover:file:bg-gray-500 w-full"
                                {{ $i <= 7 ? 'required' : '' }}>
                        </div>
                        <div>
                            <label class="block font-normal text-lg mb-1 p-2">Foto Kartu Pelajar <span class="text-gray-400 font-normal">(jpg, jpeg, png)</span></label>
                            <input type="file" name="players[{{ $i }}][foto_kartu]" accept="image/*"
                                class="block border-2 border-purple-500 rounded-full p-2 bg-white text-sm text-gray-500 drop-shadow-lg file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-600 file:text-white hover:file:bg-gray-500 w-full"
                                {{ $i <= 7 ? 'required' : '' }}>
                        </div>
                    </div>
                @endfor
            </div>

            {{-- STEP 4 --}}
            <div id="step-4" class="step hidden">
                <p
                    class="text-gray-400 text-xs md:text-sm lg:text-base font-poppins text-center pb-2 sm:pb-2 md:pb-3.5 lg:pb-3.5">
                    *Minimal 1 official dalam setiap tim dan Format file jpg, jpeg, png*</p>
                <h2 class="text-xl font-semibold mb-4">Data Official</h2>
                @for ($i = 1; $i < 3; $i++)
                    <div class="mb-6 border p-4 rounded-xl shadow-sm bg-gray-50">
                        <h3 class="font-semibold mb-2">Official {{ $i }}</h3>
                        <div class="mb-2">
                            <label class="block font-normal text-lg mb-1 p-2">Nama</label>
                            <input type="text" name="officials[{{ $i }}][nama]"
                                class="w-full border-2 border-purple-500 rounded-full py-3 px-5 bg-white drop-shadow-lg"
                                {{ $i <= 1 ? 'required' : '' }}>
                        </div>
                        <div class="mb-2">
                            <label class="block font-normal text-lg mb-1 p-2">Pas Foto <span class="text-gray-400 font-normal">(jpg, jpeg, png)</span></label>
                            <input type="file" name="officials[{{ $i }}][pas_foto]" accept="image/*"
                                class="block border-2 border-purple-500 rounded-full p-2 bg-white text-sm text-gray-500 drop-shadow-lg file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-600 file:text-white hover:file:bg-gray-500 w-full"
                                {{ $i <= 1 ? 'required' : '' }}>
                        </div>
                        <div class="mb-2">
                            <label class="block font-normal text-lg mb-1 p-2">Foto KTP <span class="text-gray-400 font-normal">(jpg, jpeg, png)</span></label>
                            <input type="file" name="officials[{{ $i }}][foto_ktp]" accept="image/*"
                                class="block border-2 border-purple-500 rounded-full p-2 bg-white text-sm text-gray-500 drop-shadow-lg file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-600 file:text-white hover:file:bg-gray-500 w-full"
                                {{ $i <= 1 ? 'required' : '' }}>
                        </div>
                    </div>
                @endfor
            </div>

            {{-- STEP 5 --}}
            <div id="step-5" class="step hidden">
                <p
                    class="text-gray-400 text-xs md:text-sm lg:text-base font-poppins text-center pb-2 sm:pb-2 md:pb-3.5 lg:pb-3.5">
                    *Format file jpg, jpeg, png*</p>
                <h2 class="text-xl font-semibold mb-4">Dokumen Tambahan</h2>
                <div class="mb-6 border p-4 rounded-xl shadow-sm bg-gray-50">
                    <div class="mb-4">
                        <label class="block font-normal text-lg mb-1 p-2">Foto Tim Menggunakan Jersey <span class="text-gray-400 font-normal">(jpg, jpeg, png)</span></label>
                        <input type="file" name="foto_tim_berjersey"
                            class="block border-2 border-purple-500 rounded-full p-2 bg-white text-sm text-gray-500 drop-shadow-lg file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-600 file:text-white hover:file:bg-gray-500 w-full"
                            required>
                    </div>
                    <div class="mb-4">
                        <label class="block font-normal text-lg mb-1 p-2">Foto Jersey Pemain <span class="text-gray-400 font-normal">(jpg, jpeg, png)</span></label>
                        <input type="file" name="foto_jersey_pemain"
                            class="block border-2 border-purple-500 rounded-full p-2 bg-white text-sm text-gray-500 drop-shadow-lg file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-600 file:text-white hover:file:bg-gray-500 w-full"
                            required>
                    </div>
                    <div class="mb-4">
                        <label class="block font-normal text-lg mb-1 p-2">Foto Jersey Kiper <span class="text-gray-400 font-normal">(jpg, jpeg, png)</span></label>
                        <input type="file" name="foto_jersey_kiper"
                            class="block border-2 border-purple-500 rounded-full p-2 bg-white text-sm text-gray-500 drop-shadow-lg file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-600 file:text-white hover:file:bg-gray-500 w-full"
                            required>
                    </div>
                    <div class="mb-4">
                        <label class="block font-normal text-lg mb-1 p-2">Surat Rekomendasi dari Sekolah <span class="text-gray-400 font-normal">(jpg, jpeg, png)</span></label>
                        <input type="file" name="surat_rekomendasi"
                            class="block border-2 border-purple-500 rounded-full p-2 bg-white text-sm text-gray-500 drop-shadow-lg file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-600 file:text-white hover:file:bg-gray-500 w-full">
                    </div>
                    <div class="my-8 flex flex-col items-center justify-center">
                        <span class="block font-normal text-lg mb-1 p-2">Contoh foto 3 orang</span>
                        <img src="ThreePerson.jpg" alt="Contoh foto 3 orang" class="w-56 flex items-center justify-center border-2 border-purple-500 rounded-lg drop-shadow-lg">
                    </div>
                    <div class="mb-4">
                        <label class="block font-normal text-lg mb-1 p-2">Foto Player Satu <span class="text-gray-400 font-normal">(jpg, jpeg, png)</span></label>
                        <input type="file" name="foto_player_satu"
                            class="block border-2 border-purple-500 rounded-full p-2 bg-white text-sm text-gray-500 drop-shadow-lg file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-600 file:text-white hover:file:bg-gray-500 w-full">
                    </div>
                    <div class="mb-4">
                        <label class="block font-normal text-lg mb-1 p-2">Foto Player Dua <span class="text-gray-400 font-normal">(jpg, jpeg, png)</span></label>
                        <input type="file" name="foto_player_dua"
                            class="block border-2 border-purple-500 rounded-full p-2 bg-white text-sm text-gray-500 drop-shadow-lg file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-600 file:text-white hover:file:bg-gray-500 w-full">
                    </div>
                    <div class="mb-4">
                        <label class="block font-normal text-lg mb-1 p-2">Foto Player Tiga <span class="text-gray-400 font-normal">(jpg, jpeg, png)</span></label>
                        <input type="file" name="foto_player_tiga"
                            class="block border-2 border-purple-500 rounded-full p-2 bg-white text-sm text-gray-500 drop-shadow-lg file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-600 file:text-white hover:file:bg-gray-500 w-full">
                    </div>
                </div>
            </div>

            {{-- STEP 6 --}}
            <div id="step-6" class="step hidden">
                <p
                    class="text-gray-400 text-xs md:text-sm lg:text-base font-poppins text-center pb-2 sm:pb-2 md:pb-3.5 lg:pb-3.5">
                    *Format file jpg, jpeg, png*</p>
                <h2 class="text-xl font-semibold mb-4">Pembayaran</h2>
                <div class="mb-6 border p-4 rounded-xl shadow-sm bg-gray-50">
                    <div class="mb-4">
                        <span class="block w-full border-2 border-purple-500 rounded-full py-3 px-5 bg-white drop-shadow-lg">
                            MANDIRI : 1840005923469 A/N FIRNANDA RAHMAWATI
                        </span>
                        <span class="block w-full border-2 border-purple-500 rounded-full py-3 px-5 bg-white drop-shadow-lg">
                            DANA : 0813 2941 3574 A/N FIRNANDA RAHMAWATI
                        </span>
                    </div>
                    <div class="mb-6 p-4 rounded-xl shadow-sm bg-gray-50">
                        <div class="mb-4">
                            <label class="block font-normal text-lg mb-1 p-2">Foto Bukti Transfer <span class="text-gray-400 font-normal">(jpg, jpeg, png)</span></label>
                            <input type="file" name="bukti_pembayaran"
                                class="block border-2 border-purple-500 rounded-full p-2 bg-white text-sm text-gray-500 drop-shadow-lg file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-600 file:text-white hover:file:bg-gray-500 w-full"
                                required>
                        </div>
                    </div>
                </div>
            </div>

            {{-- STEP 7 --}}
            <div id="step-7" class="step hidden">
                <h2 class="text-xl font-semibold mb-4">Review Pendaftaran</h2>
                <div class="overflow-x-auto my-6 rounded-xl shadow border border-gray-200">
                    <table id="previewData" class="min-w-full divide-y divide-gray-200 text-sm text-left">
                        <!-- Isi tabel diisi dari JavaScript -->
                    </table>
                </div>
            </div>

            {{-- Navigation Buttons --}}
            <div class="flex justify-between mt-6">
                <button type="button" id="prevBtn"
                    class="flex items-center justify-center bg-purple-700 hover:bg-purple-800 text-white px-4 py-2 rounded-full"><img
                        src="play2.svg" alt="kiri" class="mr-2 w-4"> Back</button>
                <button type="button" id="nextBtn"
                    class="flex items-center justify-center bg-purple-700 hover:bg-purple-800 text-white px-4 py-2 rounded-full">Next
                    <img src="play.svg" alt="kanan" class="ml-2 w-4"></button>
                <button type="submit" id="submitBtn"
                    class="bg-green-600 text-white px-4 py-2 rounded hidden">Submit</button>
            </div>
        </form>
    </div>

    <script>
        let currentStep = 1;

        function showStep(step) {
            document.querySelectorAll('.step').forEach(el => el.classList.add('hidden'));
            document.getElementById(`step-${step}`).classList.remove('hidden');

            document.getElementById('prevBtn').classList.toggle('hidden', step === 1);
            document.getElementById('nextBtn').classList.toggle('hidden', step === 7);
            document.getElementById('submitBtn').classList.toggle('hidden', step !== 7);

            [1, 2, 3, 4, 5, 6, 7].forEach(num => {
                const circle = document.getElementById(`circle-${num}`);
                const check = document.getElementById(`check-${num}`);
                const stepNumber = circle.querySelector('.step-number');

                if (num < step) {
                    // Step selesai
                    circle.classList.add('text-white', 'border-green-600');
                    circle.classList.remove('text-blue-500', 'bg-blue-500', 'border-blue-500');

                    if (check) check.classList.remove('hidden');
                    if (stepNumber) stepNumber.classList.add('hidden');
                } else if (num === step) {
                    circle.classList.add('bg-purple-500', 'text-white');
                    circle.classList.remove('bg-white', 'text-purple-500');

                    if (check) check.classList.add('hidden');
                    if (stepNumber) {
                        stepNumber.classList.remove('hidden');
                        stepNumber.textContent = num;
                    }
                } else {
                    circle.classList.add('text-purple-500', 'bg-white');
                    circle.classList.remove('bg-purple-500');

                    if (check) check.classList.add('hidden');
                    if (stepNumber) {
                        stepNumber.classList.remove('hidden');
                        stepNumber.textContent = num;
                    }
                }
            });

            if (step === 7) {
                generatePreview();
            }
        }

        function validateStep(step) {
            const stepEl = document.getElementById(`step-${step}`);
            const inputs = stepEl.querySelectorAll('input[required]');
            let valid = true;

            inputs.forEach(input => {
                if (!input.value) {
                    input.classList.add('border-red-500');
                    valid = false;
                } else {
                    input.classList.remove('border-red-500');
                }
            });

            if (!valid) {
                if (!Swal.isVisible()) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Lengkapi Data',
                        text: 'Mohon lengkapi semua field yang wajib diisi sebelum melanjutkan.',
                    });
                }
            }

            return valid;
        }

        document.querySelectorAll('input[type="file"]').forEach(input => {
            input.addEventListener('change', () => {
                const file = input.files[0];
                if (file && file.size > 2 * 1024 * 1024) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Ukuran File Terlalu Besar',
                        text: 'Ukuran file tidak boleh lebih dari 2MB.',
                    });
                    input.value = '';
                }
            });
        });

        document.getElementById('nextBtn').addEventListener('click', () => {
            if (validateStep(currentStep)) {
                currentStep++;
                showStep(currentStep);
            }
        });

        document.getElementById('prevBtn').addEventListener('click', () => {
            if (currentStep > 1) currentStep--;
            showStep(currentStep);
        });

        function getFileName(input) {
            return input?.files?.[0]?.name || 'Tidak ada file';
        }

        function getValue(input) {
            return input?.value || '-';
        }

        function addRow(label, value) {
            return `
            <tr class="border-b hover:bg-gray-50">
                <td class="px-4 py-2 font-medium text-gray-700">${label}</td>
                <td class="px-4 py-2 text-gray-600">${value}</td>
            </tr>
            `;
        }

        function generatePreview() {
            const preview = document.getElementById('previewData');
            let content = `
            <thead class="bg-gray-100 text-gray-800">
                <tr>
                <th class="px-4 py-2 font-semibold border-r border-gray-200 w-1/3">Label</th>
                <th class="px-4 py-2 font-semibold">Isi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
            `;

            // Step 1: Data Tim
            content += addRow('Nama Tim', getValue(document.querySelector('input[name="nama"]')));
            content += addRow('Logo Tim', getFileName(document.querySelector('input[name="logo"]')));

            // Step 2: CP
            content += addRow('Nama Captain', getValue(document.querySelector('input[name="captain_nama"]')));
            content += addRow('No WA Captain', getValue(document.querySelector('input[name="captain_wa"]')));
            content += addRow('Nama Official', getValue(document.querySelector('input[name="official_nama"]')));
            content += addRow('No WA Official', getValue(document.querySelector('input[name="official_wa"]')));
            content += addRow('Nama Capo', getValue(document.querySelector('input[name="capo_nama"]')));
            content += addRow('No WA Capo', getValue(document.querySelector('input[name="capo_wa"]')));

            // Step 3: Pemain 1–12
            for (let i = 1; i <= 12; i++) {
                const nama = getValue(document.querySelector(`input[name="players[${i}][nama]"]`));
                if (nama !== '-') {
                    content += addRow(`Pemain ${i} - Nama`, nama);
                    content += addRow(`Pemain ${i} - Pas Foto`, getFileName(document.querySelector(
                        `input[name="players[${i}][pas_foto]"]`)));
                    content += addRow(`Pemain ${i} - Kartu Pelajar`, getFileName(document.querySelector(
                        `input[name="players[${i}][foto_kartu]"]`)));
                }
            }

            // Step 4: Official 1–2
            for (let i = 1; i <= 2; i++) {
                const nama = getValue(document.querySelector(`input[name="officials[${i}][nama]"]`));
                if (nama !== '-') {
                    content += addRow(`Official ${i} - Nama`, nama);
                    content += addRow(`Official ${i} - Pas Foto`, getFileName(document.querySelector(
                        `input[name="officials[${i}][pas_foto]"]`)));
                    content += addRow(`Official ${i} - KTP`, getFileName(document.querySelector(
                        `input[name="officials[${i}][foto_ktp]"]`)));
                }
            }

            // Step 5: Dokumen Tambahan
            const dokumen = [
                ['foto_tim_berjersey', 'Foto Tim Berjersey'],
                ['foto_jersey_pemain', 'Foto Jersey Pemain'],
                ['foto_jersey_kiper', 'Foto Jersey Kiper'],
                ['foto_player_satu', 'Foto Player Satu'],
                ['foto_player_dua', 'Foto Player Dua'],
                ['foto_player_tiga', 'Foto Player Tiga'],
                ['surat_rekomendasi', 'Surat Rekomendasi']
            ];
            dokumen.forEach(([name, label]) => {
                content += addRow(label, getFileName(document.querySelector(`input[name="${name}"]`)));
            });

            // Step 6: Bukti Pembayaran
            content += addRow('Bukti Pembayaran', getFileName(document.querySelector('input[name="bukti_pembayaran"]')));

            content += `</tbody>`;
            preview.innerHTML = content;
        }

        showStep(currentStep);
    </script>
@endsection
