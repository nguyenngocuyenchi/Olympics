@extends('application.gerer')

@section('content')
    <h2>Supprimer une compétition</h2>

    @if(session('success'))
    <div style="background-color: #6af36f; color: white; padding: 10px; margin-bottom: 15px;">
        {{ session('success') }}
    </div>
    @endif

    @foreach($sports as $sport)
        <h3>{{ $sport->nom }}</h3>
        <ul>
            @foreach($sport->competitions as $competition)
            <li>
                {{ $competition->nom }}
                <button href="{{ route('/application/supprimer', $competition->id) }}">Supprimer</button>
            </li>
        @endforeach
        </ul>
    @endforeach
@endsection
