<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PayEase - Sistem Penggajian Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --sidebar-bg: #1e1e2d;
            --sidebar-hover: #27293d;
            --sidebar-color: #a2a3b7;
            --sidebar-active: #4CAF50;
            --sidebar-active-bg: rgba(76, 175, 80, 0.1);
        }

        body {
            background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%);
            min-height: 100vh;
            overflow-x: hidden;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Sidebar Styles */
        #wrapper {
            display: flex;
        }

        #sidebar-wrapper {
            min-height: 100vh;
            width: 280px;
            background: var(--sidebar-bg);
            transition: all 0.3s ease-in-out;
            position: fixed;
            left: -280px;
            z-index: 1000;
            box-shadow: 4px 0 10px rgba(0,0,0,0.1);
        }

        #wrapper.toggled #sidebar-wrapper {
            left: 0;
        }

        .sidebar-heading {
            padding: 1.5rem;
            background: rgba(0,0,0,0.1);
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar-brand {
            font-size: 1.75rem;
            font-weight: 700;
            color: white;
            text-decoration: none;
        }

        .sidebar-brand span {
            color: var(--sidebar-active);
        }

        .list-group {
            padding: 1rem 0;
        }

        .list-group-item {
            background: transparent;
            color: var(--sidebar-color);
            border: none;
            padding: 0.8rem 1.5rem;
            font-size: 0.95rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            transition: all 0.3s;
            position: relative;
            margin: 4px 8px;
            border-radius: 8px;
        }

        .list-group-item i {
            width: 24px;
            font-size: 1.1rem;
            margin-right: 0.75rem;
            text-align: center;
        }

        .list-group-item:hover {
            background: var(--sidebar-hover);
            color: white;
            transform: translateX(5px);
        }

        .list-group-item.active {
            background: var(--sidebar-active-bg);
            color: var(--sidebar-active);
            font-weight: 600;
        }

        .list-group-item.active::before {
            content: '';
            position: absolute;
            left: -8px;
            top: 0;
            height: 100%;
            width: 4px;
            background: var(--sidebar-active);
            border-radius: 0 4px 4px 0;
        }

        /* Navbar Styles */
        .navbar {
            background-color: white !important;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 0.75rem 1.5rem;
            position: sticky;
            top: 0;
            z-index: 900;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: #2c3e50 !important;
            margin-left: 1rem !important;
            margin-right: auto;
        }

        .navbar-brand span {
            color: #4CAF50;
        }

        #menu-toggle {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
            margin-right: 0;
        }

        .logout-btn {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
            color: #2c3e50;
        }

        .logout-btn:hover {
            background: #e9ecef;
            color: #dc3545;
        }

        .logout-btn i {
            font-size: 1.2rem;
        }

        .close-sidebar {
            background: none;
            border: none;
            position: absolute;
            right: 1rem;
            top: 1.5rem;
            color: var(--sidebar-color);
            cursor: pointer;
            transition: all 0.3s;
        }

        .close-sidebar:hover {
            color: white;
            transform: rotate(90deg);
        }

        /* Overlay */
        .sidebar-overlay {
            display: none;
            position: fixed;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
            opacity: 0;
            transition: all 0.3s;
            backdrop-filter: blur(2px);
        }

        .sidebar-overlay.active {
            display: block;
            opacity: 1;
        }

        /* User Profile in Sidebar */
        .sidebar-profile {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
        }

        .profile-img {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: var(--sidebar-active);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            margin-right: 1rem;
        }

        .profile-info {
            flex: 1;
        }

        .profile-name {
            color: white;
            font-size: 0.95rem;
            font-weight: 600;
            margin: 0;
        }

        .profile-role {
            color: var(--sidebar-color);
            font-size: 0.8rem;
            margin: 0;
        }

        /* Content Wrapper */
        #page-content-wrapper {
            width: 100%;
            margin-left: 0;
            transition: all 0.3s;
        }

        .main-content {
            padding: 2rem;
        }

        /* Form Container */
        .form-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 0 15px;
        }

        .form-container .card {
            border: none;
            box-shadow: 0 0 20px rgba(0,0,0,0.08);
            border-radius: 12px;
        }

        .form-container .card-header {
            background: white;
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            border-radius: 12px 12px 0 0;
        }

        .form-container .card-body {
            padding: 1.5rem;
        }

        .form-container .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: #2c3e50;
        }

        .form-container .form-control,
        .form-container .form-select {
            padding: 0.6rem 1rem;
            border-color: #e2e8f0;
            border-radius: 8px;
        }

        .form-container .form-control:focus,
        .form-container .form-select:focus {
            border-color: #4CAF50;
            box-shadow: 0 0 0 0.2rem rgba(76, 175, 80, 0.15);
        }

        .form-container .input-group-text {
            background: #f8f9fa;
            border-color: #e2e8f0;
            color: #2c3e50;
        }

        .form-container textarea.form-control {
            min-height: 100px;
        }

        .form-container .btn {
            padding: 0.6rem 1.5rem;
            font-weight: 500;
            border-radius: 8px;
        }

        .form-container .btn-primary {
            background: #4CAF50;
            border-color: #4CAF50;
        }

        .form-container .btn-primary:hover {
            background: #43a047;
            border-color: #43a047;
        }

        .form-container .btn-secondary {
            background: #6c757d;
            border-color: #6c757d;
        }

        .form-container .btn-secondary:hover {
            background: #5a6268;
            border-color: #5a6268;
        }

        @media (min-width: 992px) {
            .navbar {
                padding: 1rem 2rem;
            }
        }
    </style>
</head>
<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar Overlay -->
        <div class="sidebar-overlay"></div>
        
        <!-- Sidebar -->
        @auth
        <div id="sidebar-wrapper">
            <div class="sidebar-heading">
                <a href="{{ route('home') }}" class="sidebar-brand text-decoration-none">
                    Pay<span>Ease</span>
                </a>
                <button class="close-sidebar">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <!-- User Profile -->
            <div class="sidebar-profile">
                <div class="profile-img">
                    <i class="fas fa-user"></i>
                </div>
                <div class="profile-info">
                    <h6 class="profile-name">{{ Auth::user()->name }}</h6>
                    <p class="profile-role">Administrator</p>
                </div>
            </div>

            <div class="list-group list-group-flush">
                <a href="{{ route('home') }}" class="list-group-item list-group-item-action {{ request()->is('home') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('jabatan.index') }}" class="list-group-item list-group-item-action {{ request()->is('jabatan*') ? 'active' : '' }}">
                    <i class="fas fa-sitemap"></i>
                    <span>Jabatan</span>
                </a>
                <a href="{{ route('karyawan.index') }}" class="list-group-item list-group-item-action {{ request()->is('karyawan*') ? 'active' : '' }}">
                    <i class="fas fa-users"></i>
                    <span>Karyawan</span>
                </a>
                <a href="{{ route('gaji.index') }}" class="list-group-item list-group-item-action {{ request()->is('gaji*') ? 'active' : '' }}">
                    <i class="fas fa-money-bill-wave"></i>
                    <span>Gaji</span>
                </a>
            </div>
        </div>
        @endauth

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container-fluid">
                    <div class="d-flex align-items-center">
                        <button class="btn" id="menu-toggle">
                            <i class="fas fa-bars"></i>
                        </button>
                        <a class="navbar-brand" href="{{ route('home') }}">
                            Pay<span>Ease</span>
                        </a>
                    </div>

                    @auth
                    <button class="logout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" title="Logout">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                    @endauth

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </nav>

            <div class="main-content">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Toggle Sidebar
        const wrapper = document.getElementById("wrapper");
        const menuToggle = document.getElementById("menu-toggle");
        const overlay = document.querySelector(".sidebar-overlay");
        const closeSidebar = document.querySelector(".close-sidebar");

        function toggleSidebar() {
            wrapper.classList.toggle("toggled");
            overlay.classList.toggle("active");
            document.body.style.overflow = wrapper.classList.contains("toggled") ? "hidden" : "auto";
        }

        menuToggle?.addEventListener("click", toggleSidebar);
        overlay?.addEventListener("click", toggleSidebar);
        closeSidebar?.addEventListener("click", toggleSidebar);

        // Close sidebar when clicking on a menu item on mobile
        const menuItems = document.querySelectorAll(".list-group-item");
        if (window.innerWidth < 992) {
            menuItems.forEach(item => {
                item.addEventListener("click", () => {
                    wrapper.classList.remove("toggled");
                    overlay.classList.remove("active");
                    document.body.style.overflow = "auto";
                });
            });
        }
    </script>
    @stack('scripts')
</body>
</html>
