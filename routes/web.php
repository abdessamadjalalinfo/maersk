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
use Illuminate\Support\Facades\File;


use App\Http\Controllers\UserController;

Route::post('/users', [UserController::class, 'store'])->name('store');

Route::get('/', function () {
    return view('welcome');
});



Route::get('/da', function () {
    $files = Storage::files('/');
    dd($files);
});

Route::get('/ba', function () {
        $baseDir = $directory ?? base_path();

    // Obtenir tous les fichiers dans le répertoire, y compris les sous-dossiers
    $files = File::allFiles($baseDir);

    // Parcourir chaque fichier pour vérifier le nom
    foreach ($files as $file) {
        if ($file->getFilename() === "front_1714140685.pdf") {
            return $file->getRealPath();
        }
    }

    // Retourner null si aucun fichier correspondant n'est trouvé
    return null;



    
});

Route::get('/ka', function () {
   $directories = Storage::allDirectories('/');
    dd($directories);
});

Route::get('/data', function () {
    return User::all();
});


