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



// Récupérez les données envoyées par JavaScript
$data = json_decode(file_get_contents('php://input'), true);
$sql = "SELECT NomJeu FROM GameName WHERE Id = 1";
$NomJeu = $conn->query($sql);

// Insérez les données dans la table 'games_history'
$stmt = $conn->prepare("INSERT INTO games_history (IdJoueur, GameName, Resultat, Points) VALUES (?, ?, ?, ?)");
$stmt->bind_param("isss", $idJoueur, $gameName, $resultat, $points);


// Vous devez définir l'ID du joueur et le nom du jeu ici
$idJoueur = $data['gameId']; // Remplacez 1 par l'ID du joueur réel
// Vérifier si la requête a renvoyé des résultats
if ($NomJeu->num_rows > 0) {
    // Parcourir les résultats et extraire le nom du jeu
    while($row = $NomJeu->fetch_assoc()) {
        $gameName = $row['NomJeu'];
    }
} else {
    // Si aucun résultat n'est trouvé, utiliser un nom par défaut
    $gameName = 'Nom par défaut';
}
$resultat = $data['result'];
$points = $data['points'];

$stmt->execute();

$stmt->close();
$conn->close();
?>