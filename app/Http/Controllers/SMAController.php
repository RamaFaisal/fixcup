<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class SMAController extends Controller
{
    public function create(Request $request)
    {
        $step = $request->get('step', 1); // default ke step 1
        return view('pendaftaran.sma', compact('step'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',

            'captain_nama' => 'required|string|max:255',
            'captain_wa' => 'required|string|max:255',
            'official_nama' => 'required|string|max:255',
            'official_wa' => 'required|string|max:255',
            'capo_nama' => 'nullable|string|max:255',
            'capo_wa' => 'nullable|string|max:255',

            'players' => 'required|array|min:7|max:12',
            'players.*.nama' => 'nullable|string|max:255',
            'players.*.pas_foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'players.*.foto_kartu' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',

            'officials' => 'required|array|min:1|max:2',
            'officials.*.nama' => 'nullable|string|max:255',
            'officials.*.pas_foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'officials.*.foto_ktp' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Upload logo
        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
        }

        // Buat Tim
        $team = Team::create([
            'kategori' => 'SMA',
            'nama' => $request->nama,
            'logo' => $logoPath,
        ]);

        // Simpan Kontak
        $contacts = [
            ['role' => 'captain', 'nama' => $request->captain_nama, 'no_wa' => $request->captain_wa],
            ['role' => 'official', 'nama' => $request->official_nama, 'no_wa' => $request->official_wa],
        ];

        if ($request->filled('capo_nama') && $request->filled('capo_wa')) {
            $contacts[] = ['role' => 'capo', 'nama' => $request->capo_nama, 'no_wa' => $request->capo_wa];
        }

        foreach ($contacts as $contact) {
            $team->contacts()->create($contact);
        }

        // Validasi minimal 7 pemain lengkap
        $validPlayers = collect($request->players)->filter(function ($p) {
            return isset($p['nama']) && isset($p['pas_foto']) && isset($p['foto_kartu']);
        });

        if ($validPlayers->count() < 7) {
            return back()->withInput()->withErrors(['players' => 'Minimal 7 pemain harus diisi lengkap.']);
        }

        // Simpan pemain
        foreach ($request->players as $playerData) {
            // Cek kalau nama ada (agar tidak simpan data kosong di pemain ke-8 - 12)
            if (!empty($playerData['nama'])) {
                $pasFotoPath = $playerData['pas_foto']->store('pas_foto', 'public');
                $fotoKartuPath = $playerData['foto_kartu']->store('foto_kartu', 'public');

                $team->players()->create([
                    'nama' => $playerData['nama'],
                    'pas_foto' => $pasFotoPath,
                    'foto_kartu' => $fotoKartuPath,
                ]);
            }
        }

        $validOfficials = collect($request->officials)->filter(function ($official) {
            return isset($official['nama']) && isset($official['pas_foto']) && isset($official['foto_ktp']);
        });

        if ($validOfficials->count() < 1) {
            return back()->withInput()->withErrors(['officials' => 'Minimal 1 official harus diisi lengkap.']);
        }

        foreach ($request->officials as $officialData) {
            if (!empty($officialData['nama']) && isset($officialData['pas_foto']) && isset($officialData['foto_ktp'])) {
                $pasFotoPath = $officialData['pas_foto']->store('official_pas_foto', 'public');
                $fotoKTPPath = $officialData['foto_ktp']->store('official_ktp', 'public');

                $team->officials()->create([
                    'nama' => $officialData['nama'],
                    'pas_foto' => $pasFotoPath,
                    'foto_ktp' => $fotoKTPPath,
                ]);
            }
        }

        return redirect()->route('home')->with('success', 'Tim berhasil didaftarkan!');
    }
}
