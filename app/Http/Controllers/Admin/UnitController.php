<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Unit;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UnitController extends Controller
{
    public function index(){
        $units = Unit::latest()->get();
        return view('admin.unit.unitList',compact('units'));
    }
    public function create(){
        return view('admin.unit.createUnit');
    }

    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required',
        ]);
        $unit = new Unit();
        $unit->name = $request->name;
        $unit->slug = str::slug($request->name);
        $unit->created_by = Auth::id();
        $unit->save();
        Toastr::success('Unit created successfully','Success!!');
        return redirect()->route('admin.unit.index');
    }

    public function edit($id){
        $unit = Unit::findOrFail($id);
        return view('admin.unit.editUnit',compact('unit'));
    }
    public function update(Request $request, $id){

        $this->validate($request,[
            'name'=>'required',
        ]);

        $unit = Unit::findOrFail($id);
        $unit->name = $request->name;
        $unit->slug = str::slug($request->name);
        $unit->updated_by = Auth::id();
        $unit->save();
        Toastr::success('Unit Updated successfully','Success!!');
        return redirect()->route('admin.unit.index');
    }
    public function destroy($id){
        $unit = Unit::findOrFail($id);
        $unit->delete();
        Toastr::success('Unit has been deleted successfully','Success!!');
        return redirect()->route('admin.unit.index');
    }
}
