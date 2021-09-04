<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{
    public function herb()
    {
        return $this->belongsToMany(Herb::class);
    }
}
