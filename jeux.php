<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body style="background-color: #333;">
<main>
<h1> <span id="score"></span></h1>
    <button id="addPointBtn">Ajouter un point</button>

    <script>
        document.getElementById('addPointBtn').addEventListener('click', function() {
            // Effectuer une requête AJAX pour incrémenter le score côté serveur
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'add_point.php', true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Mettre à jour l'affichage du score côté client
                    document.getElementById('score').innerText = xhr.responseText;
                }
            };
            xhr.send();
        });
    </script>

</main>

    <div class="row">
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'>
  <div class="grid-container">
    <div class="test_box box-01 col-xs-6 col-md-4">
      <div class="inner">
        <a href="blackjack_test.php?id=<?=$_GET['id']?>" class="test_click box-image-1">
          
          <div class="flex_this ">
            <h3 class="title"> Blackjack</h3>
            <span class="test_link">Jouez</span>
            
          </div>
        </a>
      </div>
    </div>
    <div class="test_box box-02 col-xs-6 col-md-4">
      <div class="inner">
        <a href="shifumi.php?id=<?=$_GET['id']?>" class="test_click box-image-2">
          
          <div class="flex_this">
            <h3 class="title"> shifumi</h3>
            <span class="test_link">Jouez</span>
          </div>
        </a>
      </div>
    </div>
    <div class="test_box box-03 col-xs-6 col-md-4">
      <div class="inner">
        <a href="Pile_ou_face.php?id=<?=$_GET['id']?>" class="test_click box-image-3">
          <div class="flex_this">
            <h3 class="title"> Pile ou face</h3>
            <span class="test_link">Jouez</span>
          </div>
        </a>
      </div>
    </div>
    <div class="test_box box-04 col-xs-6 col-md-4">
      <div class="inner">
        <a href="index.html" class="test_click box-image-4">
          <div class="flex_this">
            <h3 class="title"> Accueil</h3>
            <span class="test_link">Jouez</span>
          </div>
        </a>
      </div>
    </div>
    <div class="test_box box-05 col-xs-6 col-md-4">
      <div class="inner">
        <a href="blackjack.php?id=<?=$_GET['id']?>" class="test_click box-image-5">
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

    

<?php
// Vérifier si le paramètre "index" est défini dans la requête GET
if (isset($_GET['index'])) {
    // Détruire la session
    session_start();
    session_unset();
    session_destroy();
    // Rediriger vers la page d'index
    header("Location: index.html");
    exit;
}
?>
    
</body>
</html>