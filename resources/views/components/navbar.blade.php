<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

    .navbar-genz {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border-bottom: 1px solid rgba(0, 0, 0, 0.06);
        position: sticky;
        top: 0;
        z-index: 50;
    }

    .navbar-inner {
        max-width: 100%;
        padding: 0 1.5rem;
        height: 76px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
    }

    /* LOGO AREA */
    .navbar-brand {
        display: flex;
        align-items: center;
        gap: 14px;
        text-decoration: none;
        flex-shrink: 0;
    }

    .navbar-logo {
        height: 48px;
        width: auto;
        object-fit: contain;
    }

    .brand-text {
        display: flex;
        flex-direction: column;
        line-height: 1.2;
    }

    .brand-title {
        font-size: clamp(14px, 2vw, 22px);
        font-weight: 800;
        color: #0f172a;
        letter-spacing: -0.4px;
        line-height: 1.2;
    }

    .brand-sub {
        font-size: clamp(11px, 1.2vw, 14px);
        font-weight: 600;
        color: #6366f1;
        letter-spacing: 0.1px;
    }

    /* NAV LINKS */
    .nav-links {
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .nav-link {
        position: relative;
        padding: 7px 16px;
        border-radius: 50px;
        font-size: 14px;
        font-weight: 600;
        color: #64748b;
        text-decoration: none;
        transition: all 0.2s ease;
        white-space: nowrap;
    }

    .nav-link:hover {
        color: #0f172a;
        background: rgba(99, 102, 241, 0.07);
    }

    .nav-link.active {
        color: #4f46e5;
        background: rgba(99, 102, 241, 0.1);
    }

    .nav-link.active::after {
        content: '';
        position: absolute;
        bottom: -1px;
        left: 50%;
        transform: translateX(-50%);
        width: 4px;
        height: 4px;
        border-radius: 50%;
        background: #6366f1;
    }

    /* LOGOUT BUTTON */
    .btn-logout {
        display: flex;
        align-items: center;
        gap: 6px;
        padding: 8px 18px;
        border-radius: 50px;
        font-size: 13px;
        font-weight: 700;
        color: #ef4444;
        background: rgba(239, 68, 68, 0.07);
        border: 1.5px solid rgba(239, 68, 68, 0.18);
        cursor: pointer;
        transition: all 0.2s ease;
        font-family: 'Plus Jakarta Sans', sans-serif;
        letter-spacing: 0.1px;
    }

    .btn-logout:hover {
        background: rgba(239, 68, 68, 0.14);
        border-color: rgba(239, 68, 68, 0.35);
        transform: translateY(-1px);
    }

    .btn-logout svg {
        width: 15px;
        height: 15px;
    }

    /* USER BADGE */
    .user-chip {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 5px 14px 5px 6px;
        border-radius: 50px;
        background: rgba(99, 102, 241, 0.06);
        border: 1px solid rgba(99, 102, 241, 0.15);
    }

    .user-avatar {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background: linear-gradient(135deg, #6366f1, #818cf8);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        font-weight: 800;
        color: white;
        flex-shrink: 0;
    }

    .user-name {
        font-size: 13px;
        font-weight: 700;
        color: #4f46e5;
    }

    /* ROLE BADGE */
    .role-badge {
        display: inline-flex;
        align-items: center;
        padding: 2px 10px;
        border-radius: 50px;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    .role-badge.admin {
        background: rgba(245, 158, 11, 0.1);
        color: #d97706;
    }

    .role-badge.user {
        background: rgba(99, 102, 241, 0.1);
        color: #4f46e5;
    }

    .role-badge.baa {
        background: rgba(16, 185, 129, 0.1);
        color: #059669;
    }

    /* DIVIDER */
    .nav-divider {
        width: 1px;
        height: 24px;
        background: rgba(0, 0, 0, 0.08);
        margin: 0 6px;
    }

    /* HAMBURGER */
    .hamburger-btn {
        display: none;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        width: 40px;
        height: 40px;
        border-radius: 12px;
        background: rgba(99, 102, 241, 0.06);
        border: 1px solid rgba(99, 102, 241, 0.12);
        cursor: pointer;
        gap: 5px;
        transition: all 0.2s;
        flex-shrink: 0;
    }

    .hamburger-btn:hover {
        background: rgba(99, 102, 241, 0.12);
    }

    .ham-line {
        width: 18px;
        height: 2px;
        background: #4f46e5;
        border-radius: 2px;
        transition: all 0.3s ease;
    }

    /* MOBILE MENU */
    .mobile-menu {
        display: none;
        border-top: 1px solid rgba(0, 0, 0, 0.06);
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        padding: 12px 16px 16px;
    }

    .mobile-menu.open {
        display: block;
    }

    .mobile-nav-link {
        display: flex;
        align-items: center;
        padding: 10px 14px;
        border-radius: 14px;
        font-size: 14px;
        font-weight: 600;
        color: #64748b;
        text-decoration: none;
        transition: all 0.2s;
        margin-bottom: 4px;
    }

    .mobile-nav-link:hover {
        background: rgba(99, 102, 241, 0.07);
        color: #0f172a;
    }

    .mobile-nav-link.active {
        background: rgba(99, 102, 241, 0.1);
        color: #4f46e5;
    }

    .mobile-divider {
        height: 1px;
        background: rgba(0, 0, 0, 0.06);
        margin: 10px 0;
    }

    .btn-logout-mobile {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 11px;
        border-radius: 14px;
        font-size: 14px;
        font-weight: 700;
        color: #ef4444;
        background: rgba(239, 68, 68, 0.07);
        border: 1.5px solid rgba(239, 68, 68, 0.15);
        cursor: pointer;
        font-family: 'Plus Jakarta Sans', sans-serif;
        transition: all 0.2s;
    }

    .btn-logout-mobile:hover {
        background: rgba(239, 68, 68, 0.14);
    }

    /* =====================
       RESPONSIVE MOBILE
    ===================== */
    @media (max-width: 768px) {
        .desktop-nav { display: none !important; }
        .hamburger-btn { display: flex !important; }

        .navbar-inner {
            height: auto;
            min-height: 64px;
            padding: 10px 1rem;
        }

        .navbar-logo {
            height: 34px;
        }

        .navbar-brand {
            gap: 10px;
            flex: 1;
            min-width: 0;
            flex-shrink: 1;
        }

        .brand-text {
            display: flex;
            min-width: 0;
        }

        .brand-title {
            font-size: 12px;
            white-space: normal;
            word-break: break-word;
            line-height: 1.3;
        }

        .brand-sub {
            font-size: 10px;
            white-space: normal;
        }
    }
</style>

<nav class="navbar-genz">
    <div class="navbar-inner">

        {{-- BRAND --}}
        <div class="navbar-brand">
            <img src="{{ asset('images/logo-polhas.png') }}" alt="Logo" class="navbar-logo">
            <div class="brand-text">
                <span class="brand-title">Sistem Informasi Pengajuan Surat</span>
                <span class="brand-sub">Pengantar PKL & Penelitian</span>
            </div>
        </div>

        {{-- DESKTOP NAV --}}
        <div class="desktop-nav" style="display: flex; align-items: center; gap: 6px;">

            {{-- Chip role user --}}
            <div class="user-chip">
                <div class="user-avatar">
                    {{ strtoupper(substr(Auth::user()->name ?? Auth::user()->email, 0, 2)) }}
                </div>
                <span class="user-name">{{ Str::limit(Auth::user()->name ?? Auth::user()->email, 14) }}</span>
            </div>

            {{-- Role Badge --}}
            @if(Auth::user()->role == 'admin')
                <span class="role-badge admin">Admin</span>
            @elseif(Auth::user()->role == 'user')
                <span class="role-badge user">Mahasiswa</span>
            @elseif(Auth::user()->role == 'baa')
                <span class="role-badge baa">BAA</span>
            @endif

            <div class="nav-divider"></div>

            {{-- Nav Links --}}
            <nav class="nav-links">
                @if(Auth::user()->role == 'admin')
                    <a href="{{ route('admin.dashboard') }}"
                       class="nav-link {{ Request::routeIs('admin.dashboard') ? 'active' : '' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('admin.verifikasi.index') }}"
                       class="nav-link {{ Request::routeIs('admin.verifikasi*') ? 'active' : '' }}">
                        Verifikasi
                    </a>
                    <a href="{{ route('admin.arsip.index') }}"
                       class="nav-link {{ Request::routeIs('admin.arsip*') ? 'active' : '' }}">
                        Arsip
                    </a>
                @endif

                @if(Auth::user()->role == 'user')
                    <a href="{{ route('dashboard') }}"
                       class="nav-link {{ Request::routeIs('dashboard') ? 'active' : '' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('status-pengajuan.index') }}"
                       class="nav-link {{ Request::is('status-pengajuan*') ? 'active' : '' }}">
                        Status Pengajuan
                    </a>
                @endif

                @if(Auth::user()->role == 'baa')
                    <a href="{{ route('admin.arsip.index') }}"
                       class="nav-link {{ Request::routeIs('admin.arsip*') ? 'active' : '' }}">
                        Arsip
                    </a>
                @endif
            </nav>

            <div class="nav-divider"></div>

            {{-- Logout --}}
            <form action="{{ route('logout') }}" method="POST" onsubmit="return confirm('Yakin mau logout?')">
                @csrf
                <button type="submit" class="btn-logout">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Logout
                </button>
            </form>
        </div>

        {{-- HAMBURGER --}}
        <button id="ham-btn" class="hamburger-btn" aria-label="Toggle menu" aria-expanded="false">
            <span class="ham-line" id="ham1"></span>
            <span class="ham-line" id="ham2"></span>
            <span class="ham-line" id="ham3"></span>
        </button>

    </div>

    {{-- MOBILE MENU --}}
    <div id="mobile-menu" class="mobile-menu">

        {{-- User info mobile --}}
        <div style="display: flex; align-items: center; gap: 10px; padding: 10px 14px; margin-bottom: 8px; background: rgba(99,102,241,0.05); border-radius: 14px;">
            <div class="user-avatar" style="width:36px; height:36px; font-size:13px;">
                {{ strtoupper(substr(Auth::user()->name ?? Auth::user()->email, 0, 2)) }}
            </div>
            <div>
                <div style="font-size:14px; font-weight:700; color:#0f172a;">{{ Auth::user()->name ?? Auth::user()->email }}</div>
                @if(Auth::user()->role == 'admin')
                    <span class="role-badge admin" style="margin-top: 2px; display: inline-flex;">Admin</span>
                @elseif(Auth::user()->role == 'user')
                    <span class="role-badge user" style="margin-top: 2px; display: inline-flex;">Mahasiswa</span>
                @elseif(Auth::user()->role == 'baa')
                    <span class="role-badge baa" style="margin-top: 2px; display: inline-flex;">BAA</span>
                @endif
            </div>
        </div>

        @if(Auth::user()->role == 'admin')
            <a href="{{ route('admin.dashboard') }}" class="mobile-nav-link {{ Request::routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</a>
            <a href="{{ route('admin.verifikasi.index') }}" class="mobile-nav-link {{ Request::routeIs('admin.verifikasi*') ? 'active' : '' }}">Verifikasi</a>
            <a href="{{ route('admin.arsip.index') }}" class="mobile-nav-link {{ Request::routeIs('admin.arsip*') ? 'active' : '' }}">Arsip</a>
        @endif

        @if(Auth::user()->role == 'user')
            <a href="{{ route('dashboard') }}" class="mobile-nav-link {{ Request::routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
            <a href="{{ route('status-pengajuan.index') }}" class="mobile-nav-link {{ Request::is('status-pengajuan*') ? 'active' : '' }}">Status Pengajuan</a>
        @endif

        @if(Auth::user()->role == 'baa')
            <a href="{{ route('admin.arsip.index') }}" class="mobile-nav-link {{ Request::routeIs('admin.arsip*') ? 'active' : '' }}">Arsip</a>
        @endif

        <div class="mobile-divider"></div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn-logout-mobile">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                Logout
            </button>
        </form>
    </div>
</nav>

<script>
    const hamBtn = document.getElementById('ham-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    const ham1 = document.getElementById('ham1');
    const ham2 = document.getElementById('ham2');
    const ham3 = document.getElementById('ham3');

    hamBtn.addEventListener('click', () => {
        const isOpen = mobileMenu.classList.contains('open');
        if (isOpen) {
            mobileMenu.classList.remove('open');
            hamBtn.setAttribute('aria-expanded', 'false');
            ham1.style.transform = '';
            ham2.style.opacity = '1';
            ham3.style.transform = '';
        } else {
            mobileMenu.classList.add('open');
            hamBtn.setAttribute('aria-expanded', 'true');
            ham1.style.transform = 'translateY(7px) rotate(45deg)';
            ham2.style.opacity = '0';
            ham3.style.transform = 'translateY(-7px) rotate(-45deg)';
        }
    });

    document.addEventListener('click', (e) => {
        if (!hamBtn.contains(e.target) && !mobileMenu.contains(e.target)) {
            mobileMenu.classList.remove('open');
            hamBtn.setAttribute('aria-expanded', 'false');
            ham1.style.transform = '';
            ham2.style.opacity = '1';
            ham3.style.transform = '';
        }
    });
</script>