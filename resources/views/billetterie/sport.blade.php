<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sport</title>
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
            height: 50%;
            background: url("{{ asset('photo/sport/background.png') }}");
            background-size: cover;
            display: flex;
            background-position: center;
        }  
</style>
</head>
  <body>
  <div class="bg_main" >
    </div>

    <div class="container-fluid">
    <h1>PARIS 2024 <br>SPORTS OLYMPIQUES</h1>
    </div>

    <div class="container-fluid">
      <table>
        @foreach($sports as $sport)
        <tr>
          <td>{{$sport['nom']}}</td>
        </tr>
        @endforeach
      </table>
  </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>