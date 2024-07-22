<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Struktur extends Model
{
    use HasFactory;

    protected $table = 'struktur';

    public function atasan()
    {
        return $this->belongsTo(User::class, 'user_id_atasan');
    }

    public function bawahan()
    {
        return $this->belongsTo(User::class, 'user_id_bawahan');
    }
}
