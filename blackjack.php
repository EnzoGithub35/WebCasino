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

<header style="width: 100%;">
    <div class="topnav" id="myTopnav">
    <a href="index.php" class="current-page">Accueil</a>
        <?php if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) : ?>
            <a onclick="myFunction2()" class="dropbtn">Jeux</a>
            <div id="myDropdown" class="dropdown-content">
                <a href="jeux.php">Page des jeux</a>
                <a href="blackjack_test.php">Blackjack</a>
                <a href="shifumi.php">Shifumi</a>
                <a href="Pile_ou_face.php">Pile ou Face</a>
            </div>

            
            <span id="user-info" class="user-info">
                <?php
                $sql = "SELECT pseudo FROM utilisateur WHERE IdUtilisateur = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":id", $_SESSION["id"], PDO::PARAM_INT);
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);


                ?>
            </span>

 
            
        <?php else : ?>
            <a href="connexion.php">Connexion</a>
            <a href="inscription.php">Inscription</a>
        <?php endif; ?>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
            <i class="fa fa-bars"></i>
        </a>
    </div>
</header>
<script src="script.js"></script>




<?php
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    $sql = "SELECT pseudo, email FROM utilisateur WHERE IdUtilisateur = :id";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id", $_SESSION["id"], PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row) {
            echo '<button id="btn-message" class="button-message">
            <div class="content-avatar">
                <div class="status-user"></div>
                <div class="avatar">
                    <svg class="user-img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12,12.5c-3.04,0-5.5,1.73-5.5,3.5s2.46,3.5,5.5,3.5,5.5-1.73,5.5-3.5-2.46-3.5-5.5-3.5Zm0-.5c1.66,0,3-1.34,3-3s-1.34-3-3-3-3,1.34-3,3,1.34,3,3,3Z"></path></svg>
                </div>
            </div>
            <div class="notice-content">
                <a href="statistiques.php"> <div  class="username">Statistiques</div> </a>
                <div class="lable-message">' . $row["pseudo"] . '<span class="number-message">3</span></div>
                <div class="user-id"></div>
            </div>
        </button>';
        }
    } catch(PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
} else {
    echo '<button id="btn-message" class="button-message">
    <div class="content-avatar">
        <div class="status-user"></div>
        <div class="avatar">
            <svg class="user-img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12,12.5c-3.04,0-5.5,1.73-5.5,3.5s2.46,3.5,5.5,3.5,5.5-1.73,5.5-3.5-2.46-3.5-5.5-3.5Zm0-.5c1.66,0,3-1.34,3-3s-1.34-3-3-3-3,1.34-3,3,1.34,3,3,3Z"></path></svg>
        </div>
    </div>
    <div class="notice-content">
        <div class="username">Connectez vous</div>
        <div class="lable-message">Déconnecté<span class="number-message">3</span></div>
        <div class="user-id">svp</div>
    </div>
</button>';
}
?>

<?php if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) : ?>
<a href="deconnexion.php">
                <button class="connectBtn">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 640 512" fill="white"><path d="M579.8 267.7c56.5-56.5 56.5-148 0-204.5c-50-50-128.8-56.5-186.3-15.4l-1.6 1.1c-14.4 10.3-17.7 30.3-7.4 44.6s30.3 17.7 44.6 7.4l1.6-1.1c32.1-22.9 76-19.3 103.8 8.6c31.5 31.5 31.5 82.5 0 114L422.3 334.8c-31.5 31.5-82.5 31.5-114 0c-27.9-27.9-31.5-71.8-8.6-103.8l1.1-1.6c10.3-14.4 6.9-34.4-7.4-44.6s-34.4-6.9-44.6 7.4l-1.1 1.6C206.5 251.2 213 330 263 380c56.5 56.5 148 56.5 204.5 0L579.8 267.7zM60.2 244.3c-56.5 56.5-56.5 148 0 204.5c50 50 128.8 56.5 186.3 15.4l1.6-1.1c14.4-10.3 17.7-30.3 7.4-44.6s-30.3-17.7-44.6-7.4l-1.6 1.1c-32.1 22.9-76 19.3-103.8-8.6C74 372 74 321 105.5 289.5L217.7 177.2c31.5-31.5 82.5-31.5 114 0c27.9 27.9 31.5 71.8 8.6 103.9l-1.1 1.6c-10.3 14.4-6.9 34.4 7.4 44.6s34.4 6.9 44.6-7.4l1.1-1.6C433.5 260.8 427 182 377 132c-56.5-56.5-148-56.5-204.5 0L60.2 244.3z"></path></svg>
                Déconnexion
            </button></a>
            
            <?php endif; ?>


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
        '<div class="croupier">Croupier</div> : ' + dealerCardString +  '|' +
        '<div class="vous">Vous</div>' + playerCardString;

        var croupier = document.querySelector('.croupier');
        croupier.style.position = 'absolute';
        croupier.style.left = '25vw';
        croupier.style.top = '15vh';
        croupier.style.transform = 'translateX(-50%)';
        croupier.style.textAlign = 'center';

        var vous = document.querySelector('.vous');
        vous.style.position = 'absolute';
        vous.style.right = '20vw';
        vous.style.top = '15vh';
        vous.style.transform = 'translateX(-50%)';
        vous.style.textAlign = 'center';

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
