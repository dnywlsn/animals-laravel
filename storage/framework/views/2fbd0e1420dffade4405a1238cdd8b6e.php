<?php $__env->startSection('title', __('Login')); ?>

<?php $__env->startSection('content'); ?>
<div class="auth-wrapper">
    <div class="auth-card glass-card">
        <div class="auth-header">
            <h2><?php echo e(__('Welcome Back')); ?></h2>
            <p><?php echo e(__('Log in to your account to manage your favorites and inquiries.')); ?></p>
        </div>

        <form action="<?php echo e(route('login')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            
            <div class="form-group">
                <label><?php echo e(__('Email Address')); ?></label>
                <input type="email" name="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="name@example.com" value="<?php echo e(old('email')); ?>" required autofocus>
                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="error-text"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="form-group">
                <label><?php echo e(__('Password')); ?></label>
                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn btn-primary w-100"><?php echo e(__('Log In')); ?></button>

            <div class="auth-footer">
                <p><?php echo e(__("Don't have an account?")); ?> <a href="<?php echo e(route('register')); ?>"><?php echo e(__('Register here')); ?></a></p>
            </div>
        </form>
    </div>
</div>

<style>
    .auth-wrapper { 
        min-height: 90vh; display: flex; align-items: center; justify-content: center; 
        padding: 2rem; padding-top: 5rem;
    }
    .auth-card { width: 100%; max-width: 450px; }
    .auth-header { text-align: center; margin-bottom: 2.5rem; }
    .auth-header h2 { font-size: 2.2rem; font-weight: 800; margin-bottom: 0.5rem; letter-spacing: -1px; }
    .auth-header p { color: var(--secondary); font-size: 0.95rem; }
    .w-100 { width: 100%; margin-top: 1rem; }
    .auth-footer { text-align: center; margin-top: 2rem; font-size: 0.9rem; color: var(--secondary); }
    .auth-footer a { color: var(--accent); text-decoration: none; font-weight: 600; }
    .error-text { color: var(--danger); font-size: 0.8rem; margin-top: 0.5rem; display: block; }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/aizhan/Downloads/aizhan-project/resources/views/auth/login.blade.php ENDPATH**/ ?>