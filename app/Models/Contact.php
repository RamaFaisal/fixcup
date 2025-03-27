<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = ['team_id', 'role', 'nama', 'no_wa'];

    public function team() {
        return $this->belongsTo(Team::class);
    }
}
