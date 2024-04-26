<?php

include 'config.php';
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST["email"];
    $mdp = $_POST["mdp"]; 


    $pseudo = $_POST["pseudo"];
    $Nom = $_POST["Nom"];
    $Prenom = $_POST["Prenom"];
    
    $_SESSION['pseudo'] = $_POST["pseudo"];
    $AdresseIP = $_SERVER['REMOTE_ADDR'];

    $verification_requete = "SELECT COUNT(*) AS count FROM utilisateur WHERE email = '$email' OR pseudo = '$pseudo'";
    $resultat_verification = $conn->query($verification_requete);
    
    if ($resultat_verification) {
        $row = $resultat_verification->fetch_assoc();
        $compte = $row['count'];

        if ($compte == 0) {
            $requete = "UPDATE utilisateur (pseudo, Nom, Prenom, email, DateCreationCompte, mdp, AdresseIP, coins) VALUES ('$pseudo', '$Nom', '$Prenom', '$email', NOW(), '$mdp',  '$AdresseIP', 100)";
            
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">  
    <title>Modification des identifiants</title>
</head>
<body>
<?php include_once "navbar.php"; ?>



<main class="">
    <div class="container" style="margin-top: 5vh;">
    <h1 style="color: #F4bc5b">Modifiez vos identifiants</h1>  
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

        </form>
    </div>


        <script src="script.js"></script>
        
        


</body>
</html>
