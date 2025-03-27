<?php

namespace App\Http\Controllers;

use App\Models\{Team, Contact, Player, Official, Document, Payment};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class SmaRegistrationController extends Controller
{
    public function index()
    {
        // Ambil step saat ini
        $step = session('step', 1);
        return view('pendaftaran.pendaftaran-sma', compact('step'));
    }

    public function start()
    {
        session()->put('step', 1);
        session()->forget('pendaftaran');
        return redirect()->route('pendaftaranSMA.index');
    }

    public function handleStep(Request $request, $step)
    {
        $data = $request->except('_token');
        $pendaftaran = session('pendaftaran', []);

        // Hapus data file upload agar tidak error di session
        foreach ($data as $key => $value) {
            if ($value instanceof \Illuminate\Http\UploadedFile) {
                unset($data[$key]);
            }

            // Untuk array file seperti pas_foto[]
            if (is_array($value)) {
                $data[$key] = array_filter($value, function ($item) {
                    return !($item instanceof \Illuminate\Http\UploadedFile);
                });
            }
        }

        $pendaftaran["step_$step"] = $data;
        session()->put('pendaftaran', $pendaftaran);
        session()->put('step', $step + 1);

        return redirect()->route('pendaftaranSMA.index');
    }

    public function submit(Request $request)
    {
        $data = session('pendaftaran');

        // Validasi minimal 7 pemain dan 1 official
        $jumlahPemain = count(array_filter($data['step_3']['nama_pemain'] ?? []));
        $jumlahOfficial = count(array_filter($data['step_4']['nama_official'] ?? []));

        if ($jumlahPemain < 7 || $jumlahOfficial < 1) {
            return redirect()->back()->withErrors([
                'jumlah' => 'Minimal 7 pemain dan 1 official harus diisi.'
            ])->withInput();
        }

        try {
            // Simpan Team
            $team = Team::create([
                'kategori' => 'sma',
                'nama' => $data['step_1']['nama'],
                'logo' => $this->storeFile($request, 'logo', $data['step_1']['nama']),
            ]);

            // Simpan Contacts
            foreach (['captain', 'official', 'capo'] as $role) {
                if (!empty($data['step_2']["nama_$role"])) {
                    Contact::create([
                        'team_id' => $team->id,
                        'role' => $role,
                        'nama' => $data['step_2']["nama_$role"],
                        'no_wa' => $data['step_2']["no_wa_$role"],
                    ]);
                }
            }

            // Simpan Players
            foreach ($data['step_3']['nama_pemain'] as $i => $nama) {
                if ($nama) {
                    Player::create([
                        'team_id' => $team->id,
                        'nama' => $nama,
                        'pas_foto' => $this->storeFile($request, "pas_foto.$i", $team->nama),
                        'foto_kartu' => $this->storeFile($request, "foto_kartu.$i", $team->nama),
                    ]);
                }
            }

            // Simpan Officials
            foreach ($data['step_4']['nama_official'] as $i => $nama) {
                if ($nama) {
                    Official::create([
                        'team_id' => $team->id,
                        'nama' => $nama,
                        'pas_foto' => $this->storeFile($request, "pas_foto_official.$i", $team->nama),
                        'foto_ktp' => $this->storeFile($request, "foto_ktp_official.$i", $team->nama),
                    ]);
                }
            }

            // Simpan Dokumen
            Document::create([
                'team_id' => $team->id,
                'foto_tim_berjersey' => $this->storeFile($request, 'foto_tim_berjersey', $team->nama),
                'foto_jersey_pemain' => $this->storeFile($request, 'foto_jersey_pemain', $team->nama),
                'foto_jersey_kiper' => $this->storeFile($request, 'foto_jersey_kiper', $team->nama),
                'foto_player_satu' => $this->storeFile($request, 'foto_player_satu', $team->nama),
                'foto_player_dua' => $this->storeFile($request, 'foto_player_dua', $team->nama),
                'foto_player_tiga' => $this->storeFile($request, 'foto_player_tiga', $team->nama),
                'surat_rekomendasi' => $this->storeFile($request, 'surat_rekomendasi', $team->nama),
            ]);

            // Simpan Pembayaran
            Payment::create([
                'team_id' => $team->id,
                'bukti_pembayaran' => $this->storeFile($request, 'bukti_pembayaran', $team->nama),
            ]);

            // Clear session
            session()->forget(['pendaftaran', 'step']);

            return redirect()->route('pendaftaranSMA.index')->with('success', 'Pendaftaran berhasil!');
        } catch (\Exception $e) {
            return back()->withErrors([
                'error' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()
            ])->withInput();
        }
    }

    private function storeFile($request, $key, $teamName)
    {
        if ($request->hasFile($key)) {
            return $request->file($key)->store("uploads/teams/$teamName", 'public');
        }

        // Untuk input file dalam bentuk array (contoh pas_foto.0, pas_foto.1)
        $keys = explode('.', $key);
        if (count($keys) === 2) {
            $base = $keys[0];
            $index = $keys[1];
            if ($request->hasFile($base) && is_array($request->file($base))) {
                if (isset($request->file($base)[$index])) {
                    return $request->file($base)[$index]->store("uploads/teams/$teamName", 'public');
                }
            }
        }

        return null;
    }
}