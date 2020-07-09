<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    protected $fillable = [
        "isi", "user_id", "confirmed"
    ];

    public function pertanyaan()
    {
        return $this->belongsTo("App\Pertanyaan");
    }
}
