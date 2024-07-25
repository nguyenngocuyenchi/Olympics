@extends('calendrier.calendrier')


@section('content')
    <div>        
        <h2>Calendrier Quotidien des Jeux Olympiques</h2>

        <div class="container">
            <div class="row">
                <div class="col-6">    
                    <form method="GET">
                        <div class="col-6">    
                            <div class="dropdown">
                                <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Sélectionner un lieu
                                </button>
                                <ul class="dropdown-menu">
                                    @foreach($lieux as $lieu)
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="lieu_{{ $lieu->id }}" name="lieu_filter[]" value="{{ $lieu->id }}">
                                                <label class="form-check-label" for="lieu_{{ $lieu->id }}">{{ $lieu->nom }}</label>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="dropdown">
                                <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Sélectionner une date
                                </button>
                                <ul class="dropdown-menu">
                                    @foreach($jours_olympique as $date)
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="date_{{ $date }}" name="date_filter[]" value="{{ $date }}">
                                                <label class="form-check-label" for="date_{{ $date }}">{{ $date }}</label>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
            
                        <div class="row">
                            <div class="col">
                                <button type="submit" class="btn">Appliquer les filtres</button>
                            </div>
                            <div class="col"></div>
                        </div> 
                    </form>
                </div>
            </div>
        </div>

        <div>
            @foreach($jours_olympique as $date)

                <strong>{{ $date }}</strong> <br>
                @foreach($sports as $sport)
                    @php
                        $competitions = $sport->competition()
                            ->whereDate('jour', $date)
                            ->when(request()->has('lieu_filter'), function ($query) {
                                return $query->whereIn('lieu_id', request()->input('lieu_filter'));
                            })
                            ->when(request()->has('date_filter'), function ($query) use ($date) {
                                return $query->whereIn('jour', request()->input('date_filter'));
                            })
                            ->get();
                    @endphp
                    @foreach($competitions as $competition)
                        <div>
                            <p>Sport : {{ $sport->nom }}</p>
                            <p>Epreuve : {{ $competition->type }}</p>
                            <p>Lieu : {{ $competition->lieu->nom }}</p>
                            <hr>
                        </div>
                    @endforeach
                @endforeach
            @endforeach
        </div>
    </div>
@endsection