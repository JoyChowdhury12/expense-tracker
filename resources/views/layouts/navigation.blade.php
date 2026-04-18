<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm py-3" style="border-color: #f1f3f8 !important;">
    <div class="container-fluid max-w-7xl mx-auto sm:px-6 lg:px-8">
        <a class="navbar-brand d-flex align-items-center fw-bold text-primary tracking-tight" href="{{ route('dashboard') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="me-2" style="height: 38px; width: auto;">
            ExpenseTracker
        </a>
        <button class="navbar-toggler border-0 shadow-none focus-ring-none" type="button" data-bs-toggle="collapse" data-bs-target="#navCollapse" aria-controls="navCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navCollapse">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-4">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active fw-bold text-primary border-bottom border-2 border-primary' : 'text-muted fw-medium' }} px-3" href="{{ route('dashboard') }}" style="transition: all 0.2s;">Dashboard</a>
                </li>
            </ul>
            <div class="d-flex align-items-center mt-3 mt-lg-0">
                <div class="dropdown">
                    <button class="btn btn-light rounded-pill px-4 dropdown-toggle fw-medium text-dark shadow-sm d-flex align-items-center border-0" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #f8f9fc;">
                        <i class="bi bi-person-circle fs-5 me-2 text-primary"></i>
                        {{ Auth::user()->name }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end border-0 shadow rounded-4 mt-2 p-2" aria-labelledby="userDropdown" style="min-width: 220px;">
                        <li><h6 class="dropdown-header fw-bold text-uppercase" style="font-size: 0.75rem; letter-spacing: 1px;">Account Options</h6></li>
                        <li><a class="dropdown-item py-2 fw-medium text-secondary rounded-3 hover-bg-light" href="{{ route('profile.edit') }}"><i class="bi bi-person-gear me-2 text-muted"></i> Profile Settings</a></li>
                        <li><hr class="dropdown-divider opacity-10 my-2"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item py-2 fw-medium text-danger rounded-3"><i class="bi bi-box-arrow-right me-2"></i> Secure Log Out</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
