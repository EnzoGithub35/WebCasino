<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UtilisateurController extends Controller
{
    public function showProfil()
    {
        $userId = Auth::id();

        // Récupérer les informations de l'utilisateur
        $userInfo = DB::table('utilisateur')->where('IdUtilisateur', $userId)->first();

        // Historique des parties de Blackjack
        $blackjackHistory = DB::table('games_history')
            ->where('IdJoueur', $userId)
            ->where('GameName', 'BlackJack')
            ->orderByDesc('Id')
            ->limit(10)
            ->get();

        $victoires_bj = DB::table('games_history')
            ->where('IdJoueur', $userId)
            ->where('GameName', 'BlackJack')
            ->where('Resultat', 'Gagné')
            ->count();

        $nb_parties_BJ = DB::table('games_history')
            ->where('IdJoueur', $userId)
            ->where('GameName', 'BlackJack')
            ->count();

        $ratio_victoires_BJ = ($nb_parties_BJ > 0) ? ($victoires_bj / $nb_parties_BJ) * 100 : 100;

        // Historique des parties de Shifumi
        $shifumiHistory = DB::table('games_history')
            ->where('IdJoueur', $userId)
            ->where('GameName', 'Shifumi')
            ->orderByDesc('Id')
            ->limit(10)
            ->get();

        $victoires_shifumi = DB::table('games_history')
            ->where('IdJoueur', $userId)
            ->where('GameName', 'Shifumi')
            ->where('Resultat', 'Victoire')
            ->count();

        $nb_parties_shifumi = DB::table('games_history')
            ->where('IdJoueur', $userId)
            ->where('GameName', 'Shifumi')
            ->count();

        $ratio_victoires_shifumi = ($nb_parties_shifumi > 0) ? ($victoires_shifumi / $nb_parties_shifumi) * 100 : 100;

        // Historique des parties de Pile ou Face
        $pileOuFaceHistory = DB::table('games_history')
            ->where('IdJoueur', $userId)
            ->where('GameName', 'Pile ou Face')
            ->orderByDesc('Id')
            ->limit(10)
            ->get();

        $victoires_po = DB::table('games_history')
            ->where('IdJoueur', $userId)
            ->where('GameName', 'Pile ou Face')
            ->where('Resultat', 'Gagné')
            ->count();

        $nb_parties_po = DB::table('games_history')
            ->where('IdJoueur', $userId)
            ->where('GameName', 'Pile ou Face')
            ->count();

        $ratio_victoires_po = ($nb_parties_po > 0) ? ($victoires_po / $nb_parties_po) * 100 : 100;

        // Jeu préféré
        $favoriteGameRow = DB::table('games_history')
            ->select('GameName', DB::raw('COUNT(*) AS gameCount'))
            ->where('IdJoueur', $userId)
            ->groupBy('GameName')
            ->orderByDesc('gameCount')
            ->first();

        return view('profile', compact(
            'userInfo', 'blackjackHistory', 'victoires_bj', 'nb_parties_BJ', 'ratio_victoires_BJ',
            'shifumiHistory', 'victoires_shifumi', 'nb_parties_shifumi', 'ratio_victoires_shifumi',
            'pileOuFaceHistory', 'victoires_po', 'nb_parties_po', 'ratio_victoires_po', 'favoriteGameRow'
        ));
    }

    public function showClassement()
    {
        // Top 10 des joueurs avec le plus de coins
        $topCoins = DB::table('utilisateur')
            ->select('pseudo', 'coins')
            ->orderBy('coins', 'desc')
            ->limit(10)
            ->get();

        // Top 10 des joueurs de Blackjack avec le plus de victoires
        $topBlackjack = DB::table('utilisateur as U')
            ->join('games_history as GH', 'U.IdUtilisateur', '=', 'GH.IdJoueur')
            ->select('U.pseudo', DB::raw('COUNT(GH.Resultat) as NbVictoire'))
            ->where('GH.GameName', 'Blackjack')
            ->where('GH.Resultat', 'Gagné')
            ->groupBy('U.IdUtilisateur')
            ->orderBy('NbVictoire', 'desc')
            ->limit(10)
            ->get();

        // Top 10 des joueurs de Shifumi avec le plus de victoires
        $topShifumi = DB::table('utilisateur as U')
            ->join('games_history as GH', 'U.IdUtilisateur', '=', 'GH.IdJoueur')
            ->select('U.pseudo', DB::raw('COUNT(GH.Resultat) as NbVictoire'))
            ->where('GH.GameName', 'Shifumi')
            ->where('GH.Resultat', 'Victoire')
            ->groupBy('U.IdUtilisateur')
            ->orderBy('NbVictoire', 'desc')
            ->limit(10)
            ->get();

        // Top 10 des joueurs de Pile ou Face avec le plus de victoires
        $topPileOuFace = DB::table('utilisateur as U')
            ->join('games_history as GH', 'U.IdUtilisateur', '=', 'GH.IdJoueur')
            ->select('U.pseudo', DB::raw('COUNT(GH.Resultat) as NbVictoire'))
            ->where('GH.GameName', 'Pile ou Face')
            ->where('GH.Resultat', 'Gagné')
            ->groupBy('U.IdUtilisateur')
            ->orderBy('NbVictoire', 'desc')
            ->limit(10)
            ->get();

        return view('classement', compact('topCoins', 'topBlackjack', 'topShifumi', 'topPileOuFace'));
    }

    public function showEdit()
    {
        return view('edit', ['edit' => Auth::user()]);
    }

    /**
     * @param Request $request
     * @return
     */
    public function update(Request $request)
    {
        // Get current user
        $userId = Auth::id();
        $user = Utilisateur::findOrFail($userId);

        // Validate the data submitted by user
        $validator = Validator::make($request->all(), [
            'pseudo' => 'required|string|max:255',
            'Nom' => 'required|string|max:255',
            'Prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|'. Rule::unique('utilisateur')->ignore($user->IdUtilisateur, 'IdUtilisateur'),
            'mdp' => 'required|string|min:8|confirmed',
        ]);

        // if fails redirects back with errors
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Fill user model
        $user->fill([
            'pseudo' => $request->input('pseudo'),
            'Nom' => $request->input('Nom'),
            'Prenom' => $request->input('Prenom'),
            'email' => $request->input('email'),
            'mdp' => Hash::make($request->input('mdp')),
            'AdresseIP' => $request->ip(),
        ]);
        // Save user to database
        $user->save();

        if ($user->save()) {
            return redirect()->route('jeux')->with('EditSuccesfull', 'Profil mis à jour avec succès.');
        } else {
            return redirect()->route('edit')->with('EditError', 'Erreur lors de la mise à jour du profil.');
        }
    }
}

