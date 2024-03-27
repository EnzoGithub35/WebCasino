<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">  
    <title>Inscription</title>
</head>
<body>


<?php
// Inclure le fichier de configuration avec les informations de connexion à la base de données
include 'config.php';
session_start();

// Vérification des données postées
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des valeurs postées
    $email = $_POST["email"];
    $mdp = $_POST["mdp"]; // Mot de passe en texte clair

    // Hasher le mot de passe
    $mdpHash = password_hash($mdp, PASSWORD_DEFAULT);

    // Autres valeurs postées
    $pseudo = $_POST["pseudo"];
    $Nom = $_POST["Nom"];
    $Prenom = $_POST["Prenom"];
    $_SESSION['pseudo'] = $_POST["pseudo"];
    $AdresseIP = $_SERVER['REMOTE_ADDR'];

    // Requête SQL pour vérifier si l'email ou le pseudo existe déjà
    $verification_requete = "SELECT COUNT(*) AS count FROM utilisateur WHERE email = '$email' OR pseudo = '$pseudo'";
    $resultat_verification = $conn->query($verification_requete);
    
    if ($resultat_verification) {
        $row = $resultat_verification->fetch_assoc();
        $compte = $row['count'];

        if ($compte == 0) {
            // Aucun utilisateur avec cet email ou ce pseudo n'a été trouvé, procédez à l'inscription
            $requete = "INSERT INTO utilisateur (pseudo, Nom, Prenom, email, DateCreationCompte, mdp, AdresseIP, coins) VALUES ('$pseudo', '$Nom', '$Prenom', '$email', NOW(), '$mdpHash',  '$AdresseIP' 100)";
            
            if ($conn->query($requete) === TRUE) {
                header("Location: connexion.php");
                exit();
            } else {
                echo "Erreur lors de l'inscription : " . $conn->error;
            }
        } else {
            echo "L'utilisateur avec cet email ou pseudo existe déjà.";
        }
    }
}
?>



<header style="width: 100%;">
        <div class="topnav" id="myTopnav">
            <a href="index.php" >Accueil</a>
            <a href="connexion.php">Connexion</a>
            <a href="inscription.php" class="current-page">Inscription</a>
            </a>
          </div>
    
    </header> 
        

<main class="">
    <div class="container">
    <h1 style="color: #F4bc5b">Inscription</h1>  
    <form method="post" action="">
            <div class="form-control">    
                <input type="text"  name="pseudo" required value="">
                <label for="pseudo">Pseudo :</label>
            </div>
            <div class="form-control">    
                <input type="text"  name="Nom" required value="">
                <label for="Nom">Nom :</label>
            </div>
            <div class="form-control">    
                <input type="text"  name="Prenom" required value="">
                <label for="Prenom">Prénom :</label>
            </div>
            <div class="form-control">
                <input type="email" class="" name="email" required>
                <label for="email">Email :</label>
            </div>
            <div class="form-control">
                <input type="password" class="" name="mdp" required>
                <label for="mdp">Mot de passe :</label>
            </div>
            <input class="btn" type="submit" name="valider" value="Valider">
            <p class="text">Deja un compte ? <a href="connexion.php">Connectez vous</a> </p> 
        </form>
    </div>


        <script src="script.js"></script>
        
        


</body>
</html>