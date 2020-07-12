<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JawabanComment extends Model
{
    protected $fillable = [
        "isi", "user_id"
    ];
    
    public function jawaban()
    {
        return $this->belongsTo("App\Jawaban");
    }
}
