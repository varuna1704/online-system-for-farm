<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Crop Insights</title>
<style>
    * { box-sizing: border-box; }
    body {
        margin: 0;
        font-family: "Trebuchet MS", "Segoe UI", sans-serif;
        color: #0f172a;
        background:
            radial-gradient(circle at 12% 18%, rgba(34,197,94,.28), transparent 28%),
            radial-gradient(circle at 86% 14%, rgba(14,165,233,.28), transparent 24%),
            linear-gradient(165deg,#dcfce7 0%,#dbeafe 58%,#e2e8f0 100%);
        min-height: 100vh;
    }
    .wrap {
        width: min(1140px, 95%);
        margin: 84px auto 24px;
    }
    .hero {
        border-radius: 22px;
        background: linear-gradient(140deg,#052e16 0%,#15803d 48%,#0ea5e9 100%);
        color: #f8fafc;
        padding: 1.3rem 1.1rem;
        box-shadow: 0 18px 40px rgba(15,23,42,.22);
        animation: rise .7s ease-out both;
        position: relative;
        overflow: hidden;
    }
    .hero::after {
        content: "";
        position: absolute;
        width: 170px;
        height: 170px;
        border-radius: 999px;
        background: rgba(255,255,255,.16);
        top: -35px;
        right: -35px;
    }
    .hero h1 {
        margin: 0;
        font-size: clamp(1.6rem, 3.2vw, 2.4rem);
    }
    .hero p {
        margin: .6rem 0 0;
        color: #e2e8f0;
        line-height: 1.55;
        max-width: 700px;
    }
    .chip-row {
        margin-top: .95rem;
        display: flex;
        gap: .5rem;
        flex-wrap: wrap;
    }
    .chip {
        padding: .42rem .66rem;
        border-radius: 999px;
        background: rgba(248,250,252,.14);
        border: 1px solid rgba(248,250,252,.26);
        font-size: .78rem;
        text-transform: uppercase;
        letter-spacing: .3px;
    }
    .grid {
        margin-top: 1rem;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
        gap: .85rem;
    }
    .card {
        border-radius: 16px;
        border: 1px solid #cbd5e1;
        background: rgba(248,250,252,.9);
        box-shadow: 0 12px 24px rgba(15,23,42,.14);
        padding: .9rem .9rem 1rem;
        transform: translateY(12px);
        opacity: 0;
        transition: transform .45s ease, opacity .45s ease, box-shadow .25s ease;
    }
    .card.visible {
        transform: translateY(0);
        opacity: 1;
    }
    .card:hover {
        transform: translateY(-4px);
        box-shadow: 0 16px 26px rgba(15,23,42,.2);
    }
    .card h3 {
        margin: 0;
        font-size: 1.08rem;
    }
    .card p {
        margin: .45rem 0 .9rem;
        color: #475569;
        line-height: 1.45;
        font-size: .92rem;
    }
    .btn {
        display: inline-block;
        text-decoration: none;
        color: #f8fafc;
        background: linear-gradient(135deg,#1d4ed8 0%,#0ea5e9 100%);
        padding: .52rem .74rem;
        border-radius: 10px;
        font-size: .86rem;
        font-weight: 700;
        letter-spacing: .25px;
        transition: transform .2s ease, box-shadow .2s ease;
    }
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(14,116,144,.34);
    }
    @keyframes rise {
        from { opacity: 0; transform: translateY(12px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
</head>
<body>
<?php include __DIR__ . '/../includes/header.php'; ?>

<main class="wrap">
    <section class="hero">
        <h1>Crop Insights</h1>
        <p>Explore crop categories, planting guidance, and crop-specific pages in one interactive hub.</p>
        <div class="chip-row">
            <span class="chip">Season Planning</span>
            <span class="chip">Soil Fit</span>
            <span class="chip">Yield Focus</span>
        </div>
    </section>

    <section class="grid">
        <article class="card reveal">
            <h3>Crop Category</h3>
            <p>Open crop categories and navigate major options for farm planning.</p>
            <a class="btn" href="Crop.php">Open Crop Page</a>
        </article>
        <article class="card reveal">
            <h3>Vegetable Insights</h3>
            <p>Check vegetable-related pages and choose crop type by requirements.</p>
            <a class="btn" href="vegetable.php">View Vegetables</a>
        </article>
        <article class="card reveal">
            <h3>Fruit Insights</h3>
            <p>Review fruit sections and compare production-oriented options.</p>
            <a class="btn" href="Fruit.php">View Fruits</a>
        </article>
        <article class="card reveal">
            <h3>Back to Dashboard</h3>
            <p>Jump to the farmer dashboard for quick access to other modules.</p>
            <a class="btn" href="farmer_dashboard.php">Go Dashboard</a>
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
    items.forEach((el) => io.observe(el));
})();
</script>
</body>
</html>

