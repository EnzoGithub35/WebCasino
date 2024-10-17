<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;



class Utilisateur extends Authenticatable
{
    use Notifiable;

    protected $table = 'utilisateur';

    // Spécifiez le nom de la clé primaire
    protected $primaryKey = 'IdUtilisateur';

    // Si la clé primaire n'est pas auto-incrémentée, spécifiez-le
    public $incrementing = true;

    // Si la clé primaire n'est pas de type integer, spécifiez son type
    protected $keyType = 'int';

    // Les attributs qui peuvent être assignés en masse
    protected $fillable = [
        'pseudo', 'Nom', 'Prenom', 'email', 'mdp', 'AdresseIP', 'coins'
    ];

    // Les attributs qui doivent être cachés pour les tableaux
    protected $hidden = [
        'mdp', 'remember_token',
    ];

    // Les attributs qui doivent être castés en types natifs
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Si vous utilisez un autre nom de colonne pour le mot de passe
    public function getAuthPassword()
    {
        return $this->mdp;
    }
}