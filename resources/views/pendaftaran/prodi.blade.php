@extends('layouts.app')

@section('content')
    <div class="max-w-xl mx-auto mt-12">
        <h1 class="text-2xl font-bold mb-6 text-center">Pendaftaran Tim Prodi</h1>

        @if (session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: '{{ session('success') }}',
                        timer: 3000,
                        showConfirmButton: false,
                    });
                });
            </script>
        @endif

        <!-- Stepper Bulat -->
        <div class="flex justify-center items-center gap-6 mb-8">
            @foreach ([1 => 'Tim', 2 => 'Kontak', 3 => 'Pemain', 4 => 'Official', 5 => 'Dokumen', 6 => 'Pembayaran', 7 => 'Review'] as $num => $label)
                <div class="flex items-center gap-2">
                    <div class="flex flex-col items-center">
                        <div id="circle-{{ $num }}"
                            class="w-10 h-10 flex items-center justify-center rounded-full 
                                border-2 border-blue-500 text-blue-500 font-bold
                                bg-white hover:bg-blue-100 transition duration-300 shadow-md">
                            {{ $num }}
                        </div>
                        <span class="text-sm mt-2 text-gray-700 font-medium">{{ $label }}</span>
                    </div>
                    @if ($num < 7)
                        <div
                            class="w-10 h-1 bg-gradient-to-r from-blue-400 to-blue-600 rounded-full transition-all duration-500">
                        </div>
                    @endif
                </div>
            @endforeach
        </div>


        {{-- Formulir --}}
        <form id="pendaftaranForm" action="{{ route('pendaftaranProdi.store') }}" method="POST"
            enctype="multipart/form-data">
            @csrf

            {{-- STEP 1 --}}
            <div id="step-1" class="step">
                <h2 class="text-xl font-semibold mb-4">Data Team</h2>
                <div class="mb-4">
                    <label class="block font-medium mb-1">Nama Tim</label>
                    <input type="text" name="nama" class="w-full border rounded p-2" value="{{ old('nama') }}"
                        required>
                </div>
                <div class="mb-4">
                    <label class="block font-medium mb-1">Logo Tim</label>
                    <input type="file" name="logo" class="w-full border rounded p-2" required>
                </div>
            </div>

            {{-- STEP 2 --}}
            <div id="step-2" class="step hidden">
                <h2 class="text-xl font-semibold mb-4">Contact CP</h2>
                <div class="mb-4">
                    <label class="block font-semibold">Nama Captain</label>
                    <input type="text" name="captain_nama" class="w-full border rounded p-2"
                        value="{{ old('captain_nama') }}" required>
                </div>
                <div class="mb-4">
                    <label class="block font-semibold">No WA Captain</label>
                    <input type="text" name="captain_wa" class="w-full border rounded p-2"
                        value="{{ old('captain_wa') }}" required>
                </div>
                <div class="mb-4">
                    <label class="block font-semibold">Nama Official</label>
                    <input type="text" name="official_nama" class="w-full border rounded p-2"
                        value="{{ old('official_nama') }}" required>
                </div>
                <div class="mb-4">
                    <label class="block font-semibold">No WA Official</label>
                    <input type="text" name="official_wa" class="w-full border rounded p-2"
                        value="{{ old('official_wa') }}" required>
                </div>
            </div>

            {{-- STEP 3 --}}
            <div id="step-3" class="step hidden">
                <h2 class="text-lg font-bold mb-4">Data Pemain</h2>
                @for ($i = 1; $i <= 12; $i++)
                    <div class="mb-6 border p-4 rounded shadow-sm bg-gray-50">
                        <h3 class="font-semibold mb-2">Pemain {{ $i }}</h3>
                        <div class="mb-2">
                            <label class="block font-medium">Nama</label>
                            <input type="text" name="players[{{ $i }}][nama]"
                                class="w-full border rounded p-2" {{ $i <= 7 ? 'required' : '' }}>
                        </div>
                        <div class="mb-2">
                            <label class="block font-medium">Pas Foto</label>
                            <input type="file" name="players[{{ $i }}][pas_foto]" accept="image/*"
                                class="w-full border rounded p-2" {{ $i <= 7 ? 'required' : '' }}>
                        </div>
                        <div>
                            <label class="block font-medium">Foto Kartu Pelajar</label>
                            <input type="file" name="players[{{ $i }}][foto_kartu]" accept="image/*"
                                class="w-full border rounded p-2" {{ $i <= 7 ? 'required' : '' }}>
                        </div>
                    </div>
                @endfor
            </div>

            {{-- STEP 4 --}}
            <div id="step-4" class="step hidden">
                <h2 class="text-xl font-semibold mb-4">Data Official</h2>
                @for ($i = 1; $i < 3; $i++)
                    <div class="mb-6 border p-4 rounded shadow-sm bg-gray-50">
                        <h3 class="font-semibold mb-2">Official {{ $i }}</h3>
                        <div class="mb-2">
                            <label class="block font-medium mb-1">Nama</label>
                            <input type="text" name="officials[{{ $i }}][nama]"
                                class="w-full border rounded p-2" {{ $i <= 1 ? 'required' : '' }}>
                        </div>
                        <div class="mb-2">
                            <label class="block font-medium mb-1">Pas Foto</label>
                            <input type="file" name="officials[{{ $i }}][pas_foto]" accept="image/*"
                                class="w-full border rounded p-2" {{ $i <= 1 ? 'required' : '' }}>
                        </div>
                        <div class="mb-2">
                            <label class="block font-medium mb-1">Foto KTP</label>
                            <input type="file" name="officials[{{ $i }}][foto_ktp]" accept="image/*"
                                class="w-full border rounded p-2" {{ $i <= 1 ? 'required' : '' }}>
                        </div>
                    </div>
                @endfor
            </div>

            {{-- STEP 5 --}}
            <div id="step-5" class="step hidden">
                <h2 class="text-xl font-semibold mb-4">Dokumen Tambahan</h2>
                <div class="mb-4">
                    <label class="block font-medium mb-1">Foto Tim Menggunakan Jersey</label>
                    <input type="file" name="foto_tim_berjersey" class="w-full border rounded p-2" required>
                </div>
                <div class="mb-4">
                    <label class="block font-medium mb-1">Foto Jersey Pemain</label>
                    <input type="file" name="foto_jersey_pemain" class="w-full border rounded p-2" required>
                </div>
                <div class="mb-4">
                    <label class="block font-medium mb-1">Foto Jersey Kiper</label>
                    <input type="file" name="foto_jersey_kiper" class="w-full border rounded p-2" required>
                </div>
                <div class="mb-4">
                    <label class="block font-medium mb-1">Foto Player Satu</label>
                    <input type="file" name="foto_player_satu" class="w-full border rounded p-2">
                </div>
                <div class="mb-4">
                    <label class="block font-medium mb-1">Foto Player Dua</label>
                    <input type="file" name="foto_player_dua" class="w-full border rounded p-2">
                </div>
                <div class="mb-4">
                    <label class="block font-medium mb-1">Foto Player Tiga</label>
                    <input type="file" name="foto_player_tiga" class="w-full border rounded p-2">
                </div>
            </div>

            {{-- STEP 6 --}}
            <div id="step-6" class="step hidden">
                <h2 class="text-xl font-semibold mb-4">Pembayaran</h2>
                <div class="mb-4">
                    <label class="block font-medium mb-1">Foto Bukti Transfer</label>
                    <input type="file" name="bukti_pembayaran" class="w-full border rounded p-2" required>
                </div>
            </div>

            {{-- STEP 7 --}}
            <div id="step-7" class="step hidden">
                <h2 class="text-xl font-semibold mb-4">Review Pendaftaran</h2>
                <div class="overflow-x-auto my-6 rounded-lg shadow border border-gray-200">
                    <table id="previewData" class="min-w-full divide-y divide-gray-200 text-sm text-left">
                        <!-- Isi tabel diisi dari JavaScript -->
                    </table>
                </div>
            </div>

            {{-- Navigation Buttons --}}
            <div class="flex justify-between mt-6">
                <button type="button" id="prevBtn" class="bg-gray-300 px-4 py-2 rounded hidden">Sebelumnya</button>
                <button type="button" id="nextBtn" class="bg-blue-600 text-white px-4 py-2 rounded">Lanjut</button>
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
                if (num === step) {
                    circle.classList.remove('border-gray-300', 'text-gray-500');
                    circle.classList.add('border-blue-600', 'text-blue-600', 'font-bold');
                } else {
                    circle.classList.add('border-gray-300', 'text-gray-500');
                    circle.classList.remove('border-blue-600', 'text-blue-600', 'font-bold');
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
                    input.value = ''; // Kosongkan file input
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
                ['foto_player_tiga', 'Foto Player Tiga']
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
