<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "casino";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifiez la connexion
if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}

// Récupérer les données envoyées par JavaScript
$data = json_decode(file_get_contents('php://input'), true);

// Initialiser l'ID du joueur
$idJoueur = null;

// Vérifier si la session est active
session_start();
if(isset($_SESSION['id'])){
    $idJoueur = $_SESSION['id'];
} else {
    // Si la session n'est pas active ou si l'ID n'est pas disponible, vous pouvez gérer cette situation en envoyant une erreur ou en utilisant une valeur par défaut
    die("Erreur: Session non trouvée.");
}

// Insérer les données dans la table 'games_history'
$stmt = $conn->prepare("INSERT INTO games_history (IdJoueur, GameName, Resultat, Points) VALUES (?, ?, ?, ?)");
$stmt->bind_param("isss", $idJoueur, $gameName, $resultat, $points);

// Récupérer le nom du jeu (peut-être à partir d'une autre table ou une valeur par défaut)
$gameName = 'Blackjack'; // Mettez le nom du jeu ici

$resultat = $data['result'];
$points = $data['points'];

$stmt->execute();

$stmt->close();
$conn->close();
?>