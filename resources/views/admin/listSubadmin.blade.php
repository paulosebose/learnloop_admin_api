
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
    <!-- END: Custom CSS-->
   
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">

    <!-- BEGIN: Header-->
    @include('admin.header')
    <style>
        .d-flex {
    display: flex;
}

.justify-content-end {
    justify-content: flex-end;
}

    
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
   
    <style>
     .table-responsive {
    overflow-x: auto; /* Enables horizontal scrolling if the table is too wide */
}

.table {
    min-width: 1200px; /* You can adjust this value based on your content */
}

    .switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

/* Hide default HTML checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

.slider.round {
  border-radius: 50px; /* More rounded */
}

.slider.round:before {
  border-radius: 50%; /* Keep the thumb fully circular */
}

</style>

    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
              <div class="content-body">
                <div class="container">
                    <h2 class="text-center mt-4">Sub Admins</h2>
                    <div class="text-right mb-3">
                        <a href="{{ route('subadmin.form') }}" class="btn btn-primary mb-3 float-end">Add Sub Admin</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                     <th>Phone</th>
                                    <th>Role</th>
                                    <th>Added Date</th>
                                    <th>Status</th>
                                    
                                 
                                  
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($subAdmins as $subAdmin)
                                <tr>
                                    <td>{{ $subAdmin->name }}</td>
                                    <td>{{ $subAdmin->email }}</td>
                                    <td>{{ $subAdmin->mobile }}</td>
                                 
                                    <td>{{ $subAdmin->usertype }}</td>
                                    <td>{{ \Carbon\Carbon::parse($subAdmin->created_at)->timezone('Asia/Kolkata')->format('d-m-Y h:i A') }}</td>
                                    
                                  
                                     
                                    
                                    
                                    <td>
                                    <label class="switch">
                                    <input type="checkbox" data-id="{{ $subAdmin->id }}" class="toggle-status" {{ $subAdmin->active === 'active' ? 'checked' : '' }}>
                                    <span class="slider round"></span>
                                    </label>
                                    </td>
                                    <td>
                                        <!-- Edit Button -->
                                        <a href="{{ route('subadmin.edit', $subAdmin->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <!-- Delete Button -->
                                        <form action="{{ route('subadmin.softDelete', $subAdmin->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this sub admin?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
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


<script>
 $(document).on('change', '.toggle-status', function() {
    const subAdminId = $(this).data('id');
    const status = $(this).is(':checked') ? 'active' : 'inactive';

    // Log the data to the console
    console.log('SubAdmin ID:', subAdminId);
    console.log('Status:', status); // Logs the correct status: 'active' or 'inactive'

    $.ajax({
        url: "{{ route('subadmin.toggleStatus', '') }}/" + subAdminId,
        method: "POST",
        data: {
            _token: "{{ csrf_token() }}",
            active: status  // Send 'active' instead of 'status'
        },
        success: function(response) {
            // Optional: Display a success message
            console.log('Response:', response); // Log server response for debugging
            alert(response.message); // Optional: Replace with a proper toast message
        },
        error: function(xhr) {
            // Log the error for debugging
            console.error('Error:', xhr);
            alert('Failed to update status.');
        }
    });
});

</script>


</body>
<!-- END: Body-->

</html>


