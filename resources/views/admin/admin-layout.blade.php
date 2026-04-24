<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') — WashDepot</title>

    <link rel="stylesheet" href="{{ asset('css/variables.css') }}">
    <link rel="stylesheet" href="{{ asset('css/shared-layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/admin-layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/sidebar-styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/sidebar-middle.css') }}">
    @yield('styles')
</head>
<body>

<div class="app-container">

    {{-- ── Sidebar Backdrop (mobile / tablet) ── --}}
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    {{-- ══════════════════════════════════════
         SIDEBAR
    ══════════════════════════════════════ --}}
    <aside class="sidebar" id="sidebar">

        {{-- TOP SECTION: Main Navigation --}}
        <div class="sidebar-top">
            {{-- Brand --}}
            <div class="brand">
                
                <div class="brand-text">
                    <span class="brand-name">WashDepot</span>
                    <span class="brand-role">Admin / Owner</span>
                </div>
            </div>  

            {{-- Nav --}}
            <nav class="sidebar-nav">
                <a href="{{ url('/admin/shop-management') }}"
                   class="{{ request()->is('admin/shop-management') ? 'active' : '' }}">
                    Shop Management
                </a>
                <a href="{{ url('/admin/branch-management') }}"
                   class="{{ request()->is('admin/branch-management') ? 'active' : '' }}">
                    Branch Management
                </a>
                <a href="{{ url('/admin/update-template') }}"
                   class="{{ request()->is('admin/update-template') ? 'active' : '' }}">
                    Update Template
                </a>
                <a href="{{ url('/admin/inventory') }}"
                   class="{{ request()->is('admin/inventory*') ? 'active' : '' }}">
                    Inventory Management
                </a>
                <a href="{{ url('/admin/reports') }}"
                   class="{{ request()->is('admin/reports') ? 'active' : '' }}">
                    Reports / Sales
                </a>
                <a href="{{ url('/admin/account-management') }}"
                   class="{{ request()->is('admin/account-management') ? 'active' : '' }}">
                    Account Management
                </a>
            </nav>
        </div>

        {{-- MIDDLE SECTION: Quick Actions --}}
        <div class="sidebar-middle">
            <div class="branch-selector">
                <label for="branch-select">Branch:</label>
                <select id="branch-select">
                    <option value="">Select Branch</option>
                    <option value="branch-1">Branch 1</option>
                </select>
            </div>
            <a href="{{ url('/admin/new-laundry') }}"
               class="{{ request()->is('admin/new-laundry') ? 'active' : '' }}">
                New Laundry
            </a>
            <a href="{{ url('/admin/queue') }}"
               class="{{ request()->is('admin/queue') ? 'active' : '' }}">
                Queue Status
            </a>
        </div>

        {{-- BOTTOM SECTION: Profile & Settings --}}
        <div class="sidebar-bottom">
            <a href="{{ url('/admin/admin-profile') }}"
               class="{{ request()->is('admin/admin-profile') ? 'active' : '' }}">
                Profile
            </a>
            <a href="{{ url('/admin/help') }}"
               class="{{ request()->is('admin/help') ? 'active' : '' }}">
                Help &amp; Support
            </a>
            <a href="#" onclick="showLogoutModal(); return false;">
                Logout
            </a>
        </div>
    </aside>

    {{-- ══════════════════════════════════════
         MAIN WRAPPER
    ══════════════════════════════════════ --}}
    <div class="main-wrapper">

        {{-- ── Top Bar ── --}}
        <div class="topbar">

            {{-- Hamburger (mobile / tablet only) --}}
            <button class="hamburger" id="hamburger"
                    aria-label="Open menu" aria-expanded="false" aria-controls="sidebar">
                <span></span>
                <span></span>
                <span></span>
            </button>

            {{-- Right section --}}
            <div class="topbar-right">

                {{-- Notification Bell --}}
                <div class="notif-bell" id="notifBell" style="position:relative;" role="button"
                     aria-label="Notifications" tabindex="0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                         fill="white" viewBox="0 0 24 24">
                        <path d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.9 2 2 2zm6-6V11
                                 c0-3.07-1.64-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5
                                 s-1.5.67-1.5 1.5v.68C7.63 5.36 6 7.92 6 11v5l-2
                                 2v1h16v-1l-2-2z"/>
                    </svg>

                    {{-- Dropdown panel --}}
                    <div class="notif-panel" id="notifPanel">
                        <div class="notif-panel-header">Notifications</div>
                        <div class="notif-list" id="notifList">
                            <div class="notif-empty">No notifications yet</div>
                        </div>
                        <div class="notif-panel-footer">
                            <a href="{{ url('/admin/notifications') }}">View all</a>
                        </div>
                    </div>
                </div>
                {{-- /Bell --}}

                {{-- Admin info --}}
                <div class="staff-info">
                    <span class="staff-name">{{ auth()->user()?->name ?? "Admin's Name" }}</span>
                    <span class="staff-team">Admin / Owner</span>
                </div>

            </div>
        </div>
        {{-- /Topbar --}}

        {{-- ── Page Content ── --}}
        <div class="main-content">
            @yield('content')
        </div>

    </div>
    {{-- /Main wrapper --}}

</div>
{{-- /App container --}}

{{-- ══════════════════════════════════════
     LOGOUT MODAL
══════════════════════════════════════ --}}
<div id="logout-modal-overlay"
     style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.50);
            z-index:9999; align-items:center; justify-content:center;">

    <div style="background:#fff; border-radius:14px; width:100%; max-width:420px;
                margin:1rem; box-shadow:0 20px 60px rgba(0,0,0,0.22);
                overflow:hidden; animation: logoutModalIn 0.22s ease;">

        {{-- ── Header ── --}}
        <div style="padding:1.25rem 1.75rem; background:#f8fafc;
                    border-bottom:1px solid #e2e8f0;
                    display:flex; align-items:center; gap:0.75rem;">
          
            <h2 style="font-size:1.05rem; font-weight:600; color:#1a2535; margin:0;">
                Sign Out
            </h2>
            <button onclick="hideLogoutModal()"
                    style="margin-left:auto; background:none; border:none;
                           font-size:1.4rem; color:#9aabb8; cursor:pointer;
                           line-height:1; padding:0;"
                    aria-label="Close">×</button>
        </div>

        {{-- ── Body ── --}}
        <div style="padding:2rem 1.75rem;">

            {{-- Lock icon --}}
            <div style="width:72px; height:72px; background:#fef2f2; border-radius:50%;
                        display:flex; align-items:center; justify-content:center;
                        font-size:2rem; margin:0 auto 1.25rem auto;
                        border:2px solid #fecaca;">🔐</div>

            <h3 style="font-size:1.25rem; font-weight:700; color:#1a2535;
                       text-align:center; margin:0 0 0.5rem 0;">
                Ready to leave?
            </h3>
            <p style="font-size:0.9rem; color:#7a8999; text-align:center;
                      margin:0 0 1.5rem 0; line-height:1.6;">
                You are about to sign out of your WashDepot admin session.<br>
                Make sure you have saved all your changes before continuing.
            </p>

            {{-- Current user pill --}}
            <div style="display:flex; align-items:center; gap:0.85rem;
                        background:#f8fafc; border:1px solid #e2e8f0;
                        border-radius:9px; padding:1rem 1.25rem; margin-bottom:1.75rem;">
               
                <div>
                    <div style="font-size:0.95rem; font-weight:700; color:#1a2535;">
                        {{ auth()->user()?->name ?? "Admin's Name" }}
                    </div>
                    <div style="font-size:0.82rem; color:#7a8999;">Admin / Owner</div>
                </div>
                <div style="margin-left:auto; text-align:right;">
                    <span style="font-size:0.72rem; color:#9aabb8; display:block;
                                 text-transform:uppercase; letter-spacing:0.05em;
                                 font-weight:600;">Session started</span>
                    <span style="font-size:0.82rem; color:#4a5568; font-weight:600;">
                        {{ now()->format('g:i A') }}
                    </span>
                </div>
            </div>

            {{-- Action buttons --}}
            <div style="display:flex; gap:1rem;">
                <button onclick="hideLogoutModal()"
                        style="flex:1; padding:0.8rem 1.5rem; border-radius:7px;
                               font-weight:600; font-size:0.95rem; cursor:pointer;
                               background:white; color:#1a2535;
                               border:1px solid #d0d9e3; transition:background 0.2s;"
                        onmouseover="this.style.background='#f0f2f5'"
                        onmouseout="this.style.background='white'">
                    Stay Logged In
                </button>

                <a href="{{ url('/login') }}"
                   style="flex:1; display:block; padding:0.8rem 1.5rem; border-radius:7px;
                          font-weight:600; font-size:0.95rem; cursor:pointer;
                          background:#dc2626; color:white; border:none;
                          text-align:center; text-decoration:none; transition:all 0.2s;"
                   onmouseover="this.style.background='#b91c1c'; this.style.boxShadow='0 4px 12px rgba(220,38,38,0.35)'"
                   onmouseout="this.style.background='#dc2626'; this.style.boxShadow='none'">
                    Yes, Sign Out
                </a>
            </div>

        </div>
    </div>
</div>

{{-- ══════════════════════════════════════
     JS — Sidebar toggle + Notif panel + Logout
══════════════════════════════════════ --}}
<script>
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

/* ── Click outside sidebar to close ── */
document.addEventListener('click', function (e) {
    const sidebar = document.getElementById('sidebar');
    const hamburger = document.getElementById('hamburger');
    const clickedInsideSidebar = sidebar.contains(e.target);
    const clickedHamburger = hamburger.contains(e.target);

    if (!clickedInsideSidebar && !clickedHamburger) {
        const sidebarHasOpen = sidebar.classList.contains('open');
        if (sidebarHasOpen) {
            sidebar.classList.remove('open');
            document.getElementById('sidebarOverlay').classList.remove('visible');
            hamburger.classList.remove('open');
            hamburger.setAttribute('aria-expanded', 'false');
            document.body.style.overflow = '';
        }
    }
});

/* ── Logout Modal Functions ── */
function showLogoutModal() {
    const modal = document.getElementById('logout-modal-overlay');
    if (modal) {
        modal.style.display = 'flex';
    }
}

function hideLogoutModal() {
    const modal = document.getElementById('logout-modal-overlay');
    if (modal) {
        modal.style.display = 'none';
    }
}

/* ── Close modal when clicking outside ── */
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('logout-modal-overlay');
    if (modal) {
        modal.addEventListener('click', function(e) {
            if (e.target === this) {
                hideLogoutModal();
            }
        });
    }
});

/* ── Close modal on Escape key ── */
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        hideLogoutModal();
    }
});
</script>

@stack('scripts')
</body>
</html>