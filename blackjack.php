<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <title>Blackjack Game</title>
</head>
<body>

<style>
body {
    background-color: #333;
    color: #fff;
    font-family: "Muli", sans-serif;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    overflow: auto;
    position: relative;
    width: 100%;
}

#game-container {
  width: 97vw;
  height: 75vh;
  text-align: center;
  background-color: #121212;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 0 10px #F4bc5b;
  position: relative; /* Permet de positionner les boutons enfants correctement */
}

h1 {
  font-size: 36px;
  margin-bottom: 20px;
}

button {
  background-color: #F4bc5b;
  color: #fff;
  border: none;
  border-radius: 5px;
  padding: 10px 20px;
  font-size: 18px;
  margin: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

button:hover {
  background-color: #Fabc5b;
}

#result {
  display: flex;
  justify-content: space-between;
  align-items: center;
  height: 60%;
  margin: 20px 0;
}

#player-section {
  text-align: right; /* Pour afficher les cartes du joueur à droite */
}

#dealer-section {
  text-align: left; /* Pour afficher les cartes du croupier à gauche */
}

#player-cards img,
#dealer-cards img {
  width: 100px;
  margin: 0 10px;
}

.white {
  color: #fff;
}

.action-buttons {
position: absolute;
bottom: 80px; /* Ajustez cette valeur selon vos besoins */
left: 50%;
transform: translateX(-50%);
}

#retour-btn {
position: absolute;  
bottom: 20px;
left: 50%;
transform: translateX(-50%);
}

.card-img {
  width: 15%; /* Taille des cartes en pourcentage de la largeur de l'écran */
  max-width: 100px; /* Taille maximale des cartes */
  height: auto; /* Hauteur automatique pour conserver les proportions */
}

@media screen and (max-width: 600px) {
  #dealer-cards {
    flex-direction: row; /* Affichage des cartes du croupier en ligne */
    align-items: center; /* Alignement des cartes du croupier au centre */
    margin-bottom: 20px; /* Espacement entre les cartes du croupier et du joueur */
  }

  #player-cards {
    flex-direction: row; /* Affichage des cartes du joueur en ligne */
    align-items: center; /* Alignement des cartes du joueur au centre */
    margin-top: 20px; /* Espacement entre les cartes du croupier et du joueur */
  }

#player-cards img,
#dealer-cards img {
  width: 20px;
  height: 30px;
  margin: 0 10px;
}
}
</style>

<header style="width: 100%;">

    <div class="topnav" id="myTopnav">
        <a href="index.php" >Accueil</a>
        <a onclick="myFunction2()" class="dropbtn current-page">Jeux</a>
        <div id="myDropdown" class="dropdown-content">
            <a href="blackjack_test.php">Blackjack</a>
            <a href="shifumi.php">Shifumi</a>
            <a href="Pile_ou_face.php">Pile ou Face</a>
        </div>
        <?php
            include_once "config.php"; // Inclure le fichier de configuration
            session_start();

            // Vérifier si l'utilisateur est connecté
            if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
                // Requête pour récupérer le pseudo de l'utilisateur connecté depuis la base de données
                $sql = "SELECT pseudo FROM utilisateur WHERE IdUtilisateur = :id";

                try {
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(":id", $_SESSION["id"], PDO::PARAM_INT);
                    $stmt->execute();
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);

                    if($row) {
                        // Afficher le pseudo de l'utilisateur
                        echo "<span id='user-info' class='user-info'>Connecté en tant que : " . $row['pseudo'] . "</span>";
                    }
                } catch(PDOException $e) {
                    echo "Erreur : " . $e->getMessage();
                }
            } else {
                // Si l'utilisateur n'est pas connecté
                echo "<span id='user-info' class='user-info'>Non connecté</span>";
            }
        ?>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
            <i class="fa fa-bars"></i>
        </a>
    </div>
</header>

<script src="script.js"></script>


<div id="game-container">

  <button onclick="startGame()">Lancer la partie</button>

  <div id="result">
    <div id="player-section">
      <h2 style="text-align: right;">Vos cartes :</h2>
      <div id="player-cards"></div> <!-- Div pour les cartes du joueur -->
    </div>
    <div id="dealer-section">
      <h2 style="text-align: left;">Cartes du croupier :</h2>
      <div id="dealer-cards"></div> <!-- Div pour les cartes du croupier -->
    </div>
  </div>

  <div class="action-buttons">
    <button onclick="hit()">Hit</button>
    <button onclick="stand()">Stand</button>
  </div>
</div>

<a id="retour-btn" href="jeux.php"> <button> retour </button>

<script>
  let deck = [];
  let playerCards = [];
  let dealerCards = [];
  let gameStarted = false;
  let gameOver = false;
  let playerWon = false;

  function createDeck() {
    let suits = ['de_Coeur', 'de_Carreaux', 'de_Trefles', 'de_Pique'];
    let values = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'as'];
    deck = [];

    for (let suit of suits) {
      for (let value of values) {
        let card = {
          suit: suit,
          value: value
        };
        deck.push(card);
      }
    }
  }

  function shuffleDeck() {
    for (let i = deck.length - 1; i > 0; i--) {
      const j = Math.floor(Math.random() * (i + 1));
      [deck[i], deck[j]] = [deck[j], deck[i]];
    }
  }

  function getCardNumericValue(card) {
    switch (card.value) {
      case 'J':
      case 'Q':
      case 'K':
        return 10;
      case 'as':
        return 11;
      default:
        return parseInt(card.value);
    }
  }

  function getScore(cards) {
    let score = 0;
    let hasAce = false;

    for (let card of cards) {
      const cardValue = getCardNumericValue(card);
      score += cardValue;

      if (cardValue === 11) {
        hasAce = true;
      }
    }

    if (hasAce && score > 21) {
      score -= 10;
    }

    return score;
  }

  function updateScores() {
    let dealerScore = getScore(dealerCards);
    let playerScore = getScore(playerCards);

    if (playerScore > 21) {
      playerWon = false;
      gameOver = true;
    } else if (dealerScore > 21) {
      playerWon = true;
      gameOver = true;
    } else if (gameOver) {
      if (playerScore > dealerScore) {
        playerWon = true;
      } else {
        playerWon = false;
      }
    }
  }

  function getCardImage(card) {
    return `images/${card.value}_${card.suit}.png`;
}

function showStatus() {
    if (!gameStarted) {
        return;
    }

    updateScores();

    let dealerCardString = '';
    for (let card of dealerCards) {
        dealerCardString += `<img src="${getCardImage(card)}" class="card-img">`;
    }

    let playerCardString = '';
    for (let card of playerCards) {
        playerCardString += `<img src="${getCardImage(card)}" class="card-img">`;
    }

    document.getElementById('result').innerHTML =
        'Carte du croupier : ' + dealerCardString + '<br>' +
        'Vos cartes : ' + playerCardString + '<br><br>';

    if (gameOver) {
        if (playerWon) {
            document.getElementById('result').innerHTML += '<div>Vous avez gagné !</div>';
            sendScoresToServer();
        } else {
            document.getElementById('result').innerHTML += '<div>Le croupier a gagné.</div>';
            sendScoresToServer();
        }
        document.getElementById('result').innerHTML += '<br>Appuyez sur "Lancer la partie" pour recommencer.';
    }
}

  function startGame() {
    gameStarted = true;
    gameOver = false;
    playerWon = false;

    createDeck();
    shuffleDeck();

    playerCards = [getNextCard(), getNextCard()];
    dealerCards = [getNextCard(), getNextCard()];

    showStatus();
  }

  function getNextCard() {
    return deck.shift();
  }

  function hit() {
    if (gameStarted && !gameOver) {
      playerCards.push(getNextCard());
      showStatus();
    }
  }

  function stand() {
    if (gameStarted && !gameOver) {
      while (getScore(dealerCards) < getScore(playerCards)) {
        dealerCards.push(getNextCard());
      }

      gameOver = true;
      showStatus();
    }
  }

  function sendScoresToServer() {
    let resultat = playerWon ? 'Gagné' : 'Perdu';
    let points = playerWon ? (5) : (-5); // Ajoute ou soustrait 5 points en fonction du résultat
    let urlParams = new URLSearchParams(window.location.search);
    let gameId = urlParams.get('id'); // Vous  devez définir la logique pour obtenir l'ID de la partie en cours

    // Créez un objet contenant les données à envoyer
    let data = {
        gameId: gameId,
        result: resultat,
        points: points
    };

    // Effectuez une requête AJAX pour envoyer les données au serveur
    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'traitement_score.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                console.log('Scores envoyés avec succès !');
            } else {
                console.error('Une erreur s\'est produite lors de l\'envoi des scores.');
            }
        }
    };
    xhr.send(JSON.stringify(data));
}
</script>

</body>
</html>
