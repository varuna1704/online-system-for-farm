<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Select Category</title>
<style>
    :root {
        --ink: #0f172a;
        --muted: #475569;
        --line: #cbd5e1;
        --white: #f8fafc;
    }
    * { box-sizing: border-box; }
    body {
        margin: 0;
        font-family: "Trebuchet MS", "Segoe UI", sans-serif;
        color: var(--ink);
        background:
            radial-gradient(circle at 12% 18%, rgba(14,165,233,.26), transparent 28%),
            radial-gradient(circle at 86% 14%, rgba(16,185,129,.24), transparent 22%),
            linear-gradient(160deg,#dbeafe 0%,#dcfce7 55%,#e2e8f0 100%);
        min-height: 100vh;
    }
    .orb {
        position: fixed;
        border-radius: 999px;
        filter: blur(24px);
        opacity: .28;
        pointer-events: none;
        z-index: 0;
        animation: drift 8s ease-in-out infinite;
    }
    .orb.a {
        width: 220px;
        height: 220px;
        background: #38bdf8;
        left: -60px;
        top: 130px;
    }
    .orb.b {
        width: 240px;
        height: 240px;
        background: #22c55e;
        right: -70px;
        top: 220px;
        animation-delay: 1.6s;
    }
    @keyframes drift {
        0%,100% { transform: translateY(0) translateX(0); }
        50% { transform: translateY(-15px) translateX(8px); }
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
        gap: .55rem;
        margin-bottom: .7rem;
    }
    .top-actions a {
        text-decoration: none;
        color: #f8fafc;
        background: linear-gradient(135deg,#1d4ed8 0%,#0ea5e9 100%);
        border-radius: 999px;
        padding: .45rem .78rem;
        font-size: .82rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .35px;
        transition: transform .2s ease, box-shadow .2s ease;
    }
    .top-actions a:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 14px rgba(14,116,144,.32);
    }
    .hero {
        border-radius: 22px;
        background: linear-gradient(140deg,#052e16 0%,#1d4ed8 55%,#0ea5e9 100%);
        color: #f8fafc;
        padding: 1.2rem 1.1rem;
        box-shadow: 0 16px 38px rgba(15,23,42,.22);
        animation: rise .65s ease-out both;
    }
    .hero h1 {
        margin: 0;
        font-size: clamp(1.55rem,3vw,2.3rem);
        letter-spacing: .7px;
    }
    .hero p {
        margin: .55rem 0 0;
        color: #dbeafe;
        line-height: 1.52;
        max-width: 760px;
    }
    .grid {
        margin-top: 1rem;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(285px, 1fr));
        gap: .9rem;
    }
    .card {
        background: rgba(248,250,252,.9);
        border: 1px solid var(--line);
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 12px 24px rgba(15,23,42,.14);
        transform: translateY(12px);
        opacity: 0;
        transition: transform .45s ease, opacity .45s ease, box-shadow .25s ease;
    }
    .card.visible {
        transform: translateY(0);
        opacity: 1;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 18px 30px rgba(15,23,42,.2);
    }
    .card img {
        width: 100%;
        height: 220px;
        object-fit: cover;
        display: block;
    }
    .body {
        padding: .86rem .92rem .95rem;
    }
    .body h2 {
        margin: 0 0 .45rem;
        font-size: 1.25rem;
    }
    .line {
        margin: 0 0 .24rem;
        color: var(--muted);
        font-size: .9rem;
        line-height: 1.42;
    }
    .btn-row {
        margin-top: .66rem;
        display: flex;
        gap: .45rem;
        flex-wrap: wrap;
    }
    .btn {
        text-decoration: none;
        color: #f8fafc;
        background: linear-gradient(135deg,#1d4ed8 0%,#0ea5e9 100%);
        border-radius: 10px;
        padding: .5rem .75rem;
        font-size: .84rem;
        font-weight: 700;
        letter-spacing: .3px;
        transition: transform .2s ease, box-shadow .2s ease;
    }
    .btn.alt {
        background: linear-gradient(135deg,#0f172a 0%,#334155 100%);
    }
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 14px rgba(15,23,42,.28);
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
        <a href="welcome.php">Back</a>
        <a href="logout.php">Logout</a>
    </div>

    <section class="hero">
        <h1>Select Any Category</h1>
        <p>Choose a section to get quick crop guidance and focused agricultural information with interactive navigation.</p>
    </section>

    <section class="grid">
        <article class="card reveal">
            <img src="../images/s1.jpeg" alt="Crop Category">
            <div class="body">
                <h2>Crop</h2>
                <p class="line">1. Explore key crop types with season-oriented insights.</p>
                <p class="line">2. Learn basic soil fit and climate suitability factors.</p>
                <p class="line">3. Understand high-level crop growth planning needs.</p>
                <p class="line">4. Move to crop-specific pages for deeper details.</p>
                <div class="btn-row">
                    <a class="btn" href="Crop.php">Open Crop</a>
                    <a class="btn alt" href="crop_insights.php">View Insights</a>
                </div>
            </div>
        </article>

        <article class="card reveal">
            <img src="../images/s2.jpeg" alt="Vegetable Category">
            <div class="body">
                <h2>Vegetable</h2>
                <p class="line">1. Browse vegetable options for short and medium cycles.</p>
                <p class="line">2. Check category examples for practical farm selection.</p>
                <p class="line">3. Compare basic productivity and management effort.</p>
                <p class="line">4. Open vegetable modules to continue planning quickly.</p>
                <div class="btn-row">
                    <a class="btn" href="vegetable.php">Open Vegetable</a>
                    <a class="btn alt" href="v1ladyfinger.php">Sample Detail</a>
                </div>
            </div>
        </article>

        <article class="card reveal">
            <img src="../images/s3.jpeg" alt="Fruit Category">
            <div class="body">
                <h2>Fruit</h2>
                <p class="line">1. Access fruit crop category and orchard-focused choices.</p>
                <p class="line">2. Review broad suitability before choosing varieties.</p>
                <p class="line">3. Understand long-term yield and care considerations.</p>
                <p class="line">4. Navigate to fruit pages for crop-specific guidance.</p>
                <div class="btn-row">
                    <a class="btn" href="Fruit.php">Open Fruit</a>
                    <a class="btn alt" href="f1.php">Sample Detail</a>
                </div>
            </div>
        </article>
    </section>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>

<script>
(() => {
    const items = document.querySelectorAll('.reveal');
    const io = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                io.unobserve(entry.target);
            }
        });
    }, { threshold: 0.2 });
    items.forEach((item) => io.observe(item));
})();
</script>
</body>
</html>

