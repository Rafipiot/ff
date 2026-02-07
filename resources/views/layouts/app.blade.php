<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <title>SPK AHP-TOPSIS - Pemilihan Karyawan Terbaik</title>
   <link rel="icon" type="image/png" href="{{ asset('images/eatlahlogo.png') }}">
   <link rel="apple-touch-icon" href="{{ asset('images/eatlahlogo.png') }}">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <style>
       :root {
           --sidebar-width: 250px;
           --sidebar-collapsed-width: 70px;
           --topbar-height: 60px;
           --primary-color: #4361ee;
       }

       body {
           overflow-x: hidden;
       }
       .sidebar-brand {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 1rem;
    margin-bottom: 1rem;
    border-bottom: 1px solid rgba(255,255,255,0.1);
    pointer-events: none;
}

.sidebar-brand img {
    transition: all 0.3s ease;
}

.sidebar.collapsed .sidebar-brand img {
    transform: scale(0.8);
}

       /* Topbar Styles */
       .topbar {
           height: var(--topbar-height);
           background: white;
           position: fixed;
           top: 0;
           right: 0;
           left: 0;
           z-index: 999;
           padding: 0 1.5rem;
           display: flex;
           align-items: center;
           justify-content: flex-end;
           box-shadow: 0 2px 4px rgba(0,0,0,.1);
       }

       .user-profile {
           display: flex;
           align-items: center;
       }

       .user-btn {
           color: #333;
           background: none;
           border: none;
           display: flex;
           align-items: center;
           padding: 0.5rem 1rem;
       }

       .user-btn:hover, .user-btn:focus {
           background: #f8f9fa;
           color: var(--primary-color);
       }

       .user-btn i {
           font-size: 1.2rem;
       }

       /* Sidebar Styles */
       .sidebar {
           width: var(--sidebar-width);
           background: var(--primary-color);
           height: 100vh;
           position: fixed;
           left: 0;
           top: 0;
           transition: all 0.3s ease;
           z-index: 1000;
           padding-top: var(--topbar-height);
       }

       .sidebar.collapsed {
           width: var(--sidebar-collapsed-width);
       }

       .sidebar-brand {
           display: flex;
           align-items: center;
           padding: 1rem;
           color: white;
           font-weight: 600;
           font-size: 1.1rem;
           margin-bottom: 1rem;
           border-bottom: 1px solid rgba(255,255,255,0.1);
           pointer-events: none;
       }

       .sidebar-brand i {
           min-width: 40px;
       }

       .sidebar-brand span {
           transition: opacity 0.3s;
           line-height: 1.2;
       }

       .sidebar.collapsed .sidebar-brand span {
           opacity: 0;
           display: none;
       }

       .sidebar-nav {
           list-style: none;
           padding: 0;
           margin: 0;
       }

       .nav-item {
           margin-bottom: 0.5rem;
       }

       .nav-link {
           color: rgba(255, 255, 255, 0.8);
           padding: 0.8rem 1rem;
           display: flex;
           align-items: center;
           text-decoration: none;
           transition: all 0.3s;
           border-left: 4px solid transparent;
       }

       .nav-link:hover {
           color: white;
           background: rgba(255, 255, 255, 0.1);
       }

       .nav-link.active {
           color: white;
           background: rgba(255, 255, 255, 0.2);
           border-left-color: white;
       }

       .nav-link i {
           font-size: 1.1rem;
           min-width: 40px;
       }

       .nav-link span {
           transition: opacity 0.3s;
       }

       .sidebar.collapsed .nav-link span {
           opacity: 0;
           display: none;
       }

       /* Content Area */
       .content {
           margin-left: var(--sidebar-width);
           margin-top: var(--topbar-height);
           padding: 2rem;
           min-height: calc(100vh - var(--topbar-height));
           background: #f8f9fa;
           transition: all 0.3s;
       }

       .content.expanded {
           margin-left: var(--sidebar-collapsed-width);
       }

       /* Card Styles */
       .card {
           box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
           border-radius: 0.5rem;
           border: none;
       }

       .card-header {
           background-color: #f8f9fa;
           border-bottom: 1px solid #e9ecef;
           padding: 1rem;
           border-radius: 0.5rem 0.5rem 0 0 !important;
       }

       /* Responsive */
       @media (max-width: 768px) {
           /* Sidebar disembunyikan di luar layar dan hanya muncul saat tombol toggle diklik */
           .sidebar {
               left: 0;
               width: var(--sidebar-width);
               transform: translateX(-100%);
           }

           .sidebar.active {
               transform: translateX(0);
           }

           .content {
               margin-left: 0;
               width: 100%;
               padding: 1rem;
           }

           .content.expanded {
               margin-left: 0;
           }
       }

       /* Toggle Button */
       .sidebar-toggle {
           position: fixed;
           left: 1rem;
           top: 1rem;
           z-index: 1001;
           background: var(--primary-color);
           border: none;
           color: white;
           width: 40px;
           height: 40px;
           border-radius: 50%;
           display: none;
           align-items: center;
           justify-content: center;
           cursor: pointer;
           transition: all 0.3s;
       }

       @media (max-width: 768px) {
           .sidebar-toggle {
               display: flex;
           }
       }
   </style>
</head>
<body>
   <!-- Topbar -->
   <div class="topbar">
       @auth
       <div class="user-profile">
           <div class="dropdown">
               <button class="btn dropdown-toggle user-btn" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                   <i class="fas fa-user-circle me-2"></i>
                   {{ Auth::user()->name }}
               </button>
               <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                   <li>
                       <a class="dropdown-item" href="{{ route('logout') }}"
                          onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                           <i class="fas fa-sign-out-alt me-2"></i>Logout
                       </a>
                       <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                           @csrf
                       </form>
                   </li>
               </ul>
           </div>
       </div>
       @endauth
   </div>

   <!-- Sidebar Toggle Button -->
   <button class="sidebar-toggle" id="sidebarToggle">
       <i class="fas fa-bars"></i>
   </button>

   <!-- Sidebar -->
   <nav class="sidebar" id="sidebar">
       <!-- Brand -->
       <div class="sidebar-brand">
        <i class="fas fa-utensils text-white"></i> 
        <div class="brand-text text-white">
            <span class="brand-name">EATLAH</span>
            <span class="brand-location">SAN FRANCHICKO</span>
        </div>
    </div>

       <ul class="sidebar-nav">
           <li class="nav-item">
               <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" 
                  href="{{ route('home') }}">
                   <i class="fas fa-home"></i>
                   <span>Home</span>
               </a>
           </li>
           <li class="nav-item">
               <a class="nav-link {{ request()->routeIs('alternative.*') ? 'active' : '' }}" 
                  href="{{ route('alternative.index') }}">
                   <i class="fas fa-users"></i>
                   <span>Karyawan</span>
               </a>
           </li>
           <li class="nav-item">
               <a class="nav-link {{ request()->routeIs('criteria.*') ? 'active' : '' }}" 
                  href="{{ route('criteria.index') }}">
                   <i class="fas fa-list-check"></i>
                   <span>Kriteria</span>
               </a>
           </li>
           <li class="nav-item">
               <a class="nav-link {{ request()->routeIs('penilaian.*') ? 'active' : '' }}" 
                  href="{{ route('penilaian.index') }}">
                   <i class="fas fa-star-half-alt"></i>
                   <span>Penilaian</span>
               </a>
           </li>
           <li class="nav-item">
               <a class="nav-link {{ request()->routeIs('hasil.*') ? 'active' : '' }}" 
                  href="{{ route('hasil.index') }}">
                   <i class="fas fa-trophy"></i>
                   <span>Hasil Ranking</span>
               </a>
           </li>
       </ul>
   </nav>

   <!-- Content -->
   <div class="content" id="content">
       <div class="container-fluid">
           @yield('content')
       </div>
   </div>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
   <script>
       document.addEventListener('DOMContentLoaded', function() {
           const sidebar = document.getElementById('sidebar');
           const content = document.getElementById('content');
           const sidebarToggle = document.getElementById('sidebarToggle');

           // Desktop hover functionality
           if (window.innerWidth > 768) {
               sidebar.addEventListener('mouseenter', () => {
                   sidebar.classList.remove('collapsed');
                   content.classList.remove('expanded');
               });

               sidebar.addEventListener('mouseleave', () => {
                   sidebar.classList.add('collapsed');
                   content.classList.add('expanded');
               });

               // Initial state
               sidebar.classList.add('collapsed');
               content.classList.add('expanded');
           }

           // Mobile toggle functionality
           sidebarToggle.addEventListener('click', () => {
               sidebar.classList.toggle('active');
           });

           // Close sidebar when clicking outside on mobile
           document.addEventListener('click', (e) => {
               if (window.innerWidth <= 768 && 
                   !sidebar.contains(e.target) && 
                   !sidebarToggle.contains(e.target)) {
                   sidebar.classList.remove('active');
               }
           });
       });
   </script>
   @stack('scripts')
</body>
</html>