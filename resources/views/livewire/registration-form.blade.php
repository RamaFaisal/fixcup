<div class="max-w-5xl mx-auto py-10 px-6 sm:px-10 bg-white shadow-lg rounded-xl">
    {{-- Progress Bar --}}
    <div class="mb-10">
        <div class="w-full bg-gray-200 rounded-full h-2.5">
            <div class="bg-blue-600 h-2.5 rounded-full transition-all duration-500" style="width: {{ ($step / 6) * 100 }}%"></div>
        </div>
        <p class="text-center mt-3 text-sm text-gray-600 font-medium">Langkah {{ $step }} dari 6</p>
    </div>

    {{-- Step 1: Info Sekolah --}}
    @if($step === 1)
        <div class="space-y-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">1. Informasi Sekolah</h2>

            <div>
                <label class="block font-semibold text-gray-700 mb-1">Nama Sekolah</label>
                <input type="text" wire:model="nama_sekolah"
                       class="w-full rounded-lg border-gray-300 focus:ring-blue-400 focus:outline-none focus:ring px-4 py-2 shadow-sm" />
                @error('nama_sekolah') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block font-semibold text-gray-700 mb-1">Logo Sekolah</label>
                <input type="file" wire:model="logo_sekolah" class="w-full rounded-lg border-gray-300 focus:ring-blue-400 focus:outline-none focus:ring px-4 py-2 shadow-sm">

                @if ($logo_sekolah instanceof \Illuminate\Http\UploadedFile)
                    <img src="{{ $logo_sekolah->temporaryUrl() }}" class="w-32 h-auto mt-2 rounded shadow" alt="Preview Logo">
                @endif

                @error('logo_sekolah') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex justify-end">
                <button wire:click="nextStep"
                        class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition-all shadow">
                    Selanjutnya
                </button>
            </div>
        </div>
    @endif

    {{-- Step 2: Kontak Person --}}
    @if($step === 2)
        <div class="space-y-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">2. Kontak Person</h2>

            @foreach (['captain' => 'Kapten', 'official_cp' => 'Official', 'capo' => 'Capo'] as $key => $label)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-semibold text-gray-700 mb-1">Nama {{ $label }}</label>
                        <input type="text" wire:model="{{ $key }}.nama"
                               class="w-full rounded-lg border-gray-300 focus:ring-blue-400 px-4 py-2 shadow-sm">
                        @error($key.'.nama') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block font-semibold text-gray-700 mb-1">No WA {{ $label }}</label>
                        <input type="number" wire:model="{{ $key }}.no_wa"
                               class="w-full rounded-lg border-gray-300 focus:ring-blue-400 px-4 py-2 shadow-sm">
                        @error($key.'.no_wa') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>
            @endforeach

            <div class="flex justify-between">
                <button wire:click="prevStep"
                        class="bg-gray-500 text-white px-5 py-2 rounded-lg hover:bg-gray-600 transition-all shadow">
                    Kembali
                </button>
                <button wire:click="nextStep"
                        class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition-all shadow">
                    Selanjutnya
                </button>
            </div>
        </div>
    @endif

    {{-- Step 3 Pemain --}}
    @if ($step === 3)
        <div class="space-y-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Langkah 3: Pemain</h2>

            @foreach ($players as $index => $player)
                <div class="p-4 bg-gray-50 border rounded-xl shadow-sm space-y-4">
                    <h3 class="text-lg font-semibold text-gray-700">Pemain {{ $index + 1 }}</h3>
                    <div class="grid md:grid-cols-3 gap-4">
                        <div>
                            <label class="block font-semibold mb-1">Nama</label>
                            <input type="text" wire:model="players.{{ $index }}.nama"
                                class="w-full rounded-lg border-gray-300 focus:ring-blue-400 px-4 py-2 shadow-sm">
                            @error("players.$index.nama")<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                        </div>
                        <div>
                            <label class="block font-semibold mb-1">Pas Foto</label>
                            <input type="file" wire:model="players.{{ $index }}.pas_foto" class="w-full rounded-lg border-gray-300 focus:ring-blue-400 px-4 py-2 shadow-sm">
                            @if (isset($player['pas_foto']) && $player['pas_foto'] instanceof \Illuminate\Http\UploadedFile)
                                <img src="{{ $player['pas_foto']->temporaryUrl() }}" class="w-24 h-auto mt-2 rounded shadow">
                            @endif
                            @error("players.$index.pas_foto")<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                        </div>
                        <div>
                            <label class="block font-semibold mb-1">Foto Kartu Identitas</label>
                            <input type="file" wire:model="players.{{ $index }}.foto_kartu" class="w-full rounded-lg border-gray-300 focus:ring-blue-400 px-4 py-2 shadow-sm">
                            @if (isset($player['foto_kartu']) && $player['foto_kartu'] instanceof \Illuminate\Http\UploadedFile)
                                <img src="{{ $player['foto_kartu']->temporaryUrl() }}" class="w-24 h-auto mt-2 rounded shadow">
                            @endif
                            @error("players.$index.foto_kartu")<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    @error($player) <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            @endforeach

            <div class="flex justify-between">
                <button wire:click="prevStep"
                    class="bg-gray-500 text-white px-5 py-2 rounded-lg hover:bg-gray-600 transition-all shadow">
                    Kembali
                </button>
                <button wire:click="nextStep"
                    class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition-all shadow">
                    Selanjutnya
                </button>
            </div>
        </div>
    @endif

    {{-- Step 4 Official --}}
    @if ($step === 4)
        <div class="space-y-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Langkah 4: Official</h2>

            @foreach ($officials as $index => $official)
                <div class="p-4 bg-gray-50 border rounded-xl shadow-sm space-y-4">
                    <h3 class="text-lg font-semibold text-gray-700">Official {{ $index + 1 }}</h3>
                    <div class="grid md:grid-cols-3 gap-4">
                        <div>
                            <label class="block font-semibold mb-1">Nama</label>
                            <input type="text" wire:model="officials.{{ $index }}.nama"
                                class="w-full rounded-lg border-gray-300 focus:ring-blue-400 px-4 py-2 shadow-sm">
                            @error("officials.$index.nama")<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                        </div>
                        <div>
                            <label class="block font-semibold mb-1">Pas Foto</label>
                            <input type="file" wire:model="officials.{{ $index }}.pas_foto" class="w-full rounded-lg border-gray-300 focus:ring-blue-400 px-4 py-2 shadow-sm">
                            @if (isset($official['pas_foto']) && $official['pas_foto'] instanceof \Illuminate\Http\UploadedFile)
                                <img src="{{ $official['pas_foto']->temporaryUrl() }}" class="w-24 h-auto mt-2 rounded shadow">
                            @endif
                            @error("officials.$index.pas.foto")<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                        </div>
                        <div>
                            <label class="block font-semibold mb-1">Foto KTP</label>
                            <input type="file" wire:model="officials.{{ $index }}.foto_ktp" class="w-full rounded-lg border-gray-300 focus:ring-blue-400 px-4 py-2 shadow-sm">
                            @if (isset($official['foto_ktp']) && $official['foto_ktp'] instanceof \Illuminate\Http\UploadedFile)
                                <img src="{{ $official['foto_ktp']->temporaryUrl() }}" class="w-24 h-auto mt-2 rounded shadow">
                            @endif
                            @error("officials.$index.foto_ktp")<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="flex justify-between">
                <button wire:click="prevStep"
                    class="bg-gray-500 text-white px-5 py-2 rounded-lg hover:bg-gray-600 transition-all shadow">
                    Kembali
                </button>
                <button wire:click="nextStep"
                    class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition-all shadow">
                    Selanjutnya
                </button>
            </div>
        </div>
    @endif

    {{-- Step 5: Dokumen Tim --}}
    @if($step === 5)
        <div class="space-y-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">5. Upload Dokumen Tim</h2>

            <div class="grid md:grid-cols-2 gap-6">
                @foreach([
                    'foto_tim_berjersey' => 'Foto Tim Berjersey',
                    'foto_jersey_pemain' => 'Jersey Pemain',
                    'foto_jersey_kiper' => 'Jersey Kiper',
                    'foto_player_satu' => 'Foto Pemain 1',
                    'foto_player_dua' => 'Foto Pemain 2',
                    'foto_player_tiga' => 'Foto Pemain 3',
                    'surat_rekomendasi' => 'Surat Rekomendasi Sekolah',
                ] as $key => $label)
                    <div>
                        <label class="block font-semibold text-gray-700 mb-1">{{ $label }}</label>
                        <input type="file" wire:model="{{ $key }}" class="w-full rounded-lg border-gray-300 focus:ring-blue-400 px-4 py-2 shadow-sm">
                        @if($$key instanceof \Illuminate\Http\UploadedFile)
                            <img src="{{ $$key->temporaryUrl() }}" class="w-24 h-auto mt-2 rounded shadow">
                        @endif
                        @error($key)
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                @endforeach
            </div>

            <div class="flex justify-between">
                <button wire:click="prevStep"
                        class="bg-gray-500 text-white px-5 py-2 rounded-lg hover:bg-gray-600 transition-all shadow">
                    Kembali
                </button>
                <button wire:click="nextStep"
                        class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition-all shadow">
                    Selanjutnya
                </button>
            </div>
        </div>
    @endif

    {{-- Step 6: Bukti Pembayaran --}}
    @if($step === 6)
        <div class="space-y-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">6. Bukti Pembayaran</h2>

            <div>
                <label class="block font-semibold text-gray-700 mb-1">Upload Bukti Transfer</label>
                <input type="file" wire:model="bukti_pembayaran" class="w-full rounded-lg border-gray-300 focus:ring-blue-400 px-4 py-2 shadow-sm">

                @if($bukti_pembayaran instanceof \Illuminate\Http\UploadedFile)
                    @php
                        $extension = $bukti_pembayaran->getClientOriginalExtension();
                        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'];
                        $docExtensions = ['pdf', 'doc', 'docx'];
                    @endphp

                    <div class="mt-3">
                        @if(in_array($extension, $imageExtensions))
                            <img src="{{ $bukti_pembayaran->temporaryUrl() }}" class="w-48 h-auto rounded shadow">
                        @elseif($extension === 'pdf')
                            <iframe src="{{ $bukti_pembayaran->temporaryUrl() }}" class="w-full h-96 rounded shadow border" frameborder="0"></iframe>
                        @elseif(in_array($extension, $docExtensions))
                            <p class="text-sm text-gray-600">
                                Pratinjau file tidak tersedia untuk <strong>.{{ $extension }}</strong>.
                                <a href="{{ $bukti_pembayaran->temporaryUrl() }}" target="_blank" class="text-blue-600 underline">
                                    Klik di sini untuk membuka file
                                </a>
                            </p>
                        @else
                            <p class="text-sm text-red-500">Jenis file tidak dikenali: .{{ $extension }}</p>
                        @endif
                    </div>
                @endif

                @error('bukti_pembayaran') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex justify-between mt-4">
                <button wire:click="prevStep"
                        class="bg-gray-500 text-white px-5 py-2 rounded-lg hover:bg-gray-600 transition-all shadow">
                    Kembali
                </button>
                <button wire:click="submit"
                        class="bg-green-600 text-white px-5 py-2 rounded-lg hover:bg-green-700 transition-all shadow">
                    Submit Pendaftaran
                </button>
            </div>
        </div>
    @endif
</div>
