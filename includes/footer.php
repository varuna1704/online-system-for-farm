<style>
    .osf-footer-wrap {
        width: min(1160px, 95%);
        margin: 20px auto 10px;
    }
    .osf-footer {
        border-radius: 16px;
        padding: 14px 16px;
        text-align: center;
        color: #e2e8f0;
        background: linear-gradient(130deg, #0f172a 0%, #1e293b 100%);
        box-shadow: 0 10px 24px rgba(15, 23, 42, 0.28);
        font: 600 14px/1.5 "Segoe UI", Verdana, sans-serif;
        letter-spacing: 0.3px;
    }
    .osf-footer strong {
        color: #f8fafc;
    }
</style>
<script>
(() => {
    const mountFooter = () => {
        if (document.getElementById('osf-site-footer')) return;

        const wrap = document.createElement('div');
        wrap.id = 'osf-site-footer';
        wrap.className = 'osf-footer-wrap';
        wrap.innerHTML = `
            <footer class="osf-footer">
                <strong>Online System For Farm</strong><br>
                Smart support for crop and fertilizer decisions.
            </footer>
        `;

        if (document.body) {
            document.body.appendChild(wrap);
        }
    };

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', mountFooter);
    } else {
        mountFooter();
    }
})();
</script>
