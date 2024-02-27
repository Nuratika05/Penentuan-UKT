<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
id="layout-navbar">
<div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
    <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
        <i class="bx bx-menu bx-sm"></i>
    </a>
</div>

<div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

    <ul class="navbar-nav flex-row align-items-center ms-auto">

        <!-- User -->
        <li class="nav-item navbar-dropdown dropdown-user dropdown">
            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                data-bs-toggle="dropdown">
                <div class="avatar">
                    <img src="{{ asset('user.png') }}" alt
                        class="w-px-40 h-auto rounded-circle" />
                </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <a class="dropdown-item" href="#">
                        <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                                <div class="avatar">
                                    <img src="{{ asset('user.png') }}" alt
                                        class="w-px-40 h-auto rounded-circle" />
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <span class="fw-semibold d-block">{{ Auth::user()->nama }}</span>
                                @if (Auth::guard('mahasiswa')->check())
                                    <small class="text-muted">Mahasiswa</small>
                                @elseif (Auth::guard('admin')->check())
                                    @if (Auth::user()->role == 'verifikator')
                                        <small class="text-muted">Verifikator</small>
                                    @else
                                        <small class="text-muted">Super Admin</small>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <div class="dropdown-divider"></div>
                </li>
                <li>
                    <a class="dropdown-item" style="cursor: pointer;" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">Log Out</span>
                    </a>
                </li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </ul>
        </li>
        <!--/ User -->
    </ul>
</div>
</nav>
