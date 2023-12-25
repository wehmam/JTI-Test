<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Services\Google\AuthController;
Use App\Http\Controllers\InputController;
Use App\Http\Controllers\OutputController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', function () {
        if (!isset($_COOKIE["__apiToken"])) {
            setcookie('__apiToken', Auth::user()->createToken('auth_token')->plainTextToken);
        }
        return view('dashboard');
    })->name('dashboard');
    Route::get('/input', [InputController::class, 'index'])->name('input.index');
    Route::get('/output', [OutputController::class, 'index'])->name('output.index');
});



Route::group(['namespace' => 'GoogleAuth'], function() {
    Route::get('/login/google', [AuthController::class, 'authRedirect']);
    Route::get('/callback/google', [AuthController::class, 'authHandler']);
});

require __DIR__.'/auth.php';
