<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Olympiques</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

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
            background: url("<?php echo e(asset('photo/main/background.png')); ?>");
            background-size: cover;
            display: flex;
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
            font-family: sans-serif;
            color: white;
            font-size: 6rem;
            font-weight: 500;
            position: relative;
            z-index: 2;
            margin-top: 120px; 
            margin-left: 50px; 
        }
        .mascot {
            height: 45%;
            width: 30%;
            position: relative;
            z-index: 2;
            margin-top: 300px; 
            margin-left: 200px; 
            display: flex;
        }
        .logo {
            position: absolute;
            z-index: 2;
            width: 90px;
            height: 90px;
            right: 10px; 
        }
        .container-fluid {
            z-index: 3;
        }
        .navbar {
            font-family: sans-serif;
            font-size: 18px;
            justify-content: flex-start;
            margin-top: 20px;
            margin-left: 20px;
            margin-right: 20px;
        }
        .title-1 {
            font-family: sans-serif;
            font-weight: 600;
            font-size: 4rem;
            padding: 4rem 2rem 1rem 2rem;
            text-align: center;
        }

        .bg_sport {
            position: relative;
            width: 90%;
            height: 90%;
            padding-top : 4rem;
            background-size: cover;
            background-position: center;
        }
        .btn1 {
            background-color: white;
            border: 0.2rem solid rgb(0, 0, 0);
            color: black;
            padding: 10px 14px;
            font-size: 18px;
            cursor: pointer;
            margin-left: 2rem;
        }
        .btn1:hover {
            background-color: black;
            color: white;
        }
        .cookie-container {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            box-shadow: 0 0 0.3125rem 0 rgba(0,0,0,.5);
            z-index: 1190;
            background-color: #f0f0f0;
        padding: 1rem 4rem 1rem 4rem;
        }

    .cookie-button-container {
        display: flex;
        justify-content: flex-end;
    }

    .cookie-button {
        background-color: #d9d9d9;
        border: 0rem;
        margin: 0rem 1.5rem 0rem 1.5rem;
    }
    .bg_calendrier {
            position: relative;
            width: 100%;
            height: 50%;
            background: url("<?php echo e(asset('photo/main/calender.png')); ?>");
            background-size: cover;
            display: flex;
            background-position: center;
            margin-top : 4rem;
            margin-bottom : 4rem;
            justify-content: center; 
            align-items: center;
            font-weight: 300;
            font-size: 8rem;
            font-family: sans-serif;

        }  
    .bottom {
            width: 100%;
            height: 60%;
            background: rgb(0,0,0);
        }  
        .custom-style .style1 { width: 11rem; color: white;}

        .custom-style .style2 { min-width: 15em;color: white;}

        .custom-style .style3 { min-width: 13em;color: white;}

        .custom-style .style4 { min-width: 14em;color: white;}

    </style>
</head>
<body>
    <div class="bg_main" >
        <div class="dark-overlay"></div>
        <h1 class="title">OLYMPIQUES<br>PARIS 2024</h1>

        <img class="mascot" src="<?php echo e(asset('photo/main/mascot.png')); ?>" alt="mascot">
                
        
    </div>

    <div class="container-fluid">   
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="nav">
        <ul class="navbar-nav">
                <li class="nav-item col me-md-5">
                    <div class="dropdown">
                        <button class="btn dropdown-toggle nav-link text-white" type="button" data-bs-toggle="dropdown" aria-expanded="false"><b>Menu</b></button>
                        <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?php echo e(url('/main')); ?>">Accueil</a></li>
                        <li><a class="dropdown-item" href="<?php echo e(url('/calendrier')); ?>">Calendrier</a></li>
                        <li><a class="dropdown-item" href="<?php echo e(url('/sport')); ?>">Les Jeux</a></li>
                        <li><a class="dropdown-item" href="<?php echo e(url('/boutique')); ?>">Boutique</a></li>
                        <li><a class="dropdown-item" href="<?php echo e(url('/billetterie')); ?>">Billetterie</a></li>
                        <li><a class="dropdown-item" href="#">Nos engagements</a></li>
                        <li><a class="dropdown-item" href="#">Actualités</a></li>
                        <li><a class="dropdown-item" href="#">Spectateurs
                    </a></li>
                    </ul>
                    </div></a></li>
                <li class="nav-item col mx-md-5"><a class="nav-link text-white" href="<?php echo e(url('/calendrier')); ?>"><b>Calendrier</b></a></li>
                <li class="nav-item col mx-md-5"><a class="nav-link text-white" href="<?php echo e(url('/billetterie')); ?>"><b>Billetterie</b></a></li>
                <li class="nav-item col mx-md-5"><a class="nav-link text-white" href="#"><b>Boutique</b></a></li>
            </ul>
            <div class="nav-item col me-md-5">
            <div class="input-group">
     <input class="form-control py-2 rounded-pill mr-1 pr-5" type="search" placeholder="Rechercher">
     <span class="input-group-append">
         <button class="btn btn-outline-secondary rounded-pill border-0 ml-n5" type="button">
               <i class="fa fa-search"></i>
         </button>
     </span>
 </div>
        
</div>

            <img class="logo" src="<?php echo e(asset('photo/main/logo.png')); ?>" alt="logo">
        </div>
    </nav>
</div>



<div class="container-fluid">
<h1 class="title-1">LES AFFICHES OFFICIELLES DE PARIS 2024</h1>
<h4 style="font-weight: 200; padding: 0rem 2rem 4rem 2rem; text-align: center;">Les Affiches Officielles des Jeux de Paris 2024 ont été révélées le 4 mars 2024 au Musée d’Orsay. Destinées à illustrer l’édition des Jeux qu’elles représentent, les Affiches sont une tradition : depuis les Jeux de Stockholm en 1912, chaque Comité d’organisation y met à l’honneur ses symboles.  </h4>
<img src="photo/main/poster.png" class="img-fluid" alt="poster">

</div>

<div class="container-fluid">
</div>

<div class="container">
  <div class="row">
    <div class="col">
    <img class="bg_sport"  src="<?php echo e(asset('photo/main/running.png')); ?>" alt="running">

    </div>
    <div class="col">
    <h1 style="font-size: 45px; padding: 6rem 2rem 4rem 0rem; text-align: end;">LES SPORTS OLYMPIQUES</h1>
    <h4 style="font-weight: 200; text-align: end; padding: 0rem 2rem 4rem 2rem;">Les Jeux Olympiques sont la seule compétition véritablement mondiale et multisport. Avec plus de 200 pays participant à plus de 400 épreuves entre les Jeux d’Été et d’Hiver, les Jeux sont le seul endroit où le monde se retrouve pour concourir, se sentir inspiré et être ensemble.</h4>
    <button class="btn1">En savoir plus <i class="fa fa-arrow-right"></i></button>    
    </form>
   </div>
  </div>
</div>

<div class="container">
  <div class="row">

    <div class="col">
    <h1 style="font-size: 45px; padding: 4rem 0rem 2rem 2rem; text-align: start;">ACHETEZ VOS BILLETS</h1>
    <h4 style="font-weight: 200; text-align: start; padding: 0rem 0rem 4rem 2rem;">Découvrez les billets disponibles pour les Jeux Olympiques de Paris 2024 !</h4>
    <form action=" <?php echo e(url('/billetterie')); ?>" method="GET">
    <button class="btn1">Accéder à la vente <i class="fa fa-arrow-right"></i></button>    
    </form>
    </div>

    <div class="col">
    <img class="bg_sport" src="<?php echo e(asset('photo/main/ticket.png')); ?>" alt="ticket">
    </div>
    
  </div>
</div>

<div class="bg_calendrier" >
<a class="nav-link text-white text-center" href="<?php echo e(url('/calendrier')); ?>"><b>Calendrier</b></a>
    </div>


    <div class="bottom">
    <div class="card-group custom-style">
    <div name="suvre" class="pt-5 card-body border-0 style1">
        <div class="small">Suivez nous sur</div>
        <i class="fa fa-address-book" aria-hidden="true"></i>
        <i class="fa fa-envelope-open" aria-hidden="true"></i>
        <i class="fa fa-archive" aria-hidden="true"></i>
        <i class="fa fa-bookmark" aria-hidden="true"></i>
    </div>
        <i class="fa fa-facebook-official" aria-hidden="true"></i>

        <div class="pt-5 card-body border-0 style2">
            <div class="h5">Jeux Olympiques</div><br>
            <div>
                <p>Calendrier</p>
                <p>Sports</p>
                <p>Sites</p>
            </div>
        </div>
        <div class="pt-5 card-body border-0 style3">
            <div class="h5">Célébrer les Jeux</div><br>
            <div>
                <p>Célébrer les Jeux</p>
                <p>Parc des Champions</p>
            </div>
        </div>
        <div class="pt-5 card-body border-0 style4">
            <div class="h5">Spectateurs</div><br>
            <div>
                <p>Infos spectateurs</p>
                <p>Billetterie</p>
                <p>La boutique des Jeux</p>
                <p>Une question ?</p>
            </div>
        </div>
    </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
<?php /**PATH C:\Users\tamil\www\jos\resources\views/main.blade.php ENDPATH**/ ?>