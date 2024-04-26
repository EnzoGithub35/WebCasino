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
    $stmt_user = $pdo->prepare($sql_user);
    $stmt_user->bindParam(":id", $_SESSION["id"], PDO::PARAM_INT);
    $stmt_user->execute();
    $userInfo = $stmt_user->fetch(PDO::FETCH_ASSOC);

    // BLACKJACK
    $sql_blackjack = "SELECT * FROM games_history WHERE IdJoueur = :id AND GameName = 'BlackJack' ORDER BY Id DESC LIMIT 10";
    $stmt_blackjack = $pdo->prepare($sql_blackjack);
    $stmt_blackjack->bindParam(":id", $_SESSION["id"], PDO::PARAM_INT);
    $stmt_blackjack->execute();
    $blackjackHistory = $stmt_blackjack->fetchAll(PDO::FETCH_ASSOC);

    $sql_victoires_bj = "SELECT COUNT(*) AS victoires_bj FROM games_history WHERE IdJoueur = :id AND GameName = 'BlackJack' AND Resultat = 'Gagné'";
    $stmt_victoires_bj = $pdo->prepare($sql_victoires_bj);
    $stmt_victoires_bj->bindParam(":id", $_SESSION["id"], PDO::PARAM_INT);
    $stmt_victoires_bj->execute();
    $victoires_bj = $stmt_victoires_bj->fetchColumn();
    $sql_nb_parties_BJ = "SELECT COUNT(*) AS nb_parties_BJ FROM games_history WHERE IdJoueur = :id AND GameName = 'BlackJack'";
    $stmt_nb_parties_BJ = $pdo->prepare($sql_nb_parties_BJ);
    $stmt_nb_parties_BJ->bindParam(":id", $_SESSION["id"], PDO::PARAM_INT);
    $stmt_nb_parties_BJ->execute();
    $nb_parties_BJ = $stmt_nb_parties_BJ->fetchColumn();
    $ratio_victoires_BJ = ($nb_parties_BJ > 0) ? ($victoires_bj / $nb_parties_BJ) * 100 : 100; // Éviter la division par zéro


    // SHIFUMI 
    $sql_shifumi = "SELECT * FROM games_history WHERE IdJoueur = :id AND GameName = 'Shifumi' ORDER BY Id DESC LIMIT 10";
    $stmt_shifumi = $pdo->prepare($sql_shifumi);
    $stmt_shifumi->bindParam(":id", $_SESSION["id"], PDO::PARAM_INT);
    $stmt_shifumi->execute();
    $shifumiHistory = $stmt_shifumi->fetchAll(PDO::FETCH_ASSOC);

    $sql_victoires_shifumi = "SELECT COUNT(*) AS victoires_shifumi FROM games_history WHERE IdJoueur = :id AND GameName = 'Shifumi' AND Resultat = 'Victoire'";
    $stmt_victoires_shifumi = $pdo->prepare($sql_victoires_shifumi);
    $stmt_victoires_shifumi->bindParam(":id", $_SESSION["id"], PDO::PARAM_INT);
    $stmt_victoires_shifumi->execute();
    $victoires_shifumi = $stmt_victoires_shifumi->fetchColumn();

    $sql_nb_parties_shifumi = "SELECT COUNT(*) AS nb_parties_shifumi FROM games_history WHERE IdJoueur = :id AND GameName = 'Shifumi'";
    $stmt_nb_parties_shifumi = $pdo->prepare($sql_nb_parties_shifumi);
    $stmt_nb_parties_shifumi->bindParam(":id", $_SESSION["id"], PDO::PARAM_INT);
    $stmt_nb_parties_shifumi->execute();
    $nb_parties_shifumi = $stmt_nb_parties_shifumi->fetchColumn();

    $ratio_victoires_shifumi = ($nb_parties_shifumi > 0) ? ($victoires_shifumi / $nb_parties_shifumi) * 100 : 100; 

    //PILE OU FACE
    $sql_pileOuFace = "SELECT * FROM games_history WHERE IdJoueur = :id AND GameName = 'Pile ou Face' ORDER BY Id DESC LIMIT 10";
    $stmt_pileOuFace = $pdo->prepare($sql_pileOuFace);
    $stmt_pileOuFace->bindParam(":id", $_SESSION["id"], PDO::PARAM_INT);
    $stmt_pileOuFace->execute();
    $pileOuFaceHistory = $stmt_pileOuFace->fetchAll(PDO::FETCH_ASSOC);
    
    $sql_victoires_po = "SELECT COUNT(*) AS victoires_po FROM games_history WHERE IdJoueur = :id AND GameName = 'Pile ou Face' AND Resultat = 'Gagné'";
    $stmt_victoires_po = $pdo->prepare($sql_victoires_po);
    $stmt_victoires_po->bindParam(":id", $_SESSION["id"], PDO::PARAM_INT);
    $stmt_victoires_po->execute();
    $victoires_po = $stmt_victoires_po->fetchColumn();

    $sql_nb_parties_po = "SELECT COUNT(*) AS nb_parties_po FROM games_history WHERE IdJoueur = :id AND GameName = 'Pile ou Face'";
    $stmt_nb_parties_po = $pdo->prepare($sql_nb_parties_po);
    $stmt_nb_parties_po->bindParam(":id", $_SESSION["id"], PDO::PARAM_INT);
    $stmt_nb_parties_po->execute();
    $nb_parties_po = $stmt_nb_parties_po->fetchColumn();

    $ratio_victoires_po = ($nb_parties_po > 0) ? ($victoires_po / $nb_parties_po) * 100 : 100;

        
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
     <button><a href="classement.php"> classement </a></button>
    <!-- <button><a href="modif-user.php"> modifié vos identifiants </a></button> -->
     
    
    <div>
        <h2>Historique des parties de Blackjack</h2>
        <ul>
            <?php foreach ($blackjackHistory as $game): ?>
                <li><?php echo $game["Resultat"]; ?>  <?php echo $game["Points"]; ?></li>
            <?php endforeach; ?>
        </ul>
        <p>nombre de victoire :<?php echo round($victoires_bj, 2); ?></p>
        <p>nombre de parties jouée : <?php echo round($nb_parties_BJ, 2); ?></p>
        <p>Ratio de victoires : <?php echo round($ratio_victoires_BJ, 2); ?>%</p>
    </div>
    
    <div>
        <h2>Historique des parties de Shifumi</h2>
        <ul>
            <?php foreach ($shifumiHistory as $game): ?>
                <li><?php echo $game["Resultat"]; ?>  <?php echo $game["Points"]; ?></li>
            <?php endforeach; ?>
        </ul>
        <p>Nombre de victoires : <?php echo round($victoires_shifumi, 2); ?></p>
        <p>Nombre de parties jouées : <?php echo round($nb_parties_shifumi, 2); ?></p>
        <p>Ratio de victoires : <?php echo round($ratio_victoires_shifumi, 2); ?>%</p>

    </div>
    
    
    <div>
        <h2>Historique des parties de Pile ou Face</h2>
        <ul>
            <?php foreach ($pileOuFaceHistory as $game): ?>
                <li><?php echo $game["Resultat"]; ?>  <?php echo $game["Points"]; ?></li>
            <?php endforeach; ?>
        </ul>
        <p>Nombre de victoires : <?php echo round($victoires_po, 2); ?></p>
        <p>Nombre de parties jouées : <?php echo round($nb_parties_po, 2); ?></p>
        <p>Ratio de victoires : <?php echo round($ratio_victoires_po, 2); ?>%</p>

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


<div>

        
    </div>
    </body>
    </html>
