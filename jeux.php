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