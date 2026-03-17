<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Home</title>
<style>
    :root{
        --ink:#102a43;
        --primary:#1d4ed8;
        --accent:#0ea5e9;
        --sun:#f59e0b;
        --panel:#f8fafc;
        --white:#ffffff;
    }
    *{
        box-sizing:border-box;
    }
    body{
        margin:0;
        font-family:"Trebuchet MS","Segoe UI",sans-serif;
        color:var(--ink);
        background:
            radial-gradient(circle at 12% 15%, rgba(14,165,233,0.34) 0%, transparent 28%),
            radial-gradient(circle at 85% 14%, rgba(245,158,11,0.34) 0%, transparent 26%),
            linear-gradient(160deg,#dbeafe 0%,#cbd5e1 55%,#e2e8f0 100%);
        min-height:100vh;
        animation:bgShift 8s ease-in-out infinite alternate;
    }
    @keyframes bgShift{
        from{background-position:0 0,0 0,0 0;}
        to{background-position:8px -12px,-12px 10px,0 0;}
    }
    .navbar{
        background:#020617;
        border-radius:24px;
        width:min(1120px,95%);
        margin:1rem auto;
        box-shadow:0 12px 30px rgba(2,6,23,0.35);
    }
    .navbar ul{
        margin:0;
        padding:0.75rem;
        list-style:none;
        display:flex;
        align-items:center;
        gap:0.45rem;
        flex-wrap:wrap;
    }
    .navbar li{
        display:inline-flex;
    }
    .navbar li a{
        text-decoration:none;
        color:#e2e8f0;
        font-weight:700;
        letter-spacing:0.4px;
        font-size:0.92rem;
        padding:0.58rem 0.9rem;
        border-radius:999px;
        transition:transform .2s ease, background-color .2s ease, color .2s ease;
    }
    .navbar li a:hover{
        background:rgba(29,78,216,0.34);
        color:var(--white);
        transform:translateY(-2px);
    }
    .search{
        margin-left:auto;
    }
    .navbar input{
        border:1px solid #1e293b;
        border-radius:999px;
        padding:0.55rem 0.95rem;
        width:210px;
        background:#0f172a;
        color:#f8fafc;
        transition:border-color .2s ease, box-shadow .2s ease, width .2s ease;
    }
    .navbar input:focus{
        outline:none;
        width:240px;
        border-color:var(--accent);
        box-shadow:0 0 0 3px rgba(14,165,233,0.2);
    }
    .home-wrap{
        width:min(1120px,95%);
        margin:0 auto;
    }
    .info-card{
        background:rgba(248,250,252,0.86);
        border:1px solid rgba(255,255,255,0.65);
        border-radius:22px;
        box-shadow:0 18px 40px rgba(15,23,42,0.18);
        padding:1.5rem 1.2rem;
        margin-top:1rem;
        animation:rise .7s ease-out both;
    }
    .info-card h2{
        margin:0 0 0.8rem;
        letter-spacing:0.8px;
        color:var(--primary);
        text-transform:uppercase;
    }
    .info-card p{
        margin:0;
        line-height:1.7;
        font-size:1rem;
        text-align:justify;
    }
    .gallery{
        margin-top:1.2rem;
        display:grid;
        gap:0.95rem;
        grid-template-columns:repeat(auto-fit,minmax(240px,1fr));
    }
    .gallery .reveal{
        opacity:0;
        transform:translateY(14px) scale(0.98);
        transition:opacity .55s ease, transform .55s ease, box-shadow .25s ease;
        background:var(--panel);
        border-radius:16px;
        overflow:hidden;
        border:1px solid #cbd5e1;
    }
    .gallery .reveal.visible{
        opacity:1;
        transform:translateY(0) scale(1);
    }
    .gallery .reveal:hover{
        transform:translateY(-5px) scale(1.01);
        box-shadow:0 14px 30px rgba(15,23,42,0.2);
    }
    .gallery img{
        width:100%;
        height:260px;
        object-fit:cover;
        display:block;
    }
    @keyframes rise{
        from{opacity:0; transform:translateY(15px);}
        to{opacity:1; transform:translateY(0);}
    }
    @media (max-width:700px){
        .navbar ul{
            gap:0.3rem;
        }
        .navbar li a{
            font-size:0.8rem;
            padding:0.5rem 0.7rem;
        }
        .search{
            width:100%;
            margin-top:0.3rem;
        }
        .navbar input,.navbar input:focus{
            width:100%;
        }
        .info-card p{
            font-size:0.95rem;
        }
    }
</style>
</head>
<body>
<header>
    <nav class="navbar">
        <ul>
            <li><a href="homepage.php">HOME</a></li>
            <li><a href="agroinfo.php">AGRO INFO</a></li>
            <li><a href="about_us.php">ABOUT US</a></li>
            <li><a href="contact_us.php">CONTACT</a></li>
            <li><a href="help.php">HELP</a></li>
            <div class="search">
                <input type="text" name="search" id="search" placeholder="search this website">
            </div>
        </ul>
    </nav>
</header>

<main class="home-wrap">
    <section class="info-card">
        <h2>Information</h2>
        <p>
            The Online System for farm provides researchers and farmers with online farming information.
            It offers multiple agri-related services such as fertilizer details, land type guidance, disease info,
            and suitable crop material. This web system helps farmers grow better quality crops by understanding
            seasonal crop suitability and required fertilizer types. It aims to improve current farming practices
            and provide practical knowledge about recent agriculture issues.
        </p>
    </section>

    <section class="gallery">
        <?php
        include __DIR__ . '/../includes/con_pg.php';
        require_once __DIR__ . '/../includes/path_helpers.php';
        $query = "SELECT * FROM home";
        $res = pg_query($con, $query) or die(pg_last_error($con));
        $seen_images = array();

        while ($row = pg_fetch_assoc($res))
        {
            $img_src = $row['photo'];
            $decoded = @pg_unescape_bytea($row['photo']);
            if ($decoded !== false && $decoded !== '') {
                $img_src = $decoded;
            }

            $image_key = md5($img_src);
            if (isset($seen_images[$image_key])) {
                continue;
            }
            $seen_images[$image_key] = true;

            $img_url = osf_resolve_image_path($img_src);
            echo '<article class="reveal"><img src="' . htmlspecialchars($img_url, ENT_QUOTES, 'UTF-8') . '" alt="Farm Image"></article>';
        }
        pg_close($con);
        ?>
    </section>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>

<script>
    const revealItems = document.querySelectorAll('.reveal');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.18 });
    revealItems.forEach((item) => observer.observe(item));
</script>
</body>
</html>


