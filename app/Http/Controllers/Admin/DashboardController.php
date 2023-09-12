<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdatePasswordRequest;
use App\Http\Requests\Admin\UpdateRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index()
    {
        $admin = Admin::where('id',Auth::id())->first();
        return view('admin.dashboard',compact('admin'));
    }
    public function profile()
    {
        $admin = Admin::find(auth('admin')->user());
        return view('admin.profile',compact('admin'));
    }
    public function update(UpdateRequest $request)
    {
        $admin = Admin::find(auth('admin')->user()->id);
        $admin->update($request->only(['name' , 'email']));
        return redirect()->back()->with(['success' => 'Update Successfully']);
    }
    public function change_password()
    {
        return view('admin.ch_password');
    }
    public function password_store(UpdatePasswordRequest $request)
    {
        $hashPassword = Hash::make($request->password);
        $admin = Admin::find(auth('admin')->user()->id);
        $admin->update(['password' => $hashPassword]);
        if($admin) {
            Session::flush();
            Auth::logout();
            return redirect()->route('admin.login');
        }
        // return redirect()->back()->with(['success' => 'Update Successfully']);
    }
    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
