<?php
require __DIR__ . '/../includes/con_pg.php';

$reg_success = false;
$reg_error = '';

if (isset($_POST['user_name'])) {
    $user_name = pg_escape_string($con, stripslashes($_POST['user_name'] ?? ''));
    $user_email = pg_escape_string($con, stripslashes($_POST['user_email'] ?? ''));
    $user_age = pg_escape_string($con, stripslashes($_POST['user_age'] ?? ''));
    $user_gender = pg_escape_string($con, stripslashes($_POST['user_gender'] ?? ''));
    $user_pass = pg_escape_string($con, stripslashes($_POST['user_pass'] ?? ''));
    $conf_pass = stripslashes($_POST['conf_pass'] ?? '');
    $contact_no = pg_escape_string($con, stripslashes($_POST['contact_no'] ?? ''));
    $user_add = pg_escape_string($con, stripslashes($_POST['user_add'] ?? ''));
    $user_adhar = pg_escape_string($con, stripslashes($_POST['user_adhar'] ?? ''));
    $user_bankname = pg_escape_string($con, stripslashes($_POST['user_bankname'] ?? ''));
    $user_bankno = pg_escape_string($con, stripslashes($_POST['user_bankno'] ?? ''));
    $user_farmarea = pg_escape_string($con, stripslashes($_POST['user_farmarea'] ?? ''));
    $u_s_type = pg_escape_string($con, stripslashes($_POST['u_s_type'] ?? ''));

    if ($user_pass !== $conf_pass) {
        $reg_error = 'Password and Confirm Password do not match.';
    } else {
        $query = "INSERT INTO users(user_name,user_pass,user_email,user_age,user_gender,contact_no,user_add,user_adhar,user_bankname,user_bankno,user_farmarea,u_s_type) VALUES ('$user_name','$user_pass','$user_email','$user_age','$user_gender','$contact_no','$user_add','$user_adhar','$user_bankname','$user_bankno','$user_farmarea','$u_s_type')";
        $result = pg_query($con, $query);
        if ($result) {
            $reg_success = true;
        } else {
            $reg_error = 'Registration failed. ' . pg_last_error($con);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Registration</title>
    <style>
        :root {
            --bg-dark: #0f172a;
            --bg-mid: #1d4ed8;
            --bg-light: #0ea5e9;
            --ink: #0f172a;
            --white: #f8fafc;
            --muted: #64748b;
            --good: #16a34a;
            --warn: #f59e0b;
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
                radial-gradient(circle at 10% 20%, rgba(14, 165, 233, 0.34), transparent 28%),
                radial-gradient(circle at 92% 12%, rgba(245, 158, 11, 0.34), transparent 24%),
                linear-gradient(155deg, #cbd5e1 0%, #dbeafe 60%, #e2e8f0 100%);
            overflow-x: hidden;
        }
        .bg-orb {
            position: fixed;
            z-index: 0;
            border-radius: 999px;
            filter: blur(22px);
            opacity: 0.33;
            pointer-events: none;
            animation: floatOrb 8s ease-in-out infinite;
        }
        .orb-a {
            width: 220px;
            height: 220px;
            background: #38bdf8;
            top: 120px;
            left: -50px;
        }
        .orb-b {
            width: 260px;
            height: 260px;
            background: #1d4ed8;
            right: -70px;
            top: 240px;
            animation-delay: 1.8s;
        }
        .orb-c {
            width: 190px;
            height: 190px;
            background: #f59e0b;
            bottom: 40px;
            left: 18%;
            animation-delay: 3s;
        }
        @keyframes floatOrb {
            0%, 100% { transform: translateY(0) translateX(0); }
            50% { transform: translateY(-16px) translateX(10px); }
        }
        .reg-shell {
            position: relative;
            z-index: 1;
            width: min(1160px, 95%);
            margin: 10px auto 24px;
        }
        .reg-card {
            margin-top: 78px;
            background: rgba(248, 250, 252, 0.88);
            border: 1px solid rgba(255, 255, 255, 0.75);
            border-radius: 24px;
            box-shadow: 0 18px 40px rgba(15, 23, 42, 0.22);
            padding: 1.2rem 1.2rem 1.4rem;
            animation: panelRise .7s ease-out both;
            backdrop-filter: blur(6px);
        }
        @keyframes panelRise {
            from { opacity: 0; transform: translateY(14px) scale(0.98); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }
        .reg-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 12px;
        }
        .reg-title {
            margin: 0;
            font-size: clamp(1.55rem, 3vw, 2.1rem);
            letter-spacing: 0.6px;
        }
        .reg-sub {
            margin: 0;
            color: var(--muted);
            font-size: 0.96rem;
        }
        .progress-wrap {
            width: min(340px, 100%);
            background: #e2e8f0;
            border-radius: 999px;
            height: 10px;
            overflow: hidden;
            border: 1px solid #cbd5e1;
            position: relative;
        }
        .progress-bar {
            width: 0%;
            height: 100%;
            background: linear-gradient(90deg, #1d4ed8 0%, #0ea5e9 100%);
            border-radius: inherit;
            transition: width .35s ease;
        }
        .progress-text {
            font-size: 0.8rem;
            color: #475569;
            margin-top: 5px;
        }
        .alert {
            margin: 0 0 12px;
            border-radius: 12px;
            padding: 10px 12px;
            font-size: 0.9rem;
            font-weight: 600;
        }
        .alert.error {
            background: rgba(220, 38, 38, 0.1);
            color: #7f1d1d;
            border: 1px solid rgba(220, 38, 38, 0.3);
        }
        .alert.success {
            background: rgba(22, 163, 74, 0.12);
            color: #14532d;
            border: 1px solid rgba(22, 163, 74, 0.3);
        }
        .grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(180px, 1fr));
            gap: 0.8rem;
        }
        .field {
            background: #f8fafc;
            border: 1px solid #cbd5e1;
            border-radius: 12px;
            padding: 0.6rem 0.65rem 0.7rem;
            transition: border-color .2s ease, transform .2s ease, box-shadow .2s ease;
            animation: fieldFade .55s ease both;
        }
        .field:focus-within {
            transform: translateY(-2px);
            border-color: #0ea5e9;
            box-shadow: 0 8px 16px rgba(14, 165, 233, 0.2);
        }
        .field label {
            display: block;
            font-size: 0.79rem;
            color: #334155;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            margin-bottom: 6px;
        }
        .field input,
        .field select {
            width: 100%;
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            padding: 0.56rem 0.62rem;
            font-size: 0.92rem;
            background: #ffffff;
            color: #0f172a;
            transition: border-color .2s ease, box-shadow .2s ease;
        }
        .field input:focus,
        .field select:focus {
            outline: none;
            border-color: #0ea5e9;
            box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.18);
        }
        .field.full {
            grid-column: span 3;
        }
        .field.two {
            grid-column: span 2;
        }
        .actions {
            margin-top: 12px;
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }
        .btn-main {
            border: 0;
            border-radius: 12px;
            color: #f8fafc;
            background: linear-gradient(135deg, #1d4ed8 0%, #0ea5e9 100%);
            padding: 0.68rem 1.2rem;
            font-size: 0.95rem;
            font-weight: 700;
            letter-spacing: 0.35px;
            cursor: pointer;
            transition: transform .2s ease, box-shadow .2s ease;
        }
        .btn-main:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 18px rgba(14, 116, 144, 0.33);
        }
        .small-note {
            font-size: 0.84rem;
            color: #475569;
        }
        .strength {
            margin-top: 8px;
            height: 7px;
            border-radius: 999px;
            background: #e2e8f0;
            overflow: hidden;
        }
        .strength > span {
            display: block;
            height: 100%;
            width: 0%;
            transition: width .25s ease, background-color .25s ease;
            background: var(--bad);
        }
        .strength-label {
            margin-top: 5px;
            font-size: 0.79rem;
            color: #64748b;
        }
        .match-label {
            margin-top: 5px;
            font-size: 0.79rem;
            min-height: 18px;
        }
        .match-good { color: var(--good); }
        .match-bad { color: var(--bad); }
        @keyframes fieldFade {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @media (max-width: 980px) {
            .grid {
                grid-template-columns: repeat(2, minmax(180px, 1fr));
            }
            .field.full {
                grid-column: span 2;
            }
            .field.two {
                grid-column: span 2;
            }
        }
        @media (max-width: 620px) {
            .reg-card {
                margin-top: 72px;
                padding: 0.95rem;
            }
            .grid {
                grid-template-columns: 1fr;
            }
            .field.full,
            .field.two {
                grid-column: span 1;
            }
        }
    </style>
</head>
<body>
<div class="bg-orb orb-a"></div>
<div class="bg-orb orb-b"></div>
<div class="bg-orb orb-c"></div>

<?php include __DIR__ . '/../includes/header.php'; ?>

<main class="reg-shell">
    <section class="reg-card">
        <div class="reg-header">
            <div>
                <h1 class="reg-title">Create Your Farmer Account</h1>
                <p class="reg-sub">Fill details to access crop guidance, fertilizer data, and services.</p>
            </div>
            <div style="min-width:240px;">
                <div class="progress-wrap">
                    <div class="progress-bar" id="reg-progress"></div>
                </div>
                <div class="progress-text" id="progress-text">0% complete</div>
            </div>
        </div>

        <?php if ($reg_success): ?>
            <div class="alert success">
                Registration completed successfully. Proceed to login.
                <a href="user_login.php" style="font-weight:800; margin-left:6px; color:#166534;">Login Now</a>
            </div>
        <?php endif; ?>

        <?php if ($reg_error !== ''): ?>
            <div class="alert error"><?php echo htmlspecialchars($reg_error); ?></div>
        <?php endif; ?>

        <?php if (!$reg_success): ?>
        <form name="registration" action="" method="POST" id="reg-form" novalidate>
            <div class="grid">
                <div class="field">
                    <label for="user_name">User Name</label>
                    <input id="user_name" type="text" name="user_name" placeholder="username" required>
                </div>
                <div class="field">
                    <label for="fname">First Name</label>
                    <input id="fname" type="text" name="fname" placeholder="first name" required>
                </div>
                <div class="field">
                    <label for="lname">Last Name</label>
                    <input id="lname" type="text" name="lname" placeholder="last name" required>
                </div>

                <div class="field">
                    <label for="user_email">Email</label>
                    <input id="user_email" type="email" name="user_email" placeholder="email" required>
                </div>
                <div class="field">
                    <label for="user_age">Age</label>
                    <input id="user_age" type="number" min="1" name="user_age" placeholder="age" required>
                </div>
                <div class="field">
                    <label for="user_gender">Gender</label>
                    <select name="user_gender" id="user_gender" required>
                        <option value="female">Female</option>
                        <option value="male">Male</option>
                    </select>
                </div>

                <div class="field">
                    <label for="user_pass">Password</label>
                    <input id="user_pass" type="password" name="user_pass" placeholder="password" required>
                    <div class="strength"><span id="pw-strength"></span></div>
                    <div class="strength-label" id="pw-label">Password strength: -</div>
                </div>
                <div class="field">
                    <label for="conf_pass">Confirm Password</label>
                    <input id="conf_pass" type="password" name="conf_pass" placeholder="confirm password" required>
                    <div class="match-label" id="match-label"></div>
                </div>
                <div class="field">
                    <label for="contact_no">Contact Number</label>
                    <input id="contact_no" type="text" name="contact_no" placeholder="contact number" required>
                </div>

                <div class="field two">
                    <label for="user_add">Address</label>
                    <input id="user_add" type="text" name="user_add" placeholder="address" required>
                </div>
                <div class="field">
                    <label for="user_adhar">Aadhar Number</label>
                    <input id="user_adhar" type="text" name="user_adhar" placeholder="aadhar no" required>
                </div>

                <div class="field">
                    <label for="user_bankname">Bank Name</label>
                    <input id="user_bankname" type="text" name="user_bankname" placeholder="bank name" required>
                </div>
                <div class="field">
                    <label for="user_bankno">Bank Number</label>
                    <input id="user_bankno" type="text" name="user_bankno" placeholder="bank no" required>
                </div>
                <div class="field">
                    <label for="user_farmarea">Farm Area</label>
                    <input id="user_farmarea" type="text" name="user_farmarea" placeholder="farm area" required>
                </div>

                <div class="field">
                    <label for="u_s_type">Soil Type</label>
                    <input id="u_s_type" type="text" name="u_s_type" placeholder="soil type" required>
                </div>
                <div class="field">
                    <label for="user_city">City</label>
                    <input id="user_city" type="text" name="user_city" placeholder="city" required>
                </div>
                <div class="field">
                    <label for="user_state">State</label>
                    <select name="user_state" id="user_state" required>
                        <option value="">Select state</option>
                        <option value="andhra_pradhesh">Andhra Pradesh</option>
                        <option value="maharashtra">Maharashtra</option>
                        <option value="gujrat">Gujarat</option>
                        <option value="rajasthan">Rajasthan</option>
                        <option value="haryana">Haryana</option>
                    </select>
                </div>
            </div>

            <div class="actions">
                <button type="submit" class="btn-main">Register Account</button>
                <span class="small-note">Already registered? <a href="user_login.php">Login here</a></span>
            </div>
        </form>
        <?php endif; ?>
    </section>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>

<script>
(() => {
    const form = document.getElementById('reg-form');
    if (!form) return;

    const requiredFields = Array.from(form.querySelectorAll('[required]'));
    const bar = document.getElementById('reg-progress');
    const progressText = document.getElementById('progress-text');
    const pw = document.getElementById('user_pass');
    const cpw = document.getElementById('conf_pass');
    const pwStrength = document.getElementById('pw-strength');
    const pwLabel = document.getElementById('pw-label');
    const matchLabel = document.getElementById('match-label');

    const updateProgress = () => {
        let filled = 0;
        requiredFields.forEach((el) => {
            if (el.value && el.value.trim() !== '') {
                filled += 1;
            }
        });
        const pct = Math.round((filled / requiredFields.length) * 100);
        bar.style.width = pct + '%';
        progressText.textContent = pct + '% complete';
    };

    const updateStrength = () => {
        const v = pw.value || '';
        let score = 0;
        if (v.length >= 8) score += 1;
        if (/[A-Z]/.test(v)) score += 1;
        if (/[a-z]/.test(v)) score += 1;
        if (/\d/.test(v)) score += 1;
        if (/[^A-Za-z0-9]/.test(v)) score += 1;

        const width = (score / 5) * 100;
        pwStrength.style.width = width + '%';

        if (score <= 2) {
            pwStrength.style.backgroundColor = '#dc2626';
            pwLabel.textContent = 'Password strength: Weak';
        } else if (score <= 4) {
            pwStrength.style.backgroundColor = '#f59e0b';
            pwLabel.textContent = 'Password strength: Medium';
        } else {
            pwStrength.style.backgroundColor = '#16a34a';
            pwLabel.textContent = 'Password strength: Strong';
        }
    };

    const updateMatch = () => {
        if (!cpw.value) {
            matchLabel.textContent = '';
            matchLabel.className = 'match-label';
            return;
        }
        if (pw.value === cpw.value) {
            matchLabel.textContent = 'Passwords match';
            matchLabel.className = 'match-label match-good';
        } else {
            matchLabel.textContent = 'Passwords do not match';
            matchLabel.className = 'match-label match-bad';
        }
    };

    requiredFields.forEach((field) => {
        field.addEventListener('input', updateProgress);
        field.addEventListener('change', updateProgress);
    });
    pw.addEventListener('input', () => {
        updateStrength();
        updateMatch();
        updateProgress();
    });
    cpw.addEventListener('input', updateMatch);

    form.addEventListener('submit', (e) => {
        if (pw.value !== cpw.value) {
            e.preventDefault();
            updateMatch();
            cpw.focus();
        }
    });

    updateProgress();
})();
</script>
</body>
</html>

