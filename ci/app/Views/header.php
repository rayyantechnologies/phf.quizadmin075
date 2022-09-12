<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>PHF Ogun Quiz :: RayyanTech Dashboard</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/media/image/favicon.png" />

    <!-- Main css -->
    <link rel="stylesheet" href="vendors/bundle.css" type="text/css" />

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap"
        rel="stylesheet" />

    <!-- Daterangepicker -->
    <link rel="stylesheet" href="vendors/form-wizard/jquery.steps.css" type="text/css" />

    <!-- DataTable -->
    <link rel="stylesheet" href="vendors/dataTable/datatables.min.css" type="text/css" />

    <!-- App css -->
    <link rel="stylesheet" href="assets/css/app.min.css" type="text/css" />

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <!-- Preloader -->
    <!-- <div class="preloader">
        <div class="preloader-icon"></div>
        <span>Loading...</span>
    </div> -->
    <!-- ./ Preloader -->

    <!-- Sidebar group -->
    <div class="sidebar-group">
        <!-- BEGIN: Settings -->
        <div class="sidebar" id="settings">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title d-flex justify-content-between">
                        Settings
                        <a class="btn-sidebar-close" href="#">
                            <i class="ti-close"></i>
                        </a>
                    </h6>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item pl-0 pr-0">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch1" checked />
                                <label class="custom-control-label" for="customSwitch1">Allow notifications.</label>
                            </div>
                        </li>
                        <li class="list-group-item pl-0 pr-0">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch2" />
                                <label class="custom-control-label" for="customSwitch2">Hide user requests</label>
                            </div>
                        </li>
                        <li class="list-group-item pl-0 pr-0">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch3" checked />
                                <label class="custom-control-label" for="customSwitch3">Speed up demands</label>
                            </div>
                        </li>
                        <li class="list-group-item pl-0 pr-0">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch4" checked />
                                <label class="custom-control-label" for="customSwitch4">Hide menus</label>
                            </div>
                        </li>
                        <li class="list-group-item pl-0 pr-0">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch5" />
                                <label class="custom-control-label" for="customSwitch5">Remember next visits</label>
                            </div>
                        </li>
                        <li class="list-group-item pl-0 pr-0">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch6" />
                                <label class="custom-control-label" for="customSwitch6">Enable report
                                    generation.</label>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- END: Settings -->
    </div>
    <!-- ./ Sidebar group -->

    <!-- Layout wrapper -->
    <div class="layout-wrapper">
        <!-- Header -->
        <div class="header d-print-none">
            <div class="header-container">
                <div class="header-left">
                    <div class="navigation-toggler">
                        <a href="#" data-action="navigation-toggler">
                            <i data-feather="menu"></i>
                        </a>
                    </div>

                    <div class="header-logo">
                        <a href="index">
                            <img class="logo" src="assets/media/image/logo.png" alt="logo" width="20%" />
                        </a>
                    </div>
                </div>

                <div class="header-body">
                    <div class="header-body-left">
                        <ul class="navbar-nav">
                            <li class="nav-item mr-3">
                                <div class="header-search-form">
                                    <form>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <button class="btn">
                                                    <i data-feather="search"></i>
                                                </button>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Search" />
                                            <div class="input-group-append">
                                                <button class="btn header-search-close-btn">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </li>
                            <li class="nav-item dropdown d-none d-md-block">
                                <a href="#" class="nav-link" title="Actions" data-toggle="dropdown">Create</a>
                                <div class="dropdown-menu">
                                    <a href="#" class="dropdown-item">Add Products</a>
                                    <a href="#" class="dropdown-item disabled">Add Category</a>
                                    <a href="#" class="dropdown-item disabled">Add Report</a>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="header-body-right">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a href="#" class="nav-link mobile-header-search-btn" title="Search">
                                    <i data-feather="search"></i>
                                </a>
                            </li>

                            <li class="nav-item dropdown d-none d-md-block">
                                <a href="#" class="nav-link" title="Fullscreen" data-toggle="fullscreen">
                                    <i class="maximize" data-feather="maximize"></i>
                                    <i class="minimize" data-feather="minimize"></i>
                                </a>
                            </li>

                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link" title="Settings" data-sidebar-target="#settings">
                                    <i data-feather="settings"></i>
                                </a>
                            </li>

                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" title="User menu" data-toggle="dropdown">
                                    <figure class="avatar avatar-sm">
                                        <img src="assets/media/image/user/man_avatar3.jpg" class="rounded-circle"
                                            alt="avatar" />
                                    </figure>
                                    <span class="ml-2 d-sm-inline d-none">Bony Gidden</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-big">
                                    <div class="text-center py-4">
                                        <figure class="avatar avatar-lg mb-3 border-0">
                                            <img src="assets/media/image/user/man_avatar3.jpg" class="rounded-circle"
                                                alt="image" />
                                        </figure>
                                        <h5 class="text-center">Bony Gidden</h5>
                                        <div class="mb-3 small text-center text-muted">
                                            @bonygidden
                                        </div>
                                        <a href="#" class="btn btn-outline-light btn-rounded">Manage Your Account</a>
                                    </div>
                                    <div class="list-group">
                                        <a href="profile.html" class="list-group-item">View Profile</a>
                                        <a href="http://bifor.laborasyon.com/login" class="list-group-item text-danger"
                                            data-sidebar-target="#settings">Sign Out!</a>
                                    </div>
                                    <div class="p-4">
                                        <div class="mb-4">
                                            <h6 class="d-flex justify-content-between">
                                                Storage
                                                <span>%25</span>
                                            </h6>
                                            <div class="progress" style="height: 5px;">
                                                <div class="progress-bar bg-success-gradient" role="progressbar"
                                                    style="width: 40%;" aria-valuenow="40" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <hr class="mb-3" />
                                        <p class="small mb-0">
                                            <a href="#">Privacy policy</a>
                                        </p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <ul class="navbar-nav ml-auto">
                    <li class="nav-item header-toggler">
                        <a href="#" class="nav-link">
                            <i data-feather="arrow-down"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- ./ Header -->
