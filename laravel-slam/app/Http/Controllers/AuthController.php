<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\Utilisateur;
use Illuminate\Support\Facades\Validator;



class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'pseudo_email' => 'required|string',
            'mdp' => 'required|string',
        ]);

        $pseudo_email = $request->input('pseudo_email');
        $mdp = $request->input('mdp');

        $user = Utilisateur::where('pseudo', $pseudo_email)->orWhere('email', $pseudo_email)->first();
        if ($user && Hash::check($mdp, $user->mdp)) {
            Auth::login($user);
            return redirect()->route('home');
        } else {
            return redirect()->route('login')->with('error_message', 'Identifiants incorrects. Veuillez réessayer.');
        }
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect()->route('home');
    }

    public function profile()
    {
        $user = Auth::user(); // Utilisez la méthode user() pour obtenir l'utilisateur authentifié
        return view('profile', compact('utilisateur'));
    }
   

    public function showRegisterForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:utilisateur,email',
            'mdp' => 'required|string|min:8',
            'pseudo' => 'required|string|unique:utilisateur,pseudo',
            'Nom' => 'required|string',
            'Prenom' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        $email = $request->input('email');
        $mdp = $request->input('mdp');
        $pseudo = $request->input('pseudo');
        $Nom = $request->input('Nom');
        $Prenom = $request->input('Prenom');
        $AdresseIP = $request->ip();

        $hashed_password = Hash::make($mdp);

        $utilisateur = new Utilisateur();
        $utilisateur->pseudo = $pseudo;
        $utilisateur->Nom = $Nom;
        $utilisateur->Prenom = $Prenom;
        $utilisateur->email = $email;
        $utilisateur->mdp = $hashed_password;
        $utilisateur->DateCreationCompte = now();
        $utilisateur->AdresseIP = $AdresseIP;
        $utilisateur->coins = 100;

        if ($utilisateur->save()) {
            Session::flash('success', 'Inscription réussie. Vous pouvez maintenant vous connecter.');
            return redirect()->route('login');
        } else {
            return back()->with('error', 'Erreur lors de l\'inscription. Veuillez réessayer.');
        }
    }
}