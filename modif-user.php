<?php
include 'config.php';
session_start();

// Vérifier si la requête est une méthode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Récupérer les données du formulaire
    $pseudo = $_POST["pseudo"];
    $Nom = $_POST["Nom"];
    $Prenom = $_POST["Prenom"];
    $email = $_POST["email"];
    $mdp = $_POST["mdp"]; 

    // Vérifier si l'email ou le pseudo existe déjà dans la base de données
    $verification_requete = "SELECT COUNT(*) AS count FROM utilisateur WHERE email = '$email' OR pseudo = '$pseudo'";
    $resultat_verification = $conn->query($verification_requete);
    
    if ($resultat_verification) {
        $row = $resultat_verification->fetch_assoc();
        $compte = $row['count'];
            // Mettre à jour les informations de l'utilisateur dans la base de données
            $requete = "UPDATE utilisateur SET pseudo = '$pseudo', Nom = '$Nom', Prenom = '$Prenom', email = '$email', mdp = '$mdp' WHERE IdUtilisateur = {$_SESSION['id']}";
            
            if ($conn->query($requete) === TRUE) {
                // Rediriger vers la page de connexion après la modification
                header("Location: connexion.php");
                exit();
            } else {
                echo "Erreur lors de la modification des identifiants : " . $conn->error;
            }
        }
    }

// Récupérer les informations actuelles de l'utilisateur depuis la base de données
$sql_user_info = "SELECT pseudo, Nom, Prenom, email FROM utilisateur WHERE IdUtilisateur = {$_SESSION['id']}";
$resultat_user_info = $conn->query($sql_user_info);

if ($resultat_user_info && $resultat_user_info->num_rows > 0) {
    $row = $resultat_user_info->fetch_assoc();
    $pseudo_actuel = $row["pseudo"];
    $Nom_actuel = $row["Nom"];
    $Prenom_actuel = $row["Prenom"];
    $email_actuel = $row["email"];
} else {
    echo "Erreur : impossible de récupérer les informations de l'utilisateur.";
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
                <input type="text" name="pseudo" required value="<?php echo $pseudo_actuel; ?>">
                <label for="pseudo">Nouveau pseudo :</label>
            </div>
            <div class="form-control">    
                <input type="text" name="Nom" required value="<?php echo $Nom_actuel; ?>">
                <label for="Nom">Nouveau nom :</label>
            </div>
            <div class="form-control">    
                <input type="text" name="Prenom" required value="<?php echo $Prenom_actuel; ?>">
                <label for="Prenom">Nouveau prénom :</label>
            </div>
            <div class="form-control">
                <input type="email" name="email" required value="<?php echo $email_actuel; ?>">
                <label for="email">Nouvelle email :</label>
            </div>
            <div class="form-control">
                <input type="password" name="mdp" required>
                <label for="mdp"> Nouveau mot de passe :</label>
            </div>
            <input class="btn" type="submit" name="valider" value="Valider">
        </form>
    </div>
</main>

<script src="script.js"></script>
</body>
</html>
