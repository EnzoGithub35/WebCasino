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
    <title>Shifumi</title>
</head>
<body>
@include('navbar')

<div class="shifumi-container">
    @if (!isset($joueur))
        <form method="post" action="{{ route('shifumi') }}">
            @csrf
            <strong><label for="choix">Choisissez votre coup :</label> </strong>
            <div class="bottom">
                @foreach (["pierre", "feuille", "ciseaux"] as $option)
                    <button class="btn_choix" type="submit" name="choix" value="{{ $option }}">
                        <img src="{{ asset('images/' . ucfirst($option) . '.png') }}" class="pfc-btn" alt="{{ $option }}">
                    </button>
                @endforeach
            </div>
        </form>
    @else
        <p>Vous avez choisi : {{ $joueur }}</p>
        <img src="{{ asset('images/' . ucfirst($joueur) . '.png') }}" class="result-img" alt="{{ $joueur }}">

        <p>L'ordinateur a choisi : {{ $ordinateur }}</p>
        <img src="{{ asset('images/' . ucfirst($ordinateur) . '.png') }}" class="result-img" alt="{{ $ordinateur }}">

        <p>{{ $resultat }}</p>
    @endif

    <div class="buttons-bottom">
        @if (isset($joueur))
            <div>
                <a href="{{ route('jeux') }}"><button>Retour</button></a>
                <a href="{{ route('shifumi') }}"><button>Rejouer</button></a>
            </div>
        @endif
    </div>
</div>


</body>
</html>