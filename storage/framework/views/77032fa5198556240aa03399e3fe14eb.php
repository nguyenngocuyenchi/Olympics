

<?php $__env->startSection('content'); ?>
    <h2>Modifier la compétition</h2>
    
    <?php if(session('success')): ?>
        <div style="background-color: #daeadb; color: white; padding: 10px; margin-bottom: 15px;">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('editer', $competition->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        
        <div class="form-group">
            <label for="sport">Sport :</label>
            <select name="sport" id="sport">
                <?php $__currentLoopData = $sports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sport): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($sport->id); ?>" <?php if($sport->id == $competition->sport->id): ?> selected <?php endif; ?>><?php echo e($sport->nom); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        
        <div class="form-group">
            <label for="jour">Date :</label>
            <input type="date" id="jour" name="jour" min="2024-07-24" max="2024-08-11" value="<?php echo e($competition->jour); ?>">
        </div>

        <div class="form-group heures">
            <div>
                <label for="heure_de_debut">Heure de début :</label>
                <input type="time" id="heure_de_debut" name="heure_de_debut" value="<?php echo e($competition->heure_de_debut); ?>">
            </div>
            <div>
                <label for="heure_de_fin">Heure de fin :</label>
                <input type="time" id="heure_de_fin" name="heure_de_fin" value="<?php echo e($competition->heure_de_fin); ?>">
            </div>
        </div>

        <div class="form-group">
            <label for="lieu">Lieu :</label>
            <select name="lieu" id="lieu">
                <?php $__currentLoopData = $lieux; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lieu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($lieu->id); ?>" <?php if($lieu->id == $competition->lieu->id): ?> selected <?php endif; ?>><?php echo e($lieu->nom); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="form-group">
            <label for="prix">Prix :</label>
            <input type="number" id="prix" name="prix" value="<?php echo e($competition->prix); ?>">
        </div>

        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('application', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\tamil\www\jos\resources\views/modifier.blade.php ENDPATH**/ ?>