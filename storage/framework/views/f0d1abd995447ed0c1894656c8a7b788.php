


<?php $__env->startSection('content'); ?>
    <h2>Gérer les compétitions</h2>
    
    <?php if(session('success')): ?>
        <div style="background-color: #daeadb; color: white; padding: 10px; margin-bottom: 15px;">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <div class='row'>
        <div class="col">
            <div class="dropdown">
                <label for="competition" class="form-label">Compétition</label>
                <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Sélectionner une compétition
                </button>
                <ul class="dropdown-menu">
                    <?php $__currentLoopData = $sports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sport): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="dropdown-header"><?php echo e($sport->nom); ?></li>
                        <?php $__currentLoopData = $sport->competition; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $competition): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="<?php echo e($competition->id); ?>" name="competition" value="<?php echo e($competition->id); ?>">
                                    <label class="form-check-label" for="competition"><?php echo e($competition->jour); ?></label>
                                </div>
                                <form action="<?php echo e(route('/application/supprimer', $competition->id)); ?>" method="POST" style="display: inline-block;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-trash"></i> Supprimer
                                    </button>
                                </form>
                                <a href="<?php echo e(route('/application/modifier', $competition->id)); ?>" class="btn btn-warning">
                                    <i class="fas fa-edit"></i> Modifier
                                </a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <li class="dropdown-divider"></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('application.application', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\tamil\www\jos\resources\views//application/gerer.blade.php ENDPATH**/ ?>