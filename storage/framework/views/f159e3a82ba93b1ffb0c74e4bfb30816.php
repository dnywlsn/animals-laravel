<?php $__env->startSection('title', __('Animals')); ?>

<?php $__env->startSection('content'); ?>
<div class="animals-page">
    <div class="page-header glass-card">
        <div class="header-text">
            <h1><?php echo e(__('Our Friends')); ?></h1>
            <p><?php echo e(__('Explore and manage the animals in our shelter.')); ?></p>
        </div>
        <?php if(auth()->user()->role !== 'guest'): ?>
            <a href="<?php echo e(route('animals.create')); ?>" class="btn btn-primary btn-sm">
                <span class="plus">+</span> <?php echo e(__('Add New Friend')); ?>

            </a>
        <?php endif; ?>
    </div>

    <div class="glass-card filter-card">
        <form action="<?php echo e(route('animals.index')); ?>" method="GET" class="filter-grid">
            <div class="filter-group">
                <label><?php echo e(__('Search')); ?></label>
                <input type="text" name="search" class="form-control" placeholder="<?php echo e(__('Search by name...')); ?>" value="<?php echo e(request('search')); ?>">
            </div>
            
            <div class="filter-group">
                <label><?php echo e(__('Species')); ?></label>
                <select name="species" class="form-control">
                    <option value=""><?php echo e(__('All Species')); ?></option>
                    <?php $__currentLoopData = $speciesList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $species): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($species); ?>" <?php echo e(request('species') == $species ? 'selected' : ''); ?>>
                            <?php echo e(__($species)); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="filter-group">
                <label><?php echo e(__('Status')); ?></label>
                <select name="status" class="form-control">
                    <option value=""><?php echo e(__('All Statuses')); ?></option>
                    <option value="available" <?php echo e(request('status') == 'available' ? 'selected' : ''); ?>><?php echo e(__('Available')); ?></option>
                    <option value="pending" <?php echo e(request('status') == 'pending' ? 'selected' : ''); ?>><?php echo e(__('Pending')); ?></option>
                    <option value="adopted" <?php echo e(request('status') == 'adopted' ? 'selected' : ''); ?>><?php echo e(__('Adopted')); ?></option>
                </select>
            </div>

            <div class="filter-actions">
                <button type="submit" class="btn btn-accent"><?php echo e(__('Apply')); ?></button>
                <a href="<?php echo e(route('animals.index')); ?>" class="btn btn-outline"><?php echo e(__('Reset')); ?></a>
            </div>
        </form>
    </div>

    <div class="animals-grid">
        <?php $__empty_1 = true; $__currentLoopData = $animals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $animal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="animal-card-v2">
                <div class="card-image">
                    <?php if($animal->image_path): ?>
                        <img src="<?php echo e(asset('storage/' . $animal->image_path)); ?>" alt="<?php echo e($animal->name); ?>">
                    <?php else: ?>
                        <div class="placeholder-img">🐾</div>
                    <?php endif; ?>
                    <div class="status-tag tag-<?php echo e($animal->status); ?>"><?php echo e(__($animal->status)); ?></div>
                    
                    <div class="image-overlay-tags">
                        <span class="mini-tag">🛡️ <?php echo e(__('Vaccinated')); ?></span>
                        <span class="mini-tag">💖 <?php echo e(__('Friendly')); ?></span>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="card-title-row">
                        <h3><?php echo e($animal->name); ?></h3>
                        <span class="type-pill"><?php echo e(__($animal->species)); ?></span>
                    </div>
                    
                    <div class="meta-info">
                        <span>📅 <?php echo e($animal->created_at->format('d.m.Y')); ?></span>
                        <span>⚖️ <?php echo e(rand(2, 25)); ?> кг</span>
                    </div>

                    <p class="age-label"><?php echo e($animal->age); ?> <?php echo e(__('years old')); ?></p>
                    <p class="card-desc"><?php echo e(Str::limit($animal->description, 120)); ?></p>
                    
                    <div class="card-footer">
                        <?php if($animal->status === 'available'): ?>
                            <form action="<?php echo e(route('animals.inquire', $animal)); ?>" method="POST" style="width: 100%; margin-bottom: 1rem;">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="btn btn-primary w-100">
                                    <span>📩</span> <?php echo e(__('Inquire About Adoption')); ?>

                                </button>
                            </form>
                        <?php endif; ?>

                        <?php if(auth()->user()->role !== 'guest'): ?>
                            <div class="admin-btns">
                                <a href="<?php echo e(route('animals.edit', $animal)); ?>" class="btn-action edit" title="<?php echo e(__('Edit')); ?>">
                                    <span>✏️</span> <?php echo e(__('Edit')); ?>

                                </a>
                                <form action="<?php echo e(route('animals.destroy', $animal)); ?>" method="POST" onsubmit="return confirm('<?php echo e(__('Are you sure?')); ?>')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn-action delete" title="<?php echo e(__('Delete')); ?>">
                                        <span>🗑️</span> <?php echo e(__('Delete')); ?>

                                    </button>
                                </form>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="glass-card empty-state" style="grid-column: 1/-1; text-align: center; padding: 4rem;">
                <div style="font-size: 3rem; margin-bottom: 1rem;">🔍</div>
                <h3><?php echo e(__('No friends found matching your criteria.')); ?></h3>
                <p style="color: var(--secondary); margin-top: 0.5rem;"><?php echo e(__('Try adjusting your filters or search terms.')); ?></p>
                <a href="<?php echo e(route('animals.index')); ?>" class="btn btn-primary" style="margin-top: 2rem;"><?php echo e(__('View All Animals')); ?></a>
            </div>
        <?php endif; ?>
    </div>
</div>

<style>
    .animals-page { padding-top: 1rem; }
    .page-header { 
        display: flex; 
        justify-content: space-between; 
        align-items: center; 
        margin-bottom: 2rem;
        padding: 1.2rem 2rem !important;
        background: linear-gradient(135deg, var(--card), var(--bg));
    }
    .header-text h1 { font-size: 2.2rem; font-weight: 800; letter-spacing: -1.5px; line-height: 1; }
    .header-text p { color: var(--secondary); font-size: 0.95rem; margin-top: 0.2rem; }
    
    .filter-card { padding: 1.2rem; margin-bottom: 2rem; background: var(--card); border: 1px solid var(--border); }
    .filter-grid { display: grid; grid-template-columns: 1.5fr 1fr 1fr auto; gap: 1rem; align-items: flex-end; }
    .filter-group label { display: block; margin-bottom: 0.5rem; font-size: 0.7rem; font-weight: 800; color: var(--secondary); text-transform: uppercase; letter-spacing: 1.5px; }
    .filter-actions { display: flex; gap: 0.6rem; }
    .btn-accent { background: var(--primary); color: var(--bg); font-weight: 800; padding: 0.7rem 1.5rem; border-radius: 10px; border: none; cursor: pointer; transition: 0.3s; }
    .btn-accent:hover { opacity: 0.9; transform: translateY(-2px); }

    .animals-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1.5rem; }
    
    .animal-card-v2 { 
        background: var(--card); border-radius: 20px; overflow: hidden; 
        transition: all 0.3s ease;
        border: 1px solid var(--border);
        display: flex;
        flex-direction: column;
    }
    .animal-card-v2:hover { transform: translateY(-5px); border-color: var(--accent); }
    
    .card-image { height: 200px; position: relative; overflow: hidden; }
    .card-image img { width: 100%; height: 100%; object-fit: cover; }
    
    .image-overlay-tags { position: absolute; bottom: 0.8rem; left: 0.8rem; display: flex; gap: 0.4rem; }
    .mini-tag { background: rgba(0,0,0,0.6); backdrop-filter: blur(5px); color: white; padding: 0.2rem 0.5rem; border-radius: 6px; font-size: 0.65rem; font-weight: 600; }

    .status-tag { position: absolute; top: 1rem; right: 1rem; padding: 0.4rem 1rem; border-radius: 20px; font-size: 0.65rem; font-weight: 800; text-transform: uppercase; z-index: 5; }
    .tag-available { background: rgba(46, 204, 113, 0.9); color: white; }
    .tag-pending { background: rgba(241, 196, 15, 0.9); color: black; }
    .tag-adopted { background: rgba(231, 76, 60, 0.9); color: white; }

    .card-body { padding: 1.2rem; display: flex; flex-direction: column; flex-grow: 1; }
    .card-title-row { display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.4rem; }
    .card-title-row h3 { font-size: 1.4rem; font-weight: 800; letter-spacing: -0.5px; }
    .type-pill { background: var(--accent-soft); color: var(--accent); padding: 0.3rem 0.8rem; border-radius: 8px; font-size: 0.75rem; font-weight: 700; }
    
    .meta-info { display: flex; gap: 0.8rem; margin-bottom: 0.8rem; color: var(--secondary); font-size: 0.75rem; font-weight: 500; }

    .age-label { color: var(--accent); font-size: 0.9rem; margin-bottom: 0.8rem; font-weight: 700; }
    .card-desc { color: var(--secondary); margin-bottom: 1.5rem; line-height: 1.5; font-size: 0.85rem; min-height: 4.5em; }
    
    .card-footer { margin-top: auto; }
    .admin-btns { display: grid; grid-template-columns: 1fr 1fr; gap: 0.8rem; }
    .admin-btns form { display: contents; } /* Make the form transparent to the grid */
    
    .btn-action { 
        width: 100%;
        height: 42px; display: flex; align-items: center; justify-content: center; 
        gap: 0.5rem; border-radius: 10px; font-size: 0.85rem; font-weight: 700; text-decoration: none;
        border: 1px solid var(--border); background: var(--bg); transition: 0.3s;
        cursor: pointer; color: var(--primary);
    }
    .btn-action span { font-size: 1rem; }
    .btn-action:hover { background: var(--accent); color: white; border-color: var(--accent); }
    .btn-action.delete:hover { background: #ff4757; color: white; border-color: #ff4757; }
    .btn-action.edit { color: #f1c40f; }
    .btn-action.delete { color: #e74c3c; }
    
    .btn-sm { padding: 0.5rem 1rem; font-size: 0.8rem; }
    .plus { font-size: 1.2rem; margin-right: 0.3rem; }
    .w-100 { width: 100%; }

    @media (max-width: 1000px) { .filter-grid { grid-template-columns: 1fr 1fr; } }
    @media (max-width: 650px) { .filter-grid { grid-template-columns: 1fr; } .page-header { flex-direction: column; align-items: flex-start; gap: 1rem; } .header-text h1 { font-size: 1.8rem; } }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/oralbek/Desktop/aizhan-project/resources/views/animals/index.blade.php ENDPATH**/ ?>