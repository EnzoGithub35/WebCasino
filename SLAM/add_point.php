

<?php

include 'config.php';

// Incrémenter le score dans la base de données


// Récupérer le nouveau score
$result = $connexion->query("SELECT score FROM points WHERE id = 1");
$row = $result->fetch_assoc();
$score = $row['score'];

$sql = "UPDATE points SET score = score + 1 WHERE id = 1";
$connexion->query($sql);

// Fermer la connexion
$connexion->close();

// Retourner le nouveau score
echo $score;
?>



    
