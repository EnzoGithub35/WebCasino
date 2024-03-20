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
      font-family: Arial, sans-serif;
      background-color: #333;
      color: #fff;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    #game-container {
      width: 50vw;
      height: 50vh;
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
      margin: 20px 0;
    }

    #cards {
      display: flex;
      justify-content: center;
      margin-bottom: 20px;
    }

    #cards img {
      width: 100px;
      margin: 0 10px;
    }

    .white {
      color: #fff;
    }

    .action-buttons {
      position: absolute;
      bottom: 20px;
      left: 50%;
      transform: translateX(-50%);
    }

    #retour-btn {
      position: fixed;
      bottom: 20px;
      left: 50%;
      transform: translateX(-50%);
    }
  </style>

<div id="game-container">
  <h1>Blackjack Game</h1>

  <button onclick="startGame()">Lancer la partie</button>

  <div id="result"></div>

  <div id="cards"></div>

  <div class="action-buttons">
    <button onclick="hit()">Hit</button>
    <button onclick="stand()">Stand</button>
  </div>
</div>

<a id="retour-btn" href="jeux.php?id=<?=$_GET['id']?>"> <button> retour </button>




<script>
  
  let deck = [];
  let playerCards = [];
  let dealerCards = [];
  let gameStarted = false;
  let gameOver = false;
  let playerWon = false;

  function createDeck() {
    let suits = ['de Coeur', 'de Carreaux', 'de Trèfle', 'de Piques'];
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
        return 10
      case 'Q':
        return 10
      case 'K':
        return 10
      case 'as':
        return 11;
      case '2':
      case '3':
      case '4':
      case '5':
      case '6':
      case '7':
      case '8':
      case '9':
      case '10':
        return parseInt(card.value);
      default:
        return 0;
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
    score -= 10; // Réduit la valeur de l'As à 1 si nécessaire pour éviter de dépasser 21
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

  function showStatus() {
    if (!gameStarted) {
      return;
    }

    updateScores();

    let dealerCardString = '';
    for (let card of dealerCards) {
      dealerCardString += card.value + ' ' + card.suit + ' | ';
    }

    let playerCardString = '';
    for (let card of playerCards) {
      playerCardString += card.value + ' ' + card.suit + ' | ';
    }

    document.getElementById('result').innerHTML =
      'Carte du croupier : ' + dealerCardString + '<br>' +
      'Carte du joueur : ' + playerCardString + '<br><br>';

    if (gameOver) {
      if (playerWon) {
        document.getElementById('result').innerHTML += '<div> vous avez gagné! </div>';
        sendScoresToServer();
      } else {
        document.getElementById('result').innerHTML += '<div class="white"> Le croupier a gagné </div>';
        sendScoresToServer();
      }
      document.getElementById('result').innerHTML += '<br>appuyez sur "lancer la partie" pour recommencer.';
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