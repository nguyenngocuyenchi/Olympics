<!-- liste_sports.blade.php -->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sports</title>
</head>
<body>
    <h1>Liste des Sports</h1>
    <ul>
        @foreach($sports as $sport)
            <li>
                <strong>Nom :</strong> {{ $sport->nom }} <br>
            </li>
            <br>
        @endforeach
    </ul>
</body>
</html>
