<?php
// Inclure votre fichier de configuration de la base de données
include_once "config.php";

// Initialiser la session si ce n'est pas déjà fait
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Initialiser une variable pour stocker les informations de l'utilisateur
$userInfo = array();

// Initialiser des variables pour stocker l'historique des jeux
$blackjackHistory = array();
$shifumiHistory = array();
$pileOuFaceHistory = array();

// Vérifier si l'utilisateur est connecté
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    // Requête pour récupérer toutes les informations de l'utilisateur connecté depuis la base de données
    $sql_user = "SELECT * FROM utilisateur WHERE IdUtilisateur = :id";

    try {
        $stmt_user = $pdo->prepare($sql_user);
        $stmt_user->bindParam(":id", $_SESSION["id"], PDO::PARAM_INT);
        $stmt_user->execute();
        $userInfo = $stmt_user->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }

    // Requête pour récupérer le pseudo de l'utilisateur connecté depuis la base de données
    $sql = "SELECT pseudo FROM utilisateur WHERE IdUtilisateur = :id";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id", $_SESSION["id"], PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }

    // Requête pour récupérer les 10 dernières parties de Blackjack de l'utilisateur connecté
    $sql_blackjack = "SELECT * FROM games_history WHERE IdJoueur = :id AND GameName = 'BlackJack' ORDER BY Id DESC LIMIT 10";

    try {
        $stmt_blackjack = $pdo->prepare($sql_blackjack);
        $stmt_blackjack->bindParam(":id", $_SESSION["id"], PDO::PARAM_INT);
        $stmt_blackjack->execute();
        $blackjackHistory = $stmt_blackjack->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }

    // Requête pour récupérer les 10 dernières parties de Shifumi de l'utilisateur connecté
    $sql_shifumi = "SELECT * FROM games_history WHERE IdJoueur = :id AND GameName = 'Shifumi' ORDER BY Id DESC LIMIT 10";

    try {
        $stmt_shifumi = $pdo->prepare($sql_shifumi);
        $stmt_shifumi->bindParam(":id", $_SESSION["id"], PDO::PARAM_INT);
        $stmt_shifumi->execute();
        $shifumiHistory = $stmt_shifumi->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }

    // Requête pour récupérer les 10 dernières parties de Pile ou Face de l'utilisateur connecté
    $sql_pileOuFace = "SELECT * FROM games_history WHERE IdJoueur = :id AND GameName = 'Pile ou Face' ORDER BY Id DESC LIMIT 10";

    try {
        $stmt_pileOuFace = $pdo->prepare($sql_pileOuFace);
        $stmt_pileOuFace->bindParam(":id", $_SESSION["id"], PDO::PARAM_INT);
        $stmt_pileOuFace->execute();
        $pileOuFaceHistory = $stmt_pileOuFace->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
} else {
    // Rediriger l'utilisateur vers la page de connexion s'il n'est pas connecté
    header("Location: connexion.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body style="text-align: center;">
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
                // Afficher le pseudo de l'utilisateur connecté depuis la base de données
                if($row) {
                    echo $row["pseudo"];
                }
                ?>
            </span>

 
            
        <?php else : ?>
            <!-- L'utilisateur n'est pas connecté, afficher les boutons Connexion et Inscription -->
            <a href="connexion.php">Connexion</a>
            <a href="connexion_test.php">Connexion TEST</a>
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
    // Afficher le bouton avec les informations de l'utilisateur
    echo '<a href="profil.php"> <button id="btn-message" class="button-message">
            <div class="content-avatar">
                <div class="status-user"></div>
                <div class="avatar">
                    <svg class="user-img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12,12.5c-3.04,0-5.5,1.73-5.5,3.5s2.46,3.5,5.5,3.5,5.5-1.73,5.5-3.5-2.46-3.5-5.5-3.5Zm0-.5c1.66,0,3-1.34,3-3s-1.34-3-3-3-3,1.34-3,3,1.34,3,3,3Z"></path></svg>
                    </div>
                </div>
                
                <div class="notice-content">
                
                    <div  class="username">Profil</div> 
                    <div class="lable-message">' . $row["pseudo"] . '<span class="number-message">' . $userInfo["coins"] . '</span></div>
                    <div class="user-id"></div>
                    
                    
                </div>
                
            </button></a>';
    } else {
        // Afficher le bouton de connexion si l'utilisateur n'est pas connecté
        echo '<a href="connexion.php"><button id="btn-message" class="button-message">
        <div class="content-avatar">
            <div class="status-user"></div>
            <div class="avatar">
                <svg class="user-img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12,12.5c-3.04,0-5.5,1.73-5.5,3.5s2.46,3.5,5.5,3.5,5.5-1.73,5.5-3.5-2.46-3.5-5.5-3.5Zm0-.5c1.66,0,3-1.34,3-3s-1.34-3-3-3-3,1.34-3,3,1.34,3,3,3Z"></path></svg>
            </div>
        </div>
        <div class="notice-content">
            <div class="username">Connectez vous</div>
            <div class="lable-message">Déconnecté<span class="number-message"></span></div>
            <div class="user-id">svp</div>
        </div>
    </button></a>';
    }
    ?>
    
    <?php if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) : ?>
    <a href="deconnexion.php">
        <button class="connectBtn">
            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 640 512" fill="white"><path d="M579.8 267.7c56.5-56.5 56.5-148 0-204.5c-50-50-128.8-56.5-186.3-15.4l-1.6 1.1c-14.4 10.3-17.7 30.3-7.4 44.6s30.3 17.7 44.6 7.4l1.6-1.1c32.1-22.9 76-19.3 103.8 8.6c31.5 31.5 31.5 82.5 0 114L422.3 334.8c-31.5 31.5-82.5 31.5-114 0c-27.9-27.9-31.5-71.8-8.6-103.8l1.1-1.6c10.3-14.4 6.9-34.4-7.4-44.6s-34.4-6.9-44.6 7.4l-1.1 1.6C206.5 251.2 213 330 263 380c56.5 56.5 148 56.5 204.5 0L579.8 267.7zM60.2 244.3c-56.5 56.5-56.5 148 0 204.5c50 50 128.8 56.5 186.3 15.4l1.6-1.1c14.4-10.3 17.7-30.3 7.4-44.6s-30.3-17.7-44.6-7.4l-1.6 1.1c-32.1 22.9-76 19.3-103.8-8.6C74 372 74 321 105.5 289.5L217.7 177.2c31.5-31.5 82.5-31.5 114 0c27.9 27.9 31.5 71.8 8.6 103.9l-1.1 1.6c-10.3 14.4-6.9 34.4 7.4 44.6s34.4 6.9 44.6-7.4l1.1-1.6C433.5 260.8 427 182 377 132c-56.5-56.5-148-56.5-204.5 0L60.2 244.3z"></path></svg>
            Déconnexion
        </button>
    </a>
    <?php endif; ?>
    
    <h1>Profil de l'utilisateur</h1>
    <div>
        <h2>Informations de l'utilisateur</h2>
        <p>Pseudo: <?php echo $userInfo["pseudo"]; ?></p>
        <p>Nom: <?php echo $userInfo["Nom"]; ?></p>
        <p>Prénom: <?php echo $userInfo["Prenom"]; ?></p>
        <p>Email: <?php echo $userInfo["email"]; ?></p>
        <p>Nombre de coins: <?php echo $userInfo["coins"]; ?></p>
        <!-- Vous pouvez ajouter d'autres informations ici si nécessaire -->
    </div>
    
    <div>
        <h2>Historique des parties de Blackjack</h2>
        <ul>
            <?php foreach ($blackjackHistory as $game): ?>
                <li><?php echo $game["Resultat"]; ?>  <?php echo $game["Points"]; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    
    <div>
        <h2>Historique des parties de Shifumi</h2>
        <ul>
            <?php foreach ($shifumiHistory as $game): ?>
                <li><?php echo $game["Resultat"]; ?>  <?php echo $game["Points"]; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    
    
    <div>
        <h2>Historique des parties de Pile ou Face</h2>
        <ul>
            <?php foreach ($pileOuFaceHistory as $game): ?>
                <li><?php echo $game["Resultat"]; ?>  <?php echo $game["Points"]; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    
<?php
// Requête pour compter le nombre de parties jouées dans chaque jeu
$sql = "SELECT GameName, COUNT(*) AS gameCount
        FROM games_history
        WHERE IdJoueur = :idJoueur
        GROUP BY GameName
        ORDER BY gameCount DESC
        LIMIT 1";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(":idJoueur", $_SESSION["id"], PDO::PARAM_INT);
$stmt->execute();
$favoriteGameRow = $stmt->fetch(PDO::FETCH_ASSOC);

if ($favoriteGameRow) {
    $favoriteGame = $favoriteGameRow['GameName'];
    $maxGameCount = $favoriteGameRow['gameCount'];
?>

<div>
    <h2>Jeu préféré du joueur</h2>
    <p>Jeu préféré: <?php echo $favoriteGame; ?></p>
    <p>Nombre de parties jouées: <?php echo $maxGameCount; ?></p>
</div>
<?php
} else {
?>
<div>
    <h2>Jeu préféré du joueur</h2>
    <p>Aucune partie jouée pour le moment.</p>
</div>
<?php
}
?>
    
    </body>
    </html>
