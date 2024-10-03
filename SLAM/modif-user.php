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

    // Hacher le mot de passe
    $hashed_password = password_hash($mdp, PASSWORD_DEFAULT);

    $current_user_id = $_SESSION['id'];
    $stmt = $conn->prepare("SELECT COUNT(*) AS count FROM utilisateur WHERE (email = ? OR pseudo = ?) AND IdUtilisateur != ?");
    $stmt->bind_param("ssi", $email, $pseudo, $current_user_id);
    $stmt->execute();
    $resultat_verification = $stmt->get_result();

    if ($resultat_verification) {
        $row = $resultat_verification->fetch_assoc();
        $compte = $row['count'];

        if ($compte == 0) {
            $stmt = $conn->prepare("UPDATE utilisateur SET pseudo = ?, Nom = ?, Prenom = ?, email = ?, mdp = ?, AdresseIP = ? WHERE IdUtilisateur = ?");
            $stmt->bind_param("ssssssi", $pseudo, $Nom, $Prenom, $email, $hashed_password, $AdresseIP, $current_user_id);

            if ($stmt->execute()) {
                header("Location: index.php");
                exit();
            } else {
                echo "Erreur lors de la modification : " . $conn->error;
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
    <title>Inscription</title>
</head>
<body>
<?php include_once "navbar.php"; ?>

<main class="">
    <div class="container" style="margin-top: 5vh;">
    <h1 style="color: #F4bc5b">Modifiez</h1>  
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
</main>
</body>
</html>
