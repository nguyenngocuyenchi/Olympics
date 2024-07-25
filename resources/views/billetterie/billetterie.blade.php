<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Billetterie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
        }
        .bg_main {
            position: relative;
            width: 100%;
            height: 100%;
            background: url("{{ asset('photo/billetterie/background.png') }}");
            background-size: cover;
            display: flex;
            background-position: center;
        }  
        .dark-overlay {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); 
            z-index: 1; 
        }
        .title {
            font-family: serif;
            color: white;
            font-size: 6rem;
            font-weight: 500;
            display: flex; 
            z-index: 2;
            margin: 13rem 0rem 0rem 22rem;
            font-style: italic; 

        }
        .container {
            margin-top: 2rem;
        }
        .btn {
            border: 0.1rem solid rgb(0, 0, 0);
            margin: 0rem 2rem 2rem 0rem;
        }
        .form-label {
            margin: 0rem 2rem 2rem 0rem;
        }

        .dropdown-menu {
            max-height: 200px; overflow-y: auto;
        }
        .background {
            background-color:;
        }
        .mascot {
            height: 80%;
            width: 80%;
            position: relative;
            z-index: 2;
            display: flex;
            left: 120px;
        }

    </style>
</head>
<body>

    <div class="bg_main">
        <div class="dark-overlay"></div>
        <h1 class="title">BILLETTERIE</h1>
    </div>
    
    

    <div class='container'>
        <div class='row'>
            <div class="col">
            <form action="{{ route('/billetterie/recapitulatif') }}" method="POST">
                @csrf
                <div class='row'>
                    <div class='col-md-6 mb-3'>
                        <label for='prenom' class='form-label'>Prénom</label>
                        <input type='text' class='form-control' id='prenom' name='prenom'>
                    </div>
                    <div class='col-md-6 mb-3'>
                        <label for='nom' class='form-label'>Nom</label>
                        <input type='text' class='form-control' id='nom' name='nom'>
                    </div>
                    <div class='col-md-12 mb-3'>
                        <label for='telephone' class='form-label'>Téléphone</label>
                        <input type='text' class='form-control' id='telephone' name='telephone'>
                    </div>
                    <div class='col-md-12 mb-3'>
                        <label for='email' class='form-label'>Email</label>
                        <input type='text' class='form-control' id='email' name='email'>
                    </div>
                </div>
                <div class='row'>
                    <div class="col">
                        <div class="dropdown">
                            <label for="total_billets" class="form-label">Nombre de billets</label>
                            <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Sélectionner un sport
                            </button>
                            <ul class="dropdown-menu">
                                @foreach($sports as $sport)
                                    <li class="dropdown-header">{{ $sport->nom }}</li>
                                    @foreach($sport->competition as $competition)
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="{{ $competition }}" name="total_billets[]" value="{{ $competition->id }}">
                                                <label class="form-check-label" for="total_billets">{{$competition->jour}}</label>
                                            </div>
                                        </li>
                                    @endforeach
                                    <li class="dropdown-divider"></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <input class="btn" type="submit" value="Valider">
            </form>
            </div>
            <div class="col"></div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
