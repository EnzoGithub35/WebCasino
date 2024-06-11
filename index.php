<?php
include_once "config.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<body class="body">
<?php include_once "accueil.php"; ?>
  </body>

<?php include_once "footer.php"; ?>


</html>
