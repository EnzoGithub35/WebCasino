<?php
include_once "config.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['id'])) {
    header("Location: erreur.php");
    exit;
}

$resultat = "";
$points = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $options = ["pierre", "feuille", "ciseaux"];
    $ordinateur = $options[array_rand($options)];
    $joueur = $_POST["choix"];

    if ($joueur == $ordinateur) {
        $resultat = "Égalité";
    } elseif (($joueur == "pierre" && $ordinateur == "ciseaux") ||
              ($joueur == "feuille" && $ordinateur == "pierre") ||
              ($joueur == "ciseaux" && $ordinateur == "feuille")) {
        $resultat = "Victoire";
        $points = 5;
    } else {
        $resultat = "Défaite";
        $points = -5;
    }

    $idJoueur = $_SESSION['id'];
    $gameName = 'Shifumi'; 

    $stmt = $pdo->prepare("INSERT INTO games_history (IdJoueur, GameName, Resultat, Points) VALUES (?, ?, ?, ?)");
    $stmt->execute([$idJoueur, $gameName, $resultat, $points]);

    $sqlUpdate = "UPDATE utilisateur SET coins = coins + ? WHERE IdUtilisateur = ?";
    $stmtUpdate = $pdo->prepare($sqlUpdate);
    $stmtUpdate->execute([$points, $idJoueur]);
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

<?php include_once "navbar.php"; ?>

<div class="shifumi-container">
    <?php if (!isset($_POST['choix']) || empty($_POST['choix'])) : ?>
        <form method="post" action="shifumi.php">
            <strong><label for="choix">Choisissez votre coup :</label> </strong>
            <div class="bottom">
                <?php foreach (["pierre", "feuille", "ciseaux"] as $option) : ?>
                    <button class="btn_choix" type="submit" name="choix" value="<?= $option ?>">
                        <img src="images/<?= ucfirst($option) ?>.png" class="pfc-btn" alt="<?= $option ?>">
                    </button>
                <?php endforeach; ?>
            </div>
        </form>
    <?php else : ?>
        <p>Vous avez choisi : <?= $_POST['choix'] ?></p>
        <img src="images/<?= ucfirst($_POST['choix']) ?>.png" class="result-img" alt="<?= $_POST['choix'] ?>">

        <p>L'ordinateur a choisi : <?= $ordinateur ?></p>
        <img src="images/<?= ucfirst($ordinateur) ?>.png" class="result-img" alt="<?= $ordinateur ?>">

        <p><?= $resultat ?></p>
    <?php endif; ?>

    <div class="buttons-bottom">
        <?php if (isset($_POST['choix']) && !empty($_POST['choix'])) : ?>
            <div>
                <a href='jeux.php'><button>Retour</button></a>
                <a href='shifumi.php'><button>Rejouer</button></a>
            </div>
        <?php endif; ?>
    </div>
</div>


</body>
</html>
