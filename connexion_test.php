<?php
include_once "config.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

?>

<!DOCTYPE html>
<html lang="fr" data-bs-theme="auto">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <link rel="stylesheet" href="./style.css">
    <title>Accueil</title>
</head>
<body>

<?php include_once "navbar.php"; ?>


<main>
  


  <div class="container" style="margin-top: 5vh;">  
    <h1 style="color: #F4bc5b">Connexion</h1>  
    <form method="post">  
     <div class="form-control">  
    <input type="text" name="pseudo_email" required>
    <label for="pseudo_email">Pseudo ou Email</label>
    </div> 
         
     <div class="form-control">  
      <input type="password" name="mdp" required>  
      <label for="mdp">Mot de passe</label>  
     </div>  
     <button class="btn">Connexion</button>  
     <p class="text">Pas de compte ? <a href="inscription.php">Inscrivez vous</a> </p> 
     </div>  

  <script src="script.js"></script>


</main>




</body>

<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pseudo_email = $_POST["pseudo_email"];
    $mdp = $_POST["mdp"];

    $requete = "SELECT IdUtilisateur FROM utilisateur WHERE (pseudo = ? OR email = ?) AND mdp = ?";
    if($stmt = $pdo->prepare($requete)) {
        $stmt->bindParam(1, $pseudo_email, PDO::PARAM_STR);
        $stmt->bindParam(2, $pseudo_email, PDO::PARAM_STR);
        $stmt->bindParam(3, $mdp, PDO::PARAM_STR);

        if($stmt->execute()) {
            if($stmt->rowCount() == 1) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $id = $row["IdUtilisateur"];

                $_SESSION["loggedin"] = true;
                $_SESSION["id"] = $id;

                header("Location: index.php");
                exit();
            } else {
                $error_message = "Identifiants incorrects. Veuillez réessayer.";
                echo $error_message;
            }
        } else {
            $error_message = "Erreur lors de la tentative de connexion. Veuillez réessayer.";
            echo $error_message;
        }
    } else {
        $error_message = "Erreur lors de la tentative de connexion. Veuillez réessayer.";
        echo $error_message;
    }
}
?>
      
</html>