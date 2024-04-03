<?php
include_once "config.php";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<header style="width: 100%;">
    <div class="topnav" id="myTopnav">
    <a href="index.php" class="current-page">Accueil</a>
        <?php if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) : ?>
            <a onclick="myFunction2()" class="dropbtn">Jeux</a>
            <div id="myDropdown" class="dropdown-content">
                <a href="jeux.php">Page des jeux</a>
                <a href="blackjack.php">Blackjack</a>
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
            <a href="connexion_test.php">Connexion TEST</a>
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
    $sql = "SELECT pseudo, email, coins FROM utilisateur WHERE IdUtilisateur = :id";
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
                <a href="statistiques.php"><div  class="username">Statistiques</div> </a>
                <div class="lable-message">' . $row["pseudo"] . '<span class="number-message">' . $row["coins"] . '</span></div>
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
        <div class="lable-message">Déconnecté<span class="number-message"></span></div>
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
<body style="background-color: #333;">
<main>
</main>
    <div class="row">
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'>
  <div class="grid-container">
    <div class="test_box box-01 col-xs-6 col-md-4">
      <div class="inner">
        <a href="blackjack.php" class="test_click box-image-1">
          <div class="flex_this ">
            <h3 class="title"> Blackjack</h3>
            <span class="test_link">Jouez</span>
          </div>
        </a>
      </div>
    </div>
    <div class="test_box box-02 col-xs-6 col-md-4">
      <div class="inner">
        <a href="shifumi.php" class="test_click box-image-2">
          <div class="flex_this">
            <h3 class="title"> shifumi</h3>
            <span class="test_link">Jouez</span>
          </div>
        </a>
      </div>
    </div>
    <div class="test_box box-03 col-xs-6 col-md-4">
      <div class="inner">
        <a href="Pile_ou_face.php" class="test_click box-image-3">
          <div class="flex_this">
            <h3 class="title"> Pile ou face</h3>
            <span class="test_link">Jouez</span>
          </div>
        </a>
      </div>
    </div>
    <div class="test_box box-04 col-xs-6 col-md-4">
      <div class="inner">
        <a href="index.php" class="test_click box-image-4">
          <div class="flex_this">
            <h3 class="title"> Accueil</h3>
            <span class="test_link">Jouez</span>
          </div>
        </a>
      </div>
    </div>
    <div class="test_box box-05 col-xs-6 col-md-4">
      <div class="inner">
        <a href="blackjack_test.php" class="test_click box-image-5">
          <div class="flex_this">
            <h3 class="title"> test BJ</h3>
            <span class="test_link">Jouez</span>
          </div>
        </a>
      </div>
    </div>
    <div class="test_box box-06 col-xs-6 col-md-4">
      <div class="inner">
        <a href="utiles.html" class="test_click box-image-6">
          <div class="flex_this">
            <h3 class="title"> tttt</h3>
            <span class="test_link">Jouez</span>
          </div>
        </a>
      </div>
    </div>
  </div>
</div>
</body>
</html>