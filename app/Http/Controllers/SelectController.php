<?php

namespace App\Http\Controllers;

use App\Disease;
use App\Integrity;
use App\Nutrient;
use Illuminate\Http\Request;

class SelectController extends Controller
{
    public function integrity(Request $request)
    {
        $search = $request->q;
        $items = Integrity::where('alias', 'LIKE', '%' . $search . '%')->take(10)->get();
        return response()->json($items);
    }

    public function disease(Request $request)
    {
        $search = $request->search;
        $diseases = Disease::where('name', 'like', '%'. $search .'%')->take(20)->get();
        $disease = [];
        foreach($diseases as $d) {
            $disease[] = [
                'id' => $d->id,
                'text' => $d->name
            ];
        }
        return response()->json(['results' => $disease]);
    }
    public function nutrient(Request $request)
    {
        $search = $request->search;
        $nutrients = Nutrient::where('name', 'like', '%'. $search .'%')->take(20)->get();
        $nutrient = [];
        foreach($nutrients as $d) {
            $nutrient[] = [
                'id' => $d->id,
                'text' => $d->name
            ];
        }
        return response()->json(['results' => $nutrient]);
    }
}
