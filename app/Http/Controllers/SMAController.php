<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Document;
use App\Models\Official;
use App\Models\Payment;
use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SMAController extends Controller
{
    public function create()
    {
        return view('pendaftaran.sma');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'logo' => 'required|image|max:2048', // max dalam kilobytes, jadi 2048 = 2MB

            'contacts.*.nama' => 'required|string|max:255',
            'contacts.*.no_wa' => 'required|string|max:20',

            'pemain.*.nama' => 'nullable|string|max:255',
            'pemain.*.pas_foto' => 'nullable|image|max:2048',
            'pemain.*.foto_kartu' => 'nullable|image|max:2048',

            'official.*.nama' => 'nullable|string|max:255',
            'official.*.pas_foto' => 'nullable|image|max:2048',
            'official.*.foto_ktp' => 'nullable|image|max:2048',

            'dokumen.*' => 'nullable|image|max:2048',
            'pembayaran' => 'required|image|max:2048',
        ]);

        DB::beginTransaction();

        try {
            $teamFolder = 'tim/' . str_replace(' ', '_', strtolower($request->nama));

            $logoPath = $request->file('logo')->store("{$teamFolder}/logo", 'public');
            $team = Team::create([
                'kategori' => 'SMA',
                'nama' => $request->nama,
                'logo' => $logoPath,
            ]);

            foreach ($request->contacts as $role => $contact) {
                Contact::create([
                    'team_id' => $team->id,
                    'role' => $role,
                    'nama' => $contact['nama'],
                    'no_wa' => $contact['no_wa'],
                ]);
            }

            foreach ($request->pemain as $index => $pemain) {
                if (!isset($pemain['nama'])) continue;

                $fotoPath = $request->file("pemain.{$index}.pas_foto")?->store("{$teamFolder}/pemain/{$index}/pas_foto", 'public');
                $kartuPath = $request->file("pemain.{$index}.foto_kartu")?->store("{$teamFolder}/pemain/{$index}/foto_kartu", 'public');

                Player::create([
                    'team_id' => $team->id,
                    'nama' => $pemain['nama'],
                    'pas_foto' => $fotoPath,
                    'foto_kartu' => $kartuPath,
                ]);
            }

            foreach ($request->official as $index => $official) {
                if (!isset($official['nama'])) continue;

                $fotoPath = $request->file("official.{$index}.pas_foto")?->store("{$teamFolder}/official/{$index}/pas_foto", 'public');
                $ktpPath = $request->file("official.{$index}.foto_ktp")?->store("{$teamFolder}/official/{$index}/foto_ktp", 'public');

                Official::create([
                    'team_id' => $team->id,
                    'nama' => $official['nama'],
                    'pas_foto' => $fotoPath,
                    'foto_ktp' => $ktpPath,
                ]);
            }

            foreach ($request->dokumen ?? [] as $key => $file) {
                if ($request->hasFile("dokumen.{$key}")) {
                    $path = $request->file("dokumen.{$key}")->store("{$teamFolder}/dokumen", 'public');
                    Document::create([
                        'team_id' => $team->id,
                        'jenis' => $key,
                        'path' => $path,
                    ]);
                }
            }

            $pembayaranPath = $request->file('pembayaran')->store("{$teamFolder}/pembayaran", 'public');
            Payment::create([
                'team_id' => $team->id,
                'bukti_transfer' => $pembayaranPath,
            ]);

            DB::commit();
            return redirect()->route('/')->with('success', 'Pendaftaran berhasil.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}
