<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UtilisateurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('utilisateur')->insert([
            ['IdUtilisateur' => 1, 'pseudo' => 'Lyxow', 'Nom' => 'Reinee', 'Prenom' => 'Enzo', 'email' => 'enzo.reine35@gmail.com', 'mdp' => '$2y$10$UNYzak8U5oXK15EzpUVjFuwYTOTA0okwMa2zu5gUrx8wci1P8RC.i', 'DateCreationCompte' => '2024-03-26 15:35:01', 'AdresseIP' => '::1', 'coins' => 100015],
            ['IdUtilisateur' => 2, 'pseudo' => 'Blytepro', 'Nom' => 'Capodano', 'Prenom' => 'Yann', 'email' => 'yznn.capo@ecoles-epsi.net', 'mdp' => 'azerty', 'DateCreationCompte' => '2024-03-26 15:35:01', 'AdresseIP' => '', 'coins' => 115],
            // Ajoutez les autres enregistrements ici...
        ]);
    }
}