<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OverviewController extends Controller
{
    public function index(Request $request)
    {
        $username = $request->session()->get('username');

        if (!$username) {
            return redirect()->route('login')->with(['login' => 1]);
        }

        $data = [
            'username' => $username
        ];

        return view('overview', $data);
    }
}
