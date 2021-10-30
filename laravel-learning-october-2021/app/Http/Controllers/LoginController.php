<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    // public function __invoke()
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required'
        ]);

        $user = User::whereEmail($request->email)->first();

        if(! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'password' =>  'Vos informations sont erronnées !'
            ]);
        }
        Auth::login($user);

        return redirect(route('dashboard'));
    }
}
