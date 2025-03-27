<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_id',
        'foto_tim_berjersey',
        'foto_jersey_pemain',
        'foto_jersey_kiper',
        'foto_player_satu',
        'foto_player_dua',
        'foto_player_tiga',
        'surat_rekomendasi',
    ];

    public function team() {
        return $this->belongsTo(Team::class);
    }
}
