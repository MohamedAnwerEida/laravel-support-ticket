<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">

        <div class="panel panel-default">
            <div class="panel-heading">
                $oneticket->title
            </div>

            <div class="panel-body">
                <table class="table table-striped table-hover">
                <thead>
                    <tr class="success">
                        <th>serial</th>
                        <th>data</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th> ticket number </th>
                        <td><?php echo e($oneticket->id); ?> </td>
                    </tr>
                    <tr>
                        <th> Subject  </th>
                        <td><?php echo e($oneticket->title); ?> </td>
                    </tr>
                    <tr>
                        <th> Section  </th>
                        <td><?php echo e($oneticket->categoryName->name); ?> </td>
                    </tr>
                    
                    <tr>
                        <th> Text of the message </th>
                        <td><?php echo e($oneticket->text); ?> </td>
                    </tr>
                    <?php if(isset($oneticket->ticket_file)): ?>
                    <tr>
                        <th> Attachments </th>
                        <td>
                        <?php $__currentLoopData = $oneticket->ticket_file; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $one): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(url('/upload/files/'.$one->file)); ?>" download class="btn btn-success btn-sm">Download attachment</a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
                </table>
                <hr class="style-six">
                <?php if(count($oneticket->comments) > 0): ?>
                    <?php $__currentLoopData = $oneticket->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($comment->check_admin != 1): ?>
                            <ul class="list-group admin"  dir="rtl" >
                                <li class="list-group-item">
                                    <?php if($comment->own == 0): ?>
                                        <span class="badge pull-left">
                                            <?php echo e($oneticket->user->name); ?>

                                        </span>
                                    <?php else: ?>
                                        <span class="badge pull-left badge-admin">
                                            By a moderator
                                        </span>
                                    <?php endif; ?>

                                    <?php if(isset($comment->file_comment)): ?>

                                        <?php $__currentLoopData = $comment->file_comment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $one): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <a href="<?php echo e(url('/upload/files/'.$one->file)); ?>" download class="btn btn-success btn-sm">Download attachment</a>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <hr class="style-six">
                                    <?php endif; ?>
                                    <?php echo $comment->comment; ?>

                                    <span class="custom-span"><?php echo e($comment->created_at->diffForHumans()); ?></span>
                                </li>
                            </ul>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                <ul class="list-group admin"  dir="rtl">
                    <li class="list-group-item">
                        <span class="badge pull-left">0</span>
                        no comments
                    </li>
                </ul>
                <?php endif; ?>

                <hr class="style-six">
                <?php if(@$sent == true ): ?>
                            <div class="alert alert-success">
                                    Comment sent
                            </div>
                    <div class="clearfix"></div>
                    <?php else: ?>
                    <div class="h4 text-center" >Add new comment</div>
                    <form method="post" action="" dir="rtl" enctype="multipart/form-data">
                        <?php echo e(csrf_field()); ?>

                        <div class="col-md-6 col-md-offset-3">
                            <div class="form-group  <?php echo e($errors->has('comment') ? ' has-error' : ''); ?>">
                                <div class="control-group" id="file">
                                    <label class="control-label" for="file1">
                                        Add attachments
                                    </label>
                                    <div class="controls" style="margin-bottom: 10px">

                                        <div class="entry input-group col-xs-3" style="margin-bottom: 10px">
                                            <input class="btn btn-primary" name="files[]" multiple="multiple" type="file" style="border-radius: 0px 3px 3px 0px ; ">
                                            <span class="input-group-btn">
                                                <button class="btn btn-success btn-add" type="button" style="border-radius: 3px 0px 0px 3px ;     padding: 7px 10px 7px 10px;">
                                                    <span class="glyphicon glyphicon-plus"></span>
                                                </button>
                                            </span>
                                        </div>

                                    </div>

                                </div>
                                <?php if($errors->has('files.*')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('files.*')); ?></strong>
                                    </span>
                                <?php endif; ?>
                                <textarea class="form-control textarea" placeholder="Post your comment here" name="comment" required="required" dir="auto"><?php echo e(old('comment')); ?></textarea>
                                <?php if($errors->has('comment')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('comment')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg btn-custom">send</button>
                        </div>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script type="text/javascript">

$(function()
{
    $(document).on('click', '.btn-add', function(e)
    {
        e.preventDefault();

        var controlForm = $('.controls:first'),
            currentEntry = $(this).parents('.entry:first'),
            newEntry = $(currentEntry.clone()).appendTo(controlForm);

        newEntry.find('input').val('');
        controlForm.find('.entry:not(:last) .btn-add')
            .removeClass('btn-add').addClass('btn-remove')
            .removeClass('btn-success').addClass('btn-danger')
            .html('<span class="glyphicon glyphicon-minus"></span>');
    }).on('click', '.btn-remove', function(e)
    {
      $(this).parents('.entry:first').remove();

        e.preventDefault();
        return false;
    });
});
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>