<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OverviewController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('/login', [AuthController::class, 'showLoginForm'])->name('login');

Route::get('/overview', [OverviewController::class, 'index'])->name('home');

Route::get('/logout', function () {
    $server = "127.0.0.1:3306";
    $database = "uzskaite";
    $user = "root";
    $password = "";
    $mysqli = new mysqli($server, $user, $password, $database);
    $UserIP = strval($_SERVER['REMOTE_ADDR']);
    $DeleteSession = "DELETE FROM sesija WHERE lietotajsIP = '{$UserIP}';";
    mysqli_query($mysqli, $DeleteSession);

    return redirect()->route('login');
});