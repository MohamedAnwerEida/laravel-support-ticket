<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <?php if($myticket->isEmpty()): ?>
        <div class="alert alert-success text-center">
            <p class="lead">
                There are no tickets you can add a ticket from here,
            </p>
            <a title=" فتح تذكرة " class="btn btn-primary btn-lg" href="<?php echo e(url('/support')); ?>"> Open a ticket </a>
        </div>
        <?php else: ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                tickets
            </div>
        
            <div class="panel-body">
                <table class="table table-striped table-hover">
                    <tr class="success">
                        <td>#</td>
                        <td> The subject of the ticket</td>
                        <td> The name </td>
                        <td> From </td>
                    </tr>
                    <?php $__currentLoopData = $myticket; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
        
                        <td> <?php echo e($value->id); ?> </td>
        
                        <td>
                            <a title="  Add a comment " href="<?php echo e(url('/support/myticket/'.$value->id )); ?>">
                                <?php echo e($value->title); ?>

                            </a>
                        </td>
                        <td> <?php echo e($value->user->name); ?> </td>
                        <td>
                            <?php echo e($value->created_at->diffForHumans()); ?>

                        </td>
        
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </table>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>