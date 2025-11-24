<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->
<head>
    <style>
    /* .pagination {
        margin: 20px 0; /* Spacing around pagination */
    }
    
    .pagination .page-item {
        margin: 0 5px; /* Space between page items */
    }
    .pagination-box {
  
    padding: 10px; /* Padding around the content */
    border-radius: 5px; /* Rounded corners */
  
    margin-top: -20px; /* Use negative margin to move it up */
}

.custom-success-btn {
    background-color: #28a745; /* Green success color */
    color: #fff; /* White text */
    border: 1px solid #28a745; /* Matching border */
    border-radius: 5px; /* Rounded corners */
    padding: 5px 10px; /* Adjust padding for better spacing */
    font-size: 14px; /* Set font size */
    cursor: pointer; /* Show pointer cursor on hover */
    transition: background-color 0.3s ease; /* Smooth transition for hover effect */
}

.custom-success-btn:hover {
    background-color: #218838; /* Darker green on hover */
}




    
    .pagination .page-link {
        color: #1B247E; /* Bootstrap primary color */
        background-color: #f8f9fa; /* Light background */
        border: 1px solid #1B247E; /* Border color */
        border-radius: 5px; /* Rounded corners */
        padding: 10px 15px; /* Padding for larger buttons */
    }
    

    .pagination .page-link:hover {
    color: #fff !important; 
    background-color: #1B247E !important;
}


    
    .pagination .active .page-link {
        background-color: #1B247E; /* Active background color */
        color: white; /* Active text color */
        border-color:#1B247E; /* Active border color */
    } */
   
    </style>
    
@include('admin.adminheader')
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
                        <h2 class="text-center mt-4">User Requests</h2>
                        <div class="table-responsive">
                            <table class="table table-custom">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>User Name</th>
                                        <th>Email</th> 
                                         <th>Phone</th><!-- New Email column header -->
                                        <th>Time</th>
                                       
                                        <!--<th>Status</th>-->
                                        <!--<th>Actions</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                    <tr>
                                        <!--<td>{{$user->id}}</td>-->
                                         <td>{{ $loop->index + 1 }}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td> <!-- Email for John Doe -->
                                          <td>{{$user->mobile}}</td>
                                        <td style="padding: 0;">{{$user->created_at}}</td>
                                        <!--<td>-->
                                        <!--    @if($user->status == 0)-->
                                        <!--        <span class="badge bg-warning text-dark">Pending</span>-->
                                        <!--    @elseif($user->status == 1)-->
                                        <!--        <span class="badge bg-success">Accepted</span>-->
                                        <!--    @elseif($user->status == 2)-->
                                        <!--        <span class="badge bg-danger">Rejected</span>-->
                                        <!--    @endif-->
                                        <!--</td>-->
                                       
<!--                                            <td style="display: flex; gap: 5px; align-items: center;">-->
<!--                                                <form action="{{ route('user-request.approve', $user->id) }}" method="POST">-->
<!--                                                    @csrf-->
<!--                                                  <button type="submit" class="btn btn-sm custom-success-btn"  style="background-color: #28a745; color: #fff; border: 1px solid #28a745; border-radius: 5px;">-->
<!--    Accept-->
<!--</button>-->


<!--                                                </form>-->
                                                <!-- Reject form -->
<!--                                                <form action="{{ route('user-request.reject', $user->id) }}" method="POST">-->
<!--                                                    @csrf-->
<!--                                                    <button type="submit" class="btn btn-danger btn-sm">Reject</button>-->
<!--                                                </form>-->
                                            
<!--                                        </td>-->
                                    </tr>
                                    @endforeach
                                 
                            
                                    <!-- Add more rows as needed -->
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
                $startPage = max(1, $currentPage - 2);
                $endPage = min($lastPage, $currentPage + 2);
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