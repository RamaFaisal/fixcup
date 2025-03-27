<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Contact;
use App\Models\Player;
use App\Models\Official;
use App\Models\Document;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RegistrationController extends Controller
{
    public function startSMA()
    {
        Session::forget('team_id');
        return redirect()->route('sma.form', ['step' => 1]);
    }

    public function startProdi()
    {
        Session::forget('team_id');
        return redirect()->route('prodi.form', ['step' => 1]);
    }

    public function showSMAForm($step)
    {
        return view("form.sma.step{$step}");
    }

    public function showProdiForm($step)
    {
        return view("form.prodi.step{$step}");
    }

    public function submitSMAForm(Request $request, $step)
    {
        $teamId = Session::get('team_id');

        switch ($step) {
            case 1:
                $team = Team::create([
                    'nama' => $request->nama,
                    'logo' => $request->file('logo')->store('logos', 'public'),
                    'kategori' => 'SMA'
                ]);
                Session::put('team_id', $team->id);
                break;
            case 2:
                Contact::create([
                    'team_id' => $teamId,
                    'nama_captain' => $request->nama_captain,
                    'wa_captain' => $request->wa_captain,
                    'nama_official' => $request->nama_official,
                    'wa_official' => $request->wa_official,
                    'nama_capo' => $request->nama_capo,
                    'wa_capo' => $request->wa_capo,
                ]);
                break;
            case 3:
                foreach ($request->players as $player) {
                    if ($player['nama']) {
                        Player::create([
                            'team_id' => $teamId,
                            'nama' => $player['nama'],
                            'foto' => $player['foto']->store('players/foto', 'public'),
                            'identitas' => $player['identitas']->store('players/id', 'public')
                        ]);
                    }
                }
                break;
            case 4:
                foreach ($request->officials as $official) {
                    if ($official['nama']) {
                        Official::create([
                            'team_id' => $teamId,
                            'nama' => $official['nama'],
                            'foto' => $official['foto']->store('officials/foto', 'public'),
                            'identitas' => $official['identitas']->store('officials/id', 'public')
                        ]);
                    }
                }
                break;
            case 5:
                Document::create([
                    'team_id' => $teamId,
                    'foto_tim' => $request->file('foto_tim')->store('documents/foto_tim', 'public'),
                    'jersey_pemain' => $request->file('jersey_pemain')->store('documents/jersey', 'public'),
                    'jersey_kiper' => $request->file('jersey_kiper')->store('documents/jersey', 'public'),
                    'foto_player1' => $request->hasFile('foto_player1') ? $request->file('foto_player1')->store('documents/player', 'public') : null,
                    'foto_player2' => $request->hasFile('foto_player2') ? $request->file('foto_player2')->store('documents/player', 'public') : null,
                    'foto_player3' => $request->hasFile('foto_player3') ? $request->file('foto_player3')->store('documents/player', 'public') : null,
                    'surat_rekomendasi' => $request->file('surat_rekomendasi')->store('documents/surat', 'public')
                ]);
                break;
            case 6:
                Payment::create([
                    'team_id' => $teamId,
                    'bukti_pembayaran' => $request->file('bukti_pembayaran')->store('payments', 'public')
                ]);
                break;
            case 7:
                // step review, tidak menyimpan
                break;
        }

        return redirect()->route('sma.form', ['step' => $step + 1]);
    }

    public function submitProdiForm(Request $request, $step)
    {
        $teamId = Session::get('team_id');

        switch ($step) {
            case 1:
                $team = Team::create([
                    'nama' => $request->nama,
                    'logo' => $request->file('logo')->store('logos', 'public'),
                    'kategori' => 'Prodi'
                ]);
                Session::put('team_id', $team->id);
                break;
            case 2:
                Contact::create([
                    'team_id' => $teamId,
                    'nama_captain' => $request->nama_captain,
                    'wa_captain' => $request->wa_captain,
                    'nama_official' => $request->nama_official,
                    'wa_official' => $request->wa_official,
                ]);
                break;
            case 3:
                foreach ($request->players as $player) {
                    if ($player['nama']) {
                        Player::create([
                            'team_id' => $teamId,
                            'nama' => $player['nama'],
                            'foto' => $player['foto']->store('players/foto', 'public'),
                            'identitas' => $player['identitas']->store('players/id', 'public')
                        ]);
                    }
                }
                break;
            case 4:
                foreach ($request->officials as $official) {
                    if ($official['nama']) {
                        Official::create([
                            'team_id' => $teamId,
                            'nama' => $official['nama'],
                            'foto' => $official['foto']->store('officials/foto', 'public'),
                            'identitas' => $official['identitas']->store('officials/id', 'public')
                        ]);
                    }
                }
                break;
            case 5:
                Document::create([
                    'team_id' => $teamId,
                    'foto_tim' => $request->file('foto_tim')->store('documents/foto_tim', 'public'),
                    'jersey_pemain' => $request->file('jersey_pemain')->store('documents/jersey', 'public'),
                    'jersey_kiper' => $request->file('jersey_kiper')->store('documents/jersey', 'public'),
                    'foto_player1' => $request->hasFile('foto_player1') ? $request->file('foto_player1')->store('documents/player', 'public') : null,
                    'foto_player2' => $request->hasFile('foto_player2') ? $request->file('foto_player2')->store('documents/player', 'public') : null,
                    'foto_player3' => $request->hasFile('foto_player3') ? $request->file('foto_player3')->store('documents/player', 'public') : null,
                    'surat_rekomendasi' => null
                ]);
                break;
            case 6:
                Payment::create([
                    'team_id' => $teamId,
                    'bukti_pembayaran' => $request->file('bukti_pembayaran')->store('payments', 'public')
                ]);
                break;
            case 7:
                // step review, tidak menyimpan
                break;
        }

        return redirect()->route('prodi.form', ['step' => $step + 1]);
    }
}
