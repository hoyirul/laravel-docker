<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index(){
        $title = 'Dashboard';
        $user = Admin::with('user')
                    ->where('user_id', Auth::user()->id)
                    ->first();
        return view('admin.home.index', compact([
            'title', 'user'
        ]));
    }

    public function update_profile(Request $request){
        // ddd($request->all());
        $request->validate([
            'name' => 'required|string|max:50',
            'phone_number' => 'required',
            'gender' => 'required',
            'address' => 'required|string',
            'zip_code' => 'required|string|max:10',
            'photo_profile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $image_name = null;
        if(auth()->user()->photo_profile && file_exists(storage_path('app/public/'. auth()->user()->photo_profile))){
            Storage::delete(['public/', auth()->user()->photo_profile]);
        }
        
        if($request->photo_profile != null){
            $image_name = $request->file('photo_profile')->store('admin-profile', 'public');
        }

        User::where('id', auth()->user()->id)
            ->update([
                'photo_profile' => ($image_name == null) ? auth()->user()->photo_profile : $image_name
            ]);
        
        Admin::where('user_id', auth()->user()->id)
            ->update([
                'name' => $request->name,
                'phone_number' => $request->phone_number,
                'gender' => $request->gender,
                'address' => $request->address,
                'zip_code' => $request->zip_code,
            ]);
        
        return redirect()->back()
                         ->with('success', 'Profile successfully changed at '. Carbon::now());
    }

    public function change_password(){
        $title = 'Change Password';
        $user = Admin::with('user')
                        ->where('user_id', auth()->user()->id)
                        ->first();
        return view('admin.home.change_password', compact('user', 'title'));
    }

    public function update_password(Request $request){
        $request->validate([
            'password' => 'required|min:6',
            'password_confirmation' => 'same:password|min:6'
        ]);
        
        User::where('id', auth()->user()->id)->update([
            'password' => Hash::make($request->password)
        ]);
        
        return redirect('/u/change_password')->with('success', 'Password successfully changed at '.Carbon::now());
    }
}
