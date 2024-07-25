

<?php $__env->startSection('title', 'Register'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container mb-5">
        <div class="row">
            <div class="col-12 mt-5 text-center">
                <h1>Register</h1>
            </div>
        </div>
        <?php if($errors->any()): ?>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="alert alert-danger mt-2" role="alert">
                    <?php echo e($error); ?>

                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
        <form class="mt-5" method="post">
            <?php echo csrf_field(); ?>
            <div class="row">
                <div class="mb-3 col">
                    <label for="nom" class="form-label">Nom :</label>
                    <input type="text" class="form-control" id="nom" name="nom" value="<?php echo e(old('nom')); ?>">
                </div>
                <div class="mb-3 col">
                    <label for="prenom" class="form-label">Prénom :</label>
                    <input type="text"class="form-control" id="prenom" name="prenom" value="<?php echo e(old('prenom')); ?>">
                </div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email : </label>
                <input type="text" class="form-control" id="email" name="email" value="<?php echo e(old('email')); ?>">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe :</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Créer</button>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\tamil\www\jos\resources\views/user/register.blade.php ENDPATH**/ ?>