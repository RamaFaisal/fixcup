<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PDFController extends Controller
{
    // Download PDF Data Tim
    public function downloadTeamPDF($id)
    {
        $team = Team::with(['contacts', 'players', 'officials', 'document', 'payment'])->findOrFail($id);

        $pdf = Pdf::loadView('pdf.team', compact('team'));

        // return $pdf->download('Team_' . $team->nama . '.pdf');
        return $pdf->stream('Team_' . $team->nama . '.pdf');
    }

    // Download PDF Surat Rekomendasi
    public function downloadSuratFile($id)
    {
        $team = Team::with('document')->findOrFail($id);

        if (!$team->document || !$team->document->surat_rekomendasi) {
            return back()->with('error', 'Surat rekomendasi tidak ditemukan.');
        }

        $filePath = $team->document->surat_rekomendasi;
        $fileName = 'Surat_Rekomendasi_' . $team->nama . '.pdf';

        $storagePath = "public/{$filePath}";

        if (!Storage::exists($storagePath)) {
            return back()->with('error', 'File surat rekomendasi tidak ditemukan di server.');
        }

        return Storage::download($storagePath);
    }
}
