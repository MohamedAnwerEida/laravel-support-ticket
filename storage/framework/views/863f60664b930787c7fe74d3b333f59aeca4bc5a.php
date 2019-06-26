<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="alert alert-info">
        <p class="lead ">
            You can send a technical support ticket and select the appropriate section from the bottom
        </p>
        </div>
        
        <div class="panel panel-default">
            <div class="panel-heading">technical support ticket</div>
 
            <div class="panel-body">
                <div class="tick-features">
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-6">
                    <a href="<?php echo e(url('/support/'.$category->id)); ?>" class="tick-feat">
                        <div class="t-feat-img">
                            <i class="<?php echo e($category->icon); ?>"></i>
                        </div>
                        <div class="t-feat-info">
                            <h3><?php echo e($category->name); ?></h3>
                            <p><?php echo e($category->text); ?></p>
                        </div>
                    </a>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>