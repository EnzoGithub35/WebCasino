<?php

session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $playerScore = (int)$_POST['playerScore'];
    $dealerScore = (int)$_POST['dealerScore'];
    $id = (int)$_GET['id'];
    

    if ($playerScore > $dealerScore && $playerScore <= 21) {
        $stmt = $pdo->prepare("INSERT INTO games_history (IdJoueur, GameName, Resultat, Points) VALUES (?, 'Blackjack', 'Victoire', '+5')");
        $stmt->execute([$id]);
        
    } 
    
    if ($playerScore < $dealerScore || $playerScore > 21) {
        $stmt = $pdo->prepare("INSERT INTO games_history (IdJoueur, GameName, Resultat, Points) VALUES (?, 'Blackjack', 'Defaite', '-5')");
        $stmt->execute([$id]);
    }
}

?>