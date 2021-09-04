<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Integrity extends Model
{
    public function criteria(){
        return $this->hasMany(Criteria::class);
    }
}
