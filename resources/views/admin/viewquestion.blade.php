<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

@include('admin.adminheader')
<!-- END: Head-->
<style>
    .table-responsive {
    overflow-x: auto; /* Enables horizontal scrolling if the table is too wide */
}

.table {
    min-width: 1200px; /* You can adjust this value based on your content */
}
.table-custom th,
.table-custom td {
    text-align: left !important;
}
 .table-custom td:nth-child(4),
    .table-custom th:nth-child(4) {
        width: 150px; /* Adjust this value as needed */
    }



</style>
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
                    <div class="container">
                        <h2 class="text-center mt-4">Exam Questions</h2>
                        <div class="text-right mb-3">
                             <div class="d-flex justify-content-end mb-1 gap-2">
                            <a href="{{ route('add-question', ['examId' => $exam->id]) }}" class="btn btn-primary">Add Question</a> <!-- Add Question button -->
                        </div>
                        
                       <form id="bulkDeleteForm" method="POST" action="{{ route('questions.bulkDelete') }}">
                        @csrf
                        <div class="text-right mb-3">
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete selected questions?')">Delete Selected</button>
                        </div>
                        <input type="text" id="searchInput" class="form-control mb-3" placeholder="Search questions...">

                        <div class="table-responsive">
                            <table class="table table-custom">
                                  
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="selectAll"></th>
                                        <th>ID</th>
                                       
                                        <th>Question</th>
                                         <th>Options</th>
                                        <th>Reason</th> <!-- New column for images -->
                                        <th>Actions</th> <!-- Column for actions -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($questions as $question)
                                    <tr>
                                          <td><input type="checkbox" name="question_ids[]" value="{{ $question->id }}"></td>
                                         <td>{{ $loop->index + 1 }}</td>
                                        <!--<td>{{ $question->id }}</td>-->
                                        <!-- <td>{{ $question->admin ? $question->admin->name : 'Not Defined' }}</td> -->
                                       <td style="min-width:220px; max-width:220px;">{{ $question->question }}</td>

                                        <td style="min-width:300px; max-width:300px;">
                                        <ul class="list-group option-list">
                                            @foreach($question->options as $option)
                                                <li class="list-group-item d-flex justify-content-between align-items-center
                                                    {{ $option->is_correct ? 'list-group-item-success' : '' }}">
                                                    <span>{{ $option->option }}</span>

                                                    <span class="badge {{ $option->is_correct ? 'bg-success' : 'bg-secondary' }}">
                                                        {{ $option->is_correct ? 'Correct' : 'Incorrect' }}
                                                    </span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>

                                        
                                        <td>
                                            <!-- @if($question->image)
                                                <img src="{{ asset($question->image) }}" alt="Question {{ $question->id }}" class="img-thumbnail" style="width: 50px; height: 50px;"> <!-- Display image -->
                                            <!-- @else
                                                No Image
                                            @endif --> 
                                        {{ $question->reason ?? '' }}

                                        </td>
                                        <td>
                                            
                                            <a href="{{ route('edit-question', ['examId' => $exam->id, 'questionId' => $question->id]) }}" class="btn btn-primary btn-sm">Edit</a>
                                            <form action="{{ route('delete-question', ['examId' => $exam->id, 'questionId' => $question->id]) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this sub admin?')">Delete</button>
                                            </form>
                                            <a href="{{ route('show-question', ['examId' => $exam->id, 'questionId' => $question->id]) }}" class="btn btn-info btn-sm">View</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @if($questions->isEmpty())
                                    <tr>
                                        <td colspan="4" class="text-center">No questions available for this exam.</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        </form>
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
        document.getElementById('searchInput').addEventListener('input', function() {
    const filter = this.value.toLowerCase();
    const rows = document.querySelectorAll('table tbody tr');

    rows.forEach(row => {
        const questionCell = row.querySelector('td:nth-child(3)'); // 3rd column = Question
        if (questionCell) {
            const questionText = questionCell.textContent.toLowerCase();
            if (questionText.includes(filter)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        }
    });
});

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
    // Save scroll position before leaving the page
    window.addEventListener('beforeunload', function () {
        localStorage.setItem('scrollPosition', window.scrollY);
    });

    // Restore scroll position when page loads
    window.addEventListener('load', function () {
        const scrollPosition = localStorage.getItem('scrollPosition');
        if (scrollPosition) {
            window.scrollTo(0, parseInt(scrollPosition));
        }
    });
</script>

    <script>
    document.getElementById('selectAll').addEventListener('change', function () {
        const checkboxes = document.querySelectorAll('input[name="question_ids[]"]');
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });
</script>

</body>
<!-- END: Body-->

</html>