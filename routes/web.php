<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ItemViewController;

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
    return view('dashboard');
    // return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/login', [RegistrationController::class, 'showLoginForm'])->name('login');
Route::post('/login', [RegistrationController::class, 'login']);
Route::post('/logout', [RegistrationController::class, 'logout'])->name('logout');


Route::get('/register', [RegistrationController::class, 'showRegistrationForm'])->name('registerform');
Route::post('/register', [RegistrationController::class, 'register'])->name('register');
Route::middleware('auth:sanctum')->group(function () {

    Route::resource('items', ItemViewController::class);
});
