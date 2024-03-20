<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Document</title>
</head>
<body>
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
        include 'config.php';
        session_start();
            // Vérification des données postées

                  
          if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $pseudo = $_POST["pseudo"];
            $mdp = $_POST["mdp"];
            $_SESSION["pseudo"] = $pseudo;
           


            $requete = "SELECT IdUtilisateur FROM utilisateur WHERE pseudo = '$pseudo' AND mdp = '$mdp'";
            $resultat = $conn->query($requete);
      
                  // Vérification du résultat de la requête
             if ($resultat && $resultat->num_rows > 0) {
       
                // Fermer la connexion à la base de données
                $conn->close();
    
                $row = $resultat->fetch_assoc();
                $id = $row["IdUtilisateur"];
                header("Location: jeux.php?id=$id");
                exit();
              } else {
                // Utilisateur non trouvé, afficher un message d'erreur ou effectuer une autre action
                echo "Identifiants incorrects. Veuillez réessayer.";
          }

          // Fermer la connexion à la base de données
          $conn->close();

            }
    
      ?>
      
</html>