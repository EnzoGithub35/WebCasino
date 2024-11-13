<!-- resources/views/login.blade.php -->

<!DOCTYPE html>
<html lang="fr" data-bs-theme="auto">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@endif
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
<script src="script.js">


</script>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


@foreach (['error_message'] as $msg)
    @if (\Session::has($msg))
        <script>
            toastr.error("{{ \Session::get($msg) }}");
        </script>
    @endif
@endforeach

@foreach (['RegisterSuccesfull'] as $msg)
    @if (\Session::has($msg))
        <script>
            toastr.success("{{ \Session::get($msg) }}");
        </script>
    @endif
@endforeach

</main>
</body>
</html>