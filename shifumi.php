<?php
// Connexion à la base de données
include_once "config.php";

// Démarrer la session si ce n'est pas déjà fait
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Vérifier si l'ID de session est disponible
if (!isset($_SESSION['id'])) {
    // Si l'ID de session n'est pas défini, redirigez l'utilisateur vers une page appropriée
    header("Location: erreur.php");
    exit;
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Options possibles pour le joueur et l'ordinateur
    $options = ["pierre", "feuille", "ciseaux"];
    
    // Choisir une option aléatoire pour l'ordinateur
    $ordinateur = $options[array_rand($options)];
    
    // Récupérer l'option choisie par le joueur
    $joueur = $_POST["choix"];
    
    // Afficher les choix du joueur et de l'ordinateur
    echo "<p>Vous avez choisi : $joueur</p>";
    echo "<p>L'ordinateur a choisi : $ordinateur</p>";
    
    // Déterminer le résultat du jeu
    if ($joueur == $ordinateur) {
        echo "<p>C'est une égalité !</p>";
        $resultat = "Égalité";
        $points = 0;
    } elseif (($joueur == "pierre" && $ordinateur == "ciseaux") ||
              ($joueur == "feuille" && $ordinateur == "pierre") ||
              ($joueur == "ciseaux" && $ordinateur == "feuille")) {
        echo "<p>Vous avez gagné !</p>";
        $resultat = "Victoire";
        $points = 5;
    } else {
        echo "<p>L'ordinateur a gagné !</p>";
        $resultat = "Défaite";
        $points = -5;
    }

    // Insérer les données dans la table 'games_history'
    $idJoueur = $_SESSION['id']; // Récupérer l'ID de session
    $gameName = 'Shifumi'; // Nom du jeu
    $stmt = $pdo->prepare("INSERT INTO games_history (IdJoueur, GameName, Resultat, Points) VALUES (?, ?, ?, ?)");
    $stmt->execute([$idJoueur, $gameName, $resultat, $points]);

    // Afficher les boutons pour rejouer ou retourner à la page précédente avec l'ID conservé
    echo "<div>
            <a href='jeux.php'><button>Retour</button></a>
            <a href='shifumi.php'><button>Rejouer</button></a>
          </div>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
  <link rel="stylesheet" href="./style.css">
  <title>Shifumi</title>
</head>
<body>
  <h1>Shifumi</h1>

  <form method="post" action="">
    <label for="choix">Choisissez votre coup :</label>
    <button class="btn_choix" type="submit" name="choix" value="pierre"><img src="images/Pierre.png" class="pfc-btn" alt="pierre"></button>
    <button class="btn_choix" type="submit" name="choix" value="feuille"><img src="images/Feuille.png" class="pfc-btn" alt="feuille"></button>
    <button class="btn_choix" type="submit" name="choix" value="ciseaux"><img src="images/Ciseaux.png" class="pfc-btn" style="height: 100%" alt="ciseaux"></button>
  </form>
</body>
</html>