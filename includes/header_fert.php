<?php
require_once __DIR__ . '/con_pg.php';

$row_count = 0;
$select_rows = @pg_query($con, "SELECT * FROM cart");
if ($select_rows) {
    $row_count = pg_num_rows($select_rows);
}
?>
<style>
    .fert-topbar {
        position: sticky;
        top: 0;
        z-index: 50;
        margin: 0 0 1.2rem 0;
        background: linear-gradient(135deg, #0f172a 0%, #1d4ed8 55%, #0ea5e9 100%);
        box-shadow: 0 12px 30px rgba(15, 23, 42, 0.35);
    }
    .fert-inner {
        max-width: 1150px;
        margin: 0 auto;
        padding: 0.85rem 1rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        flex-wrap: wrap;
    }
    .fert-brand {
        color: #f8fafc;
        text-decoration: none;
        font-size: 1.2rem;
        font-weight: 800;
        letter-spacing: 1px;
        padding: 0.45rem 0.8rem;
        border-radius: 999px;
        background: rgba(248, 250, 252, 0.14);
        transition: transform 0.2s ease, background 0.2s ease;
    }
    .fert-brand:hover {
        transform: translateY(-1px);
        background: rgba(248, 250, 252, 0.22);
    }
    .fert-nav {
        display: flex;
        align-items: center;
        gap: 0.6rem;
        flex: 1;
        min-width: 250px;
    }
    .fert-link {
        text-decoration: none;
        color: #e2e8f0;
        font-size: 0.92rem;
        font-weight: 700;
        letter-spacing: 0.4px;
        text-transform: uppercase;
        padding: 0.55rem 0.8rem;
        border-radius: 999px;
        background: rgba(2, 6, 23, 0.26);
        transition: transform 0.2s ease, background 0.2s ease, color 0.2s ease;
    }
    .fert-link:hover {
        color: #ffffff;
        background: rgba(2, 6, 23, 0.48);
        transform: translateY(-1px);
    }
    .fert-cart {
        margin-left: auto;
        text-decoration: none;
        color: #0f172a;
        background: #facc15;
        border-radius: 999px;
        font-weight: 800;
        padding: 0.5rem 0.75rem;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .fert-cart:hover {
        transform: translateY(-1px);
        box-shadow: 0 8px 18px rgba(250, 204, 21, 0.35);
    }
    .fert-cart span {
        background: #0f172a;
        color: #f8fafc;
        border-radius: 999px;
        min-width: 22px;
        height: 22px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 0.78rem;
        padding: 0 0.3rem;
    }
    @media (max-width: 700px) {
        .fert-inner {
            padding: 0.7rem;
        }
        .fert-link {
            font-size: 0.82rem;
            padding: 0.45rem 0.65rem;
        }
        .fert-brand {
            font-size: 1rem;
        }
        .fert-cart {
            margin-left: 0;
        }
    }
</style>
<header class="fert-topbar">
    <div class="fert-inner">
        <a href="select_vcf.php" class="fert-brand">AGROINFO</a>
        <nav class="fert-nav">
            <a href="admin.php" class="fert-link">Add Fertilizer</a>
            <a href="fertilizer.php" class="fert-link">View Fertilizer</a>
        </nav>
        <a href="cart_fert.php" class="fert-cart">Cart <span><?php echo $row_count; ?></span></a>
    </div>
</header>
