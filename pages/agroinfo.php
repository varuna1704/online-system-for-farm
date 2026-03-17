<?php include __DIR__ . '/../includes/login_header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Agro Info Dashboard</title>
<style>
    :root {
        --ink: #0f172a;
        --muted: #475569;
        --white: #f8fafc;
        --line: #cbd5e1;
    }
    * { box-sizing: border-box; }
    body {
        margin: 0;
        min-height: 100vh;
        font-family: "Trebuchet MS", "Segoe UI", sans-serif;
        color: var(--ink);
        background:
            radial-gradient(circle at 12% 18%, rgba(14,165,233,.28), transparent 28%),
            radial-gradient(circle at 88% 14%, rgba(34,197,94,.22), transparent 24%),
            linear-gradient(165deg, #dbeafe 0%, #dcfce7 54%, #e2e8f0 100%);
        overflow-x: hidden;
    }
    .orb {
        position: fixed;
        border-radius: 999px;
        filter: blur(24px);
        opacity: .3;
        z-index: 0;
        pointer-events: none;
        animation: drift 8s ease-in-out infinite;
    }
    .orb.a {
        width: 230px;
        height: 230px;
        background: #38bdf8;
        left: -70px;
        top: 120px;
    }
    .orb.b {
        width: 210px;
        height: 210px;
        background: #22c55e;
        right: -50px;
        top: 250px;
        animation-delay: 1.7s;
    }
    @keyframes drift {
        0%,100% { transform: translateY(0) translateX(0); }
        50% { transform: translateY(-16px) translateX(10px); }
    }
    .wrap {
        position: relative;
        z-index: 1;
        width: min(1160px, 95%);
        margin: 84px auto 26px;
    }
    .hero {
        border-radius: 24px;
        color: #f8fafc;
        background: linear-gradient(140deg, #020617 0%, #1d4ed8 56%, #0ea5e9 100%);
        box-shadow: 0 18px 40px rgba(15,23,42,.24);
        padding: 1.25rem 1.15rem;
        animation: panelIn .65s ease-out both;
    }
    .hero h1 {
        margin: 0;
        font-size: clamp(1.6rem, 3.2vw, 2.4rem);
        letter-spacing: .8px;
    }
    .hero p {
        margin: .6rem 0 0;
        max-width: 760px;
        line-height: 1.56;
        color: #dbeafe;
    }
    .module-grid {
        margin-top: 1rem;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: .8rem;
    }
    .module {
        border: 1px solid var(--line);
        border-radius: 16px;
        background: rgba(248,250,252,.92);
        box-shadow: 0 12px 24px rgba(15,23,42,.14);
        padding: .84rem .86rem .9rem;
        transform: translateY(12px);
        opacity: 0;
        transition: transform .45s ease, opacity .45s ease, box-shadow .25s ease;
    }
    .module.visible {
        transform: translateY(0);
        opacity: 1;
    }
    .module:hover {
        transform: translateY(-4px);
        box-shadow: 0 18px 30px rgba(15,23,42,.19);
    }
    .module h3 {
        margin: 0;
        font-size: 1.08rem;
    }
    .module p {
        margin: .46rem 0 .72rem;
        color: var(--muted);
        font-size: .9rem;
        line-height: 1.45;
    }
    .btn {
        display: inline-block;
        text-decoration: none;
        color: #f8fafc;
        background: linear-gradient(135deg, #1d4ed8 0%, #0ea5e9 100%);
        border-radius: 10px;
        padding: .5rem .72rem;
        font-size: .82rem;
        font-weight: 700;
        letter-spacing: .3px;
        transition: transform .2s ease, box-shadow .2s ease;
    }
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 14px rgba(14,116,144,.32);
    }
    .info-section {
        margin-top: 1rem;
        border: 1px solid var(--line);
        border-radius: 18px;
        background: rgba(248,250,252,.9);
        box-shadow: 0 12px 24px rgba(15,23,42,.14);
        padding: 1rem;
        animation: panelIn .8s ease-out both;
    }
    .info-section h2 {
        margin: 0 0 .5rem;
        font-size: 1.35rem;
    }
    .info-list {
        margin: 0;
        padding-left: 1rem;
        color: #334155;
        line-height: 1.55;
        font-size: .95rem;
    }
    .info-list li {
        margin-bottom: .35rem;
    }
    @keyframes panelIn {
        from { opacity: 0; transform: translateY(12px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
</head>
<body>
<div class="orb a"></div>
<div class="orb b"></div>

<main class="wrap">
    <section class="hero">
        <h1>Agro Info Dashboard</h1>
        <p>
            This dashboard gives you one-click access to crop, fruit, vegetable, fertilizer, and support modules.
            It is designed to help farmers quickly navigate useful pages and get practical agriculture information.
        </p>
    </section>

    <section class="module-grid">
        <article class="module reveal">
            <h3>Crops</h3>
            <p>Open crop section with visual cards and key cultivation details.</p>
            <a class="btn" href="Crop.php">Open Crops</a>
        </article>

        <article class="module reveal">
            <h3>Vegetables</h3>
            <p>Use the animated vegetable slider with info and quick actions.</p>
            <a class="btn" href="vegetable.php">Open Vegetables</a>
        </article>

        <article class="module reveal">
            <h3>Fruits</h3>
            <p>View fruit gallery where information drops down on hover.</p>
            <a class="btn" href="Fruit.php">Open Fruits</a>
        </article>

        <article class="module reveal">
            <h3>Crop Insights</h3>
            <p>Explore category-level crop planning and selection guidance.</p>
            <a class="btn" href="crop_insights.php">Open Insights</a>
        </article>

        <article class="module reveal">
            <h3>Fertilizer Hub</h3>
            <p>Browse fertilizer modules and jump to product/cart screens.</p>
            <a class="btn" href="fertilizer_hub.php">Open Hub</a>
        </article>

        <article class="module reveal">
            <h3>Fertilizer Store</h3>
            <p>See available fertilizers and add products into cart quickly.</p>
            <a class="btn" href="fertilizer.php">Open Store</a>
        </article>

        <article class="module reveal">
            <h3>Farmer Dashboard</h3>
            <p>Track platform stats and navigate major modules from one view.</p>
            <a class="btn" href="farmer_dashboard.php">Open Dashboard</a>
        </article>

        <article class="module reveal">
            <h3>Cart & Checkout</h3>
            <p>Review selected products and continue with checkout flow.</p>
            <a class="btn" href="cart_fert.php">Open Cart</a>
        </article>

        <article class="module reveal">
            <h3>Account Access</h3>
            <p>Login or register to use personalized modules and workflow.</p>
            <a class="btn" href="user_login.php">Open Login</a>
            <a class="btn" href="user_reg.php" style="margin-left:.42rem;">Open Register</a>
        </article>
    </section>

    <section class="info-section">
        <h2>Platform Information</h2>
        <ul class="info-list">
            <li>This project supports farmers with crop, fruit, vegetable, and fertilizer guidance in one place.</li>
            <li>Users can explore category pages, read short practical info, and move to detail pages instantly.</li>
            <li>The fertilizer module connects store, cart, and checkout flow for simpler purchase decisions.</li>
            <li>Animated UI components are used across pages to improve readability and user interaction.</li>
            <li>Dashboard-style navigation reduces time spent searching and helps focus on farm decisions.</li>
        </ul>
    </section>
</main>

<?php include __DIR__ . '/../includes/footer_agri.php'; ?>
<script>
(() => {
    const cards = document.querySelectorAll('.reveal');
    const io = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                io.unobserve(entry.target);
            }
        });
    }, { threshold: 0.16 });
    cards.forEach((card) => io.observe(card));
})();
</script>
</body>
</html>

