<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Document</title>
</head>
<body>
<header style="width: 100%;">
        <div class="topnav" id="myTopnav">
            <a href="index.php" >Accueil</a>
            <a href="connexion.php" class="current-page">Connexion</a>
            <a href="inscription.php" >Inscription</a>
                <a onclick="myFunction2()" class="dropbtn">Jeux</a>
                <div id="myDropdown" class="dropdown-content">
                  <a href="blackjack_test.php">Blackjack</a>
                  <a href="shifumi.php">Shifumi</a>
                  <a href="Pile_ou_face.php">Pile ou Face</a>
                </div>
              </a>
            <a href="javascript:void(0);" class="icon" onclick="myFunction()">
              <i class="fa fa-bars"></i>
            </a>
          </div>
    
</header> 
<main>
  


  <div class="container">  
    <h1 style="color: #F4bc5b">Connexion</h1>  
    <form method="post">  
     <div class="form-control">  
      <input type="text" name="pseudo" required>  
      <label for="pseudo">pseudo</label>  
         </div>  
     <div class="form-control">  
      <input type="password" name="mdp" required>  
      <label for="mdp">Password</label>  
     </div>  
     <button class="btn">Connexion</button>  
     <p class="text">Pas de compte ? <a href="inscription.php">Inscrivez vous</a> </p> 

  <script src="script.js"></script>
</main>


</body>

<?php
session_start();
include 'config.php';

// Vérification des données postées
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pseudo = $_POST["pseudo"];
    $mdp = $_POST["mdp"];

    // Requête pour vérifier les informations d'identification de l'utilisateur
    $requete = "SELECT IdUtilisateur FROM utilisateur WHERE pseudo = ? AND mdp = ?";
    if($stmt = $pdo->prepare($requete)) {
        // Liaison des paramètres
        $stmt->bindParam(1, $pseudo, PDO::PARAM_STR);
        $stmt->bindParam(2, $mdp, PDO::PARAM_STR);

        // Exécution de la requête
        if($stmt->execute()) {
            // Vérification du résultat
            if($stmt->rowCount() == 1) {
                // Récupérer l'ID de l'utilisateur
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $id = $row["IdUtilisateur"];

                // Stocker l'ID de l'utilisateur dans la session
                $_SESSION["loggedin"] = true;
                $_SESSION["id"] = $id;

                // Rediriger vers la page d'accueil avec l'ID de l'utilisateur
                header("Location: index.php?id=$id");
                exit();
            } else {
                // Identifiants incorrects
                $error_message = "Identifiants incorrects. Veuillez réessayer.";
            }
        } else {
            // Erreur lors de l'exécution de la requête
            $error_message = "Erreur lors de la tentative de connexion. Veuillez réessayer.";
        }
    } else {
        // Erreur lors de la préparation de la requête
        $error_message = "Erreur lors de la tentative de connexion. Veuillez réessayer.";
    }
}

?>
      
</html>