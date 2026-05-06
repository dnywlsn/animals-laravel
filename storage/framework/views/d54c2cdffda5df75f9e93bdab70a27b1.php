<?php $__env->startSection('title', __('register') . ' - Astana Animal Shelter'); ?>

<?php $__env->startSection('content'); ?>
<div style="max-width: 500px; margin: 4rem auto;">
    <div class="card">
        <h1 style="margin-bottom: 2rem; text-align: center;"><?php echo e(__('register')); ?></h1>
        <form action="<?php echo e(route('register')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label for="name"><?php echo e(__('name')); ?></label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="role">Role</label>
                <select name="role" id="role" class="form-control" required>
                    <option value="guest">Guest / Adopter</option>
                    <option value="volunteer">Volunteer</option>
                    <option value="manager">Manager</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%;"><?php echo e(__('register')); ?></button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/oralbek/Desktop/aizhan-project/resources/views/auth/register.blade.php ENDPATH**/ ?>