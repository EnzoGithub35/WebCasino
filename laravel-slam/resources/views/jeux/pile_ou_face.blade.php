<!DOCTYPE html>
<html lang="fr" data-bs-theme="auto">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@endif
    <title>Pile ou Face</title>
</head>
<body>
@include('navbar')

<div class="formPoF">
    <form method="post" action="{{ route('pile_ou_face') }}">
        @csrf
        <input type="radio" id="pile" name="choix" value="0" class="inputPoF" required>
        <label for="pile">Pile</label>

        <input type="radio" id="face" name="choix" value="1" class="inputPoF" required>
        <label for="face">Face</label>

        <div class="resultPoF">Votre choix : {{ $choixUtilisateurTexte ?? '' }}</div>
        <div class="resultPoF">Pièce : {{ $choixOrdinateurTexte ?? '' }}</div>
        <div class="resultPoF">{{ $resultat ?? 'Choisissez et lancez !' }}</div>
        <button type="submit" class="buttonPoF">Lancer</button>
    </form>
</div>
<div>
    <a style="position: relative;" href="{{ route('jeux') }}"><button class="buttonPoF">Quitter</button></a>
</div>

</body>
</html>