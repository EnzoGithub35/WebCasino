<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Profil de l'utilisateur</title>
</head>
<body style="text-align: center;">
@include('navbar')

<h1>Profil de l'utilisateur</h1>
<div>
    <h2>Informations de l'utilisateur</h2>
    <p>Pseudo: {{ $userInfo->pseudo }}</p>
    <p>Nom: {{ $userInfo->Nom }}</p>
    <p>Prénom: {{ $userInfo->Prenom }}</p>
    <p>Email: {{ $userInfo->email }}</p>
    <p>Nombre de coins: {{ $userInfo->coins }}</p>
</div>
<button><a href="{{ route('classement') }}">Classement</a></button>
<button><a href="{{ route('edit') }}">Modifier vos identifiants</a></button>

<div>
    <h2>Historique des parties de Blackjack</h2>
    <ul>
        @foreach ($blackjackHistory as $game)
            <li>{{ $game->Resultat }}  {{ $game->Points }}</li>
        @endforeach
    </ul>
    <p>Nombre de victoires : {{ round($victoires_bj, 2) }}</p>
    <p>Nombre de parties jouées : {{ round($nb_parties_BJ, 2) }}</p>
    <p>Ratio de victoires : {{ round($ratio_victoires_BJ, 2) }}%</p>
</div>

<div>
    <h2>Historique des parties de Shifumi</h2>
    <ul>
        @foreach ($shifumiHistory as $game)
            <li>{{ $game->Resultat }}  {{ $game->Points }}</li>
        @endforeach
    </ul>
    <p>Nombre de victoires : {{ round($victoires_shifumi, 2) }}</p>
    <p>Nombre de parties jouées : {{ round($nb_parties_shifumi, 2) }}</p>
    <p>Ratio de victoires : {{ round($ratio_victoires_shifumi, 2) }}%</p>
</div>

<div>
    <h2>Historique des parties de Pile ou Face</h2>
    <ul>
        @foreach ($pileOuFaceHistory as $game)
            <li>{{ $game->Resultat }}  {{ $game->Points }}</li>
        @endforeach
    </ul>
    <p>Nombre de victoires : {{ round($victoires_po, 2) }}</p>
    <p>Nombre de parties jouées : {{ round($nb_parties_po, 2) }}</p>
    <p>Ratio de victoires : {{ round($ratio_victoires_po, 2) }}%</p>
</div>

@if ($favoriteGameRow)
<div>
    <h2>Jeu préféré du joueur</h2>
    <p>Jeu préféré: {{ $favoriteGameRow->GameName }}</p>
    <p>Nombre de parties jouées: {{ $favoriteGameRow->gameCount }}</p>
</div>
@else
<div>
    <h2>Jeu préféré du joueur</h2>
    <p>Aucune partie jouée pour le moment.</p>
</div>
@endif

</body>
</html>