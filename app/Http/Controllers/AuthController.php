<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function logout()
    {
        Auth::logout();
        return redirect(route('auth.login'))->with('success', 'Logout!');
    }
    public function index()
    {
        return view('admin.auth.login');
    }
    public function attempt(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required',
                'password' => 'required',
            ]
        );
        if ($validator->fails()) {
            return response()->json(['status' => 403, 'msg' => $validator->errors()]);
        }
        $cred = $request->only(['email', 'password']);
        if (Auth::attempt($cred)) {
            return response()->json(['status' => 200, 'msg' => 'Logged In!', 'location' => url('/')]);
        }
        return response()->json(['status' => 403, 'msg' => ['invalid Credentials!']]);
    }
}
