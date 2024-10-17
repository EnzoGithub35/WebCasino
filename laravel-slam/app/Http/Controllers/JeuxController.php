<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Utilisateur;
use Illuminate\Support\Facades\DB;

class JeuxController extends Controller
{
    public function showShifumiForm()
    {
        return view('jeux.shifumi');
    }

    public function playShifumi(Request $request)
    {
        $resultat = "";
        $points = 0;

        if ($request->isMethod('post')) {
            $options = ["pierre", "feuille", "ciseaux"];
            $ordinateur = $options[array_rand($options)];
            $joueur = $request->input('choix');

            if ($joueur == $ordinateur) {
                $resultat = "Égalité";
            } elseif (($joueur == "pierre" && $ordinateur == "ciseaux") ||
                      ($joueur == "feuille" && $ordinateur == "pierre") ||
                      ($joueur == "ciseaux" && $ordinateur == "feuille")) {
                $resultat = "Victoire";
                $points = 5;
            } else {
                $resultat = "Défaite";
                $points = -5;
            }

            $idJoueur = Auth::id();
            $gameName = 'Shifumi';

            DB::table('games_history')->insert([
                'IdJoueur' => $idJoueur,
                'GameName' => $gameName,
                'Resultat' => $resultat,
                'Points' => $points,
            ]);

            DB::table('utilisateur')
                ->where('IdUtilisateur', $idJoueur)
                ->increment('coins', $points);

            return view('jeux.shifumi', compact('resultat', 'points', 'joueur', 'ordinateur'));
        }

        return view('jeux.shifumi');
    }
    public function showBlackjackForm()
    {
        return view('jeux.blackjack');
    }

    public function playBlackjack(Request $request)
    {
        $data = $request->json()->all();
        $resultat = $data['result'];
        $points = $data['points'];
        $idJoueur = Auth::id();
        $gameName = 'Blackjack';

        DB::table('games_history')->insert([
            'IdJoueur' => $idJoueur,
            'GameName' => $gameName,
            'Resultat' => $resultat,
            'Points' => $points,
        ]);

        DB::table('utilisateur')
            ->where('IdUtilisateur', $idJoueur)
            ->increment('coins', $points);

        return response()->json(['message' => 'Scores envoyés avec succès !']);
    }

    public function showPileOuFaceForm()
    {
        return view('jeux.pile_ou_face');
    }

    public function playPileOuFace(Request $request)
    {
        $resultat = "Choisissez et lancez !";
        $choixUtilisateurTexte = "";
        $choixOrdinateurTexte = "";
        $points = 0;

        if ($request->isMethod('post')) {
            $userId = Auth::id();
            $choixUtilisateur = $request->input('choix');
            $choixOrdinateur = rand(0, 1);
            $options = ["Pile", "Face"];

            $choixOrdinateurTexte = $options[$choixOrdinateur];
            $choixUtilisateurTexte = $options[$choixUtilisateur];

            if ($choixUtilisateur == $choixOrdinateur) {
                $resultat = "Gagné";
                $points = 5;
            } else {
                $resultat = "Perdu";
                $points = -5;
            }

            DB::table('utilisateur')
                ->where('IdUtilisateur', $userId)
                ->increment('coins', $points);

            DB::table('games_history')->insert([
                'IdJoueur' => $userId,
                'GameName' => 'Pile ou Face',
                'Resultat' => $resultat,
                'Points' => $points,
            ]);

            return view('jeux.pile_ou_face', compact('resultat', 'choixUtilisateurTexte', 'choixOrdinateurTexte'));
        }

        return view('jeux.pile_ou_face', compact('resultat', 'choixUtilisateurTexte', 'choixOrdinateurTexte'));
    }
}