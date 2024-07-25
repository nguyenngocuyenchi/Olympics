<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendrier des Jeux Olympiques</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">        
    <style>
        /* Styles CSS personnalisés */
        body {
            background-color: rgb(249, 249, 249);
            color: rgb(45, 45, 45);
            font-family: Helvetica, sans-serif;
            font-size: 1.6rem;
            -webkit-font-smoothing: antialiased;
            -webkit-tap-highlight-color: transparent;
            line-height: 2.4rem;
            position: relative;
        }

        h1 {
            font-size: 3rem;
            text-align: center;
        }

        nav {
            text-align: center;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: center;
        }

        nav ul li {
            margin: 0 10px;
        }

        nav ul li a {
            text-decoration: none;
            color: #000;
            font-weight: bold;
            font-size: 1.4rem;
        }

        button{
            background-color:#d1ecd2;
            border: 0.1rem solid rgb(0, 0, 0);
            margin: 0rem 2rem 2rem 0rem;
        }

        i{
            text-align: center;
        }

        .details {
            display: none;
            background-color:#d1ecd2;
            padding: 20px;
            border: 1px solid #999;
            border-radius: 5px;
            position: absolute;
        }

        .bi-1-circle:hover + .details, .bi-star:hover + .details,  .bi-award:hover + .details{
            display: block;
        } 

        table {
            border-collapse: separate;
            text-indent: initial;
            border-spacing: 2px;
        }

        th {
            display: table-cell;
            vertical-align: inherit;
            font-weight: bold;
            text-align: -internal-center;
            unicode-bidi: isolate;
        }

        td {
            display: table-cell;
            vertical-align: inherit;
            unicode-bidi: isolate;
        }

        tr {
            display: table-row;
            vertical-align: inherit;
            unicode-bidi: isolate;
            border-color: inherit;
        }

        tfoot th {
            width: 100%;
        }

        .mois th {
            text-align: left;
            background-color: #54bd58;
        }

        .jours th {
            background-color: #54bd58;
        }

        .sport {
            text-align: left;
            background-color: #54bd58;
        }

        .dropdown-menu {
            max-height: 200px; overflow-y: auto;
        }

        .case {
            background-color: #fff;
        }

        /* Styles pour rendre la table responsive */
        @media (max-width: 575.98px) {
            .table-responsive-sm {
                display: block;
                width: 100%;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
                -ms-overflow-style: -ms-autohiding-scrollbar;
            }
        }

        @media (max-width: 767.98px) {
            .table-responsive-md {
                display: block;
                width: 100%;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
                -ms-overflow-style: -ms-autohiding-scrollbar;
            }
        }

        @media (max-width: 991.98px) {
            .table-responsive-lg {
                display: block;
                width: 100%;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
                -ms-overflow-style: -ms-autohiding-scrollbar;
            }
        }

        @media (max-width: 1199.98px) {
            .table-responsive-xl {
                display: block;
                width: 100%;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
                -ms-overflow-style: -ms-autohiding-scrollbar;
            }
        }
    </style>
<body>
    <div class="container">
        <h1>CALENDRIER OLYMPIQUE</h1>
        <nav>
            <ul>
                <li><a href="<?php echo e(route('calendrier_mensuel')); ?>">Calendrier Mensuel</a></li>
                <li><a href="<?php echo e(route('calendrier_quotidien')); ?>">Calendrier Quotidien</a></li>
            </ul>
        </nav>

        <?php echo $__env->yieldContent('content'); ?>
    </div>


</body>
</html>
<?php /**PATH C:\Users\tamil\www\jos\resources\views/calendrier.blade.php ENDPATH**/ ?>