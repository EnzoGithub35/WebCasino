    <?php
    
    $serveur = "bdd.wouafwouaf.ovh";
    $utilisateur = "wouafwouaf_casino";
    $mdp = "!2jSKgjU05HvN6TA";
    $basededonnees = "wouafwouaf_casino";

    $conn = new mysqli($servername, $username, $password, $dbname);


    if ($conn->connect_error) {
        die("Connexion échouée: " . $conn->connect_error);
    }


    $data = json_decode(file_get_contents('php://input'), true);


    $idJoueur = null;


    session_start();
    if(isset($_SESSION['id'])){
        $idJoueur = $_SESSION['id'];
    } else {
        die("Erreur: Session non trouvée.");
    }

    $stmt = $conn->prepare("INSERT INTO games_history (IdJoueur, GameName, Resultat, Points) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $idJoueur, $gameName, $resultat, $points);

    $gameName = 'Blackjack'; 

    $resultat = $data['result'];
    $points = $data['points'];
    $sqlUpdate = "UPDATE utilisateur SET coins = coins + ? WHERE IdUtilisateur = ?";
    $stmtUpdate = $conn->prepare($sqlUpdate);
    $stmtUpdate->execute([$points, $idJoueur]);

    $stmt->execute();

    $stmt->close();
    $conn->close();
    ?>