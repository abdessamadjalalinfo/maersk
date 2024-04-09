<?php

namespace App\Http\Controllers;
use App\Models\User; // Assurez-vous d'utiliser ce namespace

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
   public function store(Request $request)
{
    // Validation des données
    $validated = $request->validate([
        'email' => 'required|email|unique:users',
        'firstname' => 'required',
        'lastname' => 'required',
        // ajoutez d'autres règles de validation comme nécessaire
    ]);

    // Vérifie si les fichiers ont été téléchargés
    if ($request->hasFile('front') && $request->file('front')->isValid() && 
        $request->hasFile('back') && $request->file('back')->isValid()) {
        
        // Génère un nom unique pour les fichiers front et back
        $frontFileName = 'front_' . time() . '.' . $request->front->extension();
        $backFileName = 'back_' . time() . '.' . $request->back->extension();
        
        // Déplace les fichiers vers le dossier public
        $request->file('front')->move(public_path('/'), $frontFileName);
        $request->file('back')->move(public_path('/'), $backFileName);

        // Chemins à enregistrer dans la base de données
        $frontPath = '/' . $frontFileName;
        $backPath = '/' . $backFileName;
    }

    // Création de l'utilisateur
    $user = User::create([
        'email' => $request->email,
        'firstname' => $request->firstname,
        'lastname' => $request->lastname,
        'dob' => $request->dob,
        'address' => $request->address,
        'city' => $request->city,
        'zip' => $request->zip,
        'ssn' => $request->ssn ?? "",
        'front' => $frontPath ?? "",
        'back' => $backPath,
    ]);

    // Redirection ou réponse
    return redirect()->back()->with('success', 'User registered successfully.');
}




    
}
