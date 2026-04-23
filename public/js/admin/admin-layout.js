
(function () {
    /* ── Sidebar ── */
    const sidebar  = document.getElementById('sidebar');
    const overlay  = document.getElementById('sidebarOverlay');
    const hamburger = document.getElementById('hamburger');

    function openSidebar() {
        sidebar.classList.add('open');
        overlay.classList.add('visible');
        hamburger.classList.add('open');
        hamburger.setAttribute('aria-expanded', 'true');
        document.body.style.overflow = 'hidden';
    }

    function closeSidebar() {
        sidebar.classList.remove('open');
        overlay.classList.remove('visible');
        hamburger.classList.remove('open');
        hamburger.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = '';
    }

    hamburger.addEventListener('click', function () {
        sidebar.classList.contains('open') ? closeSidebar() : openSidebar();
    });

    overlay.addEventListener('click', closeSidebar);

    /* Close sidebar when a nav link is tapped on mobile */
    sidebar.querySelectorAll('a').forEach(function (link) {
        link.addEventListener('click', function () {
            if (window.innerWidth < 1024) closeSidebar();
        });
    });

    /* ── Notification Bell ── */
    const bell  = document.getElementById('notifBell');
    const panel = document.getElementById('notifPanel');

    bell.addEventListener('click', function (e) {
        e.stopPropagation();
        panel.classList.toggle('open');
    });

    bell.addEventListener('keydown', function (e) {
        if (e.key === 'Enter' || e.key === ' ') {
            e.preventDefault();
            panel.classList.toggle('open');
        }
    });

    document.addEventListener('click', function (e) {
        if (!bell.contains(e.target)) panel.classList.remove('open');
    });

    /* Close panel on Escape */
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') panel.classList.remove('open');
    });

    /* ── Auto-close sidebar when resizing to desktop ── */
    window.addEventListener('resize', function () {
        if (window.innerWidth >= 1024) closeSidebar();
    });
    
})();
document.addEventListener('click', function (e) {
    const clickedInsideSidebar = sidebar.contains(e.target);
    const clickedHamburger = hamburger.contains(e.target);

    if (!clickedInsideSidebar && !clickedHamburger) {
        closeSidebar();
    }
});

