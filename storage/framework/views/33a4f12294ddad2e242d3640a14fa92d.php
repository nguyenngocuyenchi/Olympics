


<?php $__env->startSection('content'); ?>
    <h2>Programmer une compétition</h2>
    
    <?php if(session('success')): ?>
    <div style="background-color: #daeadb; color: white; padding: 10px; margin-bottom: 15px;">
        <?php echo e(session('success')); ?>

    </div>
    <?php endif; ?>

    <form action="<?php echo e(route('/application/sauvegarder')); ?>" method="post">
        <?php echo csrf_field(); ?>

        <div class="form-group">
            <label for="sport">Sport :</label>
            <select name="sport" id="sport">
                <?php $__currentLoopData = $sports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sport): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($sport->id); ?>"><?php echo e($sport->nom); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="form-group">
            <label for="jour">Date :</label>
            <input type="date" id="jour" name="jour" min="2024-07-24" max="2024-08-11">
        </div>

        <div class="form-group heures">
            <div>
                <label for="heure_de_debut">Heure de début :</label>
                <input type="time" id="heure_de_debut" name="heure_de_debut" before="heure_de_fin" >
            </div>
            <div>
                <label for="heure_de_fin">Heure de fin :</label>
                <input type="time" id="heure_de_fin" name="heure_de_fin">
            </div>
        </div>

        <div class="form-group">
            <label for="lieu">Lieu :</label>
            <select name="lieu" id="lieu">
                <?php $__currentLoopData = $lieux; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lieu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($lieu->id); ?>"><?php echo e($lieu->nom); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="form-group">
            <label for="prix">Prix :</label>
            <input type="number" id="prix" name="prix">
        </div>


        <div class="form-group">
            <label for="type">Type :</label>
            <select id="type" name="type">
                <option value="1er tour">1er tour</option>
                <option value="Demi-Finale">Demi-Finale</option>
                <option value="Finale">Finale</option>
            </select>
        </div>

        <input type="submit" value="Programmer">
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('application.application', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Thieu\Downloads\jos\resources\views//application/programmer.blade.php ENDPATH**/ ?>