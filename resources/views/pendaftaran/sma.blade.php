<!-- resources/views/pendaftaran/sma.blade.php -->

@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-12">
    <form action="{{ route('pendaftaranSMA.store') }}" method="POST" enctype="multipart/form-data" id="multiStepForm">
        @csrf

        <!-- STEP 1: Nama Sekolah & Logo -->
        <div class="form-step">
            <h2 class="text-2xl font-bold mb-4">Step 1: Identitas Sekolah</h2>
            <input type="hidden" name="kategori" value="SMA">
            
            <label class="block mb-2">Nama Sekolah</label>
            <input type="text" name="nama" class="w-full border rounded px-3 py-2 mb-4" required>

            <label class="block mb-2">Logo Sekolah</label>
            <input type="file" name="logo" class="w-full mb-4" required>
        </div>

        <!-- STEP 2: Kontak -->
        <div class="form-step hidden">
            <h2 class="text-2xl font-bold mb-4">Step 2: Kontak</h2>
            @foreach(['captain', 'official', 'capo'] as $role)
                <div class="mb-4">
                    <h3 class="font-semibold capitalize">Contact {{ $role }}</h3>
                    <input type="hidden" name="contacts[{{ $role }}][role]" value="{{ $role }}">
                    <label>Nama</label>
                    <input type="text" name="contacts[{{ $role }}][nama]" class="w-full border px-3 py-2 mb-2" {{ $role !== 'capo' ? 'required' : '' }}>

                    <label>No WhatsApp</label>
                    <input type="number" name="contacts[{{ $role }}][no_wa]" class="w-full border px-3 py-2" {{ $role !== 'capo' ? 'required' : '' }}>
                </div>
            @endforeach
        </div>

        <!-- STEP 3: Pemain -->
        <div class="form-step hidden">
            <h2 class="text-2xl font-bold mb-4">Step 3: Data Pemain</h2>
            <p class="text-sm text-gray-600 mb-4">* 7 pemain pertama wajib diisi dari total 12</p>
            @for ($i = 1; $i <= 12; $i++)
                <div class="mb-4 border p-4 rounded-lg bg-gray-50">
                    <h3 class="font-semibold mb-2">Pemain {{ $i }} @if($i <= 7)<span class="text-red-500">*</span>@endif</h3>

                    <label>Nama</label>
                    <input type="text" name="pemain[{{ $i }}][nama]" class="w-full border px-3 py-2 mb-2" @if($i <= 7) required @endif>

                    <label>Pas Foto</label>
                    <input type="file" name="pemain[{{ $i }}][pas_foto]" class="w-full mb-2" accept="image/*" @if($i <= 7) required @endif>

                    <label>Foto Kartu Pelajar</label>
                    <input type="file" name="pemain[{{ $i }}][foto_kartu]" class="w-full" accept="image/*" @if($i <= 7) required @endif>
                </div>
            @endfor
        </div>

        <!-- STEP 4: Official -->
        <div class="form-step hidden">
            <h2 class="text-2xl font-bold mb-4">Step 4: Data Official</h2>
            @for ($i = 1; $i <= 2; $i++)
                <div class="mb-4 border p-4 rounded-lg bg-gray-50">
                    <h3 class="font-semibold mb-2">Official {{ $i }} @if($i <= 1)<span class="text-red-500">*</span>@endif</h3>

                    <label>Nama</label>
                    <input type="text" name="official[{{ $i }}][nama]" class="w-full border px-3 py-2 mb-2" @if($i <= 1) required @endif>

                    <label>Pas Foto</label>
                    <input type="file" name="official[{{ $i }}][pas_foto]" class="w-full mb-2" accept="image/*" @if($i <= 1) required @endif>

                    <label>Foto KTP</label>
                    <input type="file" name="official[{{ $i }}][foto_ktp]" class="w-full" accept="image/*" @if($i <= 1) required @endif>
                </div>
            @endfor
        </div>

        <!-- STEP 5: Dokumen -->
        <div class="form-step hidden">
            <h2 class="text-2xl font-bold mb-4">Step 5: Dokumen</h2>
            <label>Foto Tim Berjersey</label>
            <input type="file" name="dokumen[foto_tim_berjersey]" class="w-full mb-2" required>

            <label>Foto Jersey Pemain</label>
            <input type="file" name="dokumen[foto_jersey_pemain]" class="w-full mb-2" required>

            <label>Foto Jersey Kiper</label>
            <input type="file" name="dokumen[foto_jersey_kiper]" class="w-full mb-2" required>

            <label>Foto Player Satu</label>
            <input type="file" name="dokumen[foto_player_satu]" class="w-full mb-2">

            <label>Foto Player Dua</label>
            <input type="file" name="dokumen[foto_player_dua]" class="w-full mb-2">

            <label>Foto Player Tiga</label>
            <input type="file" name="dokumen[foto_player_tiga]" class="w-full mb-2">

            <label>Surat Rekomendasi</label>
            <input type="file" name="dokumen[surat_rekomendasi]" class="w-full mb-2">
        </div>

        <!-- STEP 6: Bukti Pembayaran -->
        <div class="form-step hidden">
            <h2 class="text-2xl font-bold mb-4">Step 6: Bukti Pembayaran</h2>
            <label>Bukti Transfer</label>
            <input type="file" name="pembayaran" class="w-full" required>
        </div>

        <!-- STEP 7: Review -->
        <div class="form-step hidden">
            <h2 class="text-2xl font-bold mb-4">Step 7: Review</h2>
            <p class="text-sm text-gray-500">Silakan periksa kembali data Anda sebelum menekan tombol kirim.</p>
            <button type="submit" class="mt-4 bg-purple-600 hover:bg-purple-700 text-white px-6 py-2 rounded">Kirim</button>
        </div>

        <!-- Buttons -->
        <div class="flex justify-between mt-8">
            <button type="button" onclick="prevStep()" class="bg-gray-300 hover:bg-gray-400 text-black px-6 py-2 rounded">Sebelumnya</button>
            <button type="button" onclick="nextStep()" class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-2 rounded">Selanjutnya</button>
        </div>
    </form>
</div>

<script>
    let currentStep = 0;
    const steps = document.querySelectorAll('.form-step');

    function showStep(step) {
        steps.forEach((s, index) => {
            s.classList.toggle('hidden', index !== step);
        });
    }

    function nextStep() {
        const currentForm = steps[currentStep];
        const inputs = currentForm.querySelectorAll('input, select, textarea');
        let valid = true;

        inputs.forEach(input => {
            if (input.hasAttribute('required') && !input.value) {
                input.classList.add('border-red-500');
                valid = false;
            } else {
                input.classList.remove('border-red-500');
            }
        });

        if (!valid) {
            alert('Harap isi semua kolom yang wajib diisi sebelum melanjutkan.');
            return;
        }

        if (currentStep < steps.length - 1) {
            currentStep++;
            showStep(currentStep);
        }
    }

    function prevStep() {
        if (currentStep > 0) {
            currentStep--;
            showStep(currentStep);
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        showStep(currentStep);
    });
</script>
@endsection