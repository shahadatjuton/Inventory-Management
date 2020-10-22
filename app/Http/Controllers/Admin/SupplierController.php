<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Supplier;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    public function index(){
        $suppliers = Supplier::latest()->get();
        return view('admin.supplier.supplierList',compact('suppliers'));
    }
    public function create(){
        return view('admin.supplier.createSupplier');
    }

    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'phone'=>'required',
            'address'=>'required',
        ]);
        $supplier = new Supplier();
        $supplier->name = $request->name;
        $supplier->email = $request->email;
        $supplier->phone = $request->phone;
        $supplier->address = $request->address;
        $supplier->created_by = Auth::id();
        $supplier->save();
        Toastr::success('Supplier created successfully','Success!!');
        return redirect()->route('admin.supplier.index');
    }

    public function edit($id){
        $supplier = Supplier::findOrFail($id);
        return view('admin.supplier.editSupplier',compact('supplier'));
    }
    public function update(Request $request, $id){

        $this->validate($request,[
            'name'=>'required',
            'phone'=>'required',
            'address'=>'required',
        ]);

        $supplier = Supplier::findOrFail($id);

        $supplier->name = $request->name;
        $supplier->email = $request->email;
        $supplier->phone = $request->phone;
        $supplier->address = $request->address;
        $supplier->updated_by = Auth::id();
        $supplier->save();
        Toastr::success('Supplier Updated successfully','Success!!');
        return redirect()->route('admin.supplier.index');
    }
    public function destroy($id){
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();
        Toastr::success('Supplier has been deleted successfully','Success!!');
        return redirect()->route('admin.supplier.index');
    }
}
