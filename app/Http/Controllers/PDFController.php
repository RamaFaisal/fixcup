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
        $extension = pathinfo($filePath, PATHINFO_EXTENSION);
        $fileName = 'Surat_Rekomendasi_' . $team->nama . '.' . $extension;

        $storagePath = storage_path("app/public/" . $filePath);

        if (!file_exists($storagePath)) {
            return back()->with('error', 'File tidak ditemukan di server.');
        }

        return response()->download($storagePath, $fileName);
    }
}
