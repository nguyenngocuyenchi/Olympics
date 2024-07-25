@extends('application.gerer')

@section('content')
    <h2>Modifier la compétition</h2>
    
    @if(session('success'))
        <div style="background-color: #daeadb; color: white; padding: 10px; margin-bottom: 15px;">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('/application/editer', $competition->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="sport">Sport :</label>
            <select name="sport" id="sport">
                @foreach($sports as $sport)
                    <option value="{{ $sport->id }}" @if($sport->id == $competition->sport->id) selected @endif>{{ $sport->nom }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="form-group">
            <label for="jour">Date :</label>
            <input type="date" id="jour" name="jour" min="2024-07-24" max="2024-08-11" value="{{ $competition->jour }}">
        </div>

        <div class="form-group heures">
            <div>
                <label for="heure_de_debut">Heure de début :</label>
                <input type="time" id="heure_de_debut" name="heure_de_debut" value="{{ $competition->heure_de_debut }}">
            </div>
            <div>
                <label for="heure_de_fin">Heure de fin :</label>
                <input type="time" id="heure_de_fin" name="heure_de_fin" value="{{ $competition->heure_de_fin }}">
            </div>
        </div>

        <div class="form-group">
            <label for="lieu">Lieu :</label>
            <select name="lieu" id="lieu">
                @foreach($lieux as $lieu)
                    <option value="{{ $lieu->id }}" @if($lieu->id == $competition->lieu->id) selected @endif>{{ $lieu->nom }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="prix">Prix :</label>
            <input type="number" id="prix" name="prix" value="{{ $competition->prix }}">
        </div>

        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
@endsection
