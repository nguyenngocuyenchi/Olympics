@extends('application.application')


@section('content')
    <h2>Gérer les compétitions</h2>
    
    @if(session('success'))
        <div style="background-color: #daeadb; color: white; padding: 10px; margin-bottom: 15px;">
            {{ session('success') }}
        </div>
    @endif

    <div class='row'>
        <div class="col">
            <div class="dropdown">
                <label for="competition" class="form-label">Compétition</label>
                <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Sélectionner une compétition
                </button>
                <ul class="dropdown-menu">
                    @foreach($sports as $sport)
                        <li class="dropdown-header">{{ $sport->nom }}</li>
                        @foreach($sport->competition as $competition)
                            <li>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="{{ $competition->id }}" name="competition" value="{{ $competition->id }}">
                                    <label class="form-check-label" for="competition">{{ $competition->jour }}</label>
                                </div>
                                <form action="{{ route('/application/supprimer', $competition->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-trash"></i> Supprimer
                                    </button>
                                </form>
                                <a href="{{ route('/application/modifier', $competition->id) }}" class="btn btn-warning">
                                    <i class="fas fa-edit"></i> Modifier
                                </a>
                            </li>
                        @endforeach
                        <li class="dropdown-divider"></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
