<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Crop Insights</title>
<style>
    :root {
        --ink: #0f172a;
        --muted: #475569;
        --white: #f8fafc;
        --line: #cbd5e1;
        --brand-a: #14532d;
        --brand-b: #166534;
        --brand-c: #0ea5e9;
    }
    * {
        box-sizing: border-box;
    }
    body {
        margin: 0;
        font-family: "Trebuchet MS", "Segoe UI", sans-serif;
        color: var(--ink);
        background:
            radial-gradient(circle at 12% 18%, rgba(34,197,94,.28), transparent 28%),
            radial-gradient(circle at 90% 14%, rgba(14,165,233,.28), transparent 24%),
            linear-gradient(165deg,#dcfce7 0%,#dbeafe 55%,#e2e8f0 100%);
        min-height: 100vh;
    }
    .orb {
        position: fixed;
        border-radius: 999px;
        filter: blur(22px);
        opacity: 0.28;
        z-index: 0;
        pointer-events: none;
        animation: drift 8s ease-in-out infinite;
    }
    .orb.a {
        width: 220px;
        height: 220px;
        background: #22c55e;
        left: -60px;
        top: 130px;
    }
    .orb.b {
        width: 240px;
        height: 240px;
        background: #0ea5e9;
        right: -75px;
        top: 230px;
        animation-delay: 1.8s;
    }
    @keyframes drift {
        0%,100% { transform: translateY(0) translateX(0); }
        50% { transform: translateY(-14px) translateX(8px); }
    }
    .page-wrap {
        position: relative;
        z-index: 1;
        width: min(1160px, 95%);
        margin: 84px auto 24px;
    }
    .top-actions {
        display: flex;
        justify-content: flex-end;
        gap: 0.55rem;
        margin-bottom: 0.7rem;
    }
    .top-actions a {
        text-decoration: none;
        color: #f8fafc;
        background: linear-gradient(135deg, #1d4ed8 0%, #0ea5e9 100%);
        border-radius: 999px;
        font-size: 0.82rem;
        font-weight: 800;
        letter-spacing: 0.35px;
        text-transform: uppercase;
        padding: 0.45rem 0.78rem;
        transition: transform .2s ease, box-shadow .2s ease;
    }
    .top-actions a:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(14,116,144,.32);
    }
    .hero {
        border-radius: 22px;
        background: linear-gradient(140deg,#052e16 0%,#15803d 52%,#0ea5e9 100%);
        color: #f8fafc;
        padding: 1.2rem 1.1rem;
        box-shadow: 0 16px 38px rgba(15,23,42,.22);
        animation: rise .65s ease-out both;
        position: relative;
        overflow: hidden;
    }
    .hero::after {
        content: "";
        position: absolute;
        width: 170px;
        height: 170px;
        border-radius: 999px;
        background: rgba(255,255,255,.14);
        right: -35px;
        top: -35px;
    }
    .hero h1 {
        margin: 0;
        font-size: clamp(1.6rem, 3vw, 2.3rem);
        letter-spacing: 0.6px;
    }
    .hero p {
        margin: 0.55rem 0 0;
        color: #dbeafe;
        line-height: 1.55;
        max-width: 760px;
    }
    .grid {
        margin-top: 1rem;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 0.9rem;
    }
    .crop-card {
        background: rgba(248,250,252,.9);
        border: 1px solid var(--line);
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 12px 24px rgba(15,23,42,.14);
        transform: translateY(12px);
        opacity: 0;
        transition: transform .45s ease, opacity .45s ease, box-shadow .25s ease;
    }
    .crop-card.visible {
        transform: translateY(0);
        opacity: 1;
    }
    .crop-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 18px 30px rgba(15,23,42,.2);
    }
    .crop-card img {
        width: 100%;
        height: 220px;
        object-fit: cover;
        display: block;
    }
    .crop-body {
        padding: 0.85rem 0.9rem 0.95rem;
    }
    .crop-body h2 {
        margin: 0 0 0.5rem;
        font-size: 1.25rem;
    }
    .info-line {
        margin: 0 0 0.26rem;
        font-size: 0.9rem;
        color: var(--muted);
        line-height: 1.45;
    }
    .btn {
        margin-top: 0.65rem;
        display: inline-block;
        text-decoration: none;
        color: #f8fafc;
        background: linear-gradient(135deg,#1d4ed8 0%,#0ea5e9 100%);
        border-radius: 10px;
        padding: 0.52rem 0.76rem;
        font-size: 0.84rem;
        font-weight: 700;
        letter-spacing: 0.3px;
        transition: transform .2s ease, box-shadow .2s ease;
    }
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(14,116,144,.33);
    }
    @keyframes rise {
        from { opacity: 0; transform: translateY(12px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
</head>
<body>
<div class="orb a"></div>
<div class="orb b"></div>

<?php include __DIR__ . '/../includes/header.php'; ?>

<main class="page-wrap">
    <div class="top-actions">
        <a href="select_vcf.php">Back</a>
        <a href="logout.php">Logout</a>
    </div>

    <section class="hero">
        <h1>Crop Overview</h1>
        <p>Explore key crop options with quick insights for season, soil, irrigation, and productivity planning.</p>
    </section>

    <section class="grid">
        <article class="crop-card reveal">
            <img src="../images/c1.jpeg" alt="Wheat Crop">
            <div class="crop-body">
                <h2>Wheat</h2>
                <p class="info-line">1. Wheat grows best in cool season with moderate rainfall.</p>
                <p class="info-line">2. Well-drained loamy soil supports strong root development.</p>
                <p class="info-line">3. Timely nitrogen fertilizer improves grain filling quality.</p>
                <p class="info-line">4. Irrigation at crown-root and flowering stage is important.</p>
                <p class="info-line">5. Proper spacing helps reduce disease pressure in field.</p>
                <a class="btn" href="c1.php">View Wheat Details</a>
            </div>
        </article>

        <article class="crop-card reveal">
            <img src="../images/c2.jpeg" alt="Maize Crop">
            <div class="crop-body">
                <h2>Maize</h2>
                <p class="info-line">1. Maize needs warm climate and good sunlight for growth.</p>
                <p class="info-line">2. Fertile, well-aerated soil improves cob size and yield.</p>
                <p class="info-line">3. Balanced NPK and micronutrients increase crop vigor.</p>
                <p class="info-line">4. Consistent moisture during tasseling is highly critical.</p>
                <p class="info-line">5. Early weed control prevents strong nutrient competition.</p>
                <a class="btn" href="c2.php">View Maize Details</a>
            </div>
        </article>

        <article class="crop-card reveal">
            <img src="../images/c3.jpeg" alt="Millet Crop">
            <div class="crop-body">
                <h2>Millet</h2>
                <p class="info-line">1. Millet is drought-tolerant and fits low-rainfall regions.</p>
                <p class="info-line">2. It performs well in light to medium textured soils.</p>
                <p class="info-line">3. Crop matures fast and supports climate-resilient farming.</p>
                <p class="info-line">4. Moderate fertilizer and low water input are sufficient.</p>
                <p class="info-line">5. Millet grains are nutritious and improve farm income options.</p>
                <a class="btn" href="c3.php">View Millet Details</a>
            </div>
        </article>
    </section>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>

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
    }, { threshold: 0.2 });
    cards.forEach((card) => io.observe(card));
})();
</script>
</body>
</html>

