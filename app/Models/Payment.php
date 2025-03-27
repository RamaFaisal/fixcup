<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_id',
        'bukti_pembayaran',
    ];

    public function team() {
        return $this->belongsTo(Team::class);
    }
}
