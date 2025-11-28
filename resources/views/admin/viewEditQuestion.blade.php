<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <base href="/public">
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
                        <h2 class="text-center mt-4">Edit Question</h2>
                        <form action="{{ route('update-question', [$examId, $question->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT') <!-- Use PUT method for updates -->
                    
                            <div class="form-group">
                                <label for="questionText">Question</label>
                                <input type="text" class="form-control" id="questionText" name="question" value="{{ $question->question }}" required>
                            </div>
                    
                            <div class="form-group">
                                <label for="image">Image (optional)</label>
                                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                            </div>
                            
                            <div class="form-group mt-3">
                            <label>Image Position</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" 
                                       type="radio" 
                                       name="image_position" 
                                       id="top" 
                                       value="top" 
                                       {{ $question->image_position == 'top' ? 'checked' : '' }}>
                                <label class="form-check-label" for="top">Top</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" 
                                       type="radio" 
                                       name="image_position" 
                                       id="down" 
                                       value="down" 
                                       {{ $question->image_position == 'down' ? 'checked' : '' }}>
                                <label class="form-check-label" for="down">Down</label>
                            </div>
                        </div>

                    
                            <h5>Options</h5>
                           @foreach ($question->options as $option)
    <div class="form-group">
        <label for="option{{ $loop->index }}">Option {{ $loop->index + 1 }}</label>
        <input type="text" 
               class="form-control" 
               id="option{{ $loop->index }}" 
               name="options[{{ $loop->index }}][option]" 
               value="{{ $option->option }}" 
               required>

        <input type="hidden" 
               name="options[{{ $loop->index }}][id]" 
               value="{{ $option->id }}">

        <div class="form-check">
            <input type="checkbox" 
                   class="form-check-input" 
                   id="is_correct{{ $loop->index }}" 
                   name="options[{{ $loop->index }}][is_correct]" 
                   value="1" 
                   {{ $option->is_correct ? 'checked' : '' }}> 

            <label class="form-check-label" for="is_correct{{ $loop->index }}">Correct Option</label>
        </div>
    </div>
@endforeach

                            <div class="form-group">
    <label for="reason">Explanation (Optional)</label>
    <textarea class="form-control" id="reason" name="reason" rows="3">{{ old('reason', $question->reason) }}</textarea>
</div>
<div class="form-group">
                                <label for="reason_image">Explanation Image (optional)</label>
                                <input type="file" class="form-control" id="reason_image" name="reason_image" accept="image/*">
                           
                            @if($question->reason_image != null)
<img src="{{asset($question->reason_image)}}" width="100px" height="100px">


                    @endif
                    </div>
                            <button type="submit" id="updateButton" class="btn btn-primary">Update Question</button>
                        </form>
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
    
<script>
    document.addEventListener("DOMContentLoaded", function () {
        console.log("Script loaded and running...");

        const updateButton = document.getElementById("updateButton"); // Change this to match your button ID

        updateButton.addEventListener("click", function (event) {
            console.log("Update button clicked!");

            const checkboxes = document.querySelectorAll('input[type="checkbox"][name^="options"]');
            let checked = false;

            checkboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    checked = true;
                }
            });

            if (!checked) {
                event.preventDefault(); // Prevent form submission
                alert("Please select at least one correct option.");
            }
        });
    });
</script>



</body>
<!-- END: Body-->

</html>