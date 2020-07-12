<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pertanyaan extends Model
{

    
    protected $fillable = [
        "judul", "isi", "user_id"
    ];
    
    public function jawabans()
    {
        return $this->hasMany("App\Jawaban");
    }

    public function tags()
    {
        return $this->belongsToMany("App\Tag", "pertanyaan_tag", "pertanyaan_id", "tag_id");
    }

    public function user()
    {
        return $this->belongsTo("App\User");
    }

    public function vote()
    {
        return $this->belongsToMany("App\User", "vote_pertanyaans", "pertanyaan_id", "user_id")
            ->withPivot('vote_value');
    }

    public function comment()
    {
        return  $this->hasMany("App\PertanyaanComment");
    }
}
