<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Spartans">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Login Page</title>
<!-- Apple Touch Icon & Favicon -->
<link rel="apple-touch-icon" href="{{ asset('app-assets/images/ico/apple-icon-120.png') }}">
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('app-assets/images/ico/spartanicon.ico') }}">

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

<!-- BEGIN: Vendor CSS -->
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors.min.css') }}">
<!-- END: Vendor CSS -->

<!-- BEGIN: Theme CSS -->
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap1.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap-extended1.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/colors2.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/components1.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/dark-layout.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/bordered-layout.css') }}">

<!-- BEGIN: Page CSS -->
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/form-validation.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/page-auth.css') }}">
<!-- END: Page CSS -->

<!-- BEGIN: Custom CSS -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">

    <!-- END: Custom CSS-->
    <style>
        .mb-4, .my-4 {
    margin-bottom: 0 !important; /* Remove bottom margin */
    margin-top: 0 !important;    /* Remove top margin for .my-4 */
}

.image-container {
    background-image: url("{{ asset('app-assets/images/pages/final-login-banner-image-2.jpg') }}");

    background-size: cover; /* Ensures the image covers the entire container */
    background-position: center; /* Centers the image in the container */
    background-repeat: no-repeat; /* Prevents the image from repeating */
    width: 100%;
    height: 100vh;
}

/* Style the input field when it's focused */
#login-password:focus {
    border-color: #1B247E; /* Change the border color to your desired color */
    outline: none; /* Remove the default outline */
}


.input-group-merge:focus-within .input-group-text {
    border-color: #1B247E; /* Change the border color of the icon container */
    color: #1B247E; /* Optionally change the icon color */
}

/* Ensure the entire input group (including the icon) gets the focus color */
.input-group-merge:focus-within .input-group-append {
    border-color: #1B247E; /* Change the border color of the right container */
    color: #1B247E; /* Optionally change the icon color */
}


</style>

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="auth-wrapper auth-v2">
                    <div class="auth-inner row m-0">
                        
                        <!-- /Brand logo-->
                        <!-- Left Text-->
                        <div class="d-none d-lg-flex col-lg-8 align-items-center p-5 image-container">
                            <div class="w-100 d-lg-flex align-items-center justify-content-center px-5">
                               
                            </div>
                        </div>
                        <!-- /Left Text-->
                        <!-- Login-->
                        <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
                            <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                                <img src="{{ asset('app-assets/images/logo/spartans.jpg') }}" alt="Logo" class="img-fluid mb-4" style="max-width: 150px; display: block; margin: 0 auto ;"> 
                               
                                <form class="auth-login-form mt-2" action="{{ route('dologin') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                    <div class="form-group">
                                        <label class="form-label" for="login-email">Email</label>
                                        <input class="form-control" id="login-email" type="text" name="email" placeholder="john@example.com" aria-describedby="login-email" autofocus="" tabindex="1" style="width: 100%;" />

                                    </div>
                                    <div class="form-group">
                                        <div class="d-flex justify-content-between">
                                            <label for="login-password">Password</label>
                                        </div>
                                        <div class="input-group input-group-merge form-password-toggle">
                                            <input class="form-control form-control-merge" id="login-password" type="password" name="password" placeholder="············" aria-describedby="login-password" tabindex="2" />
                                            <div class="input-group-append"><span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span></div>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary btn-block" tabindex="4">Sign in</button>
                                </form>
                                
                                
                            </div>
                        </div>
                        <!-- /Login-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->


 <!-- BEGIN: Vendor JS -->
<script src="{{ asset('app-assets/vendors/js/vendors.min.js') }}"></script>
<!-- END: Vendor JS -->

<!-- BEGIN: Page Vendor JS -->
<script src="{{ asset('app-assets/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
<!-- END: Page Vendor JS -->

<!-- BEGIN: Theme JS -->
<script src="{{ asset('app-assets/js/core/app-menu.js') }}"></script>
<script src="{{ asset('app-assets/js/core/app.js') }}"></script>
<!-- END: Theme JS -->

<!-- BEGIN: Page JS -->
<script src="{{ asset('app-assets/js/scripts/pages/page-auth-login.js') }}"></script>
<!-- END: Page JS -->

    <!-- END: Page JS-->

    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>
</body>
<!-- END: Body-->

</html>