<?php
$serveur = "bdd.wouafwouaf.ovh";
$utilisateur = "wouafwouaf_casino";
$mdp = "!2jSKgjU05HvN6TA";
$basededonnees = "casino";
$charset = 'utf8mb4';

$dsn = "mysql:host=$serveur;dbname=$basededonnees;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

// Créer une connexion PDO
try {
    $pdo = new PDO($dsn, $utilisateur, $mdp, $opt);
} catch (PDOException $e) {
    die("Échec de la connexion à la base de données : " . $e->getMessage());
}
?>