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
    
    <!-- Favicon -->
    <link rel="apple-touch-icon" href="{{ asset('app-assets/images/ico/apple-icon-120.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('app-assets/images/ico/spartanicon.ico') }}">
    
    <!-- Google Fonts -->
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

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/charts/chart-apex.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/extensions/ext-component-toastr.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/app-invoice-list.css') }}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">

    <!-- BEGIN: Header-->
    @include('admin.header')
    <style>
    
        /* .pagination {
            margin: 20px 0; /* Spacing around pagination */
        
        
        .pagination .page-item {
            margin: 0 5px; /* Space between page items */
        }
        .pagination-box {
      
        padding: 10px; /* Padding around the content */
        border-radius: 5px; /* Rounded corners */
      
        margin-top: -20px; /* Use negative margin to move it up */
    }
    
        
        .pagination .page-link {
            color: #1B247E; /* Bootstrap primary color */
            background-color: #f8f9fa; /* Light background */
          
            border-radius: 5px; /* Rounded corners */
            padding: 10px 15px; /* Padding for larger buttons */
        }
        
        .pagination .page-link:hover {
            background-color: #1B247E; /* Change background on hover */
            color: white; /* Change text color on hover */
        }
        
        .pagination .active .page-link {
            background-color: #007bff; /* Active background color */
            color: white; /* Active text color */
            border-color: #007bff; /* Active border color */
        } */
        </style>
    
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
                        <h2 class="text-center mt-4">Users</h2>
                         <div class="search-bar mb-4">
    <form action="{{ route('user_search') }}" method="GET" class="d-flex justify-content-end">
        <!-- Search Input -->
        <input type="text" name="search" class="form-control me-2" placeholder="Search by name" value="{{ request()->query('search') }}">
        
        <!-- Search Button -->
        <button type="submit" class="btn btn-primary">Search</button>
    </form>
</div>

                        <div class="table-responsive">
                            <table class="table table-custom">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                           <!--<th>Status</th>-->
                                         <th>Contact No</th>
                                        <th>Actions</th> <!-- New column for actions -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                    <tr>
                                        <!--<td>{{$user->id}}</td>-->
                                         <td>{{ $loop->index + 1 }}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <!-- <td>-->
                                        <!--    @if($user->status == 0)-->
                                        <!--        <span class="badge bg-warning text-dark">Pending</span>-->
                                        <!--    @elseif($user->status == 1)-->
                                        <!--        <span class="badge bg-success">Accepted</span>-->
                                        <!--    @elseif($user->status == 2)-->
                                        <!--        <span class="badge bg-danger">Rejected</span>-->
                                        <!--    @endif-->
                                        <!--</td>-->
                                        
                                        <td>{{ $user->mobile ?? 'null' }}</td>
                                        <td>
                                            <a href="{{ route('user.status', ['id' => $user->id]) }}" class="btn btn-primary btn-sm">View</a>
                                        </td> <!-- View button as a link -->

                                    </tr>
                                    @endforeach
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                   <div class="d-flex justify-content-center mt-4">
   <div class="pagination-box">
    <nav>
        <ul class="pagination mb-0">
            <!-- Previous Page Link -->
            @if ($users->onFirstPage())
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link">«</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $users->previousPageUrl() }}" rel="prev" aria-label="Previous">«</a>
                </li>
            @endif

            <!-- Pagination Number Links -->
            @php
                $currentPage = $users->currentPage();
                $lastPage = $users->lastPage();

                // Define the number of pages to show before and after the current page
                $showPages = 2; // Change this to display more or fewer pages
                $startPage = max(1, $currentPage - $showPages);
                $endPage = min($lastPage, $currentPage + $showPages);
            @endphp

            @if ($startPage > 1)
                <li class="page-item">
                    <a class="page-link" href="{{ $users->url(1) }}">1</a>
                </li>
                @if ($startPage > 2)
                    <li class="page-item disabled"><span class="page-link">...</span></li>
                @endif
            @endif

            @for ($page = $startPage; $page <= $endPage; $page++)
                @if ($page == $currentPage)
                    <li class="page-item active" aria-current="page">
                        <span class="page-link" style="background-color: #1B247E; color: #fff;">{{ $page }}</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $users->url($page) }}">{{ $page }}</a>
                    </li>
                @endif
            @endfor

            @if ($endPage < $lastPage)
                @if ($endPage < $lastPage - 1)
                    <li class="page-item disabled"><span class="page-link">...</span></li>
                @endif
                <li class="page-item">
                    <a class="page-link" href="{{ $users->url($lastPage) }}">{{ $lastPage }}</a>
                </li>
            @endif

            <!-- Next Page Link -->
            @if ($users->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $users->nextPageUrl() }}" rel="next" aria-label="Next">»</a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link">»</span>
                </li>
            @endif
        </ul>
    </nav>
</div>

</div>

                    <!--/ List DataTable -->
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
<!-- END: Vendor JS-->

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