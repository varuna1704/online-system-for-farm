<?php
include __DIR__ . '/../includes/auth.php';
require __DIR__ . '/../includes/con_pg.php';

$username = $_SESSION['user_name'] ?? 'Farmer';

$users_count = 0;
$product_count = 0;
$cart_count = 0;

$res = @pg_query($con, "SELECT COUNT(*) AS c FROM users");
if ($res) {
    $row = pg_fetch_assoc($res);
    $users_count = (int)($row['c'] ?? 0);
}

$res = @pg_query($con, "SELECT COUNT(*) AS c FROM products");
if ($res) {
    $row = pg_fetch_assoc($res);
    $product_count = (int)($row['c'] ?? 0);
}

$res = @pg_query($con, "SELECT COUNT(*) AS c FROM cart");
if ($res) {
    $row = pg_fetch_assoc($res);
    $cart_count = (int)($row['c'] ?? 0);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Farmer Dashboard</title>
<style>
    * { box-sizing: border-box; }
    body {
        margin: 0;
        font-family: "Trebuchet MS", "Segoe UI", sans-serif;
        color: #0f172a;
        background:
            radial-gradient(circle at 13% 16%, rgba(14,165,233,.28), transparent 28%),
            radial-gradient(circle at 87% 18%, rgba(16,185,129,.28), transparent 24%),
            linear-gradient(160deg,#dbeafe 0%,#dcfce7 58%,#e2e8f0 100%);
        min-height: 100vh;
    }
    .wrap { width: min(1140px,95%); margin: 84px auto 24px; }
    .hero {
        border-radius: 22px;
        padding: 1.2rem 1.1rem;
        color: #f8fafc;
        background: linear-gradient(140deg,#020617 0%,#0f766e 52%,#0ea5e9 100%);
        box-shadow: 0 18px 38px rgba(15,23,42,.22);
        animation: rise .65s ease-out both;
    }
    .hero h1 { margin: 0; font-size: clamp(1.5rem,3.2vw,2.3rem); }
    .hero p { margin: .5rem 0 0; color: #dbeafe; max-width: 760px; line-height: 1.5; }
    .stats {
        margin-top: .95rem;
        display: grid;
        grid-template-columns: repeat(auto-fit,minmax(175px,1fr));
        gap: .7rem;
    }
    .stat {
        border-radius: 13px;
        padding: .68rem .75rem;
        background: rgba(248,250,252,.16);
        border: 1px solid rgba(248,250,252,.26);
    }
    .stat small {
        display: block;
        color: #bfdbfe;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .35px;
        font-size: .74rem;
    }
    .stat strong {
        display: block;
        margin-top: .24rem;
        font-size: 1.22rem;
    }
    .grid {
        margin-top: 1rem;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px,1fr));
        gap: .8rem;
    }
    .tile {
        border-radius: 16px;
        border: 1px solid #cbd5e1;
        background: rgba(248,250,252,.9);
        box-shadow: 0 12px 24px rgba(15,23,42,.14);
        padding: .9rem;
        transform: translateY(12px);
        opacity: 0;
        transition: transform .45s ease, opacity .45s ease, box-shadow .25s ease;
    }
    .tile.visible { transform: translateY(0); opacity: 1; }
    .tile:hover {
        transform: translateY(-4px);
        box-shadow: 0 16px 28px rgba(15,23,42,.2);
    }
    .tile h3 { margin: 0; font-size: 1.05rem; }
    .tile p { margin: .45rem 0 .75rem; color: #475569; font-size: .9rem; line-height: 1.45; }
    .btn {
        display: inline-block;
        text-decoration: none;
        color: #f8fafc;
        background: linear-gradient(135deg,#1d4ed8 0%,#0ea5e9 100%);
        border-radius: 10px;
        padding: .5rem .74rem;
        font-size: .84rem;
        font-weight: 700;
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
        <h1>Farmer Dashboard</h1>
        <p>Hello <?php echo htmlspecialchars($username); ?>. Track your system status and jump to your most used modules.</p>
        <div class="stats">
            <article class="stat"><small>Registered Users</small><strong><?php echo $users_count; ?></strong></article>
            <article class="stat"><small>Available Products</small><strong><?php echo $product_count; ?></strong></article>
            <article class="stat"><small>Cart Entries</small><strong><?php echo $cart_count; ?></strong></article>
            <article class="stat"><small>Session</small><strong>Active</strong></article>
        </div>
    </section>

    <section class="grid">
        <article class="tile reveal">
            <h3>Open Welcome</h3>
            <p>Go back to welcome view and core post-login navigation.</p>
            <a class="btn" href="welcome.php">Go Welcome</a>
        </article>
        <article class="tile reveal">
            <h3>Crop Insights</h3>
            <p>Review crop modules and explore category-specific sections.</p>
            <a class="btn" href="crop_insights.php">Open Insights</a>
        </article>
        <article class="tile reveal">
            <h3>Fertilizer Hub</h3>
            <p>Browse fertilizer products and manage purchase flow quickly.</p>
            <a class="btn" href="fertilizer_hub.php">Open Hub</a>
        </article>
        <article class="tile reveal">
            <h3>Cart & Checkout</h3>
            <p>Check selected products and proceed to checkout page.</p>
            <a class="btn" href="cart_fert.php">Open Cart</a>
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
    }, { threshold: 0.18 });
    items.forEach((el) => io.observe(el));
})();
</script>
</body>
</html>

