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
    
        // Stockage des fichiers
        $frontPath = $request->file('front')->store('public/files');
        $backPath = $request->file('back')->store('public/files');
    
        // Création de l'utilisateur
        $user = User::create([
            'email' => $request->email,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'dob' => $request->dob,
            'address' => $request->address,
            'city' => $request->city,
            'zip' => $request->zip,
            'ssn' => $request->ssn,
            'front' => $frontPath,
            'back' => $backPath,
        ]);
    
        // Redirection ou réponse
        return redirect()->back()->with('success', 'User registered successfully.');
    }
}
