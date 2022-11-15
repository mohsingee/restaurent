@extends('admin.layouts.master')
@section('page_title','Restaurent - Dashboard')
@section('content')
<style>
.hidden{
    display: none !important;
}
.white-space {
    white-space: nowrap;
}
</style>
    <div class="container-fluid p-0">

        <div class="row mb-2 mb-xl-3">
            <div class="col-auto d-none d-sm-block">
                <h3 class="admin-db-text">Dashboard</h3>
            </div>

            <div class="col-auto ms-auto text-end mt-n1 hidden">
                <span class="dropdown me-2 hidden">
                    <button class="btn btn-light bg-white shadow-sm dropdown-toggle" id="day" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="align-middle mt-n1" data-feather="calendar"></i> Today
                    </button>
                    <div class="dropdown-menu" aria-labelledby="day">
                        <h6 class="dropdown-header">Settings</h6>
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Separated link</a>
                    </div>
                </span>

                <button class="btn btn-primary shadow-sm">
                    <i class="align-middle" data-feather="filter">&nbsp;</i>
                </button>
                <button class="btn btn-primary shadow-sm">
                    <i class="align-middle" data-feather="refresh-cw">&nbsp;</i>
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-3 d-flex">
                <div class="card flex-fill">
                    <div class="card-body py-4">
                        <div class="d-flex align-items-start">
                            <div class="flex-grow-1">
                                <h3 class=" dashbaird_box_font">Total Users</h3>
                                    <p class="mb-0 top-list-p">{{ userCount() }}</p>
                                <div class="mb-0 hidden">
                                    <span class="badge badge-soft-success me-2"> <i class="mdi mdi-arrow-bottom-right"></i>
                                        +5.35% </span>
                                    <span class="text-muted">Since last week</span>
                                </div>
                            </div>
                            <div class="d-inline-block ms-3">
                                <div class="stat">
                                    <i class="align-middle text-success" data-feather="users"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-3 d-flex">
                <div class="card flex-fill">
                    <div class="card-body py-4">
                        <div class="d-flex align-items-start">
                            <div class="flex-grow-1">
                                <h3 class="mb-2 dashbaird_box_font">Total Restaurents</h3>
                                <p class="mb-2 top-list-p">{{ restaurentCount() }}</p>
                                <div class="mb-0 hidden">
                                    <span class="badge badge-soft-success me-2"> <i class="mdi mdi-arrow-bottom-right"></i>
                                        +5.35% </span>
                                    <span class="text-muted">Since last week</span>
                                </div>
                            </div>
                            <div class="d-inline-block ms-3">
                                <div class="stat">
                                    <i class="align-middle text-success" data-feather="users"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('js/pages/dashboard.js') }}"></script>
@endsection