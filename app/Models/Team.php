<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = ['kategori', 'nama', 'logo'];

    public function contacts() {
        return $this->hasMany(Contact::class);
    }

    public function players() {
        return $this->hasMany(Player::class);
    }

    public function officials() {
        return $this->hasMany(Official::class);
    }

    public function document() {
        return $this->hasOne(Document::class);
    }

    public function payment() {
        return $this->hasOne(Payment::class);
    }
}
