<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recap</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body>
    <style>
    </style>
    <h2>Recapitulatif !</h2>

    <div class="container-fluid">
        <p>Prénom: {{ $spectateur->prenom }}</p>
        <p>Nom: {{ $spectateur->nom }}</p>
        <p>Téléphone: {{ $spectateur->telephone }}</p>
        <p>Email: {{ $spectateur->email }}</p>

        <p>Dates sélectionnées :</p>
        <ul>
            @foreach($total_billets as $billet)
                @foreach($sports as $sport)
                    @foreach($sport->competition as $competition)
                        @if ($billet == $competition->id )
                        <li>Jour: {{ $competition->jour }}</li>
                            <li>Sport: {{ $sport->nom }}</li>
                            <li>Heure de début: {{ $competition->heure_de_debut }}</li>
                            <li>Heure de fin: {{ $competition->heure_de_fin }}</li>
                            <li>Lieu: {{ $competition->lieu->nom }}</li>
                            <li>Prix: {{ $competition->prix }}</li>
                        @endif
                    @endforeach
                @endforeach
            @endforeach
        </ul>
    </div>

    <p>Les billets :</p>
    <ul>
        @php
            $total_prix = 0;
        @endphp
        @foreach($total_billets as $billet)
            @foreach($sports as $sport)
                @foreach($sport->competition as $competition)
                    @if ($billet == $competition->id)
                        <li>Prix: {{ $competition->prix }}</li>
                        @php
                            $total_prix += $competition->prix;
                        @endphp
                    @endif
                @endforeach
            @endforeach
        @endforeach
        <p>Total: {{ $total_prix }}</p>
    </ul>

    <div class="container-fluid">
        <div class="row">
        <div class="col-3">
        <a href="{{url('/billetterie')}}"><i class="fa fa-arrow-left"></i> Autre reservation</a>
        </div>
        <div class="col-3">
        <a href="{{url('/main')}}">Valider <i class="fa fa-arrow-right"></i>
    </a>
        </div>
        <div class="col-6"></div>
        
    </div>
    </div>
</body>
</html>
