<?php $__env->startSection('title', __('Welcome')); ?>

<?php $__env->startSection('content'); ?>
<style>
    .section-title { font-size: 2.5rem; font-weight: 800; margin-bottom: 3rem; text-align: center; letter-spacing: -1.5px; }
    .section-title span { color: var(--accent); font-size: 0.9rem; display: block; margin-bottom: 0.3rem; letter-spacing: 3px; text-transform: uppercase; }
    
    .hero-section { 
        background: url('https://images.unsplash.com/photo-1450778869180-41d0601e046e?auto=format&fit=crop&q=80&w=2000');
        background-size: cover; background-position: center; text-align: center; color: white;
    }
    .hero-overlay { position: absolute; inset: 0; background: linear-gradient(to bottom, rgba(0,0,0,0.3), rgba(0,0,0,0.7)); }
    .hero-content { position: relative; z-index: 10; max-width: 800px; padding: 0 1.5rem; }
    .hero-content h1 { font-size: 4rem; line-height: 1.1; margin-bottom: 1.5rem; font-weight: 800; letter-spacing: -2px; }
    .hero-content p { font-size: 1.1rem; margin-bottom: 2.5rem; opacity: 0.9; font-weight: 400; max-width: 600px; margin-left: auto; margin-right: auto; line-height: 1.5; }
    .badge { background: var(--accent); padding: 0.5rem 1.2rem; border-radius: 50px; font-size: 0.75rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 2rem; display: inline-block; box-shadow: 0 5px 15px rgba(0,0,0,0.3); }

    .mission-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem; }
    .mission-card { text-align: left; transition: 0.6s cubic-bezier(0.165, 0.84, 0.44, 1); padding: 2rem !important; }
    .mission-card:hover { transform: translateY(-10px); border-color: var(--accent); box-shadow: 0 30px 60px rgba(0,0,0,0.2); }
    .mission-card .icon { font-size: 3rem; margin-bottom: 1.5rem; display: block; }
    .mission-card h3 { font-size: 1.5rem; margin-bottom: 1rem; font-weight: 800; letter-spacing: -0.5px; }
    .mission-card p { color: var(--secondary); font-size: 0.95rem; line-height: 1.6; }

    .stats-section { background: var(--accent-soft); position: relative; overflow: hidden; padding: 4rem 0; }
    .achievements-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 3rem; }
    .achievement-item .number { display: block; font-size: 3.5rem; font-weight: 800; color: var(--accent); line-height: 1; letter-spacing: -2px; }
    .achievement-item .label { font-size: 1.1rem; color: var(--secondary); font-weight: 700; margin-top: 1rem; display: block; }
    .achievement-item .desc { font-size: 0.8rem; color: var(--secondary); opacity: 0.7; margin-top: 0.3rem; display: block; }

    .faq-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem; }
    .faq-item { text-align: left; padding: 2rem !important; }
    .faq-item h4 { font-size: 1.2rem; margin-bottom: 1rem; color: var(--accent); font-weight: 800; }
    .faq-item p { color: var(--secondary); line-height: 1.6; font-size: 0.9rem; }

    .gallery-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; width: 100%; margin: 0 auto; }
    .gallery-item { aspect-ratio: 1.2; background-size: cover; background-position: center; border-radius: 16px; transition: 0.5s; border: 1px solid var(--border); }
    .gallery-item:hover { transform: scale(1.02); border-color: var(--accent); z-index: 2; }

    .cta-card { padding: 4rem !important; text-align: center; max-width: 800px; margin: 0 auto; }
    .cta-card h2 { font-size: 3rem; margin-bottom: 1.5rem; font-weight: 800; letter-spacing: -2px; }
    .cta-card p { font-size: 1.1rem; margin-bottom: 2rem; color: var(--secondary); }
    .newsletter-form { display: flex; gap: 1rem; max-width: 500px; margin: 2rem auto; }
    .newsletter-form .form-control { flex: 1; height: 55px; font-size: 1rem; padding: 0 1.5rem; border-radius: 12px; }
    .cta-footer { margin-top: 2rem; font-size: 0.95rem; color: var(--secondary); }
    .cta-footer a { color: var(--accent); text-decoration: none; font-weight: 800; border-bottom: 2px solid var(--accent-soft); padding-bottom: 2px; }

    /* Reveal Animation */
    .reveal { opacity: 0; transform: translateY(40px); transition: all 1s cubic-bezier(0.165, 0.84, 0.44, 1); }
    .reveal.active { opacity: 1; transform: translateY(0); }

    .snap-section { 
        height: 100vh; 
        scroll-snap-align: start; 
        padding-top: 70px;
        display: flex; 
        flex-direction: column;
        justify-content: center;
        align-items: center;
        position: relative; 
    }
    .snap-section > .container { width: 100%; }



    @media (max-width: 1000px) {
        .hero-content h1 { font-size: 4rem; }
        .section-title { font-size: 3rem; }
        .gallery-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 768px) {
        .hero-content h1 { font-size: 3rem; }
        .cta-card h2 { font-size: 2.5rem; }
        .newsletter-form { flex-direction: column; }
        .gallery-grid { grid-template-columns: 1fr; }
    }
</style>

<section class="snap-section hero-section">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <span class="badge"><?php echo e(__('🐾 Astana Best Animal Shelter')); ?></span>
        <h1><?php echo e(__('Give a Second Chance to a Friend')); ?></h1>
        <p><?php echo e(__('Join the largest and most caring animal shelter in the capital. We are dedicated to rescuing, healing, and finding loving homes for thousands of animals.')); ?></p>
        <div class="hero-buttons">
            <a href="<?php echo e(route('animals.index')); ?>" class="btn btn-primary" style="font-size: 1rem; padding: 1rem 2rem;"><?php echo e(__('Meet Our Animals')); ?></a>
            <a href="<?php echo e(route('register')); ?>" class="btn btn-outline" style="font-size: 1rem; padding: 1rem 2rem;"><?php echo e(__('Join the Mission')); ?></a>
        </div>
    </div>
</section>

<section id="mission" class="snap-section mission-section">
    <div class="container">
        <h2 class="section-title reveal"><?php echo e(__('Our Core Mission')); ?></h2>
        <div class="mission-grid">
            <div class="mission-card glass-card reveal">
                <div class="icon">🏘️</div>
                <h3><?php echo e(__('Safe Shelter')); ?></h3>
                <p><?php echo e(__('We provide high-quality living conditions for every resident. Our shelter in Astana is equipped with modern facilities for comfort and safety.')); ?></p>
            </div>
            <div class="mission-card glass-card reveal">
                <div class="icon">🩺</div>
                <h3><?php echo e(__('Medical Care')); ?></h3>
                <p><?php echo e(__('Professional veterinary care is provided 24/7. From vaccinations to complex surgeries, we ensure every animal is healthy and strong.')); ?></p>
            </div>
            <div class="mission-card glass-card reveal">
                <div class="icon">🏡</div>
                <h3><?php echo e(__('Successful Adoption')); ?></h3>
                <p><?php echo e(__('We don\'t just find homes, we find families. Our thorough matching process ensures a lifelong bond between pets and owners.')); ?></p>
            </div>
        </div>
    </div>
</section>

<section class="snap-section stats-section">
    <div class="container">
        <h2 class="section-title reveal"> <?php echo e(__('Our Collective Impact')); ?></h2>
        <div class="achievements-grid">
            <div class="achievement-item reveal">
                <span class="number">1.5K+</span>
                <span class="label"><?php echo e(__('Rescued')); ?></span>
                <span class="desc"><?php echo e(__('Abandoned lives saved from the streets.')); ?></span>
            </div>
            <div class="achievement-item reveal">
                <span class="number">920+</span>
                <span class="label"><?php echo e(__('Adopted')); ?></span>
                <span class="desc"><?php echo e(__('Successful matches and happy families.')); ?></span>
            </div>
            <div class="achievement-item reveal">
                <span class="number">120+</span>
                <span class="label"><?php echo e(__('Partners')); ?></span>
                <span class="desc"><?php echo e(__('Local businesses supporting our cause.')); ?></span>
            </div>
            <div class="achievement-item highlight reveal">
                <span class="number">5K+</span>
                <span class="label"><?php echo e(__('Donations')); ?></span>
                <span class="desc"><?php echo e(__('Total support from our community.')); ?></span>
            </div>
        </div>
    </div>
</section>

<section class="snap-section faq-section">
    <div class="container">
        <h2 class="section-title reveal"> <?php echo e(__('Everything You Need to Know')); ?></h2>
        <div class="faq-grid">
            <div class="faq-item glass-card reveal">
                <h4>🐕 <?php echo e(__('What is the adoption process?')); ?></h4>
                <p><?php echo e(__('Browse our catalog, choose a pet, and fill out the inquiry form. We will schedule a meeting and an interview to ensure the best fit for both you and the animal.')); ?></p>
            </div>
            <div class="faq-item glass-card reveal">
                <h4>📍 <?php echo e(__('Where are you located?')); ?></h4>
                <p><?php echo e(__('We are located in the heart of Astana. You can visit us during our open hours to meet the animals and see our facilities firsthand.')); ?></p>
            </div>
            <div class="faq-item glass-card reveal">
                <h4>🍖 <?php echo e(__('How can I help besides adopting?')); ?></h4>
                <p><?php echo e(__('You can donate food, medicine, or funds. We also have a great volunteer program where you can help with walking and caring for the animals.')); ?></p>
            </div>
            <div class="faq-item glass-card reveal">
                <h4>💉 <?php echo e(__('Are all animals vaccinated?')); ?></h4>
                <p><?php echo e(__('Yes, every animal that leaves our shelter is fully vaccinated, dewormed, and has a medical record provided to the new owner.')); ?></p>
            </div>
        </div>
    </div>
</section>

<section class="snap-section gallery-section">
    <div class="container">
        <h2 class="section-title reveal"> <?php echo e(__('Moments of Joy')); ?></h2>
        <div class="gallery-grid">
            <div class="gallery-item" style="background-image: url('https://images.unsplash.com/photo-1548191265-cc70d3d45ba1?auto=format&fit=crop&q=80&w=600')"></div>
            <div class="gallery-item" style="background-image: url('https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba?auto=format&fit=crop&q=80&w=600')"></div>
            <div class="gallery-item" style="background-image: url('https://images.unsplash.com/photo-1583511655857-d19b40a7a54e?auto=format&fit=crop&q=80&w=600')"></div>
            <div class="gallery-item" style="background-image: url('https://images.unsplash.com/photo-1583337130417-3346a1be7dee?auto=format&fit=crop&q=80&w=600')"></div>
            <div class="gallery-item" style="background-image: url('https://images.unsplash.com/photo-1537151608828-ea2b11777ee8?auto=format&fit=crop&q=80&w=600')"></div>
            <div class="gallery-item" style="background-image: url('https://images.unsplash.com/photo-1543466835-00a7907e9de1?auto=format&fit=crop&q=80&w=600')"></div>
            <div class="gallery-item" style="background-image: url('https://images.unsplash.com/photo-1530281700549-e82e7bf110d6?auto=format&fit=crop&q=80&w=600')"></div>
            <div class="gallery-item" style="background-image: url('https://images.unsplash.com/photo-1444212477490-ca407925329e?auto=format&fit=crop&q=80&w=600')"></div>
        </div>
    </div>
</section>

<section class="snap-section cta-section">
    <div class="container">
        <div class="cta-card glass-card reveal">
            <h2><?php echo e(__('Join Our Global Community')); ?></h2>
            <p><?php echo e(__('Stay updated with our latest rescues, success stories, and upcoming events. Your support changes lives.')); ?></p>
            <form class="newsletter-form" onsubmit="event.preventDefault(); alert('Subscribed!');">
                <input type="email" class="form-control" placeholder="your@email.com" required>
                <button type="submit" class="btn btn-primary"><?php echo e(__('Get Updates →')); ?></button>
            </form>
            <div class="cta-footer">
                <p><?php echo e(__('Ready to make a difference?')); ?> <a href="<?php echo e(route('animals.index')); ?>"><?php echo e(__('🐾 Explore All Animals 🐾')); ?></a></p>
            </div>
        </div>
    </div>
</section>

<script>
    function handleScroll() {
        const reveals = document.querySelectorAll('.reveal');
        reveals.forEach(el => {
            const rect = el.getBoundingClientRect();
            if (rect.top <= window.innerHeight * 0.85) {
                el.classList.add('active');
            }
        });
    }

    window.addEventListener('scroll', handleScroll);
    window.addEventListener('load', handleScroll);
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/aizhan/Downloads/aizhan-project/resources/views/welcome.blade.php ENDPATH**/ ?>