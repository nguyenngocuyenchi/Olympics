<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recap</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body>
    <style>
    </style>
    <h2>Recapitulatif !</h2>

    <div class="container-fluid">
        <p>Prénom: <?php echo e($spectateur->prenom); ?></p>
        <p>Nom: <?php echo e($spectateur->nom); ?></p>
        <p>Téléphone: <?php echo e($spectateur->telephone); ?></p>
        <p>Email: <?php echo e($spectateur->email); ?></p>

        <p>Dates sélectionnées :</p>
        <ul>
            <?php $__currentLoopData = $total_billets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $billet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $__currentLoopData = $sports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sport): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $__currentLoopData = $sport->competition; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $competition): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($billet == $competition->id ): ?>
                        <li>Jour: <?php echo e($competition->jour); ?></li>
                            <li>Sport: <?php echo e($sport->nom); ?></li>
                            <li>Heure de début: <?php echo e($competition->heure_de_debut); ?></li>
                            <li>Heure de fin: <?php echo e($competition->heure_de_fin); ?></li>
                            <li>Lieu: <?php echo e($competition->lieu->nom); ?></li>
                            <li>Prix: <?php echo e($competition->prix); ?></li>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>

    <p>Les billets :</p>
    <ul>
        <?php
            $total_prix = 0;
        ?>
        <?php $__currentLoopData = $total_billets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $billet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $__currentLoopData = $sports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sport): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $__currentLoopData = $sport->competition; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $competition): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($billet == $competition->id): ?>
                        <li>Prix: <?php echo e($competition->prix); ?></li>
                        <?php
                            $total_prix += $competition->prix;
                        ?>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <p>Total: <?php echo e($total_prix); ?></p>
    </ul>

    <div class="container-fluid">
        <div class="row">
        <div class="col-3">
        <a href="<?php echo e(url('/billetterie')); ?>"><i class="fa fa-arrow-left"></i> Autre reservation</a>
        </div>
        <div class="col-3">
        <a href="<?php echo e(url('/main')); ?>">Valider <i class="fa fa-arrow-right"></i>
    </a>
        </div>
        <div class="col-6"></div>
        
    </div>
    </div>
</body>
</html>
<?php /**PATH C:\Users\Thieu\Downloads\jos\resources\views//billetterie/recapitulatif.blade.php ENDPATH**/ ?>