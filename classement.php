<?php
include_once "config.php";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Classement</title>
</head>
<body>
<?php include_once "navbar.php"; ?>

<h1>Top 10 des joueurs avec le plus de coins</h1>

<table>
    <thead>
        <tr>
            <th>Position</th>
            <th>Pseudo</th>
            <th>Coins</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Requête SQL pour sélectionner les 10 joueurs avec le plus de coins
        $requete_coins = "SELECT pseudo, coins FROM utilisateur ORDER BY coins DESC LIMIT 10";
        $resultat_coins = $conn->query($requete_coins);

        // Variable pour suivre la position
        $position_coins = 1;

        // Vérifier si des résultats ont été trouvés
        if ($resultat_coins->num_rows > 0) {
            // Afficher les résultats
            while($row_coins = $resultat_coins->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $position_coins . "</td>";
                echo "<td style='text-align: center'>" . $row_coins["pseudo"] . "</td>";
                echo "<td style='text-align: right'>" . $row_coins["coins"] . "</td>";
                echo "</tr>";
                $position_coins++;
            }
        } else {
            echo "<tr><td colspan='3'>Aucun joueur avec des coins trouvé.</td></tr>";
        }

        // Libérer le résultat de la mémoire
        $resultat_coins->free();
        ?>
    </tbody>
</table>

<h1>Top 10 des joueurs de Blackjack avec le plus de victoires</h1>

<table >
    <thead>
        <tr>
            <th>Position</th>
            <th>Pseudo</th>
            <th>Victoires</th>
        </tr>
    </thead>
    <tbody>
    <?php
// Requête SQL pour sélectionner les 10 meilleurs joueurs de Blackjack
$requete_blackjack = "SELECT U.pseudo, U.coins, COUNT(GH.Resultat) AS NbVictoire
                      FROM utilisateur U
                      JOIN games_history GH ON U.IdUtilisateur = GH.IdJoueur
                      WHERE GH.GameName = 'Blackjack' AND GH.Resultat = 'Gagné'
                      GROUP BY U.IdUtilisateur
                      ORDER BY NbVictoire DESC
                      LIMIT 10";
$resultat_blackjack = $conn->query($requete_blackjack);

// Variable pour suivre la position
$position_blackjack = 1;

// Vérifier si des résultats ont été trouvés
if ($resultat_blackjack->num_rows > 0) {
    // Afficher les résultats
    while($row_blackjack = $resultat_blackjack->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $position_blackjack . "</td>";
        echo "<td style='text-align: center'>" . $row_blackjack["pseudo"] . "</td>";
        echo "<td style='text-align: right'>" . $row_blackjack["NbVictoire"] . "</td>";
        echo "</tr>";
        $position_blackjack++;
    }
} else {
    echo "<tr><td colspan='4'>Aucun joueur de Blackjack trouvé.</td></tr>";
}

// Libérer le résultat de la mémoire
$resultat_blackjack->free();
?>
    </tbody>
</table>

<h1>Top 10 des joueurs de Shifumi avec le plus de victoires</h1>

<table>
    <thead>
        <tr>
            <th>Position</th>
            <th>Pseudo</th>
            <th>Victoires</th>
        </tr>
    </thead>
    <tbody>
    <?php
    // Requête SQL pour sélectionner les 10 meilleurs joueurs de Shifumi
    $requete_shifumi = "SELECT U.pseudo, U.coins, COUNT(GH.Resultat) AS NbVictoire
                      FROM utilisateur U
                      JOIN games_history GH ON U.IdUtilisateur = GH.IdJoueur
                      WHERE GH.GameName = 'Shifumi' AND GH.Resultat = 'Victoire'
                      GROUP BY U.IdUtilisateur
                      ORDER BY NbVictoire DESC
                      LIMIT 10";
    $resultat_shifumi = $conn->query($requete_shifumi);

    // Variable pour suivre la position
    $position_shifumi = 1;

    // Vérifier si des résultats ont été trouvés
    if ($resultat_shifumi->num_rows > 0) {
        // Afficher les résultats
        while($row_shifumi = $resultat_shifumi->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $position_shifumi . "</td>";
            echo "<td style='text-align: center'>" . $row_shifumi["pseudo"] . "</td>";
            echo "<td style='text-align: right'>" . $row_shifumi["NbVictoire"] . "</td>";
            echo "</tr>";
            $position_shifumi++;
        }
    } else {
        echo "<tr><td colspan='3'>Aucun joueur de Shifumi trouvé.</td></tr>";
    }

    // Libérer le résultat de la mémoire
    $resultat_shifumi->free();
    ?>
    </tbody>
</table>

<h1>Top 10 des joueurs de Pile ou Face avec le plus de victoires</h1>

<table>
    <thead>
        <tr>
            <th>Position</th>
            <th>Pseudo</th>
            <th>Victoires</th>
        </tr>
    </thead>
    <tbody>
    <?php
    // Requête SQL pour sélectionner les 10 meilleurs joueurs de Pile ou Face
    $requete_pile_ou_face = "SELECT U.pseudo, U.coins, COUNT(GH.Resultat) AS NbVictoire
                      FROM utilisateur U
                      JOIN games_history GH ON U.IdUtilisateur = GH.IdJoueur
                      WHERE GH.GameName = 'Pile ou Face' AND GH.Resultat = 'Gagné'
                      GROUP BY U.IdUtilisateur
                      ORDER BY NbVictoire DESC
                      LIMIT 10";
    $resultat_pile_ou_face = $conn->query($requete_pile_ou_face);

    // Variable pour suivre la position
    $position_pile_ou_face = 1;

    // Vérifier si des résultats ont été trouvés
    if ($resultat_pile_ou_face->num_rows > 0) {
        // Afficher les résultats
        while($row_pile_ou_face = $resultat_pile_ou_face->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $position_pile_ou_face . "</td>";
            echo "<td style='text-align: center'>" . $row_pile_ou_face["pseudo"] . "</td>";
            echo "<td style='text-align: right'>" . $row_pile_ou_face["NbVictoire"] . "</td>";
            echo "</tr>";
            $position_pile_ou_face++;
        }
    } else {
        echo "<tr><td colspan='3'>Aucun joueur de Pile ou Face trouvé.</td></tr>";
    }

    // Libérer le résultat de la mémoire
    $resultat_pile_ou_face->free();
    ?>
    </tbody>
</table>


</body>
</html>
