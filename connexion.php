<!DOCTYPE html>
<html lang="fr" data-bs-theme="auto">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <link rel="stylesheet" href="./style.css">
    <title>Connexion</title>
</head>
<body>
<?php
// Inclure le fichier de configuration de la base de données
include_once "config.php";

// Initialiser la session si ce n'est pas déjà fait
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Vérification des données postées
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pseudo_email = $_POST["pseudo_email"];
    $mdp = $_POST["mdp"];

    // Requête pour récupérer le mot de passe haché de l'utilisateur
    $requete = "SELECT IdUtilisateur, mdp FROM utilisateur WHERE pseudo = ? OR email = ?";
    if($stmt = $pdo->prepare($requete)) {
        // Liaison des paramètres
        $stmt->bindParam(1, $pseudo_email, PDO::PARAM_STR);
        $stmt->bindParam(2, $pseudo_email, PDO::PARAM_STR);

        // Exécution de la requête
        if($stmt->execute()) {
            // Vérification du résultat
            if($stmt->rowCount() >= 1) {
                // Récupérer l'ID de l'utilisateur et le mot de passe haché
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $id = $row["IdUtilisateur"];
                $hashed_password = $row["mdp"];

                // Vérifier si le mot de passe fourni correspond au mot de passe haché
                if(password_verify($mdp, $hashed_password)) {
                    $_SESSION["loggedin"] = true;
                    $_SESSION["id"] = $id;

                    // Rediriger vers la page d'accueil avec l'ID de l'utilisateur
                    header("Location: index.php");
                    exit();
                } else {
                    // Mot de passe incorrect
                    $error_message = "Identifiants incorrects. Veuillez réessayer.";
                }
            } else {
                // Aucun utilisateur trouvé avec ce pseudo ou email
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

<?php include_once "navbar.php"; ?>

<main>
<div class="container" style="margin-top: 5vh;">  
    <h1 style="color: #F4bc5b">Connexion</h1>  
    <?php 
    if (isset($error_message)) {
        echo "<p style='color: red;'>$error_message</p>";
    }
    ?>
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
        <p class="text">Pas de compte ? <a href="inscription.php">Inscrivez vous</a></p> 
    </form>  
</div>  
<script src="script.js"></script>
</main>
</body>
</html>
