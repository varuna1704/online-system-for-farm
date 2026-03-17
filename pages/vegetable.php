<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Vegetable Hub</title>
<style>
    :root {
        --ink: #0f172a;
        --muted: #475569;
        --line: #cbd5e1;
        --white: #f8fafc;
    }
    * {
        box-sizing: border-box;
    }
    body {
        margin: 0;
        font-family: "Trebuchet MS", "Segoe UI", sans-serif;
        color: var(--ink);
        background:
            radial-gradient(circle at 11% 18%, rgba(34,197,94,.30), transparent 28%),
            radial-gradient(circle at 88% 14%, rgba(14,165,233,.24), transparent 24%),
            linear-gradient(165deg,#dcfce7 0%,#dbeafe 56%,#e2e8f0 100%);
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
        width: 240px;
        height: 240px;
        background: #22c55e;
        left: -70px;
        top: 120px;
    }
    .orb.b {
        width: 220px;
        height: 220px;
        background: #0ea5e9;
        right: -60px;
        top: 220px;
        animation-delay: 1.6s;
    }
    @keyframes drift {
        0%, 100% { transform: translateY(0) translateX(0); }
        50% { transform: translateY(-16px) translateX(8px); }
    }
    .page-wrap {
        position: relative;
        z-index: 1;
        width: min(1180px, 95%);
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
        background: linear-gradient(140deg,#052e16 0%,#15803d 48%,#0ea5e9 100%);
        box-shadow: 0 16px 36px rgba(15,23,42,.22);
        padding: 1.2rem 1.1rem;
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
        font-size: clamp(1.6rem, 3.1vw, 2.35rem);
        letter-spacing: .7px;
    }
    .hero p {
        margin: .58rem 0 0;
        max-width: 760px;
        color: #dbeafe;
        line-height: 1.5;
    }
    .slider-shell {
        margin-top: 1rem;
        border: 1px solid #cbd5e1;
        border-radius: 18px;
        background: rgba(248,250,252,.88);
        box-shadow: 0 14px 28px rgba(15,23,42,.16);
        padding: .85rem .85rem 1rem;
    }
    .slider-head {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: .6rem;
        flex-wrap: wrap;
        margin-bottom: .65rem;
    }
    .slider-head h2 {
        margin: 0;
        font-size: 1.35rem;
    }
    .slider-controls {
        display: inline-flex;
        align-items: center;
        gap: .45rem;
    }
    .ctrl-btn {
        border: 1px solid #1d4ed8;
        background: #eff6ff;
        color: #1d4ed8;
        border-radius: 10px;
        min-width: 38px;
        height: 34px;
        font-size: 1.1rem;
        font-weight: 800;
        cursor: pointer;
        transition: transform .2s ease, background-color .2s ease, color .2s ease;
    }
    .ctrl-btn:hover {
        background: #1d4ed8;
        color: #f8fafc;
        transform: translateY(-1px);
    }
    .slider-window {
        overflow: hidden;
        border-radius: 14px;
    }
    .slider-track {
        display: flex;
        gap: .8rem;
        transition: transform .48s ease;
        will-change: transform;
    }
    .veg-card {
        flex: 0 0 calc((100% - 1.6rem) / 3);
        border: 1px solid var(--line);
        border-radius: 14px;
        overflow: hidden;
        background: rgba(255,255,255,.95);
        box-shadow: 0 10px 20px rgba(15,23,42,.12);
        transition: transform .22s ease, box-shadow .22s ease;
    }
    .veg-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 14px 24px rgba(15,23,42,.18);
    }
    .veg-card img {
        width: 100%;
        height: 190px;
        object-fit: cover;
        display: block;
    }
    .veg-body {
        padding: .75rem .78rem .82rem;
    }
    .veg-body h3 {
        margin: 0 0 .45rem;
        font-size: 1.08rem;
    }
    .info {
        margin: 0 0 .22rem;
        color: var(--muted);
        font-size: .86rem;
        line-height: 1.4;
    }
    .btn-row {
        margin-top: .58rem;
        display: flex;
        gap: .42rem;
        flex-wrap: wrap;
    }
    .btn {
        text-decoration: none;
        color: #f8fafc;
        background: linear-gradient(135deg,#1d4ed8 0%,#0ea5e9 100%);
        border-radius: 9px;
        padding: .44rem .68rem;
        font-size: .78rem;
        font-weight: 700;
        letter-spacing: .25px;
        transition: transform .2s ease, box-shadow .2s ease;
    }
    .btn.alt {
        background: linear-gradient(135deg,#0f172a 0%,#334155 100%);
    }
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 12px rgba(15,23,42,.25);
    }
    .dot-wrap {
        margin-top: .72rem;
        display: flex;
        justify-content: center;
        gap: .38rem;
    }
    .dot {
        width: 8px;
        height: 8px;
        border-radius: 999px;
        background: #94a3b8;
        transition: transform .2s ease, background-color .2s ease;
    }
    .dot.active {
        background: #1d4ed8;
        transform: scale(1.25);
    }
    @media (max-width: 980px) {
        .veg-card {
            flex-basis: calc((100% - .8rem) / 2);
        }
    }
    @media (max-width: 640px) {
        .veg-card {
            flex-basis: 100%;
        }
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
        <h1>Vegetable Hub</h1>
        <p>Slide through vegetable options, check quick cultivation notes, and open detail pages from each card.</p>
    </section>

    <section class="slider-shell">
        <div class="slider-head">
            <h2>Vegetable Slider</h2>
            <div class="slider-controls">
                <button class="ctrl-btn" id="prevBtn" type="button" aria-label="Previous">&#8249;</button>
                <button class="ctrl-btn" id="nextBtn" type="button" aria-label="Next">&#8250;</button>
            </div>
        </div>

        <div class="slider-window">
            <div class="slider-track" id="vegTrack">
                <article class="veg-card">
                    <img src="../images/v1.jpeg" alt="Ladyfinger">
                    <div class="veg-body">
                        <h3>Ladyfinger</h3>
                        <p class="info">1. Grows well in warm weather and bright sunlight.</p>
                        <p class="info">2. Needs well-drained fertile soil for better pods.</p>
                        <p class="info">3. Regular picking improves continuous production.</p>
                        <p class="info">4. Light irrigation and weed control are important.</p>
                        <div class="btn-row">
                            <a class="btn" href="v1ladyfinger.php">View Details</a>
                            <a class="btn alt" href="Crop.php">Crop Match</a>
                        </div>
                    </div>
                </article>

                <article class="veg-card">
                    <img src="../images/v2.jpeg" alt="Potato">
                    <div class="veg-body">
                        <h3>Potato</h3>
                        <p class="info">1. Prefers cool climate during tuber development.</p>
                        <p class="info">2. Loose, friable soil helps uniform tuber growth.</p>
                        <p class="info">3. Timely earthing-up protects tubers from sunlight.</p>
                        <p class="info">4. Balanced fertilizer improves yield and quality.</p>
                        <div class="btn-row">
                            <a class="btn" href="v2potato.php">View Details</a>
                            <a class="btn alt" href="Crop.php">Crop Match</a>
                        </div>
                    </div>
                </article>

                <article class="veg-card">
                    <img src="../images/v3.jpeg" alt="Cauliflower">
                    <div class="veg-body">
                        <h3>Cauliflower</h3>
                        <p class="info">1. Cool and moist conditions support good curd size.</p>
                        <p class="info">2. Rich soil with organic matter gives better growth.</p>
                        <p class="info">3. Uniform moisture prevents stress and loose curds.</p>
                        <p class="info">4. Timely pest checks keep heads market ready.</p>
                        <div class="btn-row">
                            <a class="btn" href="v3califlower.php">View Details</a>
                            <a class="btn alt" href="Crop.php">Crop Match</a>
                        </div>
                    </div>
                </article>

                <article class="veg-card">
                    <img src="../images/s2.jpeg" alt="Tomato" style="object-position: right center;">
                    <div class="veg-body">
                        <h3>Tomato</h3>
                        <p class="info">1. Needs full sun and regular moisture for fruit set.</p>
                        <p class="info">2. Support staking improves air flow and harvest ease.</p>
                        <p class="info">3. Potash-rich feeding helps color and firmness.</p>
                        <p class="info">4. Early blight control is key in humid weather.</p>
                        <div class="btn-row">
                            <a class="btn" href="agroinfo.php">Growing Tips</a>
                            <a class="btn alt" href="fertilizer_hub.php">Fertilizer Hub</a>
                        </div>
                    </div>
                </article>

                <article class="veg-card">
                    <img src="../images/s2.jpeg" alt="Spinach" style="object-position: left center;">
                    <div class="veg-body">
                        <h3>Spinach</h3>
                        <p class="info">1. Thrives in cool season with quick leafy growth.</p>
                        <p class="info">2. Frequent light irrigation keeps leaves tender.</p>
                        <p class="info">3. Nitrogen helps richer green and better biomass.</p>
                        <p class="info">4. Harvest in intervals for continuous supply.</p>
                        <div class="btn-row">
                            <a class="btn" href="agroinfo.php">Growing Tips</a>
                            <a class="btn alt" href="fertilizer_hub.php">Fertilizer Hub</a>
                        </div>
                    </div>
                </article>

                <article class="veg-card">
                    <img src="../images/s2.jpeg" alt="Brinjal" style="object-position: 78% center;">
                    <div class="veg-body">
                        <h3>Brinjal</h3>
                        <p class="info">1. Performs best in warm climate and fertile soil.</p>
                        <p class="info">2. Consistent moisture supports flowering and fruiting.</p>
                        <p class="info">3. Field sanitation reduces shoot and fruit borer risk.</p>
                        <p class="info">4. Regular picking encourages higher total yield.</p>
                        <div class="btn-row">
                            <a class="btn" href="agroinfo.php">Growing Tips</a>
                            <a class="btn alt" href="fertilizer_hub.php">Fertilizer Hub</a>
                        </div>
                    </div>
                </article>
            </div>
        </div>

        <div class="dot-wrap" id="dotWrap"></div>
    </section>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>

<script>
(() => {
    const track = document.getElementById('vegTrack');
    const cards = Array.from(track.children);
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const dotWrap = document.getElementById('dotWrap');
    let index = 0;
    let timer = null;

    const visibleCount = () => {
        if (window.innerWidth <= 640) return 1;
        if (window.innerWidth <= 980) return 2;
        return 3;
    };

    const cardStep = () => cards[0].getBoundingClientRect().width + 12.8;

    const maxIndex = () => Math.max(0, cards.length - visibleCount());

    const buildDots = () => {
        dotWrap.innerHTML = '';
        const count = maxIndex() + 1;
        for (let i = 0; i < count; i++) {
            const dot = document.createElement('span');
            dot.className = 'dot';
            dot.addEventListener('click', () => {
                index = i;
                render();
                restartAuto();
            });
            dotWrap.appendChild(dot);
        }
    };

    const render = () => {
        if (index > maxIndex()) index = maxIndex();
        if (index < 0) index = 0;
        track.style.transform = `translateX(${-index * cardStep()}px)`;
        const dots = Array.from(dotWrap.children);
        dots.forEach((d, i) => d.classList.toggle('active', i === index));
    };

    const next = () => {
        index = index >= maxIndex() ? 0 : index + 1;
        render();
    };

    const prev = () => {
        index = index <= 0 ? maxIndex() : index - 1;
        render();
    };

    const restartAuto = () => {
        if (timer) clearInterval(timer);
        timer = setInterval(next, 3800);
    };

    nextBtn.addEventListener('click', () => {
        next();
        restartAuto();
    });

    prevBtn.addEventListener('click', () => {
        prev();
        restartAuto();
    });

    window.addEventListener('resize', () => {
        buildDots();
        render();
    });

    buildDots();
    render();
    restartAuto();
})();
</script>
</body>
</html>

