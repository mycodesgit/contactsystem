<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Models\User;

class LoginController extends Controller
{
    public function getLogin()
    {
        return view('login');
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $validatedUser = auth()->guard('web')->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ]);

        if ($validatedUser) {
            return redirect()->route('index.contact')->with('success', 'You have successfully logged in.');
        } else {
            return redirect()->back()->with('error', 'Invalid Credentials');
        }
    }

    public function getRegister()
    {
        return view('register');
    }

    public function postRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|unique:contacts,email',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'company' => $request->company,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => bcrypt($request->password), 
            'remember_token' => Str::random(64),
            'role' => 0, 
        ]);

        auth()->guard('web')->login($user);

        return response()->json([
            'success' => true,
            'message' => 'Thank you for registering!',
            'redirect' => route('index.contact')
        ]);
    }

}
