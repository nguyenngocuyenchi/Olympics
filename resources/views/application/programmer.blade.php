@extends('application.application')


@section('content')
    <h2>Programmer une compétition</h2>
    
    @if(session('success'))
    <div style="background-color: #daeadb; color: white; padding: 10px; margin-bottom: 15px;">
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('/application/sauvegarder') }}" method="post">
        @csrf

        <div class="form-group">
            <label for="sport">Sport :</label>
            <select name="sport" id="sport">
                @foreach($sports as $sport)
                <option value="{{ $sport->id }}">{{ $sport->nom }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="jour">Date :</label>
            <input type="date" id="jour" name="jour" min="2024-07-24" max="2024-08-11">
        </div>

        <div class="form-group heures">
            <div>
                <label for="heure_de_debut">Heure de début :</label>
                <input type="time" id="heure_de_debut" name="heure_de_debut" before="heure_de_fin" >
            </div>
            <div>
                <label for="heure_de_fin">Heure de fin :</label>
                <input type="time" id="heure_de_fin" name="heure_de_fin">
            </div>
        </div>

        <div class="form-group">
            <label for="lieu">Lieu :</label>
            <select name="lieu" id="lieu">
                @foreach($lieux as $lieu)
                <option value="{{ $lieu->id }}">{{ $lieu->nom }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="prix">Prix :</label>
            <input type="number" id="prix" name="prix">
        </div>


        <div class="form-group">
            <label for="type">Type :</label>
            <select id="type" name="type">
                <option value="1er tour">1er tour</option>
                <option value="Demi-Finale">Demi-Finale</option>
                <option value="Finale">Finale</option>
            </select>
        </div>

        <input type="submit" value="Programmer">
    </form>
@endsection
