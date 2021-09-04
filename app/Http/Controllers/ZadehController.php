<?php

namespace App\Http\Controllers;


use App\Criteria;
use App\Fuzzification;
use App\Herb;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
class ZadehController extends Controller
{
    public function data()
    {
        $herb = Herb::query();
        $criteria = Criteria::all();
        $dt = DataTables::eloquent($herb);
        $dt->addIndexColumn();
        foreach($criteria as $c){
            $dt->addColumn(strtolower(str_replace(' ','_',$c->criteria)).'.good', function(Herb $herb) use ($c){
                $fuzz = Fuzzification::where('herb_id', $herb->id)->where('criteria_id', $c->id)->first();
                return (number_format($fuzz->good,2,'.',''));
            });
        }
        $dt->addColumn('fire_strength', function(Herb $herb){
            $fuzz = Fuzzification::where('herb_id', $herb->id)->min('good');
            return ($fuzz);
        });
        $dt->addColumn('ket', function(Herb $herb){
            $fuzz = Fuzzification::where('herb_id', $herb->id)->get();
            $arr = [];
            foreach($fuzz as $f){
                $arr[] = $f->good;
            }
            if(in_array(0, $arr)){
                return 'Kurang';
            }else{
                return 'Baik';
            }
        });
        return $dt->toJson();
    }

    public function index()
    {
        return view('zadeh.index');
    }
}
