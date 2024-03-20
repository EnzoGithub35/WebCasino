<?php
$serveur = "localhost";
$utilisateur = "root";
$motdepasse = "";
$basededonnees = "casino";
$charset = 'utf8mb4';

$dsn = "mysql:host=$serveur;dbname=$basededonnees;charset=$charset";
$conn = new mysqli($serveur, $utilisateur, $motdepasse, $basededonnees);

$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $utilisateur, $motdepasse, $opt);

if ($conn->connect_error) {
    die("Échec de la connexion à la base de données : " . $conn->connect_error);
}







