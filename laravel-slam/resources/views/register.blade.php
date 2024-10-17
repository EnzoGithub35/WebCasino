<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Inscription</title>
</head>
<body>
@include('navbar')

<main class="container" style="margin-top: 5vh;">
    <h1 style="color: #F4bc5b">Inscription</h1>
    @if (session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif
    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="post" action="{{ route('register') }}">
        @csrf
        <div class="form-control">
            <input type="text" name="pseudo" required value="{{ old('pseudo') }}">
            <label for="pseudo">Pseudo :</label>
        </div>
        <div class="form-control">
            <input type="text" name="Nom" required value="{{ old('Nom') }}">
            <label for="Nom">Nom :</label>
        </div>
        <div class="form-control">
            <input type="text" name="Prenom" required value="{{ old('Prenom') }}">
            <label for="Prenom">Prénom :</label>
        </div>
        <div class="form-control">
            <input type="email" name="email" required value="{{ old('email') }}">
            <label for="email">Email :</label>
        </div>
        <div class="form-control">
            <input type="password" name="mdp" required>
            <label for="mdp">Mot de passe :</label>
        </div>
        <input class="btn" type="submit" name="valider" value="Valider">
        <p class="text">Déjà un compte ? <a href="{{ route('login') }}">Connectez-vous</a></p>
    </form>
</main>

<script src="script.js"></script>
</body>
</html>