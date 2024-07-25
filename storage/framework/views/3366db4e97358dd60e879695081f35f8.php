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

    <div class="container-fluid">
        <div class="row">
        <div class="col-3">
            <form action="<?php echo e(url('/billetterie')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <button type="submit"><i class="fa fa-arrow-left"> Autre reservation</i></button>
            </form>
        </div>
        <div class="col-3">
            <form action="<?php echo e(url('/panier')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <button type="submit">Valider <i class="fa fa-arrow-right"></i></button>
            </form>
        </div>
        <div class="col-6"></div>
        
    </div>
    </div>
</body>
</html>
<?php /**PATH C:\Users\tamil\www\jos\resources\views/recapitulatif.blade.php ENDPATH**/ ?>