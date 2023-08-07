<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <div class="sb-sidenav-menu-heading">
                <div class="text-center">
                    <img src="https://pkl.smksriwijayakrpc.sch.id/img/favicon/favicon.ico" class="rounded" alt="Logo SMK" style="max-width: 50px;">
                </div>
            </div>
            <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>
            <div class="sb-sidenav-menu-heading">Addons</div>
            <a class="nav-link {{ request()->is('admin/siswa*') ? 'active' : '' }}" href="{{ route('admin.siswa') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-solid fa-users"></i></div>
                List Data Siswa
            </a>
        </div>
    </div>
</nav>