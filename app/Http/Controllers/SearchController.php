<?php

namespace App\Http\Controllers;

use App\Criteria;
use App\Disease;
use App\Fuzzification;
use App\Herb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class SearchController extends Controller
{
        public function index(Request $request)
        {
            if(request()->ajax()){
                $search = (!empty($request->get('search')) ? $request->get('search') : '-');
                $herb = Herb::query()
                ->whereHas('diseases', function($q) use ($search){
                    $q->where('name','like','%'.$search.'%');
                })->orderBy('name')->get();
                $dt = datatables()->of($herb);
                $dt->addIndexColumn();
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
                return $dt->make(true);
            }

            return view('search.index');
        }
}
