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
    
    

    .card-custom {
        height: 200px; /* Set a fixed height for uniformity */
        display: flex;
        flex-direction: column;
        justify-content: center; /* Center text vertically */
        align-items: center; /* Center text horizontally */
        text-align: center;
    }
    
    .card-body p {
        font-size: 1.1em;
        margin: 0;
    }

   
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
            <div class="content-header row"></div>
            <div class="content-body">
                <!-- User Quiz Status Section -->
                <section id="user-quiz-status">
                    <div class="container">
                        <h2 class="text-center mt-4">User Quiz Status</h2>

                        <!-- User Information Cards -->
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <div class="card card-custom">
                                    <div class="card-header">
                                        <h5 class="mb-0">Name</h5>
                                    </div>
                                    <div class="card-body">
                                        <p>{{ $name }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="card card-custom">
                                    <div class="card-header">
                                        <h5 class="mb-0">Email</h5>
                                    </div>
                                    <div class="card-body">
                                        <p>{{ $email }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="card card-custom">
                                    <div class="card-header">
                                        <h5 class="mb-0">Mobile</h5>
                                    </div>
                                    <div class="card-body">
                                        <p>{{ $mobile }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Quiz Status Cards -->
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <div class="card card-custom">
                                    <div class="card-header">
                                        <h5 class="mb-0">Quiz Level</h5>
                                    </div>
                                    <div class="card-body">
                                        <p>{{ $levelName }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="card card-custom">
                                    <div class="card-header">
                                        <h5 class="mb-0">Exam Name</h5>
                                    </div>
                                    <div class="card-body">
                                        <p>{{ $examName }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="card card-custom">
                                    <div class="card-header">
                                        <h5 class="mb-0">Questions Completed</h5>
                                    </div>
                                    <div class="card-body">
                                        <p>{{ $answeredQuestionsCount }} / {{ $totalQuestionsCount }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- User Status Section -->
                       <div class="row">
    <!-- Quiz Status -->
    <div class="col-md-4 mb-3">
        <div class="card card-custom">
            <div class="card-header">
                <h5 class="mb-0">Quiz Status</h5>
            </div>
            <div class="card-body">
                <p>{{ $quizStatus }}</p>
            </div>
        </div>
    </div>

    <!-- User Status -->
    <div class="col-md-4 mb-3">
        <div class="card card-custom">
            <div class="card-header">
                <h5 class="mb-0">Status</h5>
            </div>
            <div class="card-body">
               <p>
                        @if($status === 1)
                            Accepted
                        @elseif($status === 0)
                            Pending
                        @elseif($status === 2)
                            Rejected
                        @else
                            Unknown
                        @endif
                    </p>
            </div>
        </div>
    </div>
 <div class="col-md-4 mb-3">
        <div class="card card-custom">
            <div class="card-header">
                <h5 class="mb-0">Usage Time</h5>
            </div>
            <div class="card-body">
                <p>{{ @$totalTime }} Hours</p>
            </div>
        </div>
    </div>


</div>
                            <!--<div class="col-md-8 mb-3">-->
                            <!--    <div class="card">-->
                            <!--        <div class="card-header">-->
                            <!--            <h5>Update Level Accessibility</h5>-->
                            <!--        </div>-->
                            <!--        <div class="card-body">-->
                            <!--            <ul class="list-group">-->
                            <!--                @foreach($levels as $level)-->
                            <!--                    <li class="list-group-item d-flex justify-content-between align-items-center">-->
                            <!--                        <label>-->
                            <!--                            <input -->
                            <!--                                type="checkbox" -->
                            <!--                                class="level-checkbox" -->
                            <!--                                data-level-id="{{ $level->id }}" -->
                            <!--                                data-user-id="{{ $id }}" -->
                            <!--                                @if(\App\Models\LevelAccess::where('user_id', $id)->where('level_id', $level->id)->exists())-->
                            <!--                                    checked-->
                            <!--                                @endif-->
                            <!--                            >-->
                            <!--                            {{ $level->subject_name }} {{ $level->level_name }}-->
                                                         
                            <!--                        </label>-->
                            <!--                    </li>-->
                            <!--                @endforeach-->
                            <!--            </ul>-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--</div>-->
                            
                            
                            <div class="col-md-8 mb-3">
    <div class="card">
        <div class="card-header">
            <h5>Update Subject Accessibility</h5>
        </div>
        <div class="card-body">
            <ul class="list-group">
                @foreach($subjects as $subject)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <label>
                            <input 
                                type="checkbox" 
                                class="subject-checkbox" 
                                data-subject-id="{{ $subject->id }}" 
                                data-user-id="{{ $id }}"
                                @if(\App\Models\SubjectAccess::where('user_id', $id)->where('subject_id', $subject->id)->where('accessibility', 1)->exists())
                                    checked
                                @endif
                            >
                            {{ $subject->subject_name }}
                        </label>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

                        </div>
                    </div>
                </section>
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
    
    
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.subject-checkbox').forEach(function (checkbox) {
            checkbox.addEventListener('change', function () {
                const subjectId = this.dataset.subjectId;
                const userId = this.dataset.userId;
                const isAccessible = this.checked ? 1 : 0;
                fetch("{{ route('updateSubjectAccess') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        subject_id: subjectId,
                        user_id: userId,
                        accessibility: isAccessible
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (!data.success) {
                        alert('Error updating access');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            });
        });
    });
</script>

    
    
    <script>
   document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.level-checkbox').forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            const levelId = this.dataset.levelId;
            const userId = this.dataset.userId;
            const isAccessible = this.checked ? 1 : 0;

            fetch("{{ route('updateLevelAccess') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    user_id: userId,
                    level_id: levelId,
                    accessibility: isAccessible
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log('Level access updated successfully');
                } else {
                    console.error('Failed to update level access');
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
});

</script>
</body>
<!-- END: Body-->

</html>