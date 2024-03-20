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

  <?php
session_start();
include 'config.php';

// Vérifier si l'ID est déjà défini dans la session
if (!isset($_SESSION['id'])) {
    // Si non, vérifier si un ID est passé dans la requête GET
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $_SESSION['id'] = $_GET['id'];
    } else {
        // Si aucun ID n'est passé dans la requête GET, rediriger vers une page d'erreur ou une autre action appropriée
        // Exemple : header("Location: erreur.php");
        exit("Erreur : Aucun ID n'est défini.");
    }
}

// Vérifiez si le formulaire a été soumis
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

    if (!isset($_SESSION['id'])) {
      // Si non, vérifier si un ID est passé dans la requête GET
      if (isset($_GET['id']) && !empty($_GET['id'])) {
          $_SESSION['id'] = $_GET['id'];
      } else {
          // Si aucun ID n'est passé dans la requête GET, rediriger vers une page d'erreur ou une autre action appropriée
          // Exemple : header("Location: erreur.php");
          exit("Erreur : Aucun ID n'est défini.");
      }
  }

    // Insérer le résultat dans la table games_history
    $id = (int)$_GET["id"];
    $sql = "SELECT NomJeu FROM GameName WHERE Id = 2";
    $NomJeu = $conn->query($sql);
    if ($NomJeu->num_rows > 0) {
      // Parcourir les résultats et extraire le nom du jeu
      while($row = $NomJeu->fetch_assoc()) {
          $gameName = $row['NomJeu'];
      }
  } else {
      // Si aucun résultat n'est trouvé, utiliser un nom par défaut
      $gameName = 'Nom par défaut';
  } 
    $stmt = $pdo->prepare("INSERT INTO games_history (IdJoueur, GameName, Resultat, Points) VALUES (?, ?, ?, ?)");
    $stmt->execute([$id, $gameName, $resultat, $points]);



    // Fermeture de la connexion à la base de données
    $stmt = null;
    $pdo = null;

    // Afficher les boutons pour rejouer ou retourner à la page précédente avec l'id conservé
    echo "<div>
            <a href='jeux.php?id=$id'><button>Retour</button></a>
            <a href='shifumi.php?id=$id'><button>Rejouer</button></a>
          </div>";
    exit;
}
?>


  <form method="post" action="">
    <label for="choix">Choisissez votre coup :</label>
        <button class="btn_choix " type="submit" name="choix" value="pierre"><img src="images/Pierre.png" class="pfc-btn" alt="pierre"></button>
        <button class="btn_choix " type="submit" name="choix" value="feuille"><img src="images/Feuille.png" class="pfc-btn" alt="feuille"></button>
        <button class="btn_choix " type="submit" name="choix" value="ciseaux"><img src="images/Ciseaux.png" class="pfc-btn" style="height: 100%" alt="ciseaux"></button>
  </form>
</body>
</html>