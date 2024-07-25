@extends('user.main')

@section('title', 'Register')

@section('content')
    <div class="container mb-5">
        <div class="row">
            <div class="col-12 mt-5 text-center">
                <h1>Register</h1>
            </div>
        </div>
        @if($errors->any())
            @foreach($errors->all() as $error)
                <div class="alert alert-danger mt-2" role="alert">
                    {{ $error }}
                </div>
            @endforeach
        @endif
        <form class="mt-5" method="post">
            @csrf
            <div class="row">
                <div class="mb-3 col">
                    <label for="nom" class="form-label">Nom :</label>
                    <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom') }}">
                </div>
                <div class="mb-3 col">
                    <label for="prenom" class="form-label">Prénom :</label>
                    <input type="text"class="form-control" id="prenom" name="prenom" value="{{ old('prenom') }}">
                </div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email : </label>
                <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe :</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Créer</button>
        </form>
    </div>
@endsection
