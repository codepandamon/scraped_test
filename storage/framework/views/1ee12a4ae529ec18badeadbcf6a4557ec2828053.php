<?php $__env->startSection('index'); ?>
<div class="content-wrapper wrapper hold-transition dark-skin sidebar-mini theme-primary">
    <div class="container-full">

        <!-- Main content -->
        <section class="content ">
            <div class="row">
                <div class="col-md-4">
                    <div class="box">
                        <div class="box-header">
                            <h3><?php echo e((Session::get('results'))); ?></h3>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>
</div>




<?php $__env->stopSection(); ?>
<?php echo $__env->make('user.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\test_final\resources\views/exam/finish.blade.php ENDPATH**/ ?>