<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Customer;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function index(){
        $customers = Customer::latest()->get();
        return view('admin.customer.customerList',compact('customers'));
    }
    public function create(){
        return view('admin.customer.createCustomer');
    }

    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'phone'=>'required',
            'address'=>'required',
        ]);
        $customer = new Customer();
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->created_by = Auth::id();
        $customer->save();
        Toastr::success('Customer created successfully','Success!!');
        return redirect()->route('admin.customer.index');
    }

    public function edit($id){
        $customer = Customer::findOrFail($id);
        return view('admin.customer.editCustomer',compact('customer'));
    }
    public function update(Request $request, $id){

        $this->validate($request,[
            'name'=>'required',
            'phone'=>'required',
            'address'=>'required',
        ]);

        $customer = Customer::findOrFail($id);

        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->updated_by = Auth::id();
        $customer->save();
        Toastr::success('Customer Updated successfully','Success!!');
        return redirect()->route('admin.customer.index');
    }
    public function destroy($id){
        $customer = Customer::findOrFail($id);
        $customer->delete();
        Toastr::success('Customer has been deleted successfully','Success!!');
        return redirect()->route('admin.customer.index');
    }
}
