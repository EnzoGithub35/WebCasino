<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pile ou Face</title>
</head>
<body>
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            height: 50vh;
            width: 50vw;
            background-color: #333;
            padding: 20px;
            border-radius: 10px;
            box-shadow:0 0 40px #F4bc5b;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            color: white;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        input[type="radio"] {
            display: none;
        }

        input[type="radio"] + label {
            display: inline-block;
            padding: 10px 20px;
            margin-right: 10px;
            border: 2px solid #ccc;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        input[type="radio"]:checked + label {
            background-color: #F4bc5b;
            color: black;
            border-color: #F4bc5b;
        }

        input[type="radio"] + label:hover {
            background-color: #F4bc5b;
        }

        input[type="radio"]:checked + label:hover {
            background-color: #eabc5b;
            color: #fff;
            
        }

        button[type="submit"] {
            margin: auto;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: orange;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: auto;
        }

        button[type="submit"]:hover {
            background-color: #f6bc5b;      
        }

        .result {
            font-weight: bold;
            margin-top: 20px;
            text-align: center;
        }
    </style>
    

    
    <?php
    $resultat = "Choisissez et lancez !";
    $choixUtilisateurTexte = "";
    $choixOrdinateurTexte   = "";
    // Vérification du formulaire soumis
    if(isset($_POST['choix'])){
        // Connexion à la base de données
        include 'config.php';
        

        // Récupérer l'ID de l'utilisateur (supposons que vous l'ayez déjà)
        $userId = $_GET['id']; // Mettez ici l'ID de l'utilisateur

        // Générer un choix aléatoire pour l'utilisateur (0 pour Pile, 1 pour Face)
        $choixUtilisateur = $_POST['choix'];

        // Générer un choix aléatoire pour l'ordinateur (0 pour Pile, 1 pour Face)
        $choixOrdinateur = rand(0, 1);

        // Définir les options du jeu
        $options = array("Pile", "Face");

        // Récupérer le choix de l'ordinateur
        $choixOrdinateurTexte = $options[$choixOrdinateur];
        $choixUtilisateurTexte = $options[$choixUtilisateur];

        // Comparer les choix et déterminer le résultat
        if ($choixUtilisateur == $choixOrdinateur) {
            $resultat = "Gagné";
            $points = 5;
            
        } else {
            $resultat = "Perdu";
            $points = -5; // Perdre 5 points
        }

        // Mettre à jour le score de l'utilisateur dans la base de données
        $sqlUpdate = "UPDATE points SET score = score + $points WHERE id = $userId";
        if ($conn->query($sqlUpdate) === TRUE) {
        } else {
            echo "Erreur lors de la mise à jour du score : " . $conn->error;
        }

        // Insérer le jeu dans la table games_history
        $gameName = "Pile ou Face";
        $sqlInsert = "INSERT INTO games_history (IdJoueur, GameName, Resultat, Points) VALUES ($userId, '$gameName', '$resultat', $points)";
        if ($conn->query($sqlInsert) === TRUE) {
        } else {
            echo "Erreur lors de l'ajout du résultat : " . $conn->error;
        }

        // Fermer la connexion à la base de données
        $conn->close();
    }
    ?>
    
    <form method="post" action="">
    <input type="radio" id="pile" name="choix" value="0" required>
    <label for="pile">Pile</label>

    <input type="radio" id="face" name="choix" value="1" required>
    <label for="face">Face</label>

    <div class="result">votre choix :<?php echo $choixUtilisateurTexte; ?></div>
    <div class="result">pièce :<?php echo $choixOrdinateurTexte; ?></div>
    <div class="result"><?php echo $resultat; ?></div>
    <button type="submit" >Lancer</button>

    
</form>

<div>
    <a style="position: relative;" href="jeux.php?id=<?=$_GET['id']?>" > <button> Quitter </button>
    </div>
    
</body>
</html>