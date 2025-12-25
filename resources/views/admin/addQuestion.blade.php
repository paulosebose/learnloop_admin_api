<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

@include('admin.adminheader')
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">

    <!-- BEGIN: Header-->
     <nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow">
        <div class="navbar-container d-flex content">
            <div class="bookmark-wrapper d-flex align-items-center">
                <ul class="nav navbar-nav d-xl-none">
                    <li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><i class="ficon" data-feather="menu"></i></a></li>
                </ul>
              
                
            </div>
            <ul class="nav navbar-nav align-items-center ml-auto">
               
               
             
                <li class="nav-item dropdown dropdown-notification mr-25"><a class="nav-link" href="javascript:void(0);" data-toggle="dropdown"><i class="ficon" data-feather="bell"></i><span class="badge badge-pill badge-danger badge-up">0</span></a>
                    <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                        <li class="dropdown-menu-header">
                            <div class="dropdown-header d-flex">
                                <h4 class="notification-title mb-0 mr-auto">Notifications</h4>
                                <div class="badge badge-pill badge-light-primary">0 New</div>
                            </div>
                        </li>
                        <li class="scrollable-container media-list"><a class="d-flex" href="javascript:void(0)">
                            
                            <div class="media d-flex align-items-center">
                                <h6 class="font-weight-bolder mr-auto mb-0">No New Notifications</h6>
                                <div class="custom-control custom-control-primary custom-switch">
                                   
                                    
                        <li class="dropdown-menu-footer"><a class="btn btn-primary btn-block" href="javascript:void(0)">Read all notifications</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="user-nav d-sm-flex d-none"><span class="user-name font-weight-bolder">Admin</span></div><span class="avatar"><img class="round" src="{{ asset('app-assets/images/portrait/small/profile.png') }}" alt="avatar" height="40" width="40"><span class="avatar-status-online"></span></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
                        <a class="dropdown-item" href="{{ route('change-password') }}"><i class="mr-50" data-feather="settings"></i> Change Password</a>
                        <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="mr-50" data-feather="power"></i> Logout
                        </a>
                    </div>
                </li>
            </ul>
        </div> 
    </nav>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    <ul class="main-search-list-defaultlist d-none">
        <li class="d-flex align-items-center"><a href="javascript:void(0);">
                <h6 class="section-label mt-75 mb-0">Files</h6>
            </a></li>
        <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between w-100" href="app-file-manager.html">
                <div class="d-flex">
                    <div class="mr-75"><img src="/spartans/quizsite/public/app-assets/images/icons/xls.png" alt="png" height="32"></div>
                    <div class="search-data">
                        <p class="search-data-title mb-0">Two new item submitted</p><small class="text-muted">Marketing Manager</small>
                    </div>
                </div><small class="search-data-size mr-50 text-muted">&apos;17kb</small>
            </a></li>
        <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between w-100" href="app-file-manager.html">
                <div class="d-flex">
                    <div class="mr-75"><img src="/spartans/quizsite/public/app-assets/images/icons/jpg.png" alt="png" height="32"></div>
                    <div class="search-data">
                        <p class="search-data-title mb-0">52 JPG file Generated</p><small class="text-muted">FontEnd Developer</small>
                    </div>
                </div><small class="search-data-size mr-50 text-muted">&apos;11kb</small>
            </a></li>
        <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between w-100" href="app-file-manager.html">
                <div class="d-flex">
                    <div class="mr-75"><img src="/spartans/quizsite/public/app-assets/images/icons/pdf.png" alt="png" height="32"></div>
                    <div class="search-data">
                        <p class="search-data-title mb-0">25 PDF File Uploaded</p><small class="text-muted">Digital Marketing Manager</small>
                    </div>
                </div><small class="search-data-size mr-50 text-muted">&apos;150kb</small>
            </a></li>
        <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between w-100" href="app-file-manager.html">
                <div class="d-flex">
                    <div class="mr-75"><img src="/spartans/quizsite/public/app-assets/images/icons/doc.png" alt="png" height="32"></div>
                    <div class="search-data">
                        <p class="search-data-title mb-0">Anna_Strong.doc</p><small class="text-muted">Web Designer</small>
                    </div>
                </div><small class="search-data-size mr-50 text-muted">&apos;256kb</small>
            </a></li>
        <li class="d-flex align-items-center"><a href="javascript:void(0);">
                <h6 class="section-label mt-75 mb-0">Members</h6>
            </a></li>
        <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between py-50 w-100" href="app-user-view.html">
                <div class="d-flex align-items-center">
                    <div class="avatar mr-75"><img src="/spartans/quizsite/public/app-assets/images/portrait/small/avatar-s-8.jpg" alt="png" height="32"></div>
                    <div class="search-data">
                        <p class="search-data-title mb-0">John Doe</p><small class="text-muted">UI designer</small>
                    </div>
                </div>
            </a></li>
        <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between py-50 w-100" href="app-user-view.html">
                <div class="d-flex align-items-center">
                    <div class="avatar mr-75"><img src="/spartans/quizsite/public/app-assets/images/portrait/small/avatar-s-1.jpg" alt="png" height="32"></div>
                    <div class="search-data">
                        <p class="search-data-title mb-0">Michal Clark</p><small class="text-muted">FontEnd Developer</small>
                    </div>
                </div>
            </a></li>
        <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between py-50 w-100" href="app-user-view.html">
                <div class="d-flex align-items-center">
                    <div class="avatar mr-75"><img src="/spartans/quizsite/public/app-assets/images/portrait/small/avatar-s-14.jpg" alt="png" height="32"></div>
                    <div class="search-data">
                        <p class="search-data-title mb-0">Milena Gibson</p><small class="text-muted">Digital Marketing Manager</small>
                    </div>
                </div>
            </a></li>
        <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between py-50 w-100" href="app-user-view.html">
                <div class="d-flex align-items-center">
                    <div class="avatar mr-75"><img src="/spartans/quizsite/public/app-assets/images/portrait/small/avatar-s-6.jpg" alt="png" height="32"></div>
                    <div class="search-data">
                        <p class="search-data-title mb-0">Anna Strong</p><small class="text-muted">Web Designer</small>
                    </div>
                </div>
            </a></li>
    </ul>
    <ul class="main-search-list-defaultlist-other-list d-none">
        <li class="auto-suggestion justify-content-between"><a class="d-flex align-items-center justify-content-between w-100 py-50">
                <div class="d-flex justify-content-start"><span class="mr-75" data-feather="alert-circle"></span><span>No results found.</span></div>
            </a></li>
    </ul>
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
                   <!-- Add Question DataTable -->
                  <div class="container">
    <h2 class="text-center mt-4">Add Question</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('store-question', $examId) }}" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
        @csrf
        <div class="form-group">
            <label for="question">Question</label>
            <input type="text" class="form-control" id="question" name="question" required>
        </div>
        
        <div class="form-group">
            <label for="image">Upload Image (optional)</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*">
        </div>
        <div class="form-group mt-3">
    <label>Image Position</label><br>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="image_position" id="top" value="top" checked>
        <label class="form-check-label" for="top">Top</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="image_position" id="down" value="down">
        <label class="form-check-label" for="down">Down</label>
    </div>
</div>


        <h4>Options</h4>
<div id="options-container">
    @for ($i = 0; $i < 4; $i++)
        <div class="form-group option-item">
            <input type="text" 
                   class="form-control mb-2" 
                   name="options[{{ $i }}][option]" 
                   placeholder="Option {{ $i + 1 }}" 
                   value="{{ $i == 3 ? 'Not Sure' : '' }}" 
                   required>

            <input type="hidden" name="options[{{ $i }}][is_correct]" value="0">
            <input type="checkbox" class="is-correct-checkbox" name="options[{{ $i }}][is_correct]" value="1"> Correct
        </div>
    @endfor
</div>

           <button type="button" class="btn btn-secondary" id="add-option">Add Another Option</button>
        <div class="form-group">
    <label for="reason">Explanation (Optional)</label>
    <textarea class="form-control" id="reason" name="reason" rows="3"></textarea>
</div>
<div class="form-group">
            <label for="reason_image">Explanation Image (optional)</label>
            <input type="file" class="form-control" id="reason_image" name="reason_image" accept="image/*">
        </div>


     
        <button type="submit" class="btn btn-primary">Submit</button>
       <a href="{{route('show-questions', $examId)}}" class="btn btn-primary" >
  ← Back
</a>

    </form>
</div>

<script>
    document.getElementById('add-option').addEventListener('click', function() {
        const optionsContainer = document.getElementById('options-container');
        const currentOptionCount = optionsContainer.getElementsByClassName('option-item').length;

        // Create new option div
        const newOptionDiv = document.createElement('div');
        newOptionDiv.classList.add('form-group', 'option-item');

        newOptionDiv.innerHTML = `
            <input type="text" class="form-control mb-2" name="options[${currentOptionCount}][option]" placeholder="Option ${currentOptionCount + 1}" required>
            <input type="hidden" name="options[${currentOptionCount}][is_correct]" value="0">
            <input type="checkbox" class="is-correct-checkbox" name="options[${currentOptionCount}][is_correct]" value="1"> Correct
        `;

        // Append new option to the container
        optionsContainer.appendChild(newOptionDiv);
    });

    function validateForm() {
        let checkboxes = document.querySelectorAll(".is-correct-checkbox");
        let isChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);

        if (!isChecked) {
            alert("Please select at least one correct answer.");
            return false;
        }
        return true;
    }
</script>

                    
                    
                    
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