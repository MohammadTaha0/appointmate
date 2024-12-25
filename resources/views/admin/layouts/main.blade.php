<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Appointment Management System | AppointMate</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="AppointMate - Made by Muhammad Taha" name="description" />
    <meta content="Muhammad Taha" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets_backend/images/favicon.ico') }}">

    <!-- Plugin css -->
    <link href="{{ asset('assets_backend/vendor/daterangepicker/daterangepicker.css') }}" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('assets_backend/vendor/jsvectormap/jsvectormap.min.css') }}" rel="stylesheet" type="text/css">
    <!-- Jquery Js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Theme Config Js -->
    <script src="{{ asset('assets_backend/js/hyper-config.js') }}"></script>

    <!-- Vendor css -->
    <link href="{{ asset('assets_backend/css/vendor.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="{{ asset('assets_backend/css/app-saas.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="{{ asset('assets_backend/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.2/css/all.css">


    <style>
        .logo span {
            height: 100px !important;
        }

        .logo img {
            width: 100% !important;
            object-fit: contain !important;
            height: 100% !important;
        }
    </style>
</head>

<body>
    <!-- Pre-loader -->
    <div id="preloader">
        <div id="status">
            <div class="bouncing-loader">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>
    <!-- End Preloader-->
    <div class="alert-container"></div>
    <script>
        function showAlert(message, type) {
            var alertHtml = `
                    <div class="alert alert-${type} alert-dismissible fade show custom-alert-icon shadow-sm d-flex align-items-center gap-2" role="alert">
                    <span>
                        <i class='fa-solid fa-${type=='success'?'check':''}${type=='danger'?'times':''}${type=='warning'?'exclamation':''}-circle text-${type}'></i>
                        </span>
                        <span>
                            ${message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i class="bi bi-x"></i></button>
                            </span>
                    </div>
                `;

            var alertElement = $(alertHtml);
            $('.alert-container').append(alertElement);

            setTimeout(function() {
                alertElement.fadeOut(function() {
                    $(this).remove();
                });
            }, 10000);
        }
    </script>
    @if (session('success'))
        <script>
            showAlert("{{ session('success') }}", "success")
        </script>
    @endif

    @if (session('error'))
        <script>
            showAlert("{{ session('error') }}", "danger")
        </script>
    @endif
    <!-- Begin page -->
    <div class="wrapper">


        <div class="navbar-custom">
            <div class="topbar container-fluid">
                <div class="d-flex align-items-center gap-lg-2 gap-1">

                    <!-- Topbar Brand Logo -->
                    <div class="logo-topbar">
                        <!-- Logo light -->
                        <a href="{{ url('/') }}" class="logo-light">
                            <span class="logo-lg">
                                <img src="{{ asset('assets_backend/images/AppointMate.png') }}" alt="logo">
                            </span>
                            <span class="logo-sm">
                                <img src="{{ asset('assets_backend/images/AppointMate.png') }}" alt="small logo">
                            </span>
                        </a>

                        <!-- Logo Dark -->
                        <a href="{{ url('/') }}" class="logo-dark">
                            <span class="logo-lg">
                                <img src="{{ asset('assets_backend/images/AppointMate.png') }}" alt="dark logo">
                            </span>
                            <span class="logo-sm">
                                <img src="{{ asset('assets_backend/images/AppointMate.png') }}" alt="small logo">
                            </span>
                        </a>
                    </div>

                    <!-- Sidebar Menu Toggle Button -->
                    <button class="button-toggle-menu">
                        <i class="mdi mdi-menu"></i>
                    </button>

                    <!-- Horizontal Menu Toggle Button -->
                    <button class="navbar-toggle" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                        <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </button>

                    <!-- Topbar Search Form -->
                    {{-- <div class="app-search dropdown d-none d-lg-block">
                        <form>
                            <div class="input-group">
                                <input type="search" class="form-control dropdown-toggle" placeholder="Search..."
                                    id="top-search">
                                <span class="mdi mdi-magnify search-icon"></span>
                                <button class="input-group-text btn btn-primary" type="submit">Search</button>
                            </div>
                        </form>

                        <div class="dropdown-menu dropdown-menu-animated dropdown-lg" id="search-dropdown">
                            <!-- item-->
                            <div class="dropdown-header noti-title">
                                <h5 class="text-overflow mb-2">Found <span class="text-danger">17</span> results</h5>
                            </div>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="uil-notes font-16 me-1"></i>
                                <span>Analytics Report</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="uil-life-ring font-16 me-1"></i>
                                <span>How can I help you?</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="uil-cog font-16 me-1"></i>
                                <span>User profile settings</span>
                            </a>

                            <!-- item-->
                            <div class="dropdown-header noti-title">
                                <h6 class="text-overflow mb-2 text-uppercase">Users</h6>
                            </div>

                            <div class="notification-list">
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="d-flex">
                                        <img class="d-flex me-2 rounded-circle"
                                            src="{{ asset('assets_backend/images/users/avatar-2.jpg') }}"
                                            alt="Generic placeholder image" height="32">
                                        <div class="w-100">
                                            <h5 class="m-0 font-14">Erwin Brown</h5>
                                            <span class="font-12 mb-0">UI Designer</span>
                                        </div>
                                    </div>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="d-flex">
                                        <img class="d-flex me-2 rounded-circle"
                                            src="{{ asset('assets_backend/images/users/avatar-5.jpg') }}"
                                            alt="Generic placeholder image" height="32">
                                        <div class="w-100">
                                            <h5 class="m-0 font-14">Jacob Deo</h5>
                                            <span class="font-12 mb-0">Developer</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div> --}}
                </div>

                <ul class="topbar-menu d-flex align-items-center gap-3">
                    <li class="dropdown d-lg-none">
                        <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#"
                            role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="ri-search-line font-22"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-animated dropdown-lg p-0">
                            <form class="p-3">
                                <input type="search" class="form-control" placeholder="Search ..."
                                    aria-label="Recipient's username">
                            </form>
                        </div>
                    </li>


                    <li class="dropdown">
                        <a class="nav-link dropdown-toggle arrow-none nav-user px-2" data-bs-toggle="dropdown"
                            href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <span class="account-user-avatar">
                                <img src="{{ asset('assets_backend/images/users/avatar-1.jpg') }}" alt="user-image"
                                    width="32" class="rounded-circle">
                            </span>
                            <span class="d-lg-flex flex-column gap-1 d-none">
                                <h5 class="my-0">{{ auth()->user()->name }}</h5>
                                <h6 class="my-0 fw-normal">{{ auth()->user()->role_name }}</h6>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated profile-dropdown">
                            <!-- item-->
                            <div class=" dropdown-header noti-title">
                                <h6 class="text-overflow m-0">Welcome !</h6>
                            </div>

                            <!-- item-->
                            <a href="{{ route('auth.logout') }}" class="dropdown-item">
                                <i class="mdi mdi-logout me-1"></i>
                                <span>Logout</span>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <!-- ========== Topbar End ========== -->

        <!-- ========== Left Sidebar Start ========== -->
        <div class="leftside-menu">

            <!-- Brand Logo Light -->
            <a href="{{ url('/') }}" class="logo logo-light">
                <span class="logo-lg">
                    <img src="{{ asset('assets_backend/images/AppointMate.png') }}" alt="logo">
                </span>
                <span class="logo-sm">
                    <img src="{{ asset('assets_backend/images/AppointMate.png') }}" alt="small logo">
                </span>
            </a>

            <!-- Brand Logo Dark -->
            <a href="{{ url('/') }}" class="logo logo-dark">
                <span class="logo-lg">
                    <img src="{{ asset('assets_backend/images/AppointMate.png') }}" alt="dark logo">
                </span>
                <span class="logo-sm">
                    <img src="{{ asset('assets_backend/images/AppointMate.png') }}" alt="small logo">
                </span>
            </a>

            <!-- Sidebar Hover Menu Toggle Button -->
            <div class="button-sm-hover" data-bs-toggle="tooltip" data-bs-placement="right"
                title="Show Full Sidebar">
                <i class="ri-checkbox-blank-circle-line align-middle"></i>
            </div>

            <!-- Full Sidebar Menu Close Button -->
            <div class="button-close-fullsidebar">
                <i class="ri-close-fill align-middle"></i>
            </div>

            <!-- Sidebar -->
            <div class="h-100" id="leftside-menu-container" data-simplebar>
                <!-- Leftbar User -->
                <div class="leftbar-user">
                    <a>
                        <img src="{{ auth()->user()->image_exist ? auth()->user()->image_url : asset('assets_backend/images/users/avatar-1.jpg') }}"
                            alt="user-image" height="42" class="rounded-circle shadow-sm">
                        <span class="leftbar-user-name mt-2">{{ auth()->user()->name }}</span>
                    </a>
                </div>

                <!--- Sidemenu -->
                <ul class="side-nav">

                    <li class="side-nav-title">Navigation</li>




                    <li class="side-nav-item">
                        <a href="{{ route('admin.dashboard', ['company_slug' => Str::slug(auth()->user()->getCompany->name ?? 'SA')]) }}"
                            class="side-nav-link">
                            <i class="uil-calender"></i>
                            <span> Dashboard </span>
                        </a>
                    </li>

                    <li class="side-nav-title">CMS</li>
                    @can('SA')
                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#sidebarDashboards" aria-expanded="false"
                                aria-controls="sidebarDashboards" class="side-nav-link">
                                <i class="uil-home-alt"></i>
                                <span class="badge bg-light text-dark float-end">{{ countCompanies() }}</span>
                                <span> Companies </span>
                            </a>
                            <div class="collapse" id="sidebarDashboards">
                                <ul class="side-nav-second-level">
                                    <li>
                                        <a
                                            href="{{ route('admin.company.create', ['company_slug' => Str::slug(auth()->user()->getCompany->name ?? 'SA')]) }}">Create</a>
                                    </li>
                                    <li>
                                        <a
                                            href="{{ route('admin.company.index', ['company_slug' => Str::slug(auth()->user()->getCompany->name ?? 'SA')]) }}">List</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @endcan
                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#sidebarDashboards1" aria-expanded="false"
                            aria-controls="sidebarDashboards1" class="side-nav-link">
                            <i class="far fa-user-circle"></i>
                            <span class="badge bg-light text-dark float-end">{{ countCompanyUser() }}</span>
                            <span> Company Users </span>
                        </a>
                        <div class="collapse" id="sidebarDashboards1">
                            <ul class="side-nav-second-level">
                                <li>
                                    <a
                                        href="{{ route('admin.company_user.create', ['company_slug' => Str::slug(auth()->user()->getCompany->name ?? 'SA')]) }}">Create</a>
                                </li>
                                <li>
                                    <a
                                        href="{{ route('admin.company_user.index', ['company_slug' => Str::slug(auth()->user()->getCompany->name ?? 'SA')]) }}">List</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#sidebarDashboards2" aria-expanded="false"
                            aria-controls="sidebarDashboards2" class="side-nav-link">
                            <i class="far fa-list"></i>
                            <span class="badge bg-light text-dark float-end">{{ countService() }}</span>
                            <span> Services </span>
                        </a>
                        <div class="collapse" id="sidebarDashboards2">
                            <ul class="side-nav-second-level">
                                <li>
                                    <a
                                        href="{{ route('admin.service.create', ['company_slug' => Str::slug(auth()->user()->getCompany->name ?? 'SA')]) }}">Create</a>
                                </li>
                                <li>
                                    <a
                                        href="{{ route('admin.service.index', ['company_slug' => Str::slug(auth()->user()->getCompany->name ?? 'SA')]) }}">List</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#sidebarDashboards3" aria-expanded="false"
                            aria-controls="sidebarDashboards3" class="side-nav-link">
                            <i class="far fa-user-doctor"></i>
                            <span class="badge bg-light text-dark float-end">{{ countDoctor() }}</span>
                            <span> Doctors </span>
                        </a>
                        <div class="collapse" id="sidebarDashboards3">
                            <ul class="side-nav-second-level">
                                <li>
                                    <a
                                        href="{{ route('admin.doctor.create', ['company_slug' => Str::slug(auth()->user()->getCompany->name ?? 'SA')]) }}">Create</a>
                                </li>
                                <li>
                                    <a
                                        href="{{ route('admin.doctor.index', ['company_slug' => Str::slug(auth()->user()->getCompany->name ?? 'SA')]) }}">List</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                </ul>
                <!--- End Sidemenu -->

                <div class="clearfix"></div>
            </div>
        </div>
        <!-- ========== Left Sidebar End ========== -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">

                <!-- start page title -->
                <div class="row">
                    <div class="container px-3">
                        <div class="col-12">
                            <div class="page-title-box">
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a
                                                href="{{ route('admin.dashboard', ['company_slug' => Str::slug(auth()->user()->getCompany->name ?? 'SA')]) }}">AppointMate</a>
                                        </li>
                                        @if (!empty(trim($__env->yieldPushContent('main_bread'))))
                                            <li class="breadcrumb-item"><a
                                                    href="@stack('main_bread_url')">@stack('main_bread')</a>
                                            </li>
                                        @endif
                                        @if (!empty(trim($__env->yieldPushContent('second_bread'))))
                                            <li class="breadcrumb-item active">@stack('second_bread')</li>
                                        @endif

                                    </ol>
                                </div>
                                <h4 class="page-title">@stack('second_bread')</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <!-- Start Content-->
                <div class="container-fluid">
                    @yield('main')
                </div>

                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> © AppointMate
                            </div>
                            <div class="col-md-6">
                                <div class="text-md-end footer-links d-none d-md-block">
                                    {{-- <a href="javascript: void(0);">About</a>
                                    <a href="javascript: void(0);">Support</a>
                                    <a href="javascript: void(0);">Contact Us</a> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

        </div>
        <!-- END wrapper -->
    </div>

    <div id="danger-header-modal" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="danger-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="" method="post" class="modal-content">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title text-light" id="danger-header-modalLabel">Are You Sure?</h4>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    This action will permanently delete the selected item and cannot be undone. Please proceed with
                    caution, as this will result in the permanent removal of the data.
                </div>
                <div class="modal-footer">
                    @csrf
                    <input type="hidden" name="id" id="danger-header-modal-id">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div id="danger-header-modal-all" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="danger-header-modal-allLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="" method="post" class="modal-content">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title text-light" id="danger-header-modal-allLabel">Are You Sure? <span
                            id="danger-header-modal-all-counter"></span></h4>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    This action will permanently delete the selected items and cannot be undone. Please proceed with
                    caution, as this will result in the permanent removal of the data.
                </div>
                <div class="modal-footer">
                    @csrf
                    <input type="hidden" name="ids" id="danger-header-modal-all-ids">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- Vendor js -->
    <script src="{{ asset('assets_backend/js/vendor.min.js') }}"></script>

    <!-- Daterangepicker js -->
    {{-- <script src="{{ asset('assets_backend/vendor/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('assets_backend/vendor/daterangepicker/daterangepicker.js') }}"></script> --}}

    <!-- Charts js -->
    {{-- <script src="{{ asset('assets_backend/vendor/chart.js') }}/chart.umd.js')}}"></script> --}}
    {{-- <script src="{{ asset('assets_backend/vendor/apexcharts/apexcharts.min.js') }}"></script> --}}

    <!-- Vector Map js -->
    {{-- <script src="{{ asset('assets_backend/vendor/jsvectormap/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('assets_backend/vendor/jsvectormap/maps/world-merc.js') }}"></script>
    <script src="{{ asset('assets_backend/vendor/jsvectormap/maps/world.js') }}"></script> --}}
    <!-- Analytics Dashboard App js -->
    {{-- <script src="{{ asset('assets_backend/js/pages/demo.dashboard-analytics.js') }}"></script> --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

    <script>
        $.validator.addMethod("image", function(value, element) {
            // Regular expression to check for valid image extensions
            return this.optional(element) || /(\.jpg|\.jpeg|\.png|\.gif)$/i.test(value);
        }, "Please upload a valid image (JPEG, PNG, or GIF).");
    </script>
    <script>
        let eles = ["a", "button"];
        eles.forEach(ele => {
            $(ele).each(el => {
                el = $(ele).eq(el);
                if (el.attr('data-bs-original-title') || el.attr('title')) {
                    el.attr("data-bs-toggle", "tooltip");
                }
            })
        })

        function createEdit(rules, messages, url, redirect = null) {
            $("#createForm").validate({
                rules: rules,
                messages: messages,
                errorPlacement: function(error, element) {
                    error.prepend(`<i class='far fa-exclamation-circle me-1'></i>`);
                    if (element.attr("type") === "email") {
                        error.insertAfter(element);
                    } else if (element.attr("type") === "password") {
                        error.insertAfter(element.closest(
                            ".input-group"));
                    } else {
                        error.insertAfter(element);
                    }
                },
                submitHandler: function(form) {
                    $(".error").fadeOut();
                    $(".alert").fadeOut();
                    let btn = $(form).find("button[type='submit']");
                    btn.prop("disabled", true);
                    btn.prepend(`<span class='spinner-border spinner-border-sm border-1 me-1'></span>`);
                    let formData = new FormData(form);
                    $.ajax({
                        url: url,
                        type: "post",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(res) {
                            btn.prop("disabled", false);
                            btn.find(".spinner-border").remove();
                            if (res.status === 200) {
                                showAlert(res.msg, 'success');
                                form.reset();
                                @if (isset($data))
                                    location.href = redirect
                                @endif
                                $(".image-preview-show").fadeOut();
                            } else if (res.status === 403) {
                                for (const msg of res.msg) {
                                    showAlert(msg, 'danger');
                                }
                            } else if (res.status === 443) {
                                for (const msg in res.msg) {
                                    let ele = $("[name=" + msg + "]");
                                    if (ele.length > 0) {
                                        ele.parent().append(
                                            `<label class='error'>${res.msg[msg]}</label>`
                                        )
                                        $('html, body').animate({
                                            scrollTop: ele.parent().find(".error").offset()
                                                .top
                                        }, 1000);
                                    } else {
                                        showAlert(msg, 'danger');
                                    }
                                }
                            } else {
                                showAlert("Something Went Wrong!", 'danger');
                            }
                        },
                        error: function(err) {
                            btn.prop("disabled", false);
                            btn.find(".spinner-border").remove();
                            showAlert("Something Went Wrong!", 'danger');
                        }
                    })
                }
            });
        }

        function selectAll(deleteAllUrl) {
            $("#show-delete-btn").fadeOut("fast");
            let len = 0;

            function counts() {
                len = $('[name="selection[]"]:checked').length;
                if (len > 0) {
                    $("#show-delete-btn").fadeIn("fast");
                } else {
                    $("#show-delete-btn").fadeOut("fast");
                }
                $("#counter").html(len);
                $("#deleteAll").attr("data-bs-original-title", `Delete Selection (${len} selected)`);
            }
            $("#selectAll").click(function() {
                if ($(this).prop("checked")) {
                    $(this).closest("table").find(".form-check-input").prop("checked", true)
                } else {
                    $(this).closest("table").find(".form-check-input").prop("checked", false)
                }
                counts();
            })

            $('[name="selection[]"]').click(function() {
                let eles = $('[name="selection[]"]:checked');
                counts();
                if (eles.length > 0) {}
            });
            $(document).on("click", "#deleteAll", function() {
                if (len <= 0) {
                    showAlert("Zero Selection", 'danger');
                    return;
                }
                let ids = $('[name="selection[]"]:checked').map(function() {
                    return $(this).val();
                }).get();;
                $("#danger-header-modal-all-ids").val(ids);
                let modal = $("#danger-header-modal-all");
                modal.find("form").attr("action", deleteAllUrl);
                $("#danger-header-modal-all-counter").html(`(${len} selected)`);
                modal.modal("show");
            });
        }

        function updates(url) {
            $(document).on("click", ".updates", function() {
                let btn = $(this);
                let id = btn.attr('data-id');
                let type = btn.attr('data-type');
                let status = btn.attr('data-status');
                btn.prop("disabled", true);
                btn.parent().append(`<span class='spinner-border spinner-border-sm'></span>`);
                let formData = new FormData();
                formData.append('_token', "{{ csrf_token() }}");
                formData.append('id', id);
                formData.append('type', type);
                formData.append('status', status);
                $.ajax({
                    url: url,
                    type: "post",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(res) {
                        btn.prop("disabled", false);
                        btn.parent().find(".spinner-border").remove();
                        if (res.status === 200) {
                            showAlert(res.msg, 'success');
                            btn.parent().html(res.html);
                        } else if (res.status === 403) {
                            for (const msg of res.msg) {
                                showAlert(msg, 'danger');
                            }
                        } else {
                            showAlert("Something Went Wrong!")
                        }
                    },
                    error: function(err) {
                        btn.prop("disabled", false);
                        btn.find(".spinner-border").remove();
                        showAlert("Something Went Wrong!", 'danger');
                    }
                });
            })
        }

        function deletes(url) {
            $(document).on("click", ".delete", function() {
                let id = $(this).attr('data-id');
                $("#danger-header-modal-id").val(id);
                let modal = $("#danger-header-modal");
                modal.find("form").attr("action", url);
                modal.modal("show");
            });
        }

        function imagePreview() {
            $(document).on("change", ".image-preview", function() {
                let val = $(this)[0].files[0];
                if (!val) {
                    return;
                }
                let show = $(this).parent().find(".image-preview-show");
                let src = URL.createObjectURL(val);
                if (show.length > 0) {
                    show.attr('src', src)
                    show.fadeIn();
                    return;
                }
                $(this).parent().append(
                    `<img src='${src}' class='w-100 object-fit-contain my-2 border shadow rounded-2 p-2 image-preview-show'/>`
                )
            })
        }
        // Close dropdown when clicking outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.dropdown').length) {
                $('.dropdown-menu').removeClass('show');
                $('.dropdown-menu').removeClass('nav-menu-open');
            }
        });

        // Toggle dropdown on button click
        $('.dropdown-toggle').on('click', function(e) {
            e.preventDefault();
            let $dropdown = $(this).closest('.dropdown');
            let $menu = $dropdown.find('.dropdown-menu');

            // Close other open dropdowns
            $('.dropdown-menu').not($menu).removeClass('show');

            if ($(this).hasClass("nav-user")) {
                $menu.toggleClass("nav-menu-open")               
            }
            // Toggle current dropdown
            $menu.toggleClass('show');
        });
    </script>
    <!-- Code Highlight js -->
    <script src="{{ asset('assets_backend/vendor/highlightjs/highlight.pack.min.js') }}"></script>
    <script src="{{ asset('assets_backend/vendor/clipboard/clipboard.min.js') }}"></script>
    <script src="{{ asset('assets_backend/js/hyper-syntax.js') }}"></script>
    @stack('scripts')

    <!-- App js -->
    <script src="{{ asset('assets_backend/js/app.min.js') }}"></script>
</body>

</html>
