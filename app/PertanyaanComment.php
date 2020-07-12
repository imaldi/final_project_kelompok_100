<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PertanyaanComment extends Model
{
    protected $fillable = [
        "isi", "user_id"
    ];
    public function pertanyaan()
    {
        return $this->belongsTo("App\Pertanyaan");
    }
}
