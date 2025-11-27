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
                                <h4 class="notification-title mb-0 mr-auto">No New Notifications</h4>
                               
                            </div>
                        </li>
                        
                        <li class="dropdown-menu-footer"><a class="btn btn-primary btn-block" href="javascript:void(0)">Read all notifications</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="user-nav d-sm-flex d-none"><span class="user-name font-weight-bolder">Admin</span></div><span class="avatar"><img class="round" src="{{ asset('app-assets/images/portrait/small/profile.png')}}" alt="avatar" height="40" width="40"><span class="avatar-status-online"></span></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
                       <a class="dropdown-item" href="page-account-settings.html"><i class="mr-50" data-feather="settings"></i> Change Password</a>
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
                       <h2 class="text-center mt-4 mb-4">Exams</h2>

                        
                        
               <form action="{{ route('exams.import') }}" method="POST" class="d-flex align-items-center gap-2 flex-wrap">
    @csrf
    <input type="hidden" name="level_id" value="{{ $level->id }}">

    <!-- Dynamic Dropdown Section + Button -->
    <div class="d-flex align-items-center gap-3 mb-4 flex-wrap">
        <!-- Subject Dropdown -->
        <div>
            <label for="subjectDropdown" class="form-label mb-0 me-2">Subject:</label>
            <select id="subjectDropdown" class="form-control form-control-sm" style="width:auto;">
                <option value="">-- Select Subject --</option>
                @foreach ($allSubjects as $subject)
                    <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Level Dropdown -->
        <div>
            <label for="levelDropdown" class="form-label mb-0 me-2">Level:</label>
            <select id="levelDropdown" class="form-control form-control-sm" style="width:auto;" disabled>
                <option value="">-- Select Level --</option>
            </select>
        </div>

        <!-- Exam Dropdown -->
        <div>
            <label for="dynamicExamDropdown" class="form-label mb-0 me-2">Exam:</label>
            <select name="exam_id" id="dynamicExamDropdown" class="form-control form-control-sm" style="width:auto;" disabled>
                <option value="">-- Select Exam --</option>
            </select>
        </div>

        <!-- Import Button aligned with dropdowns -->
        <div>
            <button type="submit" class="btn btn-primary btn-sm" style="margin-top: 24px;">Import</button>
        </div>
    </div>
</form>

                
                    <!-- Add Exam Button (right side) -->
                    <a href="{{ route('viewaddexam', ['id' => $level->id]) }}" class="btn btn-primary btn-sm">
                        Add Exam {{ $level->name }}
                    </a>
                </div>

                        <div class="container my-4">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                              
                            </div>
                        @endif

            <form action="{{ route('upload.csv') }}" method="POST" enctype="multipart/form-data" class="d-inline-flex align-items-center gap-2">
                @csrf
                <label for="csv_file" class="form-label mb-0">Upload CSV:</label>
                <input type="file" name="csv_file" accept=".csv" class="form-control form-control-sm" required style="width: auto;">
                <button type="submit" class="btn btn-primary btn-sm">Upload</button>
         <a href="{{ asset('assets/questions_upload_format(1).csv') }}" class="btn btn-primary btn-sm" download="questions_upload_format.csv" style="margin-left: 15px;">
            Download Template
        </a>



      
             </form>
</div>
<form id="multiDeleteForm" action="{{ route('exam.multiDelete') }}" method="POST">
    @csrf
    @method('DELETE')

    <button type="submit" class="btn btn-danger mb-3" onclick="return confirm('Are you sure you want to delete selected exams?')">Delete Selected</button>

  

                        <div class="table-responsive">
                            <table class="table table-custom">
                                <thead>
                                    <tr>
                                         <th><input type="checkbox" id="selectAll"></th>
                                        <th>ID</th>
                                        <th>Exam Name</th>
                                        <th>Image</th> <!-- New column for images -->
                                        <th>Actions</th>
                                        <th>Status</th><!-- Column for actions -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($exams as $exam) <!-- Loop through exams -->
                                    <tr>
                                         <td><input type="checkbox" name="ids[]" value="{{ $exam->id }}"></td>
                                         <td>{{ $exam->id }}</td>
                                        <!--<td>{{ $exam->id }}</td> <!-- Display exam ID -->
                                        <td>{{ $exam->exam_name }}</td> <!-- Display exam name -->
                                        <td>
                                            @if ($exam->image)
                                            <img src="{{ asset($exam->image) }}" alt="{{ $exam->exam_name }}"  class="img-thumbnail" style="width: 50px; height: 50px;">
                                            @else
                                            <span>No Image</span>
                                            @endif
                                            <!-- Display image -->
                                        </td>
                                        <td>
                                            <a href="{{ route('editexam', ['id' => $exam->id]) }}" class="btn btn-edit btn-sm">Edit</a> 
                                            <form action="{{ route('deleteexam', $exam->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this exam?')">Delete</button>
                                            </form>
                                            <a href="{{ route('show-questions', $exam->id) }}" class="btn btn-info btn-sm">View</a> 
                                            <a href="#" class="btn btn-primary btn-sm uploadBtn"
                                        data-id="{{ $exam->id }}"
                                        data-toggle="modal"
                                        data-target="#uploadDocModal">
                                        Upload
                                        </a>

                                            
                                        </td>
                                        <td>
                    <form action="{{ route('toggle.exam.status', $exam->id) }}" method="POST" style="display:inline;">
    @csrf
    <button type="submit" class="btn btn-sm" style="background-color: {{ $exam->status ? '#28a745' : '#dc3545' }}; color: #fff;">
        {{ $exam->status ? 'Disable' : 'Enable' }}
    </button>
</form>


                </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                        </form>
                        <div class="modal fade" id="uploadDocModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Upload Word File</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
</button>
                </div>

                <form id="docUploadForm" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="modal-body">

                        <input type="hidden" name="admin_id" value="{{ auth()->id() }}">
                        <input type="hidden" id="modal_exam_id" name="exam_id">

                        <div class="mb-3">
                            <label>Select Word File (.doc/.docx)</label>
                            <input type="file" name="doc_file" class="form-control" accept=".doc,.docx" required>
                        </div>

                    </div>

                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Upload & Save</button>
                    </div>
                </form>

            </div>
        </div>
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


<script>
    const importForm = document.querySelector('form[action="{{ route('exams.import') }}"]');
    importForm.addEventListener('submit', function (e) {
        // Make sure exam dropdown is enabled before submission
        document.getElementById('dynamicExamDropdown').disabled = false;
    });
</script>

<!-- END: Page JS-->
<script>
   
    document.addEventListener('DOMContentLoaded', function() {
        let buttons = document.querySelectorAll('.uploadBtn');

        // When clicking Upload on a row
        buttons.forEach(btn => {
            btn.addEventListener('click', function() {
                let examId = this.dataset.id;

                // Fill hidden input
                document.getElementById('modal_exam_id').value = examId;

                // Update form action URL
                document.getElementById('docUploadForm').action =
                    "/exam/" + examId + "/doc-upload";
            });
        });
    });

    // Preload subjects with their levels and exams from Laravel
    const subjectsData = @json($allSubjects);

    const subjectDropdown = document.getElementById('subjectDropdown');
    const levelDropdown = document.getElementById('levelDropdown');
    const examDropdown = document.getElementById('dynamicExamDropdown');

    // When subject changes
    subjectDropdown.addEventListener('change', function () {
        const subjectId = this.value;
        levelDropdown.innerHTML = '<option value="">-- Select Level --</option>';
        examDropdown.innerHTML = '<option value="">-- Select Exam --</option>';
        examDropdown.disabled = true;

        if (subjectId) {
            const subject = subjectsData.find(s => s.id == subjectId);
            if (subject && subject.levels.length > 0) {
                levelDropdown.disabled = false;
                subject.levels.forEach(level => {
                    levelDropdown.innerHTML += `<option value="${level.id}">${level.level_name}</option>`;
                });
            } else {
                levelDropdown.disabled = true;
            }
        } else {
            levelDropdown.disabled = true;
        }
    });

    // When level changes
    levelDropdown.addEventListener('change', function () {
        const levelId = this.value;
        examDropdown.innerHTML = '<option value="">-- Select Exam --</option>';

        if (levelId) {
            let selectedSubject = subjectsData.find(s => s.id == subjectDropdown.value);
            if (selectedSubject) {
                const selectedLevel = selectedSubject.levels.find(l => l.id == levelId);
                if (selectedLevel && selectedLevel.exams.length > 0) {
                    examDropdown.disabled = false;
                    selectedLevel.exams.forEach(exam => {
                        examDropdown.innerHTML += `<option value="${exam.id}">${exam.exam_name}</option>`;
                    });
                } else {
                    examDropdown.disabled = true;
                }
            }
        } else {
            examDropdown.disabled = true;
        }
    });
</script>

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
    // Select/deselect all checkboxes
    document.getElementById('selectAll').onclick = function () {
        let checkboxes = document.querySelectorAll('input[name="ids[]"]');
        checkboxes.forEach(cb => cb.checked = this.checked);
    };
</script>
</body>
<!-- END: Body-->

</html>