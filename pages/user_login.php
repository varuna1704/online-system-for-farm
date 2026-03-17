<?php
session_start();
require __DIR__ . '/../includes/con_pg.php';

$login_error = '';

if (isset($_POST['user_name'])) {
    $user_name = pg_escape_string($con, stripslashes($_POST['user_name'] ?? ''));
    $user_pass = pg_escape_string($con, stripslashes($_POST['user_pass'] ?? ''));

    $query = "SELECT * FROM users WHERE user_name='$user_name' and user_pass='$user_pass'";
    $result = pg_query($con, $query) or die(pg_last_error($con));
    $rows = pg_num_rows($result);

    if ($rows === 1) {
        $_SESSION['user_name'] = $user_name;
        header('Location: welcome.php');
        exit();
    } else {
        $login_error = 'Invalid username or password.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Login</title>
<style>
    :root {
        --ink: #0f172a;
        --muted: #64748b;
        --white: #f8fafc;
        --line: #cbd5e1;
        --brand-a: #1d4ed8;
        --brand-b: #0ea5e9;
        --brand-c: #f59e0b;
        --good: #16a34a;
        --bad: #dc2626;
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
            radial-gradient(circle at 14% 16%, rgba(14, 165, 233, 0.34), transparent 30%),
            radial-gradient(circle at 88% 11%, rgba(245, 158, 11, 0.34), transparent 24%),
            linear-gradient(160deg, #dbeafe 0%, #cbd5e1 55%, #e2e8f0 100%);
        overflow-x: hidden;
    }
    .orb {
        position: fixed;
        border-radius: 999px;
        filter: blur(24px);
        opacity: 0.33;
        z-index: 0;
        pointer-events: none;
        animation: drift 8s ease-in-out infinite;
    }
    .orb.a {
        width: 240px;
        height: 240px;
        background: #38bdf8;
        left: -70px;
        top: 100px;
    }
    .orb.b {
        width: 210px;
        height: 210px;
        background: #1d4ed8;
        right: -60px;
        top: 240px;
        animation-delay: 1.5s;
    }
    .orb.c {
        width: 200px;
        height: 200px;
        background: #f59e0b;
        left: 20%;
        bottom: 40px;
        animation-delay: 3s;
    }
    @keyframes drift {
        0%, 100% { transform: translateY(0) translateX(0); }
        50% { transform: translateY(-18px) translateX(8px); }
    }
    .page-wrap {
        position: relative;
        z-index: 1;
        width: min(1080px, 95%);
        margin: 84px auto 24px;
    }
    .login-panel {
        display: grid;
        grid-template-columns: 1.1fr 1fr;
        gap: 1rem;
        border-radius: 24px;
        border: 1px solid rgba(255,255,255,0.72);
        background: rgba(248, 250, 252, 0.88);
        box-shadow: 0 20px 44px rgba(15, 23, 42, 0.2);
        padding: 1.2rem;
        animation: panelIn .7s ease-out both;
        backdrop-filter: blur(6px);
        transform-style: preserve-3d;
        transition: transform .2s ease;
    }
    @keyframes panelIn {
        from { opacity: 0; transform: translateY(14px) scale(0.98); }
        to { opacity: 1; transform: translateY(0) scale(1); }
    }
    .left {
        border-radius: 18px;
        padding: 1rem;
        color: #f8fafc;
        background: linear-gradient(140deg, #020617 0%, #1e3a8a 58%, #0ea5e9 100%);
        position: relative;
        overflow: hidden;
    }
    .left::before {
        content: "";
        position: absolute;
        width: 160px;
        height: 160px;
        right: -40px;
        top: -40px;
        border-radius: 999px;
        background: rgba(255,255,255,0.14);
    }
    .left h1 {
        margin: 0;
        font-size: clamp(1.45rem, 3vw, 2rem);
        line-height: 1.2;
    }
    .left p {
        margin: .8rem 0 0;
        color: #dbeafe;
        line-height: 1.55;
    }
    .tag-row {
        margin-top: 1rem;
        display: flex;
        flex-wrap: wrap;
        gap: .5rem;
    }
    .tag {
        display: inline-block;
        padding: .42rem .65rem;
        border-radius: 999px;
        background: rgba(248,250,252,0.14);
        border: 1px solid rgba(248,250,252,0.2);
        font-size: .78rem;
        letter-spacing: .35px;
        text-transform: uppercase;
        text-decoration: none;
        color: #f8fafc;
        transition: transform .2s ease, background-color .2s ease, border-color .2s ease;
    }
    .tag:hover {
        transform: translateY(-2px);
        background: rgba(248,250,252,0.24);
        border-color: rgba(248,250,252,0.45);
    }
    .right {
        padding: .35rem .2rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .title {
        margin: 0 0 .3rem;
        font-size: 1.5rem;
    }
    .sub {
        margin: 0 0 .85rem;
        color: var(--muted);
        font-size: .92rem;
    }
    .alert {
        border-radius: 11px;
        padding: .58rem .72rem;
        margin-bottom: .75rem;
        font-weight: 700;
        font-size: .86rem;
    }
    .alert.error {
        background: rgba(220, 38, 38, 0.1);
        border: 1px solid rgba(220, 38, 38, 0.28);
        color: #7f1d1d;
    }
    .field {
        margin-bottom: .7rem;
    }
    .field label {
        display: block;
        margin-bottom: .35rem;
        font-size: .78rem;
        text-transform: uppercase;
        color: #334155;
        letter-spacing: .45px;
        font-weight: 700;
    }
    .field input {
        width: 100%;
        border: 1px solid var(--line);
        border-radius: 11px;
        padding: .62rem .72rem;
        font-size: .93rem;
        background: #ffffff;
        transition: border-color .2s ease, box-shadow .2s ease, transform .2s ease;
    }
    .field input:focus {
        outline: none;
        border-color: #0ea5e9;
        box-shadow: 0 0 0 3px rgba(14,165,233,.18);
        transform: translateY(-1px);
    }
    .password-wrap {
        display: grid;
        grid-template-columns: 1fr auto;
        gap: .45rem;
    }
    .toggle-btn {
        border: 1px solid #1e3a8a;
        background: #eff6ff;
        color: #1e3a8a;
        border-radius: 10px;
        font-weight: 700;
        padding: .5rem .66rem;
        cursor: pointer;
        transition: background .2s ease, color .2s ease, transform .2s ease;
    }
    .toggle-btn:hover {
        background: #1e3a8a;
        color: #f8fafc;
        transform: translateY(-1px);
    }
    .score {
        margin: .1rem 0 .8rem;
        font-size: .8rem;
        color: #64748b;
        min-height: 18px;
    }
    .score.good { color: var(--good); }
    .score.bad { color: var(--bad); }
    .btn-main {
        width: 100%;
        border: 0;
        border-radius: 12px;
        padding: .68rem .9rem;
        color: #f8fafc;
        font-weight: 800;
        font-size: 1rem;
        letter-spacing: .35px;
        cursor: pointer;
        background: linear-gradient(135deg, #1d4ed8 0%, #0ea5e9 100%);
        transition: transform .2s ease, box-shadow .2s ease;
    }
    .btn-main:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 18px rgba(14,116,144,0.34);
    }
    .meta {
        margin-top: .65rem;
        font-size: .86rem;
        color: #334155;
    }
    .meta a {
        font-weight: 800;
    }
    @media (max-width: 900px) {
        .page-wrap {
            margin-top: 74px;
        }
        .login-panel {
            grid-template-columns: 1fr;
        }
    }
</style>
</head>
<body>
<div class="orb a"></div>
<div class="orb b"></div>
<div class="orb c"></div>

<?php include __DIR__ . '/../includes/header.php'; ?>

<main class="page-wrap">
    <section class="login-panel" id="login-panel">
        <article class="left">
            <h1>Welcome Back to Online Farm</h1>
            <p>Access crop guidance, fertilizer data, and your personalized farm workflow with one secure login.</p>
            <div class="tag-row">
                <a class="tag" href="crop_insights.php">Crop Insights</a>
                <a class="tag" href="fertilizer_hub.php">Fertilizer Hub</a>
                <a class="tag" href="farmer_dashboard.php">Farmer Dashboard</a>
            </div>
        </article>

        <article class="right">
            <h2 class="title">Sign In</h2>
            <p class="sub">Use your registered account credentials.</p>

            <?php if ($login_error !== ''): ?>
                <div class="alert error"><?php echo htmlspecialchars($login_error); ?></div>
            <?php endif; ?>

            <form action="" method="POST" name="login" id="login-form" novalidate>
                <div class="field">
                    <label for="user_name">Username</label>
                    <input id="user_name" type="text" name="user_name" placeholder="Enter username" required>
                </div>

                <div class="field">
                    <label for="user_pass">Password</label>
                    <div class="password-wrap">
                        <input id="user_pass" type="password" name="user_pass" placeholder="Enter password" required>
                        <button class="toggle-btn" type="button" id="toggle-pass">Show</button>
                    </div>
                </div>
                <div id="pw-score" class="score"></div>

                <button type="submit" class="btn-main">Login</button>
            </form>

            <p class="meta">Not registered yet? <a href="user_reg.php">Register Here</a></p>
        </article>
    </section>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>

<script>
(() => {
    const passInput = document.getElementById('user_pass');
    const toggleBtn = document.getElementById('toggle-pass');
    const score = document.getElementById('pw-score');
    const panel = document.getElementById('login-panel');

    if (toggleBtn) {
        toggleBtn.addEventListener('click', () => {
            const isHidden = passInput.type === 'password';
            passInput.type = isHidden ? 'text' : 'password';
            toggleBtn.textContent = isHidden ? 'Hide' : 'Show';
        });
    }

    const passwordScore = (value) => {
        let points = 0;
        if (value.length >= 8) points += 1;
        if (/[A-Z]/.test(value)) points += 1;
        if (/[a-z]/.test(value)) points += 1;
        if (/\d/.test(value)) points += 1;
        if (/[^A-Za-z0-9]/.test(value)) points += 1;
        return points;
    };

    if (passInput) {
        passInput.addEventListener('input', () => {
            const points = passwordScore(passInput.value);
            if (!passInput.value) {
                score.textContent = '';
                score.className = 'score';
                return;
            }
            if (points <= 2) {
                score.textContent = 'Password strength: Weak';
                score.className = 'score bad';
            } else if (points <= 4) {
                score.textContent = 'Password strength: Medium';
                score.className = 'score';
            } else {
                score.textContent = 'Password strength: Strong';
                score.className = 'score good';
            }
        });
    }

    const tilt = (event) => {
        const rect = panel.getBoundingClientRect();
        const x = event.clientX - rect.left;
        const y = event.clientY - rect.top;
        const cx = rect.width / 2;
        const cy = rect.height / 2;
        const rx = ((y - cy) / cy) * -2.2;
        const ry = ((x - cx) / cx) * 2.2;
        panel.style.transform = `perspective(900px) rotateX(${rx}deg) rotateY(${ry}deg)`;
    };

    if (panel) {
        panel.addEventListener('mousemove', tilt);
        panel.addEventListener('mouseleave', () => {
            panel.style.transform = 'perspective(900px) rotateX(0deg) rotateY(0deg)';
        });
    }
})();
</script>
</body>
</html>

