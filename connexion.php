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


<header style="width: 100%;">
    <div class="topnav" id="myTopnav">
    <a href="index.php" >Accueil</a>
        <?php if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) : ?>
            <a onclick="myFunction2()" class="dropbtn">Jeux</a>
            <div id="myDropdown" class="dropdown-content">
                <a href="jeux.php">Page des jeux</a>
                <a href="blackjack.php">Blackjack</a>
                <a href="shifumi.php">Shifumi</a>
                <a href="Pile_ou_face.php">Pile ou Face</a>
            </div>

            
            <span id="user-info" class="user-info">
                <?php
                $sql = "SELECT pseudo, email FROM utilisateur WHERE IdUtilisateur = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":id", $_SESSION["id"], PDO::PARAM_INT);
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);


                ?>
            </span>

 
            
        <?php else : ?>
            <a class="current-page" href="connexion.php">Connexion</a>
            <a href="inscription.php">Inscription</a>
        <?php endif; ?>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
            <i class="fa fa-bars"></i>
        </a>
    </div>
</header>

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
            }
        } else {

            $error_message = "Erreur lors de la tentative de connexion. Veuillez réessayer.";
        }
    } else {
        $error_message = "Erreur lors de la tentative de connexion. Veuillez réessayer.";
    }
}
?>
      
</html>