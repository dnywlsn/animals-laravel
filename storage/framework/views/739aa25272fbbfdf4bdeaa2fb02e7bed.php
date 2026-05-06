<?php $__env->startSection('title', __('Register')); ?>

<?php $__env->startSection('content'); ?>
<div class="auth-wrapper">
    <div class="auth-card glass-card">
        <div class="auth-header">
            <h2><?php echo e(__('Create Account')); ?></h2>
            <p><?php echo e(__('Join our community and help animals find a new home in Astana.')); ?></p>
        </div>

        <form action="<?php echo e(route('register')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            
            <div class="form-group">
                <label><?php echo e(__('Full Name')); ?></label>
                <input type="text" name="name" class="form-control" placeholder="John Doe" value="<?php echo e(old('name')); ?>" required>
            </div>

            <div class="form-group">
                <label><?php echo e(__('Email Address')); ?></label>
                <input type="email" name="email" class="form-control" placeholder="name@example.com" value="<?php echo e(old('email')); ?>" required>
            </div>

            <div class="form-group-row">
                <div class="form-group">
                    <label><?php echo e(__('Password')); ?></label>
                    <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                </div>
                <div class="form-group">
                    <label><?php echo e(__('Confirm Password')); ?></label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="••••••••" required>
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100"><?php echo e(__('Create Account')); ?></button>

            <div class="auth-footer">
                <p><?php echo e(__("Already have an account?")); ?> <a href="<?php echo e(route('login')); ?>"><?php echo e(__('Log In')); ?></a></p>
            </div>
        </form>
    </div>
</div>

<style>
    .auth-wrapper { 
        min-height: 90vh; display: flex; align-items: center; justify-content: center; 
        padding: 2rem; padding-top: 6rem;
    }
    .auth-card { width: 100%; max-width: 550px; }
    .auth-header { text-align: center; margin-bottom: 2.5rem; }
    .auth-header h2 { font-size: 2.2rem; font-weight: 800; margin-bottom: 0.5rem; letter-spacing: -1px; }
    .auth-header p { color: var(--secondary); font-size: 0.95rem; }
    .form-group-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
    .w-100 { width: 100%; margin-top: 1rem; }
    .auth-footer { text-align: center; margin-top: 2rem; font-size: 0.9rem; color: var(--secondary); }
    .auth-footer a { color: var(--accent); text-decoration: none; font-weight: 600; }
    
    @media (max-width: 600px) {
        .form-group-row { grid-template-columns: 1fr; gap: 0; }
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/aizhan/Downloads/aizhan-project/resources/views/auth/register.blade.php ENDPATH**/ ?>