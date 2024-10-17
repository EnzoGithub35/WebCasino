<!-- resources/views/login.blade.php -->

<!DOCTYPE html>
<html lang="fr" data-bs-theme="auto">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Connexion</title>
</head>
<body>
@include('navbar')

<main>
<div class="container" style="margin-top: 5vh;">  
    <h1 style="color: #F4bc5b">Connexion</h1>  
    @if (session('error_message'))
        <p style='color: red;'>{{ session('error_message') }}</p>
    @endif
    <form method="post" action="{{ route('login') }}">  
        @csrf
        <div class="form-control">  
            <input type="text" name="pseudo_email" required>
            <label for="pseudo_email">Pseudo ou Email</label>
        </div> 
        <div class="form-control">  
            <input type="password" name="mdp" required>  
            <label for="mdp">Mot de passe</label>  
        </div>  
        <button class="btn">Connexion</button>  
        <p class="text">Pas de compte ? <a href="{{ route('register') }}">Inscrivez vous</a></p> 
    </form>  
</div>  
<script src="{{ asset('js/app.js') }}"></script>
</main>
</body>
</html>