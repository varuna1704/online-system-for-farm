<?php include __DIR__ . '/../includes/header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Contact Us</title>
<style>
    :root {
        --ink: #0f172a;
        --muted: #475569;
        --white: #f8fafc;
    }
    * {
        box-sizing: border-box;
    }
    body {
        margin: 0;
        min-height: 100vh;
        font-family: "Trebuchet MS", "Segoe UI", sans-serif;
        color: var(--ink);
        background:
            radial-gradient(circle at 12% 18%, rgba(14,165,233,.25), transparent 28%),
            radial-gradient(circle at 88% 12%, rgba(245,158,11,.25), transparent 24%),
            linear-gradient(165deg, #dbeafe 0%, #e2e8f0 55%, #f1f5f9 100%);
        overflow-x: hidden;
    }
    .orb {
        position: fixed;
        border-radius: 999px;
        filter: blur(24px);
        opacity: .3;
        pointer-events: none;
        z-index: 0;
        animation: floatOrb 8s ease-in-out infinite;
    }
    .orb.a {
        width: 220px;
        height: 220px;
        background: #38bdf8;
        left: -70px;
        top: 120px;
    }
    .orb.b {
        width: 200px;
        height: 200px;
        background: #f59e0b;
        right: -50px;
        top: 250px;
        animation-delay: 1.6s;
    }
    @keyframes floatOrb {
        0%,100% { transform: translateY(0) translateX(0); }
        50% { transform: translateY(-16px) translateX(10px); }
    }
    .wrap {
        position: relative;
        z-index: 1;
        width: min(1120px, 95%);
        margin: 84px auto 26px;
    }
    .hero {
        border-radius: 22px;
        padding: 1.2rem 1.1rem;
        color: #f8fafc;
        background: linear-gradient(140deg, #020617 0%, #1d4ed8 58%, #0ea5e9 100%);
        box-shadow: 0 16px 38px rgba(15,23,42,.22);
        animation: panelIn .65s ease-out both;
    }
    .hero h1 {
        margin: 0;
        font-size: clamp(1.6rem, 3.2vw, 2.4rem);
        letter-spacing: .7px;
    }
    .hero p {
        margin: .58rem 0 0;
        color: #dbeafe;
        max-width: 760px;
        line-height: 1.55;
    }
    .grid {
        margin-top: 1rem;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: .85rem;
    }
    .card {
        border: 1px solid #cbd5e1;
        border-radius: 16px;
        background: rgba(248,250,252,.92);
        box-shadow: 0 12px 24px rgba(15,23,42,.14);
        padding: .92rem .9rem;
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
    .card h2 {
        margin: 0 0 .6rem;
        font-size: 1.15rem;
    }
    .item {
        display: flex;
        align-items: center;
        gap: .5rem;
        margin: .36rem 0;
        padding: .48rem .54rem;
        border-radius: 10px;
        background: #eff6ff;
        border: 1px solid #dbeafe;
        transition: transform .2s ease, background-color .2s ease;
    }
    .item:hover {
        transform: translateX(4px);
        background: #dbeafe;
    }
    .dot {
        width: 9px;
        height: 9px;
        border-radius: 999px;
        background: linear-gradient(135deg,#1d4ed8 0%,#0ea5e9 100%);
        flex: 0 0 auto;
    }
    .item a {
        color: #0f172a;
        text-decoration: none;
        font-size: .92rem;
        font-weight: 700;
        word-break: break-word;
    }
    .item a:hover {
        text-decoration: underline;
    }
    .note {
        margin-top: .72rem;
        color: var(--muted);
        font-size: .9rem;
        line-height: 1.45;
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
        <h1>Contact Us</h1>
        <p>Reach our team by email, Instagram, or phone. Use any option below and we will connect with you quickly.</p>
    </section>

    <section class="grid">
        <article class="card reveal">
            <h2>Email Support</h2>
            <div class="item"><span class="dot"></span><a href="mailto:onlinesystemforfarm7@gmail.com">onlinesystemforfarm7@gmail.com</a></div>
            <div class="item"><span class="dot"></span><a href="mailto:onlinesystemforfarm45@gmail.com">onlinesystemforfarm45@gmail.com</a></div>
            <div class="item"><span class="dot"></span><a href="mailto:onlinesystemforfarm18@gmail.com">onlinesystemforfarm18@gmail.com</a></div>
            <p class="note">Send your crop, fertilizer, or account-related queries anytime.</p>
        </article>

        <article class="card reveal">
            <h2>Instagram</h2>
            <div class="item"><span class="dot"></span><a href="#" title="Instagram ID">Farm_System74518</a></div>
            <p class="note">Follow for regular updates, farm ideas, and seasonal guidance posts.</p>
        </article>

        <article class="card reveal">
            <h2>Contact Number</h2>
            <div class="item"><span class="dot"></span><a href="tel:9325265916">9325265916</a></div>
            <div class="item"><span class="dot"></span><a href="tel:8010558420">8010558420</a></div>
            <div class="item"><span class="dot"></span><a href="tel:7620631597">7620631597</a></div>
            <p class="note">Call during daytime for fast support and onboarding help.</p>
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
    }, { threshold: 0.18 });
    cards.forEach((card) => io.observe(card));
})();
</script>
</body>
</html>

