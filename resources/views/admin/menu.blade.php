<head>
    <script src="https://unpkg.com/feather-icons"></script>



<style>
    .nav-item.active {
    border-radius: 5px; 
}
.main-menu.menu-light .navigation {
    background: #FFFFFF;
    margin-top: 40px;
}
</style>


</head>
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="{{route('getuser')}}"><span class="brand-logo">
               <img src="{{ asset('app-assets/images/logo/upscaledlogo.jpg') }}" alt="Spartans Logo" style=" padding-top:18px; max-width: 90px; margin:-40px 0 0 0; display: block;">
                            <defs>
                                <lineargradient id="linearGradient-1" x1="100%" y1="10.5120544%" x2="50%" y2="89.4879456%">
                                    <stop stop-color="#000000" offset="0%"></stop>
                                    <stop stop-color="#FFFFFF" offset="100%"></stop>
                                </lineargradient>
                                <lineargradient id="linearGradient-2" x1="64.0437835%" y1="46.3276743%" x2="37.373316%" y2="100%">
                                    <stop stop-color="#EEEEEE" stop-opacity="0" offset="0%"></stop>
                                    <stop stop-color="#FFFFFF" offset="100%"></stop>
                                </lineargradient>
                            </defs>
                            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="Artboard" transform="translate(-400.000000, -178.000000)">
                                    <g id="Group" transform="translate(400.000000, 178.000000)">
                                        <path class="text-primary" id="Path" d="M-5.68434189e-14,2.84217094e-14 L39.1816085,2.84217094e-14 L69.3453773,32.2519224 L101.428699,2.84217094e-14 L138.784583,2.84217094e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L6.71554594,44.4188507 C2.46876683,39.9813776 0.345377275,35.1089553 0.345377275,29.8015838 C0.345377275,24.4942122 0.230251516,14.560351 -5.68434189e-14,2.84217094e-14 Z" style="fill:currentColor"></path>
                                        <path id="Path1" d="M69.3453773,32.2519224 L101.428699,1.42108547e-14 L138.784583,1.42108547e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L32.8435758,70.5039241 L69.3453773,32.2519224 Z" fill="url(#linearGradient-1)" opacity="0.2"></path>
                                        <polygon id="Path-2" fill="#000000" opacity="0.049999997" points="69.3922914 32.4202615 32.8435758 70.5039241 54.0490008 16.1851325"></polygon>
                                        <polygon id="Path-21" fill="#000000" opacity="0.099999994" points="69.3922914 32.4202615 32.8435758 70.5039241 58.3683556 20.7402338"></polygon>
                                        <polygon id="Path-3" fill="url(#linearGradient-2)" opacity="0.099999994" points="101.428699 0 83.0667527 94.1480575 130.378721 47.0740288"></polygon>
                                    </g>
                                </g>
                            </g>
                        </svg></span>
                    <h2 class="brand-text"></h2>
                </a></li>
           
        </ul>
    </div>
  
  <div class="main-menu-content">
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
        @if(auth()->user()->usertype == 'admin')
            <li class="nav-item {{ Request::is('viewSubjects') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('viewSubjects') }}">
                    <i data-feather="book"></i>
                    <span class="menu-title text-truncate" data-i18n="Chat">Manage Subjects</span>
                </a>
            </li>
            
            <!-- Move Manage Levels below Manage Subjects for Admin -->
            <!-- <li class="nav-item {{ Request::is('levelview') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('levelview') }}">
                    <i data-feather="chevrons-up"></i>
                    <span class="menu-title text-truncate" data-i18n="Chat">Manage Levels</span>
                </a>
            </li> -->
            
            <li class="nav-item {{ Request::is('getuser') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('getuser') }}">
                    <i data-feather="user"></i>
                    <span class="menu-title text-truncate" data-i18n="Email">Users</span>
                </a>
            </li>

            <li class="nav-item {{ Request::is('userrequest') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('userrequest') }}">
                    <i data-feather="user-plus"></i>
                    <span class="menu-title text-truncate" data-i18n="Email">User Requests</span>
                </a>
            </li>
            
            
             <li class="nav-item {{ Request::is('payments.list') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('payments.list') }}">
                    <i data-feather="dollar-sign"></i>
                    <span class="menu-title text-truncate" data-i18n="Email">Payments</span>
                </a>
            </li>
            
            

            <li class="nav-item {{ Route::currentRouteName() == 'subadmin.index' ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('subadmin.index') }}">
                    <i data-feather="users"></i>
                    <span class="menu-title text-truncate" data-i18n="Email">Sub-Admin</span>
                </a>
            </li>
        @elseif(auth()->user()->usertype == 'subadmin')
            <!-- Only Manage Levels is shown for Subadmin -->
            <!-- <li class="nav-item {{ Request::is('viewSubjects') ? 'active' : '' }}">-->
            <!--    <a class="d-flex align-items-center" href="{{ route('viewSubjects') }}">-->
            <!--        <i data-feather="book"></i>-->
            <!--        <span class="menu-title text-truncate" data-i18n="Chat">Manage Subjects</span>-->
            <!--    </a>-->
            <!--</li>-->
            <li class="nav-item {{ Request::is('levelview') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('levelview') }}">
                    <i data-feather="chevrons-up"></i>
                    <span class="menu-title text-truncate" data-i18n="Chat">Manage Levels</span>
                </a>
            </li>
            
            <li class="nav-item {{ Request::is('payments.list') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('payments.list') }}">
                    <i data-feather="user-plus"></i>
                    <span class="menu-title text-truncate" data-i18n="Email">Payments</span>
                </a>
            </li>
            
            
              <li class="nav-item {{ Request::is('studentdetails') ? 'active' : '' }}">
        <a class="d-flex align-items-center" href="{{ route('studentdetails') }}">
            <i data-feather="users"></i>
            <span class="menu-title text-truncate" data-i18n="Chat">Student Details</span>
        </a>
    </li>
        @endif
    </ul>
</div>


</div>