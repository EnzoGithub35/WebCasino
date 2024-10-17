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
<?php include_once "navbar.php"; ?>
        <div class="formPoF">
            <?php
            $resultat = "Choisissez et lancez !";
            $choixUtilisateurTexte = "";
            $choixOrdinateurTexte   = "";
            if(isset($_POST['choix'])){
    $userId = $_SESSION['id'];

    $choixUtilisateur = $_POST['choix'];

    $choixOrdinateur = rand(0, 1);

    $options = array("Pile", "Face");

    $choixOrdinateurTexte = $options[$choixOrdinateur];
    $choixUtilisateurTexte = $options[$choixUtilisateur];

    if ($choixUtilisateur == $choixOrdinateur) {
        $resultat = "Gagné";
        $points = +5;
    } else {
        $resultat = "Perdu";
        $points = -5; 
    }

    $sqlUpdate = "UPDATE utilisateur SET coins = coins + $points WHERE IdUtilisateur = $userId";
    if ($pdo->query($sqlUpdate)) {
    } else {
 
    }

    $gameName = "Pile ou Face";
    $sqlInsert = "INSERT INTO games_history (IdJoueur, GameName, Resultat, Points) VALUES ($userId, '$gameName', '$resultat', $points)";
    if ($pdo->query($sqlInsert)) {

    } else {

    }
}
?>

<form method="post" action="">
    <input type="radio" id="pile" name="choix" value="0" class="inputPoF" required>
    <label for="pile">Pile</label>

    <input type="radio" id="face" name="choix" value="1" class="inputPoF" required>
    <label for="face">Face</label>

    <div class="resultPoF">Votre choix : <?php echo $choixUtilisateurTexte; ?></div>
    <div class="resultPoF">Pièce : <?php echo $choixOrdinateurTexte; ?></div>
    <div class="resultPoF"><?php echo $resultat; ?></div>
    <button type="submit" class="buttonPoF">Lancer</button>
</form>
</div>
<div>
    <a style="position: relative;" href="jeux.php" ><button class="buttonPoF">Quitter</button></a>
</div>
</body>
</html>