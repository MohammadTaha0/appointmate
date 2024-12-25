<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Make An Appointment | AppointMate</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="AppointMate - Made by Muhammad Taha" name="description" />
    <meta content="Muhammad Taha" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets_backend/images/favicon.ico') }}">

    <!-- Theme Config Js -->
    <script src="{{ asset('assets_backend/js/hyper-config.js') }}"></script>

    <!-- Vendor css -->
    <link href="{{ asset('assets_backend/css/vendor.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="{{ asset('assets_backend/css/app-saas.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Bootstrap Datepicker css -->
    <link href="{{ asset('assets_backend/vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}"
        rel="stylesheet" type="text/css" />

    <!-- Icons css -->
    <link href="{{ asset('assets_backend/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.2/css/all.css">


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body class="authentication-bg position-relative">
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


    @yield('main')
    <footer class="footer footer-alt">
        {{ date('Y') }} © AppointMate
    </footer>


    <!-- Vendor js -->
    <script src="{{ asset('assets_backend/js/vendor.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#login-form").validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 8
                    }
                },
                messages: {
                    email: {
                        required: "Please Enter Your Email!",
                        email: "Please Enter Valid Email!"
                    },
                    password: {
                        required: "Please Enter Your Password!",
                        minlength: "Please Use Atleast 8 Characters in Password!"
                    }
                },
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
                        url: "{{ route('auth.attempt') }}",
                        type: "post",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(res) {
                            btn.prop("disabled", false);
                            btn.find(".spinner-border").remove();
                            if (res.status === 200) {
                                showAlert(res.msg, 'success');
                                setTimeout(() => {
                                    location.href = res.location;
                                }, 800);
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

        });
    </script>
    <!-- Bootstrap Datepicker js -->
    <script src="{{ asset('assets_backend/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    @stack('scripts')

    <!-- App js -->
    <script src="{{ asset('assets_backend/js/app.min.js') }}"></script>


</body>

</html>
