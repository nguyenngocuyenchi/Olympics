<h1>Compétitions</h1>

<h2>Premier Tour</h2>
@foreach($premier_tour as $competition)
    <div>
        <h3>{{ $competition->nom }}</h3>
        <p>Date: {{ $competition->jour }}</p>
        <p>Heure de début: {{ $competition->heure_de_debut }}</p>
        <p>Heure de fin: {{ $competition->heure_de_fin }}</p>
        <p>Prix: {{ $competition->prix }}</p>
    </div>
@endforeach

<h2>Demi-finale</h2>
@foreach($demi_finale as $competition)
    <div>
        <h3>{{ $competition->nom }}</h3>
        <p>Date: {{ $competition->jour }}</p>
        <p>Heure de début: {{ $competition->heure_de_debut }}</p>
        <p>Heure de fin: {{ $competition->heure_de_fin }}</p>
        <p>Prix: {{ $competition->prix }}</p>
    </div>
@endforeach

<h2>Finale</h2>
@foreach($finale as $competition)
    <div>
        <h3>{{ $competition->nom }}</h3>
        <p>Date: {{ $competition->jour }}</p>
        <p>Heure de début: {{ $competition->heure_de_debut }}</p>
        <p>Heure de fin: {{ $competition->heure_de_fin }}</p>
        <p>Prix: {{ $competition->prix }}</p>
    </div>
@endforeach
