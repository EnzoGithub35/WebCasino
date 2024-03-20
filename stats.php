<?php
include 'config.php';
$playerName = $_POST['pseudo'];
$IdJoueur = $_POST['IdJoueur'];
$score = $_POST['coins'];


$sql = "INSERT INTO utilisateur (score) VALUES ($score)";

if ($conn->query($sql) === TRUE) {
    echo "Score enregistré avec succès";
} else {
    echo "Erreur: " . $sql . "<br>" . $conn->error;
}

// Fermer la connexion à la base de données
$conn->close();
?>
