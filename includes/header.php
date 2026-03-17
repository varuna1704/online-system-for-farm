<style>
    .osf-top-header-wrap {
        width: min(1160px, 95%);
        margin: 12px auto 14px;
        position: relative;
        z-index: 100;
    }
    .osf-top-header {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
        padding: 11px 13px;
        border-radius: 18px;
        background: linear-gradient(135deg, #020617 0%, #1e3a8a 58%, #0ea5e9 100%);
        box-shadow: 0 12px 28px rgba(2, 6, 23, 0.35);
    }
    .osf-brand {
        text-decoration: none;
        color: #f8fafc;
        font: 800 16px/1 "Trebuchet MS", "Segoe UI", sans-serif;
        letter-spacing: 0.8px;
        text-transform: uppercase;
        padding: 9px 12px;
        border-radius: 999px;
        background: rgba(248, 250, 252, 0.14);
    }
    .osf-nav-links {
        display: flex;
        align-items: center;
        gap: 7px;
        flex-wrap: wrap;
        flex: 1;
    }
    .osf-nav-links a {
        text-decoration: none;
        color: #e2e8f0;
        font: 700 13px/1 "Verdana", "Segoe UI", sans-serif;
        letter-spacing: 0.4px;
        text-transform: uppercase;
        padding: 9px 11px;
        border-radius: 999px;
        transition: transform .2s ease, background-color .2s ease, color .2s ease;
        background: rgba(2, 6, 23, 0.26);
    }
    .osf-nav-links a:hover {
        color: #ffffff;
        background: rgba(2, 6, 23, 0.5);
        transform: translateY(-1px);
    }
    .osf-nav-search {
        margin-left: auto;
    }
    .osf-nav-search input {
        border: 1px solid #1e293b;
        border-radius: 999px;
        padding: 8px 12px;
        width: 210px;
        background: #0f172a;
        color: #f8fafc;
        font-size: 13px;
    }
    .osf-nav-search input:focus {
        outline: none;
        border-color: #38bdf8;
        box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.2);
    }
    @media (max-width: 780px) {
        .osf-nav-search {
            width: 100%;
            margin-left: 0;
        }
        .osf-nav-search input {
            width: 100%;
        }
    }
</style>
<script>
(() => {
    const mountHeader = () => {
        if (document.getElementById('osf-site-header')) return;

        const wrapper = document.createElement('div');
        wrapper.id = 'osf-site-header';
        wrapper.className = 'osf-top-header-wrap';
        wrapper.innerHTML = `
            <nav class="osf-top-header">
                <a href="homepage.php" class="osf-brand">Online Farm</a>
                <div class="osf-nav-links">
                    <a href="homepage.php">Home</a>
                    <a href="agroinfo.php">Agro Info</a>
                    <a href="about_us.php">About Us</a>
                    <a href="contact_us.php">Contact</a>
                    <a href="help.php">Help</a>
                </div>
                <div class="osf-nav-search">
                    <input type="text" placeholder="Search this website">
                </div>
            </nav>
        `;

        if (document.body) {
            document.body.insertBefore(wrapper, document.body.firstChild);
        }
    };

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', mountHeader);
    } else {
        mountHeader();
    }
})();
</script>
