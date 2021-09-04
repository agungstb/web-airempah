<?php

namespace App\Http\Controllers;

use App\Criteria;
use App\Fuzzification;
use App\Herb;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class FuzzificationController extends Controller
{
    public function data()
    {
        $herb = Herb::query();
        $criteria = Criteria::all();
        $dt = DataTables::eloquent($herb);
        $dt->addIndexColumn();
        $assessment = ['less','medium','good'];
        foreach($criteria as $c){
            foreach($assessment as $s){
                $dt->addColumn(strtolower(str_replace(' ','_',$c->criteria)).'.'.$s, function(Herb $herb) use ($c, $s){
                    $fuzz = Fuzzification::where('herb_id', $herb->id)->where('criteria_id', $c->id)->first();
                    return (number_format($fuzz[$s],2,'.',''));
                });
            }
        }
        return $dt->toJson();
    }

    public function index()
    {
        return view('fuzzification.index');
    }
}
