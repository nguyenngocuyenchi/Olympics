

<?php $__env->startSection('content'); ?>
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
                        <?php $__currentLoopData = $jours_olympique; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $jour = date('d', strtotime($date)); ?>
                            <th><?php echo e($jour); ?></th>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tr>                    
                </thead>
                <tbody>
                    <?php $__currentLoopData = $sports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sport): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="sport"><?php echo e($sport->nom); ?></td>
                        <?php $__currentLoopData = $jours_olympique; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $competition_found = false; ?>
                            <?php $__currentLoopData = $sport->competition; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $competition): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($date == $competition->jour): ?>
                                    <?php $competition_found = true; ?>
                                    <?php if($competition->type == '1er tour'): ?> 
                                        <td class="case">
                                            <i class="bi bi-1-circle"></i>                                            <div class="details">
                                                <p><?php echo e($competition->sport->nom); ?> | <?php echo e(date("d/m/Y", strtotime("$competition->jour"))); ?></p>
                                                <p><?php echo e($competition->heure_de_debut); ?> - <?php echo e($competition->heure_de_fin); ?></p>
                                                <p><?php echo e($competition->lieu->nom); ?></p>
                                                <p><ul><li>Epreuve : <?php echo e($competition->type); ?></li></ul></p>
                                            </div>
                                        </td>
                                    <?php elseif($competition->type == 'Demi-Finale'): ?>
                                        <td class="case">
                                            <i class="bi bi-star"></i>                                            
                                            <div class="details">
                                                <p><?php echo e($competition->sport->nom); ?> | <?php echo e(date("d/m/Y", strtotime("$competition->jour"))); ?></p>
                                                <p><?php echo e($competition->heure_de_debut); ?> - <?php echo e($competition->heure_de_fin); ?></p>
                                                <p><?php echo e($competition->lieu->nom); ?></p>
                                                <p><ul><li>Epreuve : <?php echo e($competition->type); ?></li></ul></p>
                                            </div>
                                        </td>
                                    <?php elseif($competition->type == 'Finale'): ?>
                                        <td class="case">
                                            <i class="bi bi-award"></i>
                                            <div class="details">
                                                <p><?php echo e($competition->sport->nom); ?> | <?php echo e(date("d/m/Y", strtotime("$competition->jour"))); ?></p>
                                                <p><?php echo e($competition->heure_de_debut); ?> - <?php echo e($competition->heure_de_fin); ?></p>
                                                <p><?php echo e($competition->lieu->nom); ?></p>
                                                <p><ul><li>Epreuve : <?php echo e($competition->type); ?></li></ul></p>
                                            </div>
                                        </td>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php if(!$competition_found): ?>
                                <td class="case"></td>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php echo $__env->make('calendrier.calendrier', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Thieu\Downloads\jos\resources\views//calendrier/calendrier_mensuel.blade.php ENDPATH**/ ?>