<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterStep1Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function registerStep1Form()
    {
        return view('auth.register-step1');
    }

    public function registerStep1Store(RegisterStep1Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect('/register/step2');
    }

    public function logout()
    {
        Auth::logout();
        
        return redirect('/login');
    }
}
