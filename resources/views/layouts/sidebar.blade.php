<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-spa"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Floréa</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ Auth::user()->role_id == 1 ? route('admin.dashboard') : route('user.dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            @if(Auth::user()->role_id == 1)
                <hr class="sidebar-divider">
                <div class="sidebar-heading">Manajemen Toko</div>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.produk.index') }}">
                        <i class="fas fa-fw fa-box"></i>
                        <span>Daftar Bucket</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.kategori.index') }}">
                        <i class="fas fa-fw fa-tags"></i>
                        <span>Kategori</span>
                    </a>
                </li>

                <hr class="sidebar-divider">
                <div class="sidebar-heading">Laporan</div>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.pesanan.index') }}">
                        <i class="fas fa-fw fa-shopping-cart"></i>
                        <span>Pesanan Masuk</span>
                    </a>
                </li>
            @endif
            
            @if(Auth::user()->role_id == 2)
                <div class="sidebar-heading">Menu Member</div>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.keranjang.index') }}">
                        <i class="fas fa-fw fa-shopping-cart"></i>
                        <span>Keranjang</span>
                    </a>
                </li>
            @endif

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>