<?php $__env->startSection('title', __('Add New Friend')); ?>

<?php $__env->startSection('content'); ?>
<div class="form-wrapper">
    <div class="glass-card form-card">
        <div class="form-header">
            <h2><?php echo e(__('Add New Friend')); ?></h2>
            <p><?php echo e(__('Enter the details of the animal to find them a new home.')); ?></p>
        </div>

        <form action="<?php echo e(route('animals.store')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            
            <div class="form-grid">
                <div class="form-group">
                    <label><?php echo e(__('Name')); ?></label>
                    <input type="text" name="name" class="form-control" placeholder="e.g. Barbos" required>
                </div>

                <div class="form-group">
                    <label><?php echo e(__('Species / Category')); ?></label>
                    <input type="text" name="species" class="form-control" list="speciesList" placeholder="<?php echo e(__('Select or type...')); ?>" required>
                    <datalist id="speciesList">
                        <option value="Dog">
                        <option value="Cat">
                        <option value="Bird">
                        <option value="Rabbit">
                        <option value="Hamster">
                        <option value="Horse">
                        <option value="Turtle">
                    </datalist>
                </div>

                <div class="form-group">
                    <label><?php echo e(__('Age (years)')); ?></label>
                    <input type="number" name="age" class="form-control" placeholder="e.g. 2" required>
                </div>

                <div class="form-group">
                    <label><?php echo e(__('Status')); ?></label>
                    <select name="status" class="form-control" required>
                        <option value="available"><?php echo e(__('Available')); ?></option>
                        <option value="pending"><?php echo e(__('Pending')); ?></option>
                        <option value="adopted"><?php echo e(__('Adopted')); ?></option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label><?php echo e(__('Description')); ?></label>
                <textarea name="description" class="form-control" rows="4" placeholder="<?php echo e(__('Tell us more about this friend...')); ?>" required></textarea>
            </div>

            <div class="form-group">
                <label><?php echo e(__('Upload Image')); ?></label>
                <div class="image-upload-wrapper">
                    <input type="file" name="image" id="imageInput" class="form-control" accept="image/*">
                    <div id="imagePreview" class="image-preview">
                        <span><?php echo e(__('No image selected')); ?></span>
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <a href="<?php echo e(route('animals.index')); ?>" class="btn btn-outline"><?php echo e(__('Cancel')); ?></a>
                <button type="submit" class="btn btn-primary"><?php echo e(__('Save Animal')); ?></button>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('imageInput').addEventListener('change', function(e) {
        const preview = document.getElementById('imagePreview');
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.innerHTML = `<img src="${e.target.result}" style="width:100%; height:100%; object-fit:cover; border-radius:12px;">`;
            }
            reader.readAsDataURL(file);
        }
    });
</script>

<style>
    .form-wrapper { display: flex; justify-content: center; padding-top: 5rem; }
    .form-card { width: 100%; max-width: 800px; }
    .form-header { text-align: center; margin-bottom: 3rem; }
    .form-header h2 { font-size: 2.2rem; font-weight: 800; }
    .form-header p { color: var(--secondary); }
    
    .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem; }
    .image-upload-wrapper { margin-top: 0.5rem; }
    .image-preview { 
        margin-top: 1rem; width: 100%; height: 250px; background: var(--bg); 
        border: 2px dashed var(--border); border-radius: 16px; 
        display: flex; align-items: center; justify-content: center; color: var(--secondary);
    }
    .form-actions { display: flex; justify-content: flex-end; gap: 1rem; margin-top: 3rem; }
    
    @media (max-width: 600px) { .form-grid { grid-template-columns: 1fr; } }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/oralbek/Desktop/aizhan-project/resources/views/animals/create.blade.php ENDPATH**/ ?>