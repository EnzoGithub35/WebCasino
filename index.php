<?php
// Inclure votre fichier de configuration de la base de données
include_once "config.php";

// Initialiser la session si ce n'est pas déjà fait
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
    <a href="index.php" class="current-page">Accueil</a>
        <?php if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) : ?>
            <a href="deconnexion.php">Déconnexion</a>
            <!-- L'utilisateur est connecté, n'affichez pas les boutons Connexion et Inscription -->
            <a onclick="myFunction2()" class="dropbtn">Jeux</a>
            <div id="myDropdown" class="dropdown-content">
                <a href="jeux.php">Page des jeux</a>
                <a href="blackjack_test.php">Blackjack</a>
                <a href="shifumi.php">Shifumi</a>
                <a href="Pile_ou_face.php">Pile ou Face</a>
            </div>
            
            <span id="user-info" class="user-info">
                <?php
                // Requête pour récupérer le pseudo de l'utilisateur connecté depuis la base de données
                $sql = "SELECT pseudo FROM utilisateur WHERE IdUtilisateur = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":id", $_SESSION["id"], PDO::PARAM_INT);
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                // Afficher le pseudo de l'utilisateur connecté depuis la base de données

                ?>
            </span>
            
        <?php else : ?>
            <!-- L'utilisateur n'est pas connecté, afficher les boutons Connexion et Inscription -->
            <a href="connexion.php">Connexion</a>
            <a href="inscription.php">Inscription</a>
        <?php endif; ?>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
            <i class="fa fa-bars"></i>
        </a>
    </div>
</header>
<script src="script.js"></script>

<?php
// Vérifier si l'utilisateur est connecté
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    // Requête pour récupérer le pseudo de l'utilisateur connecté depuis la base de données
    $sql = "SELECT pseudo FROM utilisateur WHERE IdUtilisateur = :id";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id", $_SESSION["id"], PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row) {
            // Afficher le pseudo de l'utilisateur s'il est connecté
            echo "<span id='user-info' class='user-info'>Connecté en tant que : " . $row['pseudo'] . "</span>";
        }
    } catch(PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
} else {
    // Si l'utilisateur n'est pas connecté, afficher "Non connecté"
    echo "<span id='user-info' class='user-info'>Déconnecté</span>";
}
?>

</body>
</html>