<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <span class="app-brand-logo demo">
            <img src="{{ asset('logo_politani.png') }}" alt="Logo Politani" width="36px">
        </span>
        <span class="text-capitalize app-brand-text demo menu-text fw-bolder ms-2">POLITANI</span>
    </div>
    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
        <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1" >
        <li class="menu-item  {{ request()->is('home*', 'admin/home*') ? 'active' : '' }}">
            @if (Auth::guard('mahasiswa')->check())
                <a href="{{ route('mahasiswa.page') }}" class="menu-link">
                @elseif (Auth::guard('admin')->check())
                    <a href="{{ route('admin.page') }}" class="menu-link">
            @endif
            <i class="menu-icon menu-text tf-icons bx bx-home"></i>
            <div class="menu-text">Home</div>
            </a>
        </li>
        <li class="menu-item {{ request()->is('profile*', 'admin/dashboard*') ? 'active' : '' }}">
            @if (Auth::guard('mahasiswa')->check())
                <a href="{{ route('mahasiswa.home') }}" class="menu-link">
                    <i class="menu-icon menu-text tf-icons bx bx-user"></i>
                    <div class="menu-text">Profile</div>
                </a>
            @elseif (Auth::guard('admin')->check())
                <a href="{{ route('admin.home') }}" class="menu-link">
                    <i class="menu-icon menu-text tf-icons bx bx-bar-chart"></i>
                    <div class="menu-text">Dashboard</div>
                </a>
            @endif
        </li>
        @if (Auth::guard('admin')->check() && Auth::user()->role == 'superadmin')
            <li
                class="menu-item {{ request()->is('admin/semua-data/mahasiswa*', 'admin/semua-data/jurusan*', 'admin/semua-data/prodi*', 'admin/semua-data/golongan/kelompokUKT*', 'admin/semua-data/golongan/golongan*', 'admin/semua-data/kriteria/kriteria*', 'admin/semua-data/kriteria/sub-kriteria*') ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon menu-text tf-icons bx bx-layer"></i>
                    <div data-i18n="Data Master" class="menu-text" >Semua Data</div>
                </a>
                <ul class="menu-sub menu-inner py-1" style="margin-left: 15px;">
                    <li class="menu-item {{ request()->is('admin/semua-data/mahasiswa*') ? 'active' : '' }}">
                        <a href="{{ route('mahasiswa.index') }}" class="menu-text menu-link">
                            <div class="menu-text">Mahasiswa</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->is('admin/semua-data/jurusan*') ? 'active' : '' }}">
                        <a href="{{ route('jurusan.index') }}" class="menu-text menu-link">
                            <div class="menu-text">Jurusan</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->is('admin/semua-data/prodi*') ? 'active' : '' }}">
                        <a href="{{ route('prodi.index') }}" class="menu-text menu-link">
                            <div class="menu-text">Prodi</div>
                        </a>
                    </li>
                    <li
                        class="menu-item {{ request()->is('admin/semua-data/golongan/kelompokUKT*', 'admin/semua-data/golongan/golongan*') ? 'active open' : '' }}">
                        <a href="javascript:void(0);" class="menu-link menu-text menu-toggle">
                            <div class="menu-text">Golongan</div>
                        </a>
                        <ul class="menu-sub menu-inner py-1" style="margin-left: 20px;">
                            <li
                                class="menu-item {{ request()->is('admin/semua-data/golongan/kelompokUKT*') ? 'active' : '' }}">
                                <a href="{{ route('kelompokUKT.index') }}" class="menu-text menu-link">
                                    <div class="menu-text">Kelompok UKT</div>
                                </a>
                            </li>
                            <li
                                class="menu-item {{ request()->is('admin/semua-data/golongan/golongan*') ? 'active' : '' }}">
                                <a href="{{ route('golongan.index') }}" class="menu-text menu-link">
                                    <div class="menu-text">Golongan</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li
                        class="menu-item {{ request()->is('admin/semua-data/kriteria/kriteria*', 'admin/semua-data/kriteria/sub-kriteria*') ? 'active open' : '' }}">
                        <a href="javascript:void(0);" class="menu-link menu-text menu-toggle">
                            <div class="menu-text">Kriteria</div>
                        </a>
                        <ul class="menu-sub menu-inner py-1" style="margin-left: 20px;">
                            <li
                                class="menu-item {{ request()->is('admin/semua-data/kriteria/kriteria*') ? 'active' : '' }}">
                                <a href="{{ route('kriteria.index') }}" class="menu-link">
                                    <div class="menu-text">Kriteria</div>
                                </a>
                            </li>
                            <li
                                class="menu-item {{ request()->is('admin/semua-data/kriteria/sub-kriteria*') ? 'active' : '' }}">
                                <a href="{{ route('sub-kriteria.index') }}" class="menu-link">
                                    <div class="menu-text">Sub Kriteria</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
        @endif
        @if (Auth::guard('admin')->check())
            <li
                class="menu-item {{ request()->is('admin/data-ukt/semua-data-ukt*', 'admin/data-ukt/menunggu-verifikasi*', 'admin/data-ukt/belum-lengkap*', 'admin/data-ukt/lulus-verifikasi*') ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons menu-text bx bx-money"></i>
                    <div data-i18n="Data Master" class="menu-text">Data UKT</div>
                </a>

                <ul class="menu-sub menu-inner py-1" style="margin-left: 15px;">
                    <li class="menu-item {{ request()->is('admin/data-ukt/semua-data-ukt*') ? 'active' : '' }}">
                        {{-- check guard --}}
                        <a href="{{ route('admin.data-ukt') }}" class="menu-link">
                            <div class="menu-text">Semua Data UKT</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->is('admin/data-ukt/menunggu-verifikasi*') ? 'active' : '' }}">
                        <a href="{{ route('admin.menunggu-verifikasi') }}" class="menu-link">
                            <div class="menu-text">Menunggu Verifikasi</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->is('admin/data-ukt/belum-lengkap*') ? 'active' : '' }}">
                        <a href="{{ route('admin.data-belum-lengkap') }}" class="menu-link">
                            <div class="menu-text">Belum Lengkap</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->is('admin/data-ukt/lulus-verifikasi*') ? 'active' : '' }}">
                        <a href="{{ route('admin.lulus-verifikasi') }}" class="menu-link">
                            <div class="menu-text">Lulus Verifikasi</div>
                        </a>
                    </li>
                </ul>
            </li>
        @endif
        @if (Auth::guard('mahasiswa')->check())
            <li class="menu-item {{ request()->is('data-ukt*') ? 'active' : '' }}">
                {{-- check guard --}}
                <a href="{{ route('mahasiswa.data-ukt') }}" class="menu-link">
                    <i class="menu-icon menu-text tf-icons bx bx-money"></i>
                    <div class="menu-text">Pendaftaran</div>
                </a>
            </li>
        @endif
        @if (Auth::guard('admin')->check())
            <li class="menu-item {{ request()->is('admin/arsip*') ? 'active' : '' }}">
                <a href="{{ route('arsip.index') }}" class="menu-link">
                    <i class="menu-icon menu-text tf-icons bx bx-lock"></i>
                    <div class="menu-text">Arsip</div>
                </a>
            </li>
        @endif
        @if (Auth::guard('admin')->check() && Auth::user()->role == 'superadmin')
            <li class="menu-item {{ request()->is('admin/admin*') ? 'active' : '' }}">
                <a href="{{ route('admin.index') }}" class="menu-link">
                    <i class="menu-icon menu-text tf-icons bx bx-user-check"></i>
                    <div class="menu-text">Admin</div>
                </a>
            </li>
        @endif
    </ul>
</aside>
