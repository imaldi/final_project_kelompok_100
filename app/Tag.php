<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        "tag_name"
    ];

    public function pertanyaans()
    {
        return $this->belongsToMany("App\Pertanyaan", "pertanyaan_tag", "tag_id", "pertanyaan_id");
    }
}
