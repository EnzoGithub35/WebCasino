<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@endif
    <title>Document</title>
</head>
@include('navbar')
<body style="background-color: #333;">
<main>
</main>
    <div class="row">
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'>
  <div class="grid-container">
    <div class="test_box box-01 col-xs-6 col-md-4">
      <div class="inner">
        <a href="{{ route('blackjack') }}" class="test_click box-image-1">
          <div class="flex_this ">
            <h3 class="title"> Blackjack </h3>
            
            <span class="test_link">Jouez</span>
          </div>
        </a>
      </div>
    </div>
    <div class="test_box box-02 col-xs-6 col-md-4">
      <div class="inner">
        <a href="{{ route('shifumi') }}" class="test_click box-image-2">
          <div class="flex_this">
            <h3 class="title"> Shifumi</h3>
            <span class="test_link">Jouez</span>
          </div>
        </a>
      </div>
    </div>
    <div class="test_box box-03 col-xs-6 col-md-4">
      <div class="inner">
        <a href="{{ route('pile_ou_face') }}" class="test_click box-image-3">
          <div class="flex_this">
            <h3 class="title"> Pile ou face</h3>
            <span class="test_link">Jouez</span>
          </div>
        </a>
      </div>
    </div>
    <div class="test_box box-04 col-xs-6 col-md-4">
      <div class="inner">
        <a href="{{ route('home') }}" class="test_click box-image-4">
          <div class="flex_this">
            <h3 class="title"> Accueil</h3>
            <span class="test_link">Jouez</span>
          </div>
        </a>
      </div>
    </div>
    <div class="test_box box-05 col-xs-6 col-md-4">
      <div class="inner">
        <a href="{{ route('blackjack') }}" class="test_click box-image-5">
          <div class="flex_this">
            <h3 class="title"> test BJ</h3>
            <span class="test_link">Jouez</span>
          </div>
        </a>
      </div>
    </div>
    <div class="test_box box-06 col-xs-6 col-md-4">
      <div class="inner">
        <a href="{{ route('profile') }}" class="test_click box-image-6">
          <div class="flex_this">
            <h3 class="title"> profil </h3>
            <span class="test_link">Jouez</span>
          </div>
        </a>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


@foreach (['LoginSuccesfull', 'EditSuccesfull'] as $msg)
    @if (\Session::has($msg))
        <script>
            toastr.success("{{ \Session::get($msg) }}");
        </script>
    @endif
@endforeach
</body>
</html>