<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    protected $fillable = [
        "pertanyaan_id", "isi", "user_id", "confirmed"
    ];

    public function pertanyaan()
    {
        return $this->belongsTo("App\Pertanyaan");
    }

    public function user()
    {
        return $this->belongsTo("App\User");
    }
}

