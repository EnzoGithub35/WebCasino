<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Classement</title>
</head>
<body>
@include('navbar')

<h1>Top 10 des joueurs avec le plus de coins</h1>
<table>
    <thead>
        <tr>
            <th>Position</th>
            <th>Pseudo</th>
            <th>Coins</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($topCoins as $index => $player)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td style="text-align: center">{{ $player->pseudo }}</td>
                <td style="text-align: right">{{ $player->coins }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<h1>Top 10 des joueurs de Blackjack avec le plus de victoires</h1>
<table>
    <thead>
        <tr>
            <th>Position</th>
            <th>Pseudo</th>
            <th>Victoires</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($topBlackjack as $index => $player)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td style="text-align: center">{{ $player->pseudo }}</td>
                <td style="text-align: right">{{ $player->NbVictoire }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<h1>Top 10 des joueurs de Shifumi avec le plus de victoires</h1>
<table>
    <thead>
        <tr>
            <th>Position</th>
            <th>Pseudo</th>
            <th>Victoires</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($topShifumi as $index => $player)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td style="text-align: center">{{ $player->pseudo }}</td>
                <td style="text-align: right">{{ $player->NbVictoire }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<h1>Top 10 des joueurs de Pile ou Face avec le plus de victoires</h1>
<table>
    <thead>
        <tr>
            <th>Position</th>
            <th>Pseudo</th>
            <th>Victoires</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($topPileOuFace as $index => $player)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td style="text-align: center">{{ $player->pseudo }}</td>
                <td style="text-align: right">{{ $player->NbVictoire }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>