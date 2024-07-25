@extends('user.main')

@section('title', 'Login')

@section('content')
    <div class="container mb-5">
        <div class="row">
            <div class="col-12 mt-5 text-center">
                <h1>Login</h1>
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
            <div class="mb-3 needs-validation">
                <label for="email" class="form-label">Email :</label>
                <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe :</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Se connecter</button>
        </form>
    </div>
@endsection
