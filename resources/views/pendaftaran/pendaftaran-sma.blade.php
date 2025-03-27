@extends('layouts.app')

@section('content')
@php $step = session('step', 1); @endphp

<div class="max-w-3xl mx-auto mt-10 p-6 bg-white shadow rounded space-y-6">
    <div class="text-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Pendaftaran SMA - Step {{ $step }} dari 7</h1>
    </div>

    {{-- Step 1 --}}
    @if($step == 1)
        <form action="{{ route('pendaftaranSMA.step', 1) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <input type="text" name="nama" placeholder="Nama Sekolah" required class="input-field">
            <input type="file" name="logo" class="input-field">
            <button type="submit" class="btn">Lanjut</button>
        </form>

    {{-- Step 2 --}}
    @elseif($step == 2)
        <form action="{{ route('pendaftaranSMA.step', 2) }}" method="POST" class="space-y-4">
            @csrf
            <h3 class="font-bold">Captain</h3>
            <input type="text" name="nama_captain" placeholder="Nama" required class="input-field">
            <input type="text" name="no_wa_captain" placeholder="No WA" required class="input-field">

            <h3 class="font-bold">Official</h3>
            <input type="text" name="nama_official" placeholder="Nama" required class="input-field">
            <input type="text" name="no_wa_official" placeholder="No WA" required class="input-field">

            <h3 class="font-bold">Capo</h3>
            <input type="text" name="nama_capo" placeholder="Nama" class="input-field">
            <input type="text" name="no_wa_capo" placeholder="No WA" class="input-field">

            <button type="submit" class="btn">Lanjut</button>
        </form>

    {{-- Step 3 --}}
    @elseif($step == 3)
        <form action="{{ route('pendaftaranSMA.step', 3) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @for($i = 0; $i < 10; $i++)
                <div class="border p-4 rounded">
                    <h4 class="font-semibold">Pemain {{ $i+1 }}</h4>
                    <input type="text" name="nama_pemain[]" placeholder="Nama Pemain" class="input-field">
                    <input type="file" name="pas_foto[]" class="input-field">
                    <input type="file" name="foto_kartu[]" class="input-field">
                </div>
            @endfor
            <button type="submit" class="btn">Lanjut</button>
        </form>

    {{-- Step 4 --}}
    @elseif($step == 4)
        <form action="{{ route('pendaftaranSMA.step', 4) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @for($i = 0; $i < 3; $i++)
                <div class="border p-4 rounded">
                    <h4 class="font-semibold">Official {{ $i+1 }}</h4>
                    <input type="text" name="nama_official[]" placeholder="Nama" class="input-field">
                    <input type="file" name="pas_foto_official[]" class="input-field">
                    <input type="file" name="foto_ktp_official[]" class="input-field">
                </div>
            @endfor
            <button type="submit" class="btn">Lanjut</button>
        </form>

    {{-- Step 5 --}}
    @elseif($step == 5)
        <form action="{{ route('pendaftaranSMA.step', 5) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <input type="file" name="foto_tim_berjersey" required class="input-field">
            <input type="file" name="foto_jersey_pemain" required class="input-field">
            <input type="file" name="foto_jersey_kiper" required class="input-field">
            <input type="file" name="foto_player_satu" required class="input-field">
            <input type="file" name="foto_player_dua" required class="input-field">
            <input type="file" name="foto_player_tiga" required class="input-field">
            <input type="file" name="surat_rekomendasi" required class="input-field">
            <button type="submit" class="btn">Lanjut</button>
        </form>

    {{-- Step 6 --}}
    @elseif($step == 6)
        <form action="{{ route('pendaftaranSMA.step', 6) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <input type="file" name="bukti_pembayaran" required class="input-field">
            <button type="submit" class="btn">Lanjut</button>
        </form>

    {{-- Step 7 --}}
    @elseif($step == 7)
        <form action="{{ route('pendaftaranSMA.submit') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <p class="text-gray-600">Silakan periksa kembali data yang sudah diisi sebelum mengirimkan.</p>
            <button type="submit" class="btn bg-green-600 hover:bg-green-700">Submit Final</button>
        </form>
    @endif
</div>

{{-- Styling --}}
<style>
    .input-field {
        @apply w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500;
    }
    .btn {
        @apply bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition;
    }
</style>
@endsection
