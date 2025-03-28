@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-12">
  <h1 class="text-2xl font-bold mb-6 text-center">Pendaftaran Tim Prodi</h1>

  @if(session('success'))
      <script>
        document.addEventListener('DOMContentLoaded', function () {
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
    <div class="flex justify-center items-center gap-8 mb-8">
        @foreach ([1 => 'Data Tim', 2 => 'Kontak', 3 => 'Pemain', 4 => 'Official'] as $num => $label)
            <div class="flex flex-col items-center">
                <div id="circle-{{ $num }}" class="w-10 h-10 flex items-center justify-center rounded-full border-2 border-gray-300 text-gray-500">{{ $num }}</div>
                <span class="text-sm mt-2 text-gray-600">{{ $label }}</span>
            </div>
            @if($num < 4)
                <div class="w-8 h-0.5 bg-gray-300"></div>
            @endif
        @endforeach
    </div>

    {{-- Formulir --}}
    <form id="pendaftaranForm" action="{{ route('pendaftaranProdi.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      {{-- STEP 1 --}}
      <div id="step-1" class="step">
        <h2 class="text-xl font-semibold mb-4">Data Team</h2>
        <div class="mb-4">
          <label class="block font-medium mb-1">Nama Tim</label>
          <input type="text" name="nama" class="w-full border rounded p-2" value="{{ old('nama') }}" required>
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
          <input type="text" name="captain_nama" class="w-full border rounded p-2" value="{{ old('captain_nama') }}" required>
        </div>
        <div class="mb-4">
          <label class="block font-semibold">No WA Captain</label>
          <input type="text" name="captain_wa" class="w-full border rounded p-2" value="{{ old('captain_wa') }}" required>
        </div>
        <div class="mb-4">
          <label class="block font-semibold">Nama Official</label>
          <input type="text" name="official_nama" class="w-full border rounded p-2" value="{{ old('official_nama') }}" required>
        </div>
        <div class="mb-4">
          <label class="block font-semibold">No WA Official</label>
          <input type="text" name="official_wa" class="w-full border rounded p-2" value="{{ old('official_wa') }}" required>
        </div>
        <div class="mb-4">
          <label class="block font-semibold">Nama Capo (opsional)</label>
          <input type="text" name="capo_nama" class="w-full border rounded p-2" value="{{ old('capo_nama') }}">
        </div>
        <div class="mb-4">
          <label class="block font-semibold">No WA Capo</label>
          <input type="text" name="capo_wa" class="w-full border rounded p-2" value="{{ old('capo_wa') }}">
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
            <input type="text" name="players[{{ $i }}][nama]" class="w-full border rounded p-2" {{ $i <= 7 ? 'required' : '' }}>
          </div>
          <div class="mb-2">
            <label class="block font-medium">Pas Foto</label>
            <input type="file" name="players[{{ $i }}][pas_foto]" accept="image/*" class="w-full border rounded p-2" {{ $i <= 7 ? 'required' : '' }}>
          </div>
          <div>
            <label class="block font-medium">Foto Kartu Pelajar</label>
            <input type="file" name="players[{{ $i }}][foto_kartu]" accept="image/*" class="w-full border rounded p-2" {{ $i <= 7 ? 'required' : '' }}>
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
              <input type="text" name="officials[{{ $i }}][nama]" class="w-full border rounded p-2" {{ $i <= 1 ? 'required' : '' }}>
            </div>
            <div class="mb-2">
              <label class="block font-medium mb-1">Pas Foto</label>
              <input type="file" name="officials[{{ $i }}][pas_foto]" accept="image/*" class="w-full border rounded p-2" {{ $i <= 1 ? 'required' : '' }}>
            </div>
            <div class="mb-2">
              <label class="block font-medium mb-1">Foto KTP</label>
              <input type="file" name="officials[{{ $i }}][foto_ktp]" accept="image/*" class="w-full border rounded p-2" {{ $i <= 1 ? 'required' : '' }}>
            </div>
          </div>
        @endfor
      </div>

      {{-- Navigation Buttons --}}
      <div class="flex justify-between mt-6">
        <button type="button" id="prevBtn" class="bg-gray-300 px-4 py-2 rounded hidden">Sebelumnya</button>
        <button type="button" id="nextBtn" class="bg-blue-600 text-white px-4 py-2 rounded">Lanjut</button>
        <button type="submit" id="submitBtn" class="bg-green-600 text-white px-4 py-2 rounded hidden">Submit</button>
      </div>
    </form>
</div>

    <script>
        let currentStep = 1;

        function showStep(step) {
            document.querySelectorAll('.step').forEach(el => el.classList.add('hidden'));
            document.getElementById(`step-${step}`).classList.remove('hidden');

            document.getElementById('prevBtn').classList.toggle('hidden', step === 1);
            document.getElementById('nextBtn').classList.toggle('hidden', step === 4);
            document.getElementById('submitBtn').classList.toggle('hidden', step !== 4);

            [1, 2, 3, 4].forEach(num => {
                const circle = document.getElementById(`circle-${num}`);
                if (num === step) {
                    circle.classList.remove('border-gray-300', 'text-gray-500');
                    circle.classList.add('border-blue-600', 'text-blue-600', 'font-bold');
                } else {
                    circle.classList.add('border-gray-300', 'text-gray-500');
                    circle.classList.remove('border-blue-600', 'text-blue-600', 'font-bold');
                }
            });
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

        showStep(currentStep);
    </script>
@endsection