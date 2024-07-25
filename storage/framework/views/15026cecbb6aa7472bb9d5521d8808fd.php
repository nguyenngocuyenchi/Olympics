


<?php $__env->startSection('content'); ?>
    <div>        
        <h2>Calendrier Quotidien des Jeux Olympiques</h2>

        <div class="container">
            <div class="row">
                <div class="col-6">    
                    <form method="GET">
                        <div class="col-6">    
                            <div class="dropdown">
                                <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Sélectionner un lieu
                                </button>
                                <ul class="dropdown-menu">
                                    <?php $__currentLoopData = $lieux; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lieu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="lieu_<?php echo e($lieu->id); ?>" name="lieu_filter[]" value="<?php echo e($lieu->id); ?>">
                                                <label class="form-check-label" for="lieu_<?php echo e($lieu->id); ?>"><?php echo e($lieu->nom); ?></label>
                                            </div>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                            <div class="dropdown">
                                <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Sélectionner une date
                                </button>
                                <ul class="dropdown-menu">
                                    <?php $__currentLoopData = $jours_olympique; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="date_<?php echo e($date); ?>" name="date_filter[]" value="<?php echo e($date); ?>">
                                                <label class="form-check-label" for="date_<?php echo e($date); ?>"><?php echo e($date); ?></label>
                                            </div>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </div>
            
                        <div class="row">
                            <div class="col">
                                <button type="submit" class="btn">Appliquer les filtres</button>
                            </div>
                            <div class="col"></div>
                        </div> 
                    </form>
                </div>
            </div>
        </div>

        <div>
            <?php $__currentLoopData = $jours_olympique; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <strong><?php echo e($date); ?></strong> <br>
                <?php $__currentLoopData = $sports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sport): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $competitions = $sport->competition()
                            ->whereDate('jour', $date)
                            ->when(request()->has('lieu_filter'), function ($query) {
                                return $query->whereIn('lieu_id', request()->input('lieu_filter'));
                            })
                            ->when(request()->has('date_filter'), function ($query) use ($date) {
                                return $query->whereIn('jour', request()->input('date_filter'));
                            })
                            ->get();
                    ?>
                    <?php $__currentLoopData = $competitions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $competition): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div>
                            <p>Sport : <?php echo e($sport->nom); ?></p>
                            <p>Epreuve : <?php echo e($competition->type); ?></p>
                            <p>Lieu : <?php echo e($competition->lieu->nom); ?></p>
                            <hr>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('calendrier.calendrier', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\tamil\www\jos\resources\views//calendrier/calendrier_quotidien.blade.php ENDPATH**/ ?>