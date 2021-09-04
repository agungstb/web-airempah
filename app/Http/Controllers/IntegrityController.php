<?php

namespace App\Http\Controllers;

use App\Integrity;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
class IntegrityController extends Controller
{
    public function data()
    {
        $int = Integrity::query()->select('integrities.*');
        return DataTables::eloquent($int)
            ->addIndexColumn()
            // ->addColumn('action', function(Integrity $item){
            //     return ('<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
            //                 <a href="'. route('admin.integrity.edit', $item->id) .'" title="Edit" class="btn btn-secondary"><i class="material-icons">create</i></a>
            //                 <button type="button" class="btn btn-secondary delete" data-id="'. $item->id .'"><i class="material-icons">close</i></button>
            //             </div>');
            // })
            ->toJson();
    }

    public function index()
    {
        return view('integrity.index');
    }

    public function create()
    {
        return view('integrity.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'alias' => 'required|unique:integrities,alias',
            'value' => 'required',
        ]);
        try{
            $int = new Integrity();
            $int->alias = ucwords($request->alias);
            $int->value = $request->value;
            $int->save();
            return back()->with('success', 'Success to save data');
        }catch(Exception $e){
            return back()->with('failed', 'Failed save data');
        }

    }

    public function edit($id)
    {
        $int = Integrity::findOrFail($id);
        return view('integrity.edit', compact('int'));
    }

    public function update(Request $request, $id)
    {
        $int = Integrity::findOrfail($id);
        $request->validate([
            'alias' => 'required|unique:integrities,alias,'.$int->id,
            'value' => 'required',
        ]);
        try{
            $int->alias = ucwords($request->alias);
            $int->value = $request->value;
            $int->save();
            return back()->with('success', 'Success to save data');
        }catch(Exception $e){
            return back()->with('failed', 'Failed save data');
        }
    }

    public function destroy($id)
    {
        $int = Integrity::findOrfail($id);
        if(count($int->criteria) > 0){
            return response()->json([
                'message' => 'This integrity has connected with criteria, delete criteria first !'
            ], 500);
        }else{
            $int->delete();
            return response()->json([
                'message' => 'Success to delete data'
            ], 200);
        }
    }
}
