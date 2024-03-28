<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ asset('logo_politani.png') }}" alt="Logo Politani" width="36px">
            </span>
            <span class="text-capitalize app-brand-text demo menu-text fw-bolder ms-2">Politani</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <li class="menu-item {{ request()->is('page*', 'admin/page*') ? 'active' : '' }}">
            @if (Auth::guard('mahasiswa')->check())
                <a href="{{ route('mahasiswa.page') }}" class="menu-link">
                @elseif (Auth::guard('admin')->check())
                    <a href="{{ route('admin.page') }}" class="menu-link">
            @endif
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div>Home</div>
            </a>
        </li>
        <li class="menu-item {{ request()->is('home*', 'admin/home*') ? 'active' : '' }}">
            @if (Auth::guard('mahasiswa')->check())
                <a href="{{ route('mahasiswa.home') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div>Profil</div>
                </a>
            @elseif (Auth::guard('admin')->check())
                <a href="{{ route('admin.home') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div>Dashboard</div>
                </a>
            @endif
        </li>
        @if (Auth::guard('admin')->check() && Auth::user()->role == 'superadmin')
            <li
                class="menu-item {{ request()->is('admin/kriteria*', 'admin/sub-kriteria*', 'admin/jurusan*', 'admin/prodi*', 'admin/mahasiswa*', 'admin/golongan*') ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-folder"></i>
                    <div data-i18n="Data Master">Semua Data</div>
                </a>

                <ul class="menu-sub">
                    <li class="menu-item {{ request()->is('admin/kriteria*') ? 'active' : '' }}">
                        <a href="{{ route('kriteria.index') }}" class="menu-link">
                            <div>Kriteria</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->is('admin/sub-kriteria*') ? 'active' : '' }}">
                        <a href="{{ route('sub-kriteria.index') }}" class="menu-link">
                            <div>Sub Kriteria</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->is('admin/jurusan*') ? 'active' : '' }}">
                        <a href="{{ route('jurusan.index') }}" class="menu-link">
                            <div>Jurusan</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->is('admin/prodi*') ? 'active' : '' }}">
                        <a href="{{ route('prodi.index') }}" class="menu-link">
                            <div>Prodi</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->is('admin/mahasiswa*') ? 'active' : '' }}">
                        <a href="{{ route('mahasiswa.index') }}" class="menu-link">
                            <div>Mahasiswa</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->is('admin/golongan*') ? 'active' : '' }}">
                        <a href="{{ route('golongan.index') }}" class="menu-link">
                            <div>Golongan</div>
                        </a>
                    </li>
                </ul>
            </li>
        @endif
        @if (Auth::guard('admin')->check())
            <li
                class="menu-item {{ request()->is('admin/data-ukt*', 'admin/menunggu-verifikasi*', 'admin/data-belum-lengkap', 'admin/data-lengkap') ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-folder"></i>
                    <div data-i18n="Data Master">Data UKT</div>
                </a>

                <ul class="menu-sub">
                    <li class="menu-item {{ request()->is('admin/data-ukt*') ? 'active' : '' }}">
                        {{-- check guard --}}
                        <a href="{{ route('admin.data-ukt') }}" class="menu-link">
                            <div>Semua Data UKT</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->is('admin/menunggu-verifikasi*') ? 'active' : '' }}">
                        <a href="{{ route('admin.menunggu-verifikasi') }}" class="menu-link">
                            <div>Menunggu Verifikasi</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->is('admin/data-belum-lengkap*') ? 'active' : '' }}">
                        <a href="{{ route('admin.data-belum-lengkap') }}" class="menu-link">
                            <div>Belum Lengkap</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->is('admin/data-lengkap*') ? 'active' : '' }}">
                        <a href="{{ route('admin.data-lengkap') }}" class="menu-link">
                            <div>Lengkap</div>
                        </a>
                    </li>
                </ul>
            </li>
        @endif
        @if (Auth::guard('mahasiswa')->check())
            <li class="menu-item {{ request()->is('data-ukt*') ? 'active' : '' }}">
                {{-- check guard --}}
                <a href="{{ route('mahasiswa.data-ukt') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-folder"></i>
                    <div>Data UKT</div>
                </a>
            </li>
        @endif

        @if (Auth::guard('admin')->check() && Auth::user()->role == 'superadmin')
            <li class="menu-item {{ request()->is('admin/admin*') ? 'active' : '' }}">
                <a href="{{ route('admin.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-user-check"></i>
                    <div>Admin</div>
                </a>
            </li>
        @endif
        @if (Auth::guard('admin')->check() && Auth::user()->role == 'superadmin')
            <li class="menu-item {{ request()->is('admin/arsip*') ? 'active' : '' }}">
                <a href="{{ route('arsip.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-archive"></i>
                    <div>Arsip</div>
                </a>
            </li>
        @endif
    </ul>
</aside>
