<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index()
    {
        $admin = Admin::where('id',Auth::id())->first();
        return view('admin.dashboard',compact('admin'));
    }
    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
