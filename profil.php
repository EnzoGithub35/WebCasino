<?php

include_once "config.php";


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


$userInfo = array();

$blackjackHistory = array();
$shifumiHistory = array();
$pileOuFaceHistory = array();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    
    $sql_user = "SELECT * FROM utilisateur WHERE IdUtilisateur = :id";

    try {
        $stmt_user = $pdo->prepare($sql_user);
        $stmt_user->bindParam(":id", $_SESSION["id"], PDO::PARAM_INT);
        $stmt_user->execute();
        $userInfo = $stmt_user->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }

    
    $sql = "SELECT pseudo FROM utilisateur WHERE IdUtilisateur = :id";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id", $_SESSION["id"], PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }

   
    $sql_blackjack = "SELECT * FROM games_history WHERE IdJoueur = :id AND GameName = 'BlackJack' ORDER BY Id DESC LIMIT 10";

    try {
        $stmt_blackjack = $pdo->prepare($sql_blackjack);
        $stmt_blackjack->bindParam(":id", $_SESSION["id"], PDO::PARAM_INT);
        $stmt_blackjack->execute();
        $blackjackHistory = $stmt_blackjack->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }

    $sql_shifumi = "SELECT * FROM games_history WHERE IdJoueur = :id AND GameName = 'Shifumi' ORDER BY Id DESC LIMIT 10";

    try {
        $stmt_shifumi = $pdo->prepare($sql_shifumi);
        $stmt_shifumi->bindParam(":id", $_SESSION["id"], PDO::PARAM_INT);
        $stmt_shifumi->execute();
        $shifumiHistory = $stmt_shifumi->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }

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
<?php include_once "navbar.php"; ?>
    
    <h1>Profil de l'utilisateur</h1>
    <div>
        <h2>Informations de l'utilisateur</h2>
        <p>Pseudo: <?php echo $userInfo["pseudo"]; ?></p>
        <p>Nom: <?php echo $userInfo["Nom"]; ?></p>
        <p>Prénom: <?php echo $userInfo["Prenom"]; ?></p>
        <p>Email: <?php echo $userInfo["email"]; ?></p>
        <p>Nombre de coins: <?php echo $userInfo["coins"]; ?></p>
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
