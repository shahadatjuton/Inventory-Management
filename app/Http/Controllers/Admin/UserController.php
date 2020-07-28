<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Role;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    //
    public function index(){

        $users = User::latest()->get();
        return view('admin.user.userList',compact('users'));
    }

    public function create(){
        $roles = Role::all();
        return view('admin.user.createUser',compact('roles'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'image'=>'image|mimes:jpeg,bmp,png,jpg|max:5140',
            'email'=>'required|email',
            'phone'=>'required',
            'address'=>'required',
            'role'=>'required',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $image = $request->file('image');
        $slug = str::slug($request->name);

        if (isset($image)) {
            $currant_date=Carbon::now()->toDateString();
            $image_name=$slug.'-'.$currant_date.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            //==========Check and set Image Directory==================
            if (!Storage::disk('public')->exists('profile')) {

                Storage::disk('public')->makeDirectory('profile');
            }

            $imageSize=Image::make($image)->resize(1600,1066)->save($image->getClientOriginalExtension());

            Storage::disk('public')->put('profile/'.$image_name,$imageSize);

        }else {

            $image_name="default.png";
        }

        $user = new User();
        if ($request->role == 'Admin'){
            $user->role_id = 1;
        }elseif ($request->role == 'User'){
            $user->role_id = 2;
        }elseif ($request->role == 'Customer'){
            $user->role_id = 3;
        }else{
            $user->role_id = 4;
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->password = bcrypt($request->password);
        $user->image = $image_name;
        $user->save();
        Toastr::success('The user has been created successfully.','Success!!');
        return redirect()->route('admin.user.index');
    }

    public function test($id){
        dd($id);
    }

    public function edit($id){
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('admin.user.editUser',compact('user','roles'));
    }

    public function update(Request $request, $id){

        $user = User::findOrFail($id);

        $this->validate($request,[
            'name'=>'required',
            'image'=>'image|mimes:jpeg,bmp,png,jpg|max:5140',
            'email'=>'required|email',
            'phone'=>'required',
            'address'=>'required',
            'role'=>'required',
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

        if ($request->role == 'Admin'){
            $user->role_id = 1;
        }elseif ($request->role == 'User'){
            $user->role_id = 2;
        }elseif ($request->role == 'Customer'){
            $user->role_id = 3;
        }else{
            $user->role_id = 4;
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->image = $image_name;
        $user->save();
        Toastr::success('The user has been updated successfully.','Success!!');
        return redirect()->route('admin.user.index');
    }

    public function destroy($id){

        $user = User::findOrFail($id);

        if (Storage::disk('public')->exists('profile/'. $user->image )) {
            Storage::disk('public')->delete('profile/'. $user->image );
        }
        $user->delete();
        Toastr::success('The user has been deleted successfuly','Success!!');
        return redirect()->back();
    }


}
