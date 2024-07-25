@extends('calendrier.calendrier')

@section('content')
<body>
    <h2>Calendrier Mensuel des Jeux Olympiques</h2>

    <div class="container">
        <div class="table-responsive-md">
            <table class="table">
                <thead>
                    <tr class="mois">
                        <th></th>
                        <th colspan="8" scope="colgroup">Juillet</th>
                        <th colspan="11" scope="colgroup">Août</th>
                    </tr>
                    <tr class="jours">
                        <th>Epreuves</th>
                        @foreach ($jours_olympique as $date)
                            <?php $jour = date('d', strtotime($date)); ?>
                            <th>{{ $jour }}</th>
                        @endforeach
                    </tr>                    
                </thead>
                <tbody>
                    @foreach($sports as $sport)
                    <tr>
                        <td class="sport">{{ $sport->nom }}</td>
                        @foreach($jours_olympique as $date)
                            <?php $competition_found = false; ?>
                            @foreach($sport->competition as $competition)
                                @if ($date == $competition->jour)
                                    <?php $competition_found = true; ?>
                                    @if ($competition->type == '1er tour') 
                                        <td class="case">
                                            <i class="bi bi-1-circle"></i>                                            <div class="details">
                                                <p>{{ $competition->sport->nom }} | {{ date("d/m/Y", strtotime("$competition->jour")) }}</p>
                                                <p>{{ $competition->heure_de_debut }} - {{ $competition->heure_de_fin }}</p>
                                                <p>{{ $competition->lieu->nom }}</p>
                                                <p><ul><li>Epreuve : {{ $competition->type }}</li></ul></p>
                                            </div>
                                        </td>
                                    @elseif ($competition->type == 'Demi-Finale')
                                        <td class="case">
                                            <i class="bi bi-star"></i>                                            
                                            <div class="details">
                                                <p>{{ $competition->sport->nom }} | {{ date("d/m/Y", strtotime("$competition->jour")) }}</p>
                                                <p>{{ $competition->heure_de_debut }} - {{ $competition->heure_de_fin }}</p>
                                                <p>{{ $competition->lieu->nom }}</p>
                                                <p><ul><li>Epreuve : {{ $competition->type }}</li></ul></p>
                                            </div>
                                        </td>
                                    @elseif ($competition->type == 'Finale')
                                        <td class="case">
                                            <i class="bi bi-award"></i>
                                            <div class="details">
                                                <p>{{ $competition->sport->nom }} | {{ date("d/m/Y", strtotime("$competition->jour")) }}</p>
                                                <p>{{ $competition->heure_de_debut }} - {{ $competition->heure_de_fin }}</p>
                                                <p>{{ $competition->lieu->nom }}</p>
                                                <p><ul><li>Epreuve : {{ $competition->type }}</li></ul></p>
                                            </div>
                                        </td>
                                    @endif
                                @endif
                            @endforeach
                            @if (!$competition_found)
                                <td class="case"></td>
                            @endif
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>                
                <tfoot>
                    <th colspan="20">Les jours sont affichés selon le fuseau horaire de Paris <br>
                        <i class="bi bi-1-circle"></i> Premier Tour 
                        <i class="bi bi-star"></i> Demi-Finale 
                    <i class="bi bi-award"></i> Finale
                    </th>                    
                </tfoot>
            </table>
        </div>
    </div>
</body>
</html>