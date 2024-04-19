<?php
include_once "config.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

?>

<!DOCTYPE html>
<html lang="fr" data-bs-theme="auto">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <link rel="stylesheet" href="./style.css">
    <title>Accueil</title>
</head>
<body>

<?php include_once "navbar.php"; ?>


<div id="game-container">

  <button onclick="startGame()">Lancer la partie</button>
  <div id="game-result"></div>

  <div id="result">
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
        '<div class="croupier">Croupier :</div> ' + dealerCardString +  '|' +
        '<div class="vous">Vous :</div>' + playerCardString;

        var croupier = document.querySelector('.croupier');
        croupier.style.position = 'absolute';
        croupier.style.left = '18vw';
        croupier.style.top = '12vh';
        croupier.style.transform = 'translateX(-50%)';
        croupier.style.textAlign = 'center';
        croupier.style.fontSize = '2rem';

        var vous = document.querySelector('.vous');
        vous.style.position = 'absolute';
        vous.style.right = '18vw';
        vous.style.top = '12vh';
        vous.style.transform = 'translateX(-50%)';
        vous.style.textAlign = 'center';
        vous.style.fontSize = '2rem';

  if (gameOver) {
    if (playerWon) {
        document.getElementById('result').innerHTML += "<div class='resultat'>Victoire !</div>";
        sendScoresToServer();
    } else {
        document.getElementById('result').innerHTML += "<div class='resultat'>Défaite</div>";
        sendScoresToServer();
    }
    document.getElementById('result').innerHTML += '';
}
var resultatDiv = document.querySelector('.resultat');
resultatDiv.style.position = 'absolute';
resultatDiv.style.left = '50%';
resultatDiv.style.bottom = '25vh';
resultatDiv.style.transform = 'translateX(-50%)';
resultatDiv.style.textAlign = 'center';
resultatDiv.style.fontSize = '3rem';

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
    let points = playerWon ? (+5) : (-5); 
    let urlParams = new URLSearchParams(window.location.search);
    let gameId = urlParams.get('id'); 


    let data = {
        gameId: gameId,
        result: resultat,
        points: points
    };

   
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
