<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use mysqli;

class AuthController extends Controller
{
    public function login(Request $request)
{
    // Retrieve the username and password from the request
    $username = $request->username;
    $password = $request->password;

    // Connection to the database
    $server = "127.0.0.1:3306";
    $database = "uzskaite";
    $user = "root";
    $password = "";
    $mysqli = new mysqli($server, $user, $password, $database);

    // Perform your login validation and authentication logic here
    // For example, you can check if the username and password match a user in the database
    $query = "SELECT * FROM lietotajs WHERE lietotajvards = '{$username}' AND parole = '{$password}'";
    $result = $mysqli->query($query);

    // If the login is successful, redirect the user to the overview page
   if ($result->num_rows > 0) {
        session_start();
        $_SESSION['username'] = $username;
        return redirect()->route('overview');
    } else {
        return redirect()->route('login')->withErrors(['login' => 'Ievadīti nepareizi dati!']);
    }    
    
}
    public function showLoginForm()
        {
            return view('login');
        }

}
