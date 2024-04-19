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

<style>
    .bgAccueil {
  
  background-image: url("images/BG1.webp");
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  min-height: 100%;
  min-width: 1024px;
	

  width: 100%;
  height: auto;

  position: fixed;
  top: 0;
  left: 0;
}
</style>

<?php include_once "navbar.php"; ?>

<div class="bgAccueil"></div>


</body>
</html>