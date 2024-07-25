<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestions</title>
    <style>
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            width: 400px;
            display: flex;
            flex-direction: column;
            align-items: stretch;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            margin-bottom: 5px;
        }
        input, select {
            width: 100%; 
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .heures {
            display: flex;
            justify-content: space-between;
        }
        .nav-link {
            text-decoration: none;
            padding: 10px;
            margin-bottom: 5px;
            color: #333;
            background-color: #f5f5f5;
            border-radius: 4px;
            display: block;
        }
        .nav-link.active {
            background-color: #4CAF50;
            color: white;
        }

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
    <div class="container">
        <h1>Application</h1>
        <nav>
            <ul>
                <li><a href="{{ route('/application/programmer') }}">Programmer une compétition</a></li>
                <li><a href="{{ route('/application/gerer') }}">Gérer les compétitions</a></li>
            </ul>
        </nav>
        @yield('content')
    </div>
</body>
</html>
