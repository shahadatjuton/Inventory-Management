<?php

namespace App\Http\Controllers;

use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function index(){
        $user_id = Auth::user()->id;
        $user = User::findOrFail($user_id);
        return view('admin.profile.viewProfile',compact('user'));
    }

    public function edit($id){
        $user = User::findOrFail($id);
        return view('admin.profile.editProfile',compact('user'));
    }

    public function update(Request $request,$id){

        $user = User::findOrFail($id);

        $this->validate($request,[
            'name'=>'required',
            'image'=>'image|mimes:jpeg,bmp,png,jpg|max:5140',
            'email'=>'required|email',
            'phone'=>'required',
            'address'=>'required',
        ]);

        $image = $request->file('image');
        $slug = str::slug($request->name);

        if (isset($image)) {

            $currant_date = Carbon::now()->toDateString();
            $image_name = $slug.'-'.$currant_date.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            //==========Check and set Image Directory==================
            if (!Storage::disk('public')->exists('profile')) {

                Storage::disk('public')->makeDirectory('profile');

            }

            if (Storage::disk('public')->exists('profile/'. $user->image )) {

                Storage::disk('public')->delete('profile/'. $user->image );

            }

            $imageSize=Image::make($image)->resize(1600,1066)->save($image->getClientOriginalExtension());


            Storage::disk('public')->put('profile/'.$image_name,$imageSize);

        }else {

            $image_name = $user->image ;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->image = $image_name;
        $user->save();
        Toastr::success('Profile has been updated successfully.','Success!!');
        return redirect()->route('profile.index');
    }

    public function changePassword(){
        $user = User::find(Auth::id());
        return view('admin.profile.editPassword',compact('user'));
    }

    public function updatePassword(Request $request, $id){
        $this->validate( $request,[
            'current_password'=>'required',
            'password'=>'required|confirmed',
        ]);

        $hashedPassword = Auth::user()->password;

        if (Hash::check($request->current_password, $hashedPassword))
        {
            if (!Hash::check($request->password, $hashedPassword))
            {
                $user= User::findOrFail(Auth::id());
                $user->password = Hash::make($request->password);
                $user->save();
                Toastr::warning('Your password has been changed successfully!','warning');
                Auth::logout();
                return redirect()->back();
            } else
            {
                Toastr::warning('New password can not be same as old password','warning');
                return redirect()->back();
            }
        } else
        {
            Toastr::error('Your password does not match', 'error');
            return redirect()->back();
        }
    }

    public function pswupdate(Request $request, $id)
    {
        $this->validate( $request,[
            'old_password'=>'required',
            'password'=>'required|confirmed',
        ]);

        $hashedPassword = Auth::user()->password;

        if (Hash::check($request->old_password, $hashedPassword))
        {
            if (!Hash::check($request->password, $hashedPassword))
            {
                $user= User::findOrFail(Auth::id());
                $user->password = Hash::make($request->password);
                $user->save();
                Toastr::warning('Your password has been changed successfully!','warning');
                Auth::logout();
                return redirect()->back();
            } else
            {
                Toastr::warning('New password can not be same as old password','warning');
                return redirect()->back();
            }
        } else
        {
            Toastr::error('Your password does not match', 'error');
            return redirect()->back();
        }

    }




}
