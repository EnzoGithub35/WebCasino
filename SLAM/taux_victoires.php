<?php

$NombreToursJoues = $_SESSION['tour_joues'];
$NombreToursGagne = $_SESSION['tour_gagne'];


if ($NombreToursJoues != 0) {
    $taux_victoires = ($NombreToursGagne / $NombreToursJoues) * 100;
}

$requete = "UPDATE user SET taux_victoires = ? WHERE pseudo = ?";
$stmt = $connexion->prepare($requete);
$stmt->bind_param("ds", $taux_victoires, $pseudo);
$stmt->execute();
$stmt->close();


?>