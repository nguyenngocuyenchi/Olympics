<!-- liste_lieux.blade.php -->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lieux</title>
</head>
<body>
    <h1>Liste des Spectateurs</h1>
    <ul>
        @foreach($spectateurs as $spectateur)
            <li>
                <strong>Nom :</strong> {{ $spectateur->nom }} <br>
                <strong>Prenom :</strong> {{ $spectateur->prenom }} <br>
                <strong>Téléphone :</strong> {{ $spectateur->telephone }} <br>
                <strong>Email :</strong> {{ $spectateur->email }} <br>
            </li>
            <br>
        @endforeach
    </ul>
</body>
</html>
