<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Fruit Gallery</title>
<style>
    :root {
        --ink: #0f172a;
        --white: #f8fafc;
        --muted: #475569;
    }
    * { box-sizing: border-box; }
    body {
        margin: 0;
        font-family: "Trebuchet MS", "Segoe UI", sans-serif;
        color: var(--ink);
        background:
            radial-gradient(circle at 10% 18%, rgba(244,63,94,.23), transparent 28%),
            radial-gradient(circle at 88% 15%, rgba(14,165,233,.24), transparent 24%),
            linear-gradient(165deg,#fee2e2 0%,#dbeafe 55%,#e2e8f0 100%);
        min-height: 100vh;
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
        width: 220px;
        height: 220px;
        background: #f43f5e;
        left: -65px;
        top: 130px;
    }
    .orb.b {
        width: 230px;
        height: 230px;
        background: #0ea5e9;
        right: -70px;
        top: 220px;
        animation-delay: 1.6s;
    }
    @keyframes drift {
        0%,100% { transform: translateY(0) translateX(0); }
        50% { transform: translateY(-16px) translateX(8px); }
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
        padding: .44rem .78rem;
        font-size: .82rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .35px;
        transition: transform .2s ease, box-shadow .2s ease;
    }
    .top-actions a:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 14px rgba(14,116,144,.33);
    }
    .hero {
        border-radius: 22px;
        color: #f8fafc;
        background: linear-gradient(140deg,#4c0519 0%,#be123c 52%,#0ea5e9 100%);
        box-shadow: 0 16px 38px rgba(15,23,42,.22);
        padding: 1.2rem 1.1rem;
        animation: rise .65s ease-out both;
    }
    .hero h1 {
        margin: 0;
        font-size: clamp(1.6rem,3vw,2.35rem);
        letter-spacing: .7px;
    }
    .hero p {
        margin: .55rem 0 0;
        max-width: 760px;
        color: #fecdd3;
        line-height: 1.5;
    }
    .grid {
        margin-top: 1rem;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: .9rem;
    }
    .fruit-card {
        position: relative;
        height: 360px;
        border-radius: 16px;
        overflow: hidden;
        border: 1px solid #cbd5e1;
        box-shadow: 0 12px 24px rgba(15,23,42,.16);
        transform: translateY(12px);
        opacity: 0;
        transition: transform .45s ease, opacity .45s ease, box-shadow .25s ease;
    }
    .fruit-card.visible {
        transform: translateY(0);
        opacity: 1;
    }
    .fruit-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 18px 30px rgba(15,23,42,.22);
    }
    .fruit-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transform: scale(1.01);
        transition: transform .45s ease, filter .45s ease;
    }
    .fruit-card:hover .fruit-image {
        transform: scale(1.07);
        filter: brightness(.74);
    }
    .title-chip {
        position: absolute;
        top: .62rem;
        left: .62rem;
        z-index: 2;
        color: #f8fafc;
        background: rgba(15,23,42,.58);
        border: 1px solid rgba(248,250,252,.34);
        border-radius: 999px;
        padding: .36rem .62rem;
        font-size: .78rem;
        letter-spacing: .35px;
        text-transform: uppercase;
        font-weight: 800;
    }
    .drop-info {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        padding: .82rem .78rem .86rem;
        color: #f8fafc;
        background: linear-gradient(180deg, rgba(2,6,23,.88) 0%, rgba(15,23,42,.78) 100%);
        transform: translateY(-102%);
        transition: transform .42s cubic-bezier(.2,.7,.2,1);
    }
    .fruit-card:hover .drop-info {
        transform: translateY(0);
    }
    .drop-info h3 {
        margin: 0 0 .35rem;
        font-size: 1rem;
    }
    .line {
        margin: 0 0 .2rem;
        font-size: .81rem;
        line-height: 1.38;
        color: #dbeafe;
    }
    .btn {
        margin-top: .5rem;
        display: inline-block;
        text-decoration: none;
        color: #f8fafc;
        background: linear-gradient(135deg,#1d4ed8 0%,#0ea5e9 100%);
        border-radius: 9px;
        padding: .4rem .65rem;
        font-size: .75rem;
        font-weight: 700;
        letter-spacing: .25px;
    }
    .hint {
        margin-top: .7rem;
        text-align: center;
        color: #334155;
        font-size: .9rem;
        font-weight: 600;
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
        <h1>Fruit Gallery</h1>
        <p>Hover on each fruit image to drop down cultivation information and open the related detail page.</p>
    </section>

    <section class="grid">
        <article class="fruit-card reveal">
            <span class="title-chip">Mango</span>
            <img class="fruit-image" src="../images/f1.jpeg" alt="Mango">
            <div class="drop-info">
                <h3>Mango</h3>
                <p class="line">1. Requires warm climate and full sunlight.</p>
                <p class="line">2. Deep loamy soil supports strong root growth.</p>
                <p class="line">3. Flowering stage needs balanced moisture.</p>
                <p class="line">4. Pruning improves canopy and fruit quality.</p>
                <a class="btn" href="f1.php">View Mango Details</a>
            </div>
        </article>

        <article class="fruit-card reveal">
            <span class="title-chip">Guava</span>
            <img class="fruit-image" src="../images/f2.jpeg" alt="Guava">
            <div class="drop-info">
                <h3>Guava</h3>
                <p class="line">1. Tolerates varied climates and gives regular yield.</p>
                <p class="line">2. Performs best in well-drained fertile soil.</p>
                <p class="line">3. Timely irrigation boosts fruit size and weight.</p>
                <p class="line">4. Light pruning encourages fresh productive shoots.</p>
                <a class="btn" href="f2.php">View Guava Details</a>
            </div>
        </article>

        <article class="fruit-card reveal">
            <span class="title-chip">Grape</span>
            <img class="fruit-image" src="../images/f3.jpeg" alt="Grape">
            <div class="drop-info">
                <h3>Grape</h3>
                <p class="line">1. Needs dry weather with proper vine training.</p>
                <p class="line">2. Well-aerated soil improves root activity.</p>
                <p class="line">3. Pruning schedule controls bunch quality.</p>
                <p class="line">4. Balanced nutrients enhance sweetness and color.</p>
                <a class="btn" href="f3.php">View Grape Details</a>
            </div>
        </article>

        <article class="fruit-card reveal">
            <span class="title-chip">Mixed Fruits</span>
            <img class="fruit-image" src="../images/s3.jpeg" alt="Mixed Fruits">
            <div class="drop-info">
                <h3>Mixed Fruits</h3>
                <p class="line">1. Diversified orchards reduce single-crop risk.</p>
                <p class="line">2. Mixed planting can improve seasonal income flow.</p>
                <p class="line">3. Nutrient planning should match crop stage needs.</p>
                <p class="line">4. Integrated pest management keeps orchard healthy.</p>
                <a class="btn" href="agroinfo.php">Open Agro Info</a>
            </div>
        </article>
    </section>

    <p class="hint">Hover on any fruit card to see the drop-down info animation.</p>
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

