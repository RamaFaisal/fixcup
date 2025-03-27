<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_id',
        'nama',
        'pas_foto',
        'foto_kartu',
    ];

    public function team() {
        return $this->belongsTo(Team::class);
    }
}
