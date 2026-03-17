<?php
session_start();
require __DIR__ . '/../includes/con_pg.php';
require_once __DIR__ . '/../includes/path_helpers.php';

$product_count = 0;
$cart_count = 0;
$products = array();

$count_res = @pg_query($con, "SELECT COUNT(*) AS c FROM products");
if ($count_res) {
    $row = pg_fetch_assoc($count_res);
    $product_count = (int)($row['c'] ?? 0);
}

$cart_res = @pg_query($con, "SELECT COUNT(*) AS c FROM cart");
if ($cart_res) {
    $row = pg_fetch_assoc($cart_res);
    $cart_count = (int)($row['c'] ?? 0);
}

$product_res = @pg_query($con, "SELECT product_name, product_price, product_image FROM products ORDER BY product_id DESC LIMIT 6");
if ($product_res) {
    while ($row = pg_fetch_assoc($product_res)) {
        $products[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Fertilizer Hub</title>
<style>
    * { box-sizing: border-box; }
    body {
        margin: 0;
        font-family: "Trebuchet MS", "Segoe UI", sans-serif;
        color: #0f172a;
        background:
            radial-gradient(circle at 12% 15%, rgba(59,130,246,.26), transparent 28%),
            radial-gradient(circle at 90% 12%, rgba(245,158,11,.24), transparent 22%),
            linear-gradient(165deg,#dbeafe 0%,#e2e8f0 60%,#f1f5f9 100%);
        min-height: 100vh;
    }
    .wrap { width: min(1150px, 95%); margin: 84px auto 24px; }
    .hero {
        border-radius: 22px;
        padding: 1.2rem 1.1rem;
        color: #f8fafc;
        background: linear-gradient(140deg,#020617 0%,#1d4ed8 58%,#0ea5e9 100%);
        box-shadow: 0 18px 38px rgba(15,23,42,.24);
        animation: rise .65s ease-out both;
    }
    .hero h1 { margin: 0; font-size: clamp(1.5rem,3.2vw,2.3rem); }
    .hero p { margin: .55rem 0 0; color: #dbeafe; max-width: 760px; line-height: 1.5; }
    .stats {
        margin-top: .9rem;
        display: grid;
        grid-template-columns: repeat(auto-fit,minmax(170px,1fr));
        gap: .65rem;
    }
    .stat {
        border-radius: 12px;
        padding: .68rem .75rem;
        background: rgba(248,250,252,.16);
        border: 1px solid rgba(248,250,252,.25);
    }
    .stat small {
        display: block;
        text-transform: uppercase;
        letter-spacing: .35px;
        color: #bfdbfe;
        font-weight: 700;
    }
    .stat strong {
        display: block;
        margin-top: .25rem;
        font-size: 1.2rem;
    }
    .cards {
        margin-top: 1rem;
        display: grid;
        grid-template-columns: repeat(auto-fit,minmax(220px,1fr));
        gap: .8rem;
    }
    .card {
        border-radius: 15px;
        overflow: hidden;
        border: 1px solid #cbd5e1;
        background: rgba(248,250,252,.92);
        box-shadow: 0 12px 24px rgba(15,23,42,.15);
        transform: translateY(12px);
        opacity: 0;
        transition: transform .45s ease, opacity .45s ease, box-shadow .25s ease;
    }
    .card.visible { transform: translateY(0); opacity: 1; }
    .card:hover {
        transform: translateY(-4px);
        box-shadow: 0 16px 30px rgba(15,23,42,.2);
    }
    .card img {
        width: 100%;
        height: 170px;
        object-fit: cover;
        display: block;
    }
    .meta { padding: .72rem .75rem .8rem; }
    .meta h3 { margin: 0; font-size: 1.02rem; }
    .meta p { margin: .4rem 0 .65rem; color: #475569; font-size: .9rem; }
    .btn {
        display: inline-block;
        text-decoration: none;
        color: #f8fafc;
        background: linear-gradient(135deg,#1d4ed8 0%,#0ea5e9 100%);
        border-radius: 10px;
        padding: .48rem .72rem;
        font-size: .84rem;
        font-weight: 700;
    }
    .quick {
        margin-top: .95rem;
        display: flex;
        gap: .5rem;
        flex-wrap: wrap;
    }
    .quick a {
        text-decoration: none;
        color: #0f172a;
        background: #facc15;
        border-radius: 999px;
        padding: .42rem .7rem;
        font-size: .82rem;
        font-weight: 800;
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
        <h1>Fertilizer Hub</h1>
        <p>Browse fertilizers, monitor cart activity, and quickly jump into purchase or management flow.</p>
        <div class="stats">
            <article class="stat"><small>Total Products</small><strong><?php echo $product_count; ?></strong></article>
            <article class="stat"><small>Cart Items</small><strong><?php echo $cart_count; ?></strong></article>
            <article class="stat"><small>Module</small><strong>Active</strong></article>
        </div>
        <div class="quick">
            <a href="fertilizer.php">Open Fertilizer Page</a>
            <a href="cart_fert.php">Open Cart</a>
            <a href="admin.php">Admin Panel</a>
        </div>
    </section>

    <section class="cards">
        <?php if (count($products) > 0): ?>
            <?php foreach ($products as $p): ?>
                <article class="card reveal">
                    <img src="<?php echo htmlspecialchars(osf_resolve_image_path($p['product_image']), ENT_QUOTES, 'UTF-8'); ?>" alt="Fertilizer">
                    <div class="meta">
                        <h3><?php echo htmlspecialchars($p['product_name']); ?></h3>
                        <p>Price: &#8377;<?php echo number_format((float)$p['product_price']); ?>/-</p>
                        <a href="fertilizer.php" class="btn">View in Store</a>
                    </div>
                </article>
            <?php endforeach; ?>
        <?php else: ?>
            <article class="card reveal">
                <div class="meta">
                    <h3>No products available</h3>
                    <p>Add products from admin panel to populate this hub.</p>
                    <a href="admin.php" class="btn">Go to Admin</a>
                </div>
            </article>
        <?php endif; ?>
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


