<nav id="sidebar" class="sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="#">
            <img src="{{ asset('profiles/logo.jpg') }}" width="130" alt="Restaurent" class="img-fluid" />
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-item active">
                <a class="sidebar-link" href="#">
                    <i class="align-middle" data-feather="box"></i> <span
                        class="align-middle">Dashboard</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('users.list') }}">
                    <i class="align-middle" data-feather="users"></i> <span
                        class="align-middle">Users</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a data-bs-target="#payments" data-bs-toggle="collapse" class="sidebar-link collapsed">
                <i class="align-middle" data-feather="globe"></i> Manage Restaurent
                </a>
                <ul id="payments" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('restaurent.create') }}">
                            <span class="align-middle">Add New</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('restaurent.index') }}">
                            <span class="align-middle">View All</span>
                        </a>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
</nav>
