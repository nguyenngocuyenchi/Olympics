<!-- liste_lieux.blade.php -->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lieux</title>
</head>
<body>
    <h1>Liste des Lieux</h1>
    <ul>
        @foreach($lieus as $lieu)
            <li>
                <strong>Nom :</strong> {{ $lieu->nom }} <br>
                <strong>Capacité :</strong> {{ $lieu->capacite }} <br>
            </li>
            <br>
        @endforeach
    </ul>
</body>
</html>
