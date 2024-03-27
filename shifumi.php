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
            <!-- L'utilisateur est connecté, n'affichez pas les boutons Connexion et Inscription -->
            <a onclick="myFunction2()" class="dropbtn">Jeux</a>
            <div id="myDropdown" class="dropdown-content">
                <a href="jeux.php">Page des jeux</a>
                <a href="blackjack.php">Blackjack</a>
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
    $sql = "SELECT pseudo, email FROM utilisateur WHERE IdUtilisateur = :id";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id", $_SESSION["id"], PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row) {
            // Afficher le bouton avec les informations de l'utilisateur
            echo '<button id="btn-message" class="button-message">
            <div class="content-avatar">
                <div class="status-user"></div>
                <div class="avatar">
                    <svg class="user-img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12,12.5c-3.04,0-5.5,1.73-5.5,3.5s2.46,3.5,5.5,3.5,5.5-1.73,5.5-3.5-2.46-3.5-5.5-3.5Zm0-.5c1.66,0,3-1.34,3-3s-1.34-3-3-3-3,1.34-3,3,1.34,3,3,3Z"></path></svg>
                </div>
            </div>
            <div class="notice-content">
                <a href="statistiques.php"> <div  class="username">Statistiques</div> </a>
                <div class="lable-message">' . $row["pseudo"] . '<span class="number-message">3</span></div>
                <div class="user-id"></div>
            </div>
        </button>';
        }
    } catch(PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
} else {
    // Afficher le bouton de connexion si l'utilisateur n'est pas connecté
    echo '<button id="btn-message" class="button-message">
    <div class="content-avatar">
        <div class="status-user"></div>
        <div class="avatar">
            <svg class="user-img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12,12.5c-3.04,0-5.5,1.73-5.5,3.5s2.46,3.5,5.5,3.5,5.5-1.73,5.5-3.5-2.46-3.5-5.5-3.5Zm0-.5c1.66,0,3-1.34,3-3s-1.34-3-3-3-3,1.34-3,3,1.34,3,3,3Z"></path></svg>
        </div>
    </div>
    <div class="notice-content">
        <div class="username">Connectez vous</div>
        <div class="lable-message">Déconnecté<span class="number-message">3</span></div>
        <div class="user-id">svp</div>
    </div>
</button>';
}
?>

<?php if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) : ?>
<a href="deconnexion.php">
                <button class="connectBtn">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 640 512" fill="white"><path d="M579.8 267.7c56.5-56.5 56.5-148 0-204.5c-50-50-128.8-56.5-186.3-15.4l-1.6 1.1c-14.4 10.3-17.7 30.3-7.4 44.6s30.3 17.7 44.6 7.4l1.6-1.1c32.1-22.9 76-19.3 103.8 8.6c31.5 31.5 31.5 82.5 0 114L422.3 334.8c-31.5 31.5-82.5 31.5-114 0c-27.9-27.9-31.5-71.8-8.6-103.8l1.1-1.6c10.3-14.4 6.9-34.4-7.4-44.6s-34.4-6.9-44.6 7.4l-1.1 1.6C206.5 251.2 213 330 263 380c56.5 56.5 148 56.5 204.5 0L579.8 267.7zM60.2 244.3c-56.5 56.5-56.5 148 0 204.5c50 50 128.8 56.5 186.3 15.4l1.6-1.1c14.4-10.3 17.7-30.3 7.4-44.6s-30.3-17.7-44.6-7.4l-1.6 1.1c-32.1 22.9-76 19.3-103.8-8.6C74 372 74 321 105.5 289.5L217.7 177.2c31.5-31.5 82.5-31.5 114 0c27.9 27.9 31.5 71.8 8.6 103.9l-1.1 1.6c-10.3 14.4-6.9 34.4 7.4 44.6s34.4 6.9 44.6-7.4l1.1-1.6C433.5 260.8 427 182 377 132c-56.5-56.5-148-56.5-204.5 0L60.2 244.3z"></path></svg>
                Déconnexion
            </button></a>
            
            <?php endif; ?>
<?php
include_once "config.php";

// Démarrer la session si ce n'est pas déjà fait
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Vérifier si l'ID de session est disponible
if (!isset($_SESSION['id'])) {
    // Si l'ID de session n'est pas défini, redirigez l'utilisateur vers une page appropriée
    header("Location: erreur.php");
    exit;
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Options possibles pour le joueur et l'ordinateur
    $options = ["pierre", "feuille", "ciseaux"];
    
    // Choisir une option aléatoire pour l'ordinateur
    $ordinateur = $options[array_rand($options)];
    
    // Récupérer l'option choisie par le joueur
    $joueur = $_POST["choix"];
    
    // Afficher les choix du joueur et de l'ordinateur
    echo "<p>Vous avez choisi : $joueur</p>";
    echo "<p>L'ordinateur a choisi : $ordinateur</p>";
    
    // Déterminer le résultat du jeu
    if ($joueur == $ordinateur) {
        echo "<p>C'est une égalité !</p>";
        $resultat = "Égalité";
        $points = 0;
    } elseif (($joueur == "pierre" && $ordinateur == "ciseaux") ||
              ($joueur == "feuille" && $ordinateur == "pierre") ||
              ($joueur == "ciseaux" && $ordinateur == "feuille")) {
        echo "<p>Vous avez gagné !</p>";
        $resultat = "Victoire";
        $points = +5;
    } else {
        echo "<p>L'ordinateur a gagné !</p>";
        $resultat = "Défaite";
        $points = -5;
    }

    // Insérer les données dans la table 'games_history'
    $idJoueur = $_SESSION['id']; // Récupérer l'ID de session
    $gameName = 'Shifumi'; // Nom du jeu
    
    // Exécuter la requête pour insérer les données dans la table games_history
    $stmt = $pdo->prepare("INSERT INTO games_history (IdJoueur, GameName, Resultat, Points) VALUES (?, ?, ?, ?)");
    $stmt->execute([$idJoueur, $gameName, $resultat, $points]);

    // Mettre à jour le nombre de pièces de l'utilisateur dans la table utilisateur
    $sqlUpdate = "UPDATE utilisateur SET coins = coins + ? WHERE IdUtilisateur = ?";
    $stmtUpdate = $pdo->prepare($sqlUpdate);
    $stmtUpdate->execute([$points, $idJoueur]);

    // Afficher les boutons pour rejouer ou retourner à la page précédente avec l'ID conservé
    echo "<div>
            <a href='jeux.php'><button>Retour</button></a>
            <a href='shifumi.php'><button>Rejouer</button></a>
          </div>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr" data-bs-theme="auto">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <link rel="stylesheet" href="./style.css">
    <title>Shifumi</title>
</head>
<body>

<header style="width: 100%;">
    <!-- Votre code pour l'en-tête ici -->
</header>

<?php
// Votre code pour afficher les informations de l'utilisateur ici
?>

<?php if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) : ?>
<!-- Votre code pour le bouton de déconnexion ici -->
<?php endif; ?>

<form method="post" action="">
    <label for="choix">Choisissez votre coup :</label>
    <button class="btn_choix" type="submit" name="choix" value="pierre"><img src="images/Pierre.png" class="pfc-btn" alt="pierre"></button>
    <button class="btn_choix" type="submit" name="choix" value="feuille"><img src="images/Feuille.png" class="pfc-btn" alt="feuille"></button>
    <button class="btn_choix" type="submit" name="choix" value="ciseaux"><img src="images/Ciseaux.png" class="pfc-btn" style="height: 100%" alt="ciseaux"></button>
</form>

</body>
</html>
