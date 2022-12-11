<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function add()
    {
        Customer::create([
            'user_id' => auth()->user()->id,
            'name' => auth()->user()->email,
            'phone_number' => NULL,
            'address' => NULL,
            'zip_code' => NULL
        ]);
        
        return redirect()->to('/');
    }

    public function get_admin(){
        $title = 'Admins';
        $users = Admin::with('user')->get();
        return view('admin.users.index', compact('users', 'title'));
    }

    public function get_customer(){
        $title = 'Customers';
        $users = Customer::with('user')->get();
        return view('admin.users.index', compact('users', 'title'));
    }

    public function create(){
        $title = 'Admins';
        return view('admin.users.create', compact('title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6',
            'password_confirmation' => 'required|string|min:6|confirmed',
            'role' => 'required',
            'name' => 'required|string|max:50',
            'phone_number' => 'required|string|min:11',
            'gender' => 'required',
            'address' => 'required',
            'zip_code' => 'required|string',
        ]);

        User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);
        
        $user = User::latest()->first();

        Admin::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'gender' => $request->gender,
            'address' => $request->address,
            'zip_code' => $request->zip_code,
        ]);
        
        return redirect('/u/admins')->with('success', "Data berhasil diubah");
    }

    public function edit_admin($id)
    {
        $title = 'Users';
        $users = Admin::with('user')->where('user_id', $id)->first();
        return view('admin.users.edit', compact('title', 'users'));
    }

    public function update_admin(Request $request, $id)
    {
        $request->validate([
            'role' => 'required',
            'name' => 'required|string|max:50',
            'phone_number' => 'required|string|min:11',
            'gender' => 'required',
            'address' => 'required',
            'zip_code' => 'required|string',
        ]);

        Admin::where('user_id', $id)->update([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'gender' => $request->gender,
            'address' => $request->address,
            'zip_code' => $request->zip_code,
        ]);

        User::where('id', $id)->update([
            'role' => $request->role,
        ]);
        
        return redirect('/u/admins')->with('success', "Data berhasil diubah");
    }

    public function destroy($id)
    {
        $user = User::where('id', $id)->first();
        if(Admin::where('user_id', $id)->first()){
            Admin::where('user_id', $id)->delete();
            // dd('hapus admin');
        }else if(Customer::where('user_id', $id)->first()){
            Customer::where('user_id', $id)->delete();
            // dd('hapus customer');
        }
        User::where('id', $id)->delete();
        return redirect('/u'.'/'.$user->role.'s')->with('success', "Data berhasil dihapus");
    }
}
