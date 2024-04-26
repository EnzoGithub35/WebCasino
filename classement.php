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

<h1>Top 50 des joueurs avec le plus de coins</h1>

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
        // Inclure le fichier de configuration avec les informations de connexion à la base de données
        include 'config.php';

        // Requête SQL pour sélectionner les joueurs avec le plus de coins (top 50)
        $requete = "SELECT pseudo, coins FROM utilisateur ORDER BY coins DESC LIMIT 50";
        $resultat = $conn->query($requete);

        // Variable pour suivre la position
        $position = 1;

        // Vérifier si des résultats ont été trouvés
        if ($resultat->num_rows > 0) {
            // Afficher les résultats
            while($row = $resultat->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $position . "</td>";
                echo "<td>" . $row["pseudo"] . "</td>";
                echo "<td>" . $row["coins"] . "</td>";
                echo "</tr>";
                $position++;
            }
        } else {
            echo "<tr><td colspan='3'>Aucun joueur trouvé.</td></tr>";
        }

        // Libérer le résultat de la mémoire
        $resultat->free();

        // Fermer la connexion à la base de données
        $conn->close();
        ?>
    </tbody>
</table>

</body>
</html>
