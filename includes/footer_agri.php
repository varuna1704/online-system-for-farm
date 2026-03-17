<style>
    .osf-footer-wrap {
        width: min(1160px, 95%);
        margin: 20px auto 10px;
    }
    .osf-footer {
        border-radius: 16px;
        padding: 14px 16px;
        text-align: center;
        color: #f1f5f9;
        background: linear-gradient(130deg, #14532d 0%, #166534 55%, #0f766e 100%);
        box-shadow: 0 10px 24px rgba(15, 23, 42, 0.28);
        font: 600 14px/1.5 "Segoe UI", Verdana, sans-serif;
        letter-spacing: 0.3px;
    }
    .osf-footer strong {
        color: #ffffff;
    }
</style>
<script>
(() => {
    const mountFooter = () => {
        if (document.getElementById('osf-agri-footer')) return;

        const wrap = document.createElement('div');
        wrap.id = 'osf-agri-footer';
        wrap.className = 'osf-footer-wrap';
        wrap.innerHTML = `
            <footer class="osf-footer">
                <strong>Agriculture is the pillar of society.</strong><br>
                Protect soil, grow better, and build stronger farms.
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
