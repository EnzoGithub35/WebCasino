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
<?php include_once "navbar.php"; ?>
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
            <h3 class="title"> Blackjack <p  style="font-size:small"> (en JavaScript)</p> </h3>
            
            <span class="test_link">Jouez</span>
          </div>
        </a>
      </div>
    </div>
    <div class="test_box box-02 col-xs-6 col-md-4">
      <div class="inner">
        <a href="shifumi.php" class="test_click box-image-2">
          <div class="flex_this">
            <h3 class="title"> Shifumi</h3>
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
        <a href="profil.php" class="test_click box-image-6">
          <div class="flex_this">
            <h3 class="title"> profil </h3>
            <span class="test_link">Jouez</span>
          </div>
        </a>
      </div>
    </div>
  </div>
</div>
</body>
</html>