<?php
// Welcome page
session_start();
if (!isset($_SESSION['user_name']) || $_SESSION['user_name'] === '') {
    header('Location: user_login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Welcome</title>
   <style>
      body {
         margin: 0;
         font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
         color: #0f172a;
         background:
            radial-gradient(circle at 12% 18%, #38bdf8 0%, transparent 28%),
            radial-gradient(circle at 86% 20%, #f59e0b 0%, transparent 24%),
            linear-gradient(180deg, #e2e8f0 0%, #dbeafe 45%, #cbd5e1 100%);
         min-height: 100vh;
      }
      .welcome-wrap {
         max-width: 1150px;
         margin: 0 auto;
         padding: 1.2rem 1rem 2rem;
      }
      .hero {
         margin-top: 1rem;
         background: rgba(255, 255, 255, 0.82);
         border: 1px solid rgba(255, 255, 255, 0.6);
         border-radius: 26px;
         padding: 2rem 1.4rem;
         box-shadow: 0 16px 40px rgba(30, 41, 59, 0.18);
         backdrop-filter: blur(6px);
         animation: welcomeRise 0.55s ease-out;
      }
      .chip {
         display: inline-block;
         background: #0f172a;
         color: #f8fafc;
         padding: 0.35rem 0.7rem;
         border-radius: 999px;
         font-size: 0.8rem;
         font-weight: 700;
         letter-spacing: 0.7px;
         text-transform: uppercase;
      }
      .hero h1 {
         margin: 0.8rem 0 0.35rem;
         font-size: clamp(1.7rem, 4vw, 2.7rem);
         line-height: 1.16;
      }
      .hero p {
         margin: 0;
         font-size: 1rem;
         color: #334155;
      }
      .actions {
         margin-top: 1.35rem;
         display: grid;
         grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
         gap: 0.8rem;
      }
      .action-btn {
         text-decoration: none;
         background: linear-gradient(135deg, #1d4ed8 0%, #0ea5e9 100%);
         color: #f8fafc;
         border-radius: 14px;
         padding: 0.8rem 0.9rem;
         font-weight: 700;
         text-align: center;
         transition: transform 0.2s ease, box-shadow 0.2s ease;
      }
      .action-btn:hover {
         transform: translateY(-2px);
         box-shadow: 0 10px 24px rgba(14, 116, 144, 0.35);
      }
      .quick-stats {
         margin-top: 1rem;
         display: grid;
         grid-template-columns: repeat(auto-fit, minmax(170px, 1fr));
         gap: 0.75rem;
      }
      .stat {
         background: #f8fafc;
         border: 1px solid #cbd5e1;
         border-radius: 14px;
         padding: 0.75rem 0.8rem;
      }
      .stat-title {
         font-size: 0.77rem;
         color: #475569;
         letter-spacing: 0.5px;
         text-transform: uppercase;
         margin: 0;
      }
      .stat-value {
         margin: 0.3rem 0 0;
         font-size: 1.12rem;
         font-weight: 800;
      }
      @keyframes welcomeRise {
         from {
            opacity: 0;
            transform: translateY(12px);
         }
         to {
            opacity: 1;
            transform: translateY(0);
         }
      }
   </style>
</head>
<body>
<?php include __DIR__ . '/../includes/header_fert.php'; ?>
<main class="welcome-wrap">
   <section class="hero">
      <span class="chip">Farmer Dashboard</span>
      <h1>Hello, <?php echo htmlspecialchars($_SESSION['user_name']); ?>.</h1>
      <p>Manage fertilizers, view cart activity, and continue your farm workflow from one place.</p>

      <div class="actions">
         <a href="admin.php" class="action-btn">Add Fertilizer</a>
         <a href="fertilizer.php" class="action-btn">View Fertilizer</a>
         <a href="cart_fert.php" class="action-btn">Open Cart</a>
         <a href="select_vcf.php" class="action-btn">Agro Info</a>
      </div>

      <div class="quick-stats">
         <article class="stat">
            <p class="stat-title">Session User</p>
            <p class="stat-value"><?php echo htmlspecialchars($_SESSION['user_name']); ?></p>
         </article>
         <article class="stat">
            <p class="stat-title">Access Level</p>
            <p class="stat-value">Farmer Panel</p>
         </article>
         <article class="stat">
            <p class="stat-title">Status</p>
            <p class="stat-value">Online</p>
         </article>
      </div>
   </section>
</main>
</body>
</html>

