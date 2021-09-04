<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Herb extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $appends = ['cureable_disease','total_nutrient'];

    public function diseases()
    {
        return $this->belongsToMany(Disease::class);
    }

    public function nutrient()
    {
        return $this->belongsToMany(Nutrient::class);
    }

    public function fuzz()
    {
        return $this->hasMany(Fuzzification::class);
    }

    public function getCureableDiseaseAttribute()
    {
        $disease = count($this->diseases);
        return $disease;
    }

    public function getTotalNutrientAttribute()
    {
        $n = count($this->nutrient);
        return $n;
    }

    public static function fuzzification($request, $herb)
    {
        $criteria = Criteria::all();
        foreach($criteria as $c)
        {
            $crit = strtolower($c->criteria);
            $less = 0;
            $medium = 0;
            $good = 0;
            if($crit == 'penyakit yang dapat disembuhkan'){
                $sum_diseases = count($request->input('diseases'));

                // Less
                if($sum_diseases <= 4){
                    $less = 1;
                }elseif($sum_diseases <= 3 && $sum_diseases <= 4){
                    $less = (4 - $sum_diseases) / (4 - $sum_diseases);
                }elseif($sum_diseases >= 4){
                    $less = 0;
                }

                // Medium
                if($sum_diseases < 3 && $sum_diseases > 4){
                    $medium = 0;
                }elseif($sum_diseases <= 3 && $sum_diseases <= 4){
                    $medium = ($sum_diseases - 3) / 4 - 3;
                }elseif($sum_diseases <= 4 && $sum_diseases <= 5){
                    $medium = (5-$sum_diseases)/(5-4);
                }

                // Good
                if($sum_diseases <= 3){
                    $good = 0;
                }elseif($sum_diseases <= 4 && $sum_diseases <= 5){
                    $good = ($sum_diseases - 4) / 8 - 4;
                }elseif($sum_diseases >= 5){
                    $good = 1;
                }

            }elseif($crit == 'harga rempah'){
                $price = $request->price;

                // Less
                if($price <= 6000){
                    $less = 0;
                }elseif($price <= 6000 && $price <= 15000){
                    $less = ($price - 8000) / (35000 - 8000);
                }elseif($price >= 15000){
                    $less = 1;
                }

                // Medium
                if($price >= 8000 && $price <= 15000){
                    $medium = (15000-$price)/(15000-8000);
                }elseif($price >= 6000 && $price <= 8000){
                    $medium = ($price - 6000) / (8000 - 6000);
                }elseif($price < 6000 || $price > 8000){
                    $medium = 0;
                }

                // Good
                if($price <= 8000){
                    $good = 1;
                }elseif($price <= 6000 || $price <= 8000){
                    $good = (8000 - $price) / (8000 - $price);
                }elseif($price >= 8000){
                    $good = 0;
                }

            }elseif($crit == 'kandungan'){
                $diff = count($request->input('nutrient'));

               // Less
               if($diff <= 4){
                    $less = 1;
                }elseif($diff <= 3 && $diff <= 4){
                    $less = (4 - $diff) / (4 - $diff);
                }elseif($diff >= 4){
                    $less = 0;
                }

                // Medium
                if($diff < 3 && $diff > 4){
                    $medium = 0;
                }elseif($diff <= 3 && $diff <= 4){
                    $medium = ($diff - 3) / 4 - 3;
                }elseif($diff <= 4 || $diff <= 5){
                    $medium = (5-$diff)/(5-4);
                }

                // Good
                if($diff <= 3){
                    $good = 0;
                }elseif($diff <= 4 && $diff <= 5){
                    $good = ($diff - 4) / 8 - 4;
                }elseif($diff >= 5){
                    $good = 1;
                }

            }elseif($crit == 'efek samping'){
                $effect = $request->side_effects;

                // Less
                if($effect <= 0){
                    $less = 0;
                }elseif($effect >= 3 && $effect <= 5){
                    $less = ($effect - 3) / (7 - 3);
                }elseif($effect >= 5){
                    $less = 1;
                }

                // Medium
                if( $effect <= 2 || $effect >= 3 ){
                    $medium = 0;
                }elseif($effect >= 2 && $effect <= 3){
                    $medium = ($effect - 3) / (3 - 2 );
                }elseif(3 >= $effect || $effect <= 5 ){
                    $medium = (5 - $effect)/(5 - 3);
                }

                // Good
                if($effect <= 3){
                    $good = 1;
                }elseif($effect >= 2 && $effect <= 3){
                    $good = (3 - $effect) / (3 - $effect);
                }elseif($effect >= 3){
                    $good = 0;
                }
            }
            $fuzz = Fuzzification::where('herb_id', $herb->id)->where('criteria_id', $c->id)->first();
            if($fuzz){
                $fuzz->herb_id = $herb->id;
                $fuzz->criteria_id = $c->id;
                $fuzz->less = $less < 0 ? $less * -1 : $less;
                $fuzz->medium = $medium < 0 ? $medium * -1 : $medium;
                $fuzz->good = $good < 0 ? $good * -1 : $good;
                $fuzz->save();
            }else{
                $fuzz2 = new Fuzzification();
                $fuzz2->herb_id = $herb->id;
                $fuzz2->criteria_id = $c->id;
                $fuzz2->less = $less < 0 ? $less * -1 : $less;
                $fuzz2->medium = $medium < 0 ? $medium * -1 : $medium;
                $fuzz2->good = $good < 0 ? $good * -1 : $good;
                $fuzz2->save();
            }
        }
    }
}
