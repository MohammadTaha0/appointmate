@extends('admin.layouts.main')
@push('second_bread', 'Dashboard')
@section('main')
    <div class="row row-cols-auto">
        @can('SA')
            <div class="col-3">
                <div class="card widget-flat border shadow">
                    <div class="card-body p-2 position-relative">

                        <div class="float-end">
                            <i class="far fa-building dash-icon text-bg-dark rounded-circle"></i>
                        </div>
                        <h5 class="text-dark fw-normal mt-0" data-bs-toggle='tooltip' title="Companies">
                            Companies

                        </h5>
                        <span class="fw-normal position-absolute bottom-0 end-0 p-1 m-1 badge bg-success"> <span
                                class=""><i class="far fa-check-circle"></i></span> Active</span>
                        <h3 class="mb-0 mt-3 text-dark">{{ countCompanies() }}
                        </h3>
                    </div>
                </div>
            </div>
        @endcan

        <div class="col-3">
            <div class="card widget-flat border shadow">
                <div class="card-body p-2 position-relative">

                    <div class="float-end">
                        <i class="far fa-list dash-icon text-bg-dark rounded-circle"></i>
                    </div>
                    <h5 class="text-dark fw-normal mt-0" data-bs-toggle='tooltip' title="Companies">
                        Services
                    </h5>
                    <span class="fw-normal position-absolute bottom-0 end-0 p-1 m-1 badge bg-success"> <span
                            class=""><i class="far fa-check-circle"></i></span> Active</span>
                    <h3 class="mb-0 mt-3 text-dark">{{ countService() }}
                    </h3>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card widget-flat border shadow">
                <div class="card-body p-2 position-relative">

                    <div class="float-end">
                        <i class="far fa-user-doctor dash-icon text-bg-dark rounded-circle"></i>
                    </div>
                    <h5 class="text-dark fw-normal mt-0" data-bs-toggle='tooltip' title="Companies">
                        Doctors
                    </h5>
                    <span class="fw-normal position-absolute bottom-0 end-0 p-1 m-1 badge bg-success"> <span
                            class=""><i class="far fa-check-circle"></i></span> Active</span>
                    <h3 class="mb-0 mt-3 text-dark">{{ countDoctor() }}
                    </h3>
                </div>
            </div>
        </div>

        <div class="col-3">
            <div class="card widget-flat border shadow">
                <div class="card-body p-2 position-relative">

                    <div class="float-end">
                        <i class="far fa-user-circle dash-icon text-bg-dark rounded-circle"></i>
                    </div>
                    <h5 class="text-dark fw-normal mt-0" data-bs-toggle='tooltip' title="Companies">
                        Companies Admins
                    </h5>
                    <span class="fw-normal position-absolute bottom-0 end-0 p-1 m-1 badge bg-success"> <span
                            class=""><i class="far fa-check-circle"></i></span> Active</span>
                    <h3 class="mb-0 mt-3 text-dark">{{ countCompanyUser() }}
                    </h3>
                </div>
            </div>
        </div>
        @can('CA-ONLY')
            <div class="col-12">
                <div class="card widget-flat border shadow">
                    <a href="{{ route('company.page', ['id' => auth()->user()->company, 'slug' => Str::slug(auth()->user()->name)]) }}"
                        class="card-body p-2 position-relative">

                        <div class="float-end">
                            <i class="far fa-eye dash-icon text-bg-dark rounded-circle"></i>
                        </div>
                        <h5 class="text-dark fw-normal mt-0" data-bs-toggle='tooltip' title="Companies">
                            View Appointment Page

                        </h5>
                    </a>
                </div>
            </div>
        @endcan
    </div>
@endsection
