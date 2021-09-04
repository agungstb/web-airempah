<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fuzzification extends Model
{

    protected $with = ['herb'];

    public function herb()
    {
        return $this->belongsTo(Herb::class);
    }

}
