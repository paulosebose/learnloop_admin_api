<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>ADMIN</title>
<link rel="apple-touch-icon" href="{{ asset('app-assets/images/ico/apple-icon-120.png') }}">
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('app-assets/images/ico/spartanicon.ico') }}">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

<!-- BEGIN: Vendor CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/charts/apexcharts.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/extensions/toastr.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/datatables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/responsive.bootstrap.min.css') }}">

    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap1.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap-extended1.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/colors2.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/components1.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/dark-layout.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/bordered-layout.css') }}">

<!-- BEGIN: Page CSS -->
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/charts/chart-apex.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/extensions/ext-component-toastr.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/app-invoice-list.css') }}">
<!-- END: Page CSS -->

<!-- BEGIN: Custom CSS -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
<!-- END: Custom CSS -->

    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">

    <!-- BEGIN: Header-->
    @include('admin.header')
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
  @include('admin.menu')
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- Dashboard Analytics Start -->
                <section id="dashboard-analytics">
                    <div class="row match-height">
                      
                        <!-- Greetings Card ends -->

                        <!-- Subscribers Chart Card starts -->
                       
                        <!-- Subscribers Chart Card ends -->

                        <!-- Orders Chart Card starts -->
                       
                        <!-- Orders Chart Card ends -->
                    

                    <!-- List DataTable -->
                    <div class="container">
                        <h2 class="text-center mt-4">Quiz Levels</h2>
                        <div class="text-right mb-3">
                            <a href="{{route('addlevel')}}" class="btn-primary btn-sm">Add</a> <!-- Add button -->
                        </div>
                        <div class="table-responsive">
                            <table class="table table-custom">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Level Name</th>
                                        <th>Image</th> 
                                         <th>Subject</th>
                                        <th>Actions</th> <!-- Column for actions -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($levels as $level)
                                    <tr>
                                        <!--<td>{{ $level->id }}</td>-->
                                         <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $level->level_name }}</td>
                                        <td>
                                              @if ($level->image)
                                            <img src="{{ asset($level->image) }}" alt="{{ $level->level_name }} Image" class="img-thumbnail" style="width: 50px; height: 50px;">
                                            @else
                                            <p>No Image</p>
                                            
                                            @endif
                                        </td> 
                                        <td> {{ $level->subject->subject_name ?? 'No Subject' }}</td>
                                        <td>
                                            <a href="{{route('vieweditlevel',$level->id)}}" class="btn btn-edit btn-sm me-1 mb-1">Edit</a>
                                            <form action="{{ route('deletelevel', $level->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE') 
                                                <button type="submit" class="btn btn-danger btn-sm me-1 mb-1" onclick="return confirm('Are you sure you want to delete this sub admin?')">Delete</button>
                                            </form>
                                            <a href="{{ route('examview', $level->id) }}" class="btn btn-info btn-sm me-1 mb-1">View</a>

                                           
                                            
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    
                    
                    <!--/List DataTable -->
                </section>
                <!-- Dashboard Analytics end -->

            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
   
    <!-- END: Footer-->


<!-- BEGIN: Vendor JS-->
<script src="{{ asset('app-assets/vendors/js/vendors.min.js') }}"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="{{ asset('app-assets/vendors/js/charts/apexcharts.min.js') }}"></script>
{{-- <script src="{{ asset('app-assets/vendors/js/extensions/toastr.min.js') }}"></script> --}}
<script src="{{ asset('app-assets/vendors/js/extensions/moment.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/tables/datatable/responsive.bootstrap.min.js') }}"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="{{ asset('app-assets/js/core/app-menu.js') }}"></script>
<script src="{{ asset('app-assets/js/core/app.js') }}"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<script src="{{ asset('app-assets/js/scripts/pages/dashboard-analytics.js') }}"></script>
<script src="{{ asset('app-assets/js/scripts/pages/app-invoice-list.js') }}"></script>

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