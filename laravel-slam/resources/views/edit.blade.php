<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Modifier vos informations</title>
</head>
<body>
@include('navbar')

<main class="container" style="margin-top: 5vh;">
    <h1 style="color: #F4bc5b">Modifier</h1>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
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
    <form action="{{ route('edit.update') }}" method="POST">
        @csrf
        <div class="form-control">
            <input type="text" name="pseudo" id="pseudo" required value="{{ old('pseudo', $edit->pseudo) }}">
            <label for="pseudo">Pseudo :</label>
        </div>

        <div class="form-control">
            <input type="text" name="Nom" class="form-control" id="Nom" required value="{{ old('Nom', $edit->Nom) }}">
            <label for="Nom">Nom :</label>
        </div>

        <div class="form-control">
            <input type="text" name="Prenom" class="form-control" id="Prenom" required value="{{ old('Prenom', $edit->Prenom) }}">
            <label for="Prenom">Prénom</label>
        </div>

        <div class="form-control">
            <input type="email" name="email" class="form-control" id="email" required value="{{ old('email', $edit->email) }}">
            <label for="email">Email</label>
        </div>

        <div class="form-control">
            <input type="password" name="mdp" class="form-control" id="mdp" required>
            <label for="mdp">Mot de passe</label>
        </div>

        <div class="form-control">
            <input type="password" name="mdp_confirmation" class="form-control" id="mdp_confirmation" required>
            <label for="mdp_confirmation" class="col-sm-2 col-form-label">Confirmer le mot de passe</label>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn">Valider</button>
        </div>
    </form>
</main>

<script src="script.js"></script>
</body>
</html>