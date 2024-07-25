<!-- liste_competitions.blade.php -->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Competitions</title>
</head>
<body>
    <h1>Liste des compétitions</h1>
    <ul>
        @foreach($competitions as $competition)
            <li>
                <strong>Nom :</strong> {{ $competition->sport->nom }} <br>
                <strong>Date :</strong> {{ $competition->jour }} <br>
                <strong>Heure de début :</strong> {{ $competition->heure_de_debut }} <br>
                <strong>Heure de fin :</strong> {{ $competition->heure_de_fin }} <br>
                <strong>Prix :</strong> {{ $competition->prix }} <br>
                <strong>Lieu :</strong> {{ $competition->lieu->nom }} <br>
            </li>
        @endforeach
    </ul>
</body>
</html>
