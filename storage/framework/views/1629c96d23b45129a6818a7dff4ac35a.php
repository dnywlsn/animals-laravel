<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" data-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $__env->yieldContent('title'); ?> - Astana Animal Shelter</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root[data-theme="dark"] {
            --bg: #050505;
            --card: #121212;
            --primary: #ffffff;
            --secondary: #b0b0b0;
            --accent: #3498db;
            --accent-soft: rgba(52, 152, 219, 0.15);
            --text: #ffffff;
            --nav-bg: #050505;
            --nav-bg-rgb: 5, 5, 5;
            --border: rgba(255, 255, 255, 0.08);
            --input-bg: #1a1a1a;
        }

        :root[data-theme="light"] {
            --bg: #ffffff;
            --card: #f8f9fa;
            --primary: #1a1a1a;
            --secondary: #636e72;
            --accent: #0984e3;
            --accent-soft: rgba(9, 132, 227, 0.1);
            --text: #1a1a1a;
            --nav-bg: #ffffff;
            --nav-bg-rgb: 255, 255, 255;
            --border: rgba(0, 0, 0, 0.05);
            --input-bg: #ffffff;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        html { scroll-behavior: smooth; }
        html.snap-enabled { 
            scroll-snap-type: y mandatory; 
            scroll-padding-top: 70px;
        }
        
        body { 
            font-family: 'Outfit', sans-serif; background: var(--bg); color: var(--text); 
            line-height: 1.6; transition: background 0.4s, color 0.4s;
            overflow-x: hidden;
            padding-top: 70px;
        }
        body.snap-page { padding-top: 0; }

        .navbar { 
            display: flex; justify-content: space-between; align-items: center; 
            padding: 0 5%; background: rgba(var(--nav-bg-rgb), 0.8); 
            backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);
            position: fixed; top: 0; left: 0; right: 0; z-index: 9999;
            border-bottom: 1px solid var(--border);
            height: 70px;
            box-shadow: 0 4px 30px rgba(0,0,0,0.05);
        }
        .nav-brand { font-size: 1.4rem; font-weight: 800; color: var(--primary); text-decoration: none; letter-spacing: -1px; transition: 0.3s; }
        .nav-brand:hover { opacity: 0.8; }
        .nav-brand span { color: var(--accent); }
        .nav-right { display: flex; gap: 1.5rem; align-items: center; }
        .nav-links { display: flex; gap: 1.5rem; align-items: center; }
        .nav-links a { color: var(--secondary); text-decoration: none; font-weight: 600; font-size: 0.85rem; transition: 0.3s; position: relative; padding: 0.5rem 0; }
        .nav-links a::after { content: ''; position: absolute; bottom: 0; left: 0; width: 0; height: 2px; background: var(--accent); transition: 0.3s; }
        .nav-links a:hover::after, .nav-links a.active::after { width: 100%; }
        .nav-links a:hover, .nav-links a.active { color: var(--primary); }

        .container { max-width: 1200px; margin: 0 auto; padding: 2rem 2rem; width: 100%; min-height: 80vh; }

        .btn { padding: 0.8rem 1.5rem; border-radius: 12px; border: none; font-weight: 700; cursor: pointer; transition: 0.3s; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; gap: 0.5rem; font-size: 0.9rem; }
        .btn-primary { background: var(--accent); color: white; }
        .btn-outline { border: 1px solid var(--border); color: var(--primary); background: var(--card); }

        .lang-switcher { display: flex; gap: 0.2rem; background: var(--card); padding: 0.2rem; border-radius: 8px; border: 1px solid var(--border); }
        .lang-link { padding: 0.3rem 0.6rem; border-radius: 6px; font-size: 0.7rem; color: var(--secondary); text-decoration: none; font-weight: 700; }
        .lang-link.active { background: var(--accent); color: white; }

        .glass-card { 
            background: var(--card); 
            border: 1px solid var(--border); 
            border-radius: 24px; 
            padding: 2rem;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        }

        .form-control {
            width: 100%; padding: 0.7rem 1.2rem; 
            background: var(--input-bg); 
            border: 1px solid var(--border); 
            border-radius: 12px; 
            color: var(--primary); 
            font-family: inherit;
            transition: 0.3s;
        }
        .form-control:focus { outline: none; border-color: var(--accent); }
    </style>
</head>
<body class="<?php echo e(Request::is('/') ? 'snap-page' : ''); ?>">
    <script>
        if (window.location.pathname === '/') {
            document.documentElement.classList.add('snap-enabled');
        }
    </script>

    <nav class="navbar">
        <a href="/" class="nav-brand">Astana <span>Shelter</span></a>
        <div class="nav-right">
            <div class="nav-links">
                <a href="/" class="<?php echo e(Request::is('/') ? 'active' : ''); ?>"><?php echo e(__('Home')); ?></a>
                <a href="<?php echo e(route('animals.index')); ?>" class="<?php echo e(Request::is('animals*') ? 'active' : ''); ?>"><?php echo e(__('Animals')); ?></a>
                <?php if(auth()->guard()->check()): ?>
                    <a href="<?php echo e(route('dashboard')); ?>" class="<?php echo e(Request::is('dashboard') ? 'active' : ''); ?>"><?php echo e(__('Dashboard')); ?></a>
                    <form action="<?php echo e(route('logout')); ?>" method="POST" style="display: inline;">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn btn-outline" style="padding: 0.3rem 0.6rem; font-size: 0.7rem;"><?php echo e(__('Logout')); ?></button>
                    </form>
                <?php else: ?>
                    <a href="<?php echo e(route('login')); ?>" class="<?php echo e(Request::is('login') ? 'active' : ''); ?>"><?php echo e(__('Login')); ?></a>
                <?php endif; ?>
            </div>
            <button class="theme-toggle" id="themeToggle" style="background:none; border:none; cursor:pointer; font-size:1.2rem;">🌓</button>
            <div class="lang-switcher">
                <a href="<?php echo e(route('lang.switch', 'kk')); ?>" class="lang-link <?php echo e(app()->getLocale() == 'kk' ? 'active' : ''); ?>">KK</a>
                <a href="<?php echo e(route('lang.switch', 'ru')); ?>" class="lang-link <?php echo e(app()->getLocale() == 'ru' ? 'active' : ''); ?>">RU</a>
                <a href="<?php echo e(route('lang.switch', 'en')); ?>" class="lang-link <?php echo e(app()->getLocale() == 'en' ? 'active' : ''); ?>">EN</a>
            </div>
        </div>
    </nav>

    <main class="<?php echo e(Request::is('/') ? '' : 'container'); ?>">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <script>
        const themeToggle = document.getElementById('themeToggle');
        const html = document.documentElement;
        const currentTheme = localStorage.getItem('theme') || 'dark';
        html.setAttribute('data-theme', currentTheme);

        themeToggle.addEventListener('click', () => {
            const newTheme = html.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
            html.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
        });
    </script>
</body>
</html>
<?php /**PATH /Users/oralbek/Desktop/aizhan-project/resources/views/layouts/app.blade.php ENDPATH**/ ?>