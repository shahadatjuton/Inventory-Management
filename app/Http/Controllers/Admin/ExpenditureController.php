<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Expenditure;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Image;

class ExpenditureController extends Controller
{
    public function index(){
        $expenditures = Expenditure::latest()->get();
        return view('admin.expenditure.expenditureList',compact('expenditures'));
    }

    public function create(){
        return view('admin.expenditure.createExpenditure');
    }
    public function store(Request $request){
        $this->validate($request,[
            'purpose' => 'required',
            'amount' => 'required|min:1',
            'voucher' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);
        $image = $request->file('voucher');
        $slug = Str::limit($request->purpose, 30);
      if (isset($image)){
          $currant_date=Carbon::now()->toDateString();
          $voucher = $slug.'-'.$currant_date.'-'.uniqid().'.'.$image->getClientOriginalExtension();
          if (!Storage::disk('public')->exists('voucher')){
              Storage::disk('public')->makeDirectory('voucher');
          }
          $imageSize= \Intervention\Image\Facades\Image::make($image)->resize(1600,1066)->save($image->getClientOriginalExtension());
          Storage::disk('public')->put('voucher/'.$voucher,$imageSize);

      }else{
        $voucher = 0;
      }

        $expenditure = new  Expenditure();
        $expenditure->purpose = $request->purpose;
        $expenditure->amount = $request->amount;
        $expenditure->voucher = $voucher;
        $expenditure->created_by = Auth::id();
        $expenditure->status = 1;
        $expenditure->save();
        Toastr::success('Expenditure added successfully.','Success!!');
        return redirect()->route('admin.expenditure.index');
    }

    public function edit($id){
        $expenditure = Expenditure::findOrFail($id);
        return view('admin.expenditure.editExpenditure',compact('expenditure'));
    }

    public function update(Request $request ,$id){
        $this->validate($request,[
            'purpose' => 'required',
            'amount' => 'required|min:1',
            'voucher' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);
        $expenditure = Expenditure::findOrFail($id);

        $image = $request->file('voucher');
        $slug = Str::limit($request->purpose, 30);
        if (isset($image)){
            $currant_date=Carbon::now()->toDateString();
            $voucher = $slug.'-'.$currant_date.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('voucher')){
                Storage::disk('public')->makeDirectory('voucher');
            }
            if (Storage::disk('public')->exists('voucher/'. $expenditure->voucher )) {

                Storage::disk('public')->delete('voucher/'. $expenditure->voucher );

            }

            $imageSize= \Intervention\Image\Facades\Image::make($image)->resize(1600,1066)->save($image->getClientOriginalExtension());
            Storage::disk('public')->put('voucher/'.$voucher,$imageSize);

        }else{
            $voucher = 0;
        }

        $expenditure->purpose = $request->purpose;
        $expenditure->amount = $request->amount;
        $expenditure->voucher = $voucher;
        $expenditure->created_by = Auth::id();
        $expenditure->status = 1;
        $expenditure->save();
        Toastr::success('Expenditure updated successfully.','Success!!');
        return redirect()->route('admin.expenditure.index');
    }

    public function destroy($id){
        $expenditure = Expenditure::findOrFail($id);
        $expenditure->delete();
        Toastr::success('Expenditure deleted successfully.','Success!!');
        return redirect()->route('admin.expenditure.index');
    }
}
