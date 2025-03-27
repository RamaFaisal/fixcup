<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\{Team, Contact, Player, Official, Document, Payment};

class RegistrationForm extends Component
{
    use WithFileUploads;

    public int $step = 1;

    public $nama_sekolah;
    public $logo_sekolah;

    public $captain = ['nama' => '', 'no_wa' => ''];
    public $official_cp = ['nama' => '', 'no_wa' => ''];
    public $capo = ['nama' => '', 'no_wa' => ''];

    public $players = [];
    public $officials = [];

    public $foto_tim_berjersey, $foto_jersey_pemain, $foto_jersey_kiper;
    public $foto_player_satu, $foto_player_dua, $foto_player_tiga, $surat_rekomendasi;
    public $bukti_pembayaran;

    public $team_id;

    public function mount()
    {
        for ($i = 0; $i < 12; $i++) {
            $this->players[] = ['nama' => '', 'pas_foto' => null, 'foto_kartu' => null];
        }

        for ($i = 0; $i < 2; $i++) {
            $this->officials[] = ['nama' => '', 'pas_foto' => null, 'foto_ktp' => null];
        }

        $this->restoreTempFiles();
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, [
            'logo_sekolah',
            'foto_tim_berjersey', 'foto_jersey_pemain', 'foto_jersey_kiper',
            'foto_player_satu', 'foto_player_dua', 'foto_player_tiga',
            'surat_rekomendasi', 'bukti_pembayaran'
        ])) {
            $this->storeTempFile($propertyName);
        }
    }

    public function storeTempFile($field)
    {
        if ($this->$field) {
            $filename = $this->$field->store('temp');
            session()->put("temp_files.$field", $filename);
        }
    }

    public function restoreTempFiles()
    {
        foreach (session('temp_files', []) as $field => $path) {
            if (Storage::exists($path)) {
                $this->$field = $path;
            }
        }
    }

    public function getTempPath($field)
    {
        $sessionPath = session("temp_files.$field");
        return $sessionPath && Storage::exists($sessionPath) ? $sessionPath : null;
    }

    public function nextStep()
    {
        $this->validateStep();
        $this->step++;
    }

    public function prevStep()
    {
        $this->step--;
    }

    public function validateStep()
    {
        if ($this->step === 1) {
            $this->validate([
                'nama_sekolah' => 'required|string|max:255',
                'logo_sekolah' => 'required',
            ]);
        }

        if ($this->step === 2) {
            $this->validate([
                'captain.nama' => 'required|string|max:255',
                'captain.no_wa' => 'required|string|max:20',
                'official_cp.nama' => 'required|string|max:255',
                'official_cp.no_wa' => 'required|string|max:20',
                'capo.nama' => 'nullable|string|max:255',
                'capo.no_wa' => 'nullable|string|max:20',
            ]);
        }

        if ($this->step === 3) {
            // Validasi minimal 7 pemain yang memiliki nama
            $validPlayers = array_filter($this->players, function ($player) {
                return !empty($player['nama']);
            });

            if (count($validPlayers) < 7) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'players' => 'Minimal 7 pemain harus diisi.',
                ]);
            }
        }

        if ($this->step === 4) {
            // Validasi minimal 1 official yang memiliki nama
            $validOfficials = array_filter($this->officials, function ($official) {
                return !empty($official['nama']);
            });

            if (count($validOfficials) < 1) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'officials' => 'Minimal 1 official harus diisi.',
                ]);
            }
        }

        if ($this->step === 5) {
            $this->validate([
                'foto_tim_berjersey' => 'required',
                'foto_jersey_pemain' => 'required',
                'foto_jersey_kiper' => 'required',
                'foto_player_satu' => 'required',
                'foto_player_dua' => 'required',
                'foto_player_tiga' => 'required',
                'surat_rekomendasi' => 'required',
            ]);
        }

        if ($this->step === 6) {
            $this->validate([
                'bukti_pembayaran' => 'required',
            ]);
        }
    }

    public function moveTempToFinal($tempPath, $folder)
    {
        if (!empty($tempPath) && Storage::exists($tempPath)) {
            $filename = basename($tempPath);
            $newPath = $folder . '/' . $filename;
            Storage::move($tempPath, $newPath);
            return $newPath;
        }
        return null;
    }

    public function submit()
    {
        $this->validateStep();

        $logoPath = $this->moveTempToFinal($this->getTempPath('logo_sekolah'), 'public/logos');

        $team = Team::create([
            'nama_sekolah' => $this->nama_sekolah,
            'logo_sekolah' => $logoPath,
        ]);

        $this->team_id = $team->id;

        Contact::insert([
            [
                'team_id' => $team->id,
                'role' => 'captain',
                'nama' => $this->captain['nama'],
                'no_wa' => $this->captain['no_wa'],
            ],
            [
                'team_id' => $team->id,
                'role' => 'official',
                'nama' => $this->official_cp['nama'],
                'no_wa' => $this->official_cp['no_wa'],
            ],
            [
                'team_id' => $team->id,
                'role' => 'capo',
                'nama' => $this->capo['nama'],
                'no_wa' => $this->capo['no_wa'],
            ],
        ]);

        // Simpan pemain yang valid
        foreach ($this->players as $player) {
            if (!empty($player['nama'])) {
                Player::create([
                    'team_id' => $team->id,
                    'nama' => $player['nama'],
                    'pas_foto' => $player['pas_foto'] ?? null,
                    'foto_kartu' => $player['foto_kartu'] ?? null,
                ]);
            }
        }

        // Simpan official yang valid
        foreach ($this->officials as $official) {
            if (!empty($official['nama'])) {
                Official::create([
                    'team_id' => $team->id,
                    'nama' => $official['nama'],
                    'pas_foto' => $official['pas_foto'] ?? null,
                    'foto_ktp' => $official['foto_ktp'] ?? null,
                ]);
            }
        }

        Document::create([
            'team_id' => $team->id,
            'foto_tim_berjersey' => $this->moveTempToFinal($this->getTempPath('foto_tim_berjersey'), 'public/documents'),
            'foto_jersey_pemain' => $this->moveTempToFinal($this->getTempPath('foto_jersey_pemain'), 'public/documents'),
            'foto_jersey_kiper' => $this->moveTempToFinal($this->getTempPath('foto_jersey_kiper'), 'public/documents'),
            'foto_player_satu' => $this->moveTempToFinal($this->getTempPath('foto_player_satu'), 'public/documents'),
            'foto_player_dua' => $this->moveTempToFinal($this->getTempPath('foto_player_dua'), 'public/documents'),
            'foto_player_tiga' => $this->moveTempToFinal($this->getTempPath('foto_player_tiga'), 'public/documents'),
            'surat_rekomendasi' => $this->moveTempToFinal($this->getTempPath('surat_rekomendasi'), 'public/documents'),
        ]);

        Payment::create([
            'team_id' => $team->id,
            'bukti_pembayaran' => $this->moveTempToFinal($this->getTempPath('bukti_pembayaran'), 'public/payments'),
        ]);

        session()->forget('temp_files');

        return redirect()->route('registration.success');
    }

    public function render()
    {
        return view('livewire.registration-form');
    }
}