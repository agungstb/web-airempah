<?php

namespace App\Http\Controllers;

use App\Criteria;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CriteriaController extends Controller
{
    public function data()
    {
        $criteria = Criteria::query()->select('criterias.*');
        return DataTables::eloquent($criteria)
            ->addIndexColumn()
            // ->addColumn('action', function(Criteria $item){
            //     return ('<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
            //                 <a href="'. route('admin.criteria.edit', $item->id) .'" title="Edit" class="btn btn-secondary"><i class="material-icons">create</i></a>
            //                 <button type="button" class="btn btn-secondary delete" data-id="'. $item->id .'"><i class="material-icons">close</i></button>
            //             </div>');
            // })
            ->toJson();
    }

    public function index()
    {
        return view('criteria.index');
    }

    public function create()
    {
        return view('criteria.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'criteria' => 'required|unique:criterias,criteria',
            'integrity_id' => 'required',
        ]);
        try{
            $criteria = new Criteria();
            $criteria->criteria = ucfirst($request->criteria);
            $criteria->integrity_id = $request->integrity_id;
            $criteria->save();
            return back()->with('success', 'Success to save data');
        }catch(Exception $e){
            return back()->with('failed', 'Failed save data');
        }
    }

    public function edit($id)
    {
        $criteria  = Criteria::findOrFail($id);
        return view('criteria.edit', compact('criteria'));
    }

    public function update(Request $request, $id)
    {
        $criteria = Criteria::findOrFail($id);
        $request->validate([
            'criteria' => 'required|unique:criterias,criteria,'.$criteria->id,
            'integrity_id' => 'required',
        ]);
        try{
            $criteria->criteria = ucfirst($request->criteria);
            $criteria->integrity_id = $request->integrity_id;
            $criteria->save();
            return back()->with('success', 'Success to save data');
        }catch(Exception $e){
            return back()->with('failed', 'Failed save data');
        }
    }

    public function destroy($id)
    {
        $criteria = Criteria::findOrFail($id);
        $criteria->delete();
        return response()->json([
            'message' => 'Success to delete data'
        ]);
    }
}
