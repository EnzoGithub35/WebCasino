<!-- resources/views/index.blade.php -->

@if (session_status() == PHP_SESSION_NONE)
    @php
        session_start();
    @endphp
@endif

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Accueil</title>
<body class="body">
    @include('navbar')
    @include('accueil')
</body>
@include('footer')
</html>