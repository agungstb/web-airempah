<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    protected $with = ['integrity'];

    public function integrity(){
        return $this->belongsTo(Integrity::class);
    }
}
