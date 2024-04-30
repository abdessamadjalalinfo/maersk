<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
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
use App\Models\User;

use App\Http\Controllers\UserController;

Route::post('/users', [UserController::class, 'store'])->name('store');

Route::get('/', function () {
    return view('welcome');
});



Route::get('/da', function () {
    $files = Storage::files($directory);
    dd($files);
});

Route::get('/data', function () {
    return User::all();
});


