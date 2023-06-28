<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\Lietotajs;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validate the CSRF token
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            '_token' => 'required',
        ]);

        // Retrieve the username and password from the request
        $username = $request->input('username');
        $password = $request->input('password');

        // Perform your login validation and authentication logic here
        // For example, you can check if the username and password match a user in the database
        $user = Lietotajs::where('lietotajvards', $username)->first();

        if ($user && Hash::check($password, $user->password)) {
            Session::put('lietotajvards', $username);
            return redirect()->route('home');
        } else {
            return redirect()->route('login')->withErrors(['login' => 'Ievadīti nepareizi dati!']);
        }
    }

    public function showLoginForm()
    {
        return view('login');
    }
}
