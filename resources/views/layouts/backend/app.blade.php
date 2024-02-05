<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>@yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('/') }}/backend/images/favicon.ico">

        {{-- Datatable Start --}}
        <link href="{{ asset('/') }}/backend/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/') }}/backend/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/') }}/backend/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/') }}/backend/libs/datatables.net-select-bs5/css//select.bootstrap5.min.css" rel="stylesheet" type="text/css" />
        {{-- End Datatable --}}
        {{-- Datepicker Start --}}
        <!-- Plugins css -->
        <link href="{{ asset('/') }}/backend/libs/spectrum-colorpicker2/spectrum.min.css" rel="stylesheet" type="text/css">
        <link href="{{ asset('/') }}/backend/libs/flatpickr/flatpickr.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/') }}/backend/libs/clockpicker/bootstrap-clockpicker.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/') }}/backend/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/') }}/backend/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />

        {{-- Datepicker End --}}
        <!-- Sweet Alert-->
        <link href="{{ asset('/') }}/backend/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
        {{-- Starter Start --}}
        
		<!-- App css -->
		<link href="{{ asset('/') }}/backend/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />
		<!-- icons -->
		<link href="{{ asset('/') }}/backend/css/icons.min.css" rel="stylesheet" type="text/css" />
        {{-- Starter End --}}
        @yield('css')
        <!-- third party css end -->
    </head>
    <!-- body start -->
    <body class="loading" data-layout-color="light"  data-layout-mode="default" data-layout-size="fluid" data-topbar-color="light" data-leftbar-position="fixed" data-leftbar-color="light" data-leftbar-size='default' data-sidebar-user='true'>
        
        <!-- Begin page -->
        <div id="wrapper">
            <!-- Topbar Start -->
            <div class="navbar-custom">
                <ul class="list-unstyled topnav-menu float-end mb-0">
                    <li class="dropdown d-inline-block d-lg-none">
                        <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="fe-search noti-icon"></i>
                        </a>
                        <div class="dropdown-menu dropdown-lg dropdown-menu-end p-0">
                            <form class="p-3">
                                <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                            </form>
                        </div>
                    </li>
        
                    <li class="dropdown notification-list topbar-dropdown">
                        <a class="nav-link dropdown-toggle waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="fe-bell noti-icon"></i>
                            <span class="badge bg-danger rounded-circle noti-icon-badge">9</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-lg">

                            <!-- item-->
                            <div class="dropdown-item noti-title">
                                <h5 class="m-0">
                                    <span class="float-end">
                                        <a href="" class="text-dark">
                                            <small>Clear All</small>
                                        </a>
                                    </span>Notification
                                </h5>
                            </div>
                            <div class="noti-scroll" data-simplebar>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item active">
                                    <div class="notify-icon">
                                        <img src="{{ asset('/') }}/backend/images/users/user-1.jpg" class="img-fluid rounded-circle" alt="" /> </div>
                                    <p class="notify-details">Coming Soon</p>
                                    <p class="text-muted mb-0 user-msg">
                                        <small>Coming Soon for this feature</small>
                                    </p>
                                </a>
                            </div>
                            <!-- All-->
                            <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
                                View all
                                <i class="fe-arrow-right"></i>
                            </a>
                        </div>
                    </li>
                    <li class="dropdown notification-list topbar-dropdown">
                        <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <img src="{{ asset('/') }}/backend/images/users/user-1.jpg" alt="user-image" class="rounded-circle">
                            <span class="pro-user-name ms-1">
                                {{ Auth::user()->name }} <i class="mdi mdi-chevron-down"></i> 
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                            <!-- item-->
                            <div class="dropdown-header noti-title">
                                <h6 class="text-overflow m-0">Welcome !</h6>
                            </div>

                            <!-- item-->
                            <a href="{{ route('user.profile') }}" class="dropdown-item notify-item">
                                <i class="fe-user"></i>
                                <span>My Account</span>
                            </a>

                            <!-- item-->
                            <div class="dropdown-divider"></div>

                            <!-- item-->
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout').submit();" class="dropdown-item notify-item">
                                <i class="fe-log-out"></i>
                                <span>Logout</span>
                            </a>
                            <form action="{{ route('logout') }}" method="post" id="logout">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
                <!-- LOGO -->
                <div class="logo-box">
                    <a href="index.html" class="logo logo-light text-center">
                        <span class="logo-sm">
                            <img src="{{ asset('/') }}/backend/images/logo-sm.png" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ asset('/') }}/backend/images/logopelindo.png" alt="" height="16">
                        </span>
                    </a>
                    <a href="index.html" class="logo logo-dark text-center">
                        <span class="logo-sm">
                            <img src="{{ asset('/') }}/backend/images/logo-sm.png" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ asset('/') }}/backend/images/logopelindo.png" alt="" height="16">
                        </span>
                    </a>
                </div>
                <ul class="list-unstyled topnav-menu topnav-menu-left mb-0">
                    <li>
                        <button class="button-menu-mobile disable-btn waves-effect">
                            <i class="fe-menu"></i>
                        </button>
                    </li>

                    <li>
                        <h4 class="page-title-main">@yield('page')</h4>
                    </li>
        
                </ul>
                <div class="clearfix"></div> 

            </div>
            <div class="clearfix"></div>
            <!-- end Topbar -->
            <!-- ========== Left Sidebar Start ========== -->
            <div class="left-side-menu">
                <div class="h-100" data-simplebar>
                     <!-- User box -->
                    <div class="user-box text-center">
                        <img src="{{ asset('/') }}/backend/images/users/user-1.jpg" alt="user-img" title="Mat Helme" class="rounded-circle img-thumbnail avatar-md">
                        <div class="dropdown">
                            <a href="#" class="user-name dropdown-toggle h5 mt-2 mb-1 d-block" data-bs-toggle="dropdown"  aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                        </div>
                    </div>
                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <ul id="side-menu">
                            <li class="menu-title mt-2">Navigation</li>
                            <li>
                                <a href="{{ route('admin.dashboard') }}">
                                    <i class="mdi mdi-view-dashboard"></i>
                                    <span> Dashboard </span>
                                </a>
                            </li>
                            <li class="menu-title mt-2">Ploting</li>
                            <li>
                                <a href="{{ route('admin.index') }}">
                                    <i class="nav-icon fas fa-ship"></i>
                                    <span> Ploting Kapal </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.history') }}">
                                    <i class="mdi mdi-history"></i>
                                    <span>History</span>
                                </a>
                            </li>
                            @role('superadmin')
                            <li class="menu-title mt-2">User Management</li>
                            <li>
                                <a href="{{ route('user.index') }}">
                                    <i class="fas fa-users"></i>
                                    <span>User</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('user.history') }}">
                                    <i class="fas fa-user-clock"></i>
                                    <span>History User</span>
                                </a>
                            </li>
                            @endrole
                        </ul>
                    </div>
                    <!-- End Sidebar -->
                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->
            
            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">
                    <!-- Start Content-->
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                @yield('content')
                            </div>
                        </div>
                    </div> <!-- container -->
                </div> <!-- content -->
                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <script>document.write(new Date().getFullYear())</script> &copy; Pelabuhan Indonesia Regional 2 Pontianak 
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->
            </div>
        </div>
        <!-- END wrapper -->
        {{-- Starter start --}}
        <!-- Vendor -->
        <script src="{{ asset('/') }}/backend/libs/jquery/jquery.min.js"></script>
        <script src="{{ asset('/') }}/backend/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('/') }}/backend/libs/simplebar/simplebar.min.js"></script>
        <script src="{{ asset('/') }}/backend/libs/node-waves/waves.min.js"></script>
        <script src="{{ asset('/') }}/backend/libs/waypoints/lib/jquery.waypoints.min.js"></script>
        <script src="{{ asset('/') }}/backend/libs/jquery.counterup/jquery.counterup.min.js"></script>
        <script src="{{ asset('/') }}/backend/libs/feather-icons/feather.min.js"></script>

        {{-- Datatable Start JS --}}
        <!-- third party js -->
        <script src="{{ asset('/') }}/backend/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="{{ asset('/') }}/backend/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
        <script src="{{ asset('/') }}/backend/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="{{ asset('/') }}/backend/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
        <script src="{{ asset('/') }}/backend/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="{{ asset('/') }}/backend/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js"></script>
        <script src="{{ asset('/') }}/backend/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="{{ asset('/') }}/backend/libs/datatables.net-buttons/js/buttons.flash.min.js"></script>
        <script src="{{ asset('/') }}/backend/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="{{ asset('/') }}/backend/libs/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
        <script src="{{ asset('/') }}/backend/libs/datatables.net-select/js/dataTables.select.min.js"></script>
        <script src="{{ asset('/') }}/backend/libs/pdfmake/build/pdfmake.min.js"></script>
        <script src="{{ asset('/') }}/backend/libs/pdfmake/build/vfs_fonts.js"></script>
        <!-- third party js ends -->

        <!-- Datatables init -->
        <script src="{{ asset('/') }}/backend/js/pages/datatables.init.js"></script>

        {{-- End Datatable --}}

        <!-- Plugins js-->
        <script src="{{ asset('/') }}/backend/libs/flatpickr/flatpickr.min.js"></script>
        <script src="{{ asset('/') }}/backend/libs/spectrum-colorpicker2/spectrum.min.js"></script>
        <script src="{{ asset('/') }}/backend/libs/clockpicker/bootstrap-clockpicker.min.js"></script>
        <script src="{{ asset('/') }}/backend/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
        {{-- id --}}
        <script src="{{ asset('/') }}/backend/libs/moment/moment.js"></script>
        <script src="{{ asset('/') }}/backend/libs/moment/locale/id.js"></script>

        <!-- Sweet Alerts js -->
        <script src="{{ asset('/') }}/backend/libs/sweetalert2/sweetalert2.all.min.js"></script>

        <!-- Sweet alert init js-->
        <script src="{{ asset('/') }}/backend/js/pages/sweet-alerts.init.js"></script>
        <!-- Init js-->
        <script src="{{ asset('/') }}/backend/js/pages/form-pickers.init.js"></script>
        <!-- App js -->
        <script src="{{ asset('/') }}/backend/js/app.min.js"></script>

        {{-- End Starter --}}

        @if (Session::has('success'))
            <script>
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "{{Session::get('success')}}",
                    showConfirmButton: false,
                    timer: 1500
                });
            </script>
        @endif  
        @yield('js')
    </body>
</html> 