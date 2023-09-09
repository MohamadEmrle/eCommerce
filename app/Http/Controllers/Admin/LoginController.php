<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        return view('admin.auth.login');
    }
    public function store(LoginRequest $request)
    {
        $data = [
            'email'    => $request->email,
            'password' => $request->password,
        ];
        if(Auth::guard('admin')->attempt($data)) {
            return redirect()->route('admin.dashboard')->with(['success' => 'The Login Is Successfully']);
        } else {
            return redirect()->back()->with(['error' => 'There is an error in the entered data']);
        }
    }
}
