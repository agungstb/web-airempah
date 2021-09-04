<?php

namespace App\Http\Controllers;

use App\Criteria;
use App\Disease;
use App\Fuzzification;
use App\Herb;
use App\Nutrient;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class HerbController extends Controller
{
    public function data()
    {
        $herb = Herb::query();
        return DataTables::eloquent($herb)
        ->addIndexColumn()
        ->addColumn('action', function(Herb $item){
            return ('<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                        <a href="'. route('admin.herb.edit', $item->id) .'" title="Edit" class="btn btn-secondary"><i class="material-icons">create</i></a>
                        <button type="button" class="btn btn-secondary delete" data-id="'. $item->id .'"><i class="material-icons">close</i></button>
                    </div>');
        })
        ->toJson();
    }

    public function index()
    {
        return view('herb.index');
    }

    public function create()
    {
        return view('herb.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|unique:herbs,name',
            'diseases' => 'required|array',
            'nutrient' => 'required|array',
            'price' => 'required',
            // 'difficulty' => 'required',
            'side_effects' => 'required',
        ],[
            'side_effects.required' => 'The side effects field is required'
        ]);
        try{
            $herb = new Herb();
            $herb->name = $request->name;
            $herb->price = str_replace(',','', $request->price);
            // $herb->difficulty = $request->difficulty;
            $herb->side_effects = $request->side_effects;
            $herb->save();
            $diseases = [];
            foreach($request->input('diseases') as $d => $disease) {
                $d = trim($disease);
                $ds = Disease::find($d);
                if($ds) {
                    $diseases[]=$d;
                }
                else {
                    $disease_name = Disease::where('name', $d)->first();
                    if($disease_name) {
                        $diseases[]=$disease_name->id;
                    } else {
                        $newDisease = new Disease;
                        $newDisease->name = ucfirst($d);
                        $newDisease->save();
                        $diseases[] = $newDisease->id;
                    }
                }
            }
            $nutrients = [];
            foreach($request->input('nutrient') as $d => $nutrient) {
                $d = trim($nutrient);
                $ds = Nutrient::find($d);
                if($ds) {
                    $nutrients[]=$d;
                }
                else {
                    $nutrient_name = Nutrient::where('name', $d)->first();
                    if($nutrient_name) {
                        $nutrients[]=$nutrient_name->id;
                    } else {
                        $newNutrient = new Nutrient();
                        $newNutrient->name = ucfirst($d);
                        $newNutrient->save();
                        $nutrients[] = $newNutrient->id;
                    }
                }
            }
            $herb->nutrient()->attach($nutrients);

            Herb::fuzzification($request, $herb);

            return back()->with('success', 'Success to save data');
        }catch(Exception $e){
            return back()->with('failed', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $herb = Herb::findOrFail($id);
        return view('herb.edit', compact('herb'));
    }

    public function update(Request $request, $id)
    {
        $herb = Herb::findOrFail($id);
        $request->validate([
            'name' => 'required|unique:herbs,name,'.$herb->id,
            'diseases' => 'required|array',
            'price' => 'required',
            // 'difficulty' => 'required',
            'nutrient' => 'required|array',
            'side_effects' => 'required',
        ],[
            'side_effects.required' => 'The side effects field is required'
        ]);
        try{
            $herb->name = $request->name;
            $herb->price = str_replace(',','', $request->price);
            // $herb->difficulty = $request->difficulty;
            $herb->side_effects = $request->side_effects;
            $herb->save();
            $diseases = [];
            foreach($request->input('diseases') as $d => $disease) {
                $d = trim($disease);
                $ds = Disease::find($d);
                if($ds) {
                    $diseases[]=$d;
                }
                else {
                    $disease_name = Disease::where('name', $d)->first();
                    if($disease_name) {
                        $diseases[]=$disease_name->id;
                    } else {
                        $newDisease = new Disease;
                        $newDisease->name = ucfirst($d);
                        $newDisease->save();
                        $diseases[] = $newDisease->id;
                    }
                }
            }
            $herb->diseases()->detach();
            $herb->diseases()->attach($diseases);

            $nutrients = [];
            foreach($request->input('nutrient') as $d => $nutrient) {
                $d = trim($nutrient);
                $ds = Nutrient::find($d);
                if($ds) {
                    $nutrients[]=$d;
                }
                else {
                    $nutrient_name = Nutrient::where('name', $d)->first();
                    if($nutrient_name) {
                        $nutrients[]=$nutrient_name->id;
                    } else {
                        $newNutrient = new Nutrient();
                        $newNutrient->name = ucfirst($d);
                        $newNutrient->save();
                        $nutrients[] = $newNutrient->id;
                    }
                }
            }
            $herb->nutrient()->detach();
            $herb->nutrient()->attach($nutrients);
            Herb::fuzzification($request, $herb);

            return back()->with('success', 'Success to save data');
        }catch(Exception $e){
            return back()->with('failed', $e->getMessage());
        }
    }

    public function destroy($id)
    {

    }
}
