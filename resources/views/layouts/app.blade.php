<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard</title>

    <!-- Prevent the demo from appearing in search engines -->
    <meta name="robots" content="noindex">

    {{-- Ck editor --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/31.1.0/classic/ckeditor.js"></script>
    <!-- jQuery -->
    <script src="{{asset('assets/vendor/jquery.min.js')}}"></script>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Table -->
    <link type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- Perfect Scrollbar -->
    <link type="text/css" href="{{asset('assets/vendor/perfect-scrollbar.css')}}" rel="stylesheet">

    <!-- Toastr -->
    <link type="text/css" href="{{asset('assets/css/toastr.min.css')}}" rel="stylesheet">
        <!-- jQuery -->
    <script src="{{asset('assets/vendor/jquery.min.js')}}"></script>

    <!-- App CSS -->
    <link type="text/css" href="{{asset('assets/css/style.css')}}" rel="stylesheet">

    <!-- Material Design Icons -->
    <link type="text/css" href="{{asset('assets/css/vendor-material-icons.css')}}" rel="stylesheet">

    <!-- Font Awesome FREE Icons -->
    <link type="text/css" href="{{asset('assets/css/vendor-fontawesome-free.css')}}" rel="stylesheet">
    

</head>

<body class="layout-default">

    <div class="preloader"></div>

    <!-- Header Layout -->
    <div class="mdk-header-layout js-mdk-header-layout">

        <!-- Header -->

        <div id="header" class="mdk-header js-mdk-header m-0" data-fixed>
            <div class="mdk-header__content">

                <div class="navbar navbar-expand-sm navbar-main navbar-dark bg-dark  pr-0" id="navbar" data-primary>
                    <div class="container-fluid p-0">

                        <!-- Navbar toggler -->

                        <button class="navbar-toggler navbar-toggler-right d-block d-lg-none" type="button"
                            data-toggle="sidebar">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <!-- Navbar Brand -->
                        <a href="{{ url('/') }}" class="navbar-brand ">
                            <span>CRM</span>
                        </a>



                        <ul class="nav navbar-nav ml-auto d-none d-md-flex">
                            <li class="nav-item dropdown">
                                <a href="#notifications_menu" class="nav-link dropdown-toggle" data-toggle="dropdown"
                                    data-caret="false">
                                    <i class="material-icons nav-icon navbar-notifications-indicator">notifications</i>
                                </a>
                                <div id="notifications_menu"
                                    class="dropdown-menu dropdown-menu-right navbar-notifications-menu">
                                    <div class="dropdown-item d-flex align-items-center py-2">
                                        <span class="flex navbar-notifications-menu__title m-0">Notifications</span>
                                        <a href="javascript:void(0)" class="text-muted"><small>Clear all</small></a>
                                    </div>
                                    <div class="navbar-notifications-menu__content" data-perfect-scrollbar>
                                        <div class="py-2">

                                            <div class="dropdown-item d-flex">
                                                <div class="mr-3">
                                                    <div class="avatar avatar-sm" style="width: 32px; height: 32px;">
                                                        <img src="{{asset('assets/images/256_daniel-gaffey-1060698-unsplash.jpg')}}"
                                                            alt="Avatar" class="avatar-img rounded-circle">
                                                    </div>
                                                </div>
                                                <div class="flex">
                                                    <a href="">A.Demian</a> left a comment on <a
                                                        href="">FlowDash</a><br>
                                                    <small class="text-muted">1 minute ago</small>
                                                </div>
                                            </div>
                                            <div class="dropdown-item d-flex">
                                                <div class="mr-3">
                                                    <a href="#">
                                                        <div class="avatar avatar-xs"
                                                            style="width: 32px; height: 32px;">
                                                            <span class="avatar-title bg-purple rounded-circle"><i
                                                                    class="material-icons icon-16pt">person_add</i></span>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="flex">
                                                    New user <a href="#">Peter Parker</a> signed up.<br>
                                                    <small class="text-muted">1 hour ago</small>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <a href="javascript:void(0);"
                                        class="dropdown-item text-center navbar-notifications-menu__footer">View All</a>
                                </div>
                            </li>
                        </ul>

                        <ul class="nav navbar-nav d-none d-sm-flex border-left navbar-height align-items-center">
                            <li class="nav-item dropdown">
                                <a href="#account_menu" class="nav-link dropdown-toggle" data-toggle="dropdown"
                                    data-caret="false">
                                    <span class="mr-1 d-flex-inline">
                                        <span class="text-light">{{ Auth::user()->name }}</span>
                                    </span>
                                    <img src="{{asset('assets/images/avatar/admin.png')}}" class="rounded-circle" width="32"
                                        alt="Frontted">
                                </a>
                                <div id="account_menu" class="dropdown-menu dropdown-menu-right">
                                    <div class="dropdown-item-text dropdown-item-text--lh">
                                        <div><strong>{{ Auth::user()->name }}</strong></div>
                                        <div class="text-muted">{{ Auth::user()->email }}</div>
                                    </div>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{route('dashboard')}}"><i class="material-icons">dvr</i>
                                        Dashboard</a>
                                    <a class="dropdown-item" href="profile.html"><i
                                            class="material-icons">account_circle</i> My profile</a>
                                    <a class="dropdown-item" href="edit-account.html"><i class="material-icons">edit</i>
                                        Edit account</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" ><i class="material-icons">exit_to_app</i>
                                        {{ __('Logout') }}</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                </div>
                            </li>
                        </ul>

                    </div>
                </div>

            </div>
        </div>

        <!-- // END Header -->

        <!-- Header Layout Content -->
        <div class="mdk-header-layout__content">

            <div class="mdk-drawer-layout js-mdk-drawer-layout" data-push data-responsive-width="992px">
                <div class="mdk-drawer-layout__content page">

                    <div class="container-fluid page__heading-container">
                        <div class="page__heading d-flex align-items-end">
                            <div class="flex">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb mb-0">
                                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">@yield('page_title')</li>
                                    </ol>
                                </nav>
                                <h1 class="m-0">@yield('page_title')</h1>
                                @yield('page_title_extra')
                            </div>

                        </div>
                    </div>

                    <div class="container-fluid page__container">

                        <div class="row card-group-row">

                            <div class="col-lg-12 col-md-12 ">
                                @yield('content')
                            </div>
                        </div>
                    </div>

                </div>
                <!-- // END drawer-layout__content -->
     @if (auth()->user()->role=='admin')
     <div class="mdk-drawer  js-mdk-drawer" id="default-drawer" data-align="start">
        <div class="mdk-drawer__content">
            <div class="sidebar sidebar-light sidebar-left sidebar-p-t" data-perfect-scrollbar>
                <div class="sidebar-heading">Menu</div>
                <ul class="sidebar-menu">
                    <li class="sidebar-menu-item active open">
                        <a class="sidebar-menu-button" data-toggle="collapse" href="#dashboards_menu">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">dvr</i>
                            <span class="sidebar-menu-text">Dashboards</span>
                            <span class="ml-auto sidebar-menu-toggle-icon"></span>
                        </a>
                        <ul class="sidebar-submenu collapse show " id="dashboards_menu">
                            <li class="sidebar-menu-item active">
                                <a class="sidebar-menu-button" href="{{route('dashboard')}}">
                                    <span class="sidebar-menu-text">Dashboard</span>
                                </a>
                            </li>

                        </ul>
                    </li>

                    <li class="sidebar-menu-item  ">
                        <a class="sidebar-menu-button" data-toggle="collapse" href="#customer">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">dvr</i>
                            <span class="sidebar-menu-text">Customer</span>
                            <span class="ml-auto sidebar-menu-toggle-icon"></span>
                        </a>
                        <ul class="sidebar-submenu collapse show" id="customer">
                            <li class="sidebar-menu-item ">
                                <a class="sidebar-menu-button" href="{{route('customers.index')}}">
                                    <span class="sidebar-menu-text">Customer List</span>
                                </a>
                            </li>

                        </ul>
                        <ul class="sidebar-submenu collapse show" id="customer">
                            <li class="sidebar-menu-item ">
                                <a class="sidebar-menu-button" href="{{route('customers.create')}}">
                                    <span class="sidebar-menu-text">Add Customer</span>
                                </a>
                            </li>

                        </ul>
                    </li>


                    <li class="sidebar-menu-item  ">
                        <a class="sidebar-menu-button" data-toggle="collapse" href="#tax_rule">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">dvr</i>
                            <span class="sidebar-menu-text">Tax Rules</span>
                            <span class="ml-auto sidebar-menu-toggle-icon"></span>
                        </a>
                        <ul class="sidebar-submenu collapse show " id="tax_rule">
                            <li class="sidebar-menu-item ">
                                <a class="sidebar-menu-button" href="{{route('tax.index')}}">
                                    <span class="sidebar-menu-text">Tax Rules List</span>
                                </a>
                            </li>
                        </ul>
                        <ul class="sidebar-submenu collapse show " id="tax_rule">
                            <li class="sidebar-menu-item ">
                                <a class="sidebar-menu-button" href="{{route('tax.create')}}">
                                    <span class="sidebar-menu-text">Add New</span>
                                </a>
                            </li>
                        </ul>
                    </li>


                    <li class="sidebar-menu-item  ">
                        <a class="sidebar-menu-button" data-toggle="collapse" href="#unit">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">dvr</i>
                            <span class="sidebar-menu-text">Units</span>
                            <span class="ml-auto sidebar-menu-toggle-icon"></span>
                        </a>
                        <ul class="sidebar-submenu collapse show " id="unit">
                            <li class="sidebar-menu-item ">
                                <a class="sidebar-menu-button" href="{{route('unit.index')}}">
                                    <span class="sidebar-menu-text">Unit List</span>
                                </a>
                            </li>
                        </ul>
                        <ul class="sidebar-submenu collapse show " id="unit">
                            <li class="sidebar-menu-item ">
                                <a class="sidebar-menu-button" href="{{route('unit.create')}}">
                                    <span class="sidebar-menu-text">Add New</span>
                                </a>
                            </li>
                        </ul>
                    </li>


                    <li class="sidebar-menu-item  ">
                        <a class="sidebar-menu-button" data-toggle="collapse" href="#item">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">dvr</i>
                            <span class="sidebar-menu-text">Items</span>
                            <span class="ml-auto sidebar-menu-toggle-icon"></span>
                        </a>
                        <ul class="sidebar-submenu collapse show " id="item">
                            <li class="sidebar-menu-item ">
                                <a class="sidebar-menu-button" href="{{route('item.index')}}">
                                    <span class="sidebar-menu-text">Items</span>
                                </a>
                            </li>
                        </ul>
                        <ul class="sidebar-submenu collapse show " id="item">
                            <li class="sidebar-menu-item ">
                                <a class="sidebar-menu-button" href="{{route('item.create')}}">
                                    <span class="sidebar-menu-text">Add New</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-menu-item  ">
                        <a class="sidebar-menu-button" data-toggle="collapse" href="#proposal">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">dvr</i>
                            <span class="sidebar-menu-text">Proposals</span>
                            <span class="ml-auto sidebar-menu-toggle-icon"></span>
                        </a>
                        <ul class="sidebar-submenu collapse show " id="proposal">
                            <li class="sidebar-menu-item ">
                                <a class="sidebar-menu-button" href="{{ route('proposal.index') }}">
                                    <span class="sidebar-menu-text">Proposal List</span>
                                </a>
                            </li>
                        </ul>
                        <ul class="sidebar-submenu collapse show " id="proposal">
                            <li class="sidebar-menu-item ">
                                <a class="sidebar-menu-button" href="{{route('proposal_status.index')}}">
                                    <span class="sidebar-menu-text">Panding Proposals</span>
                                </a>
                            </li>
                        </ul>
                        <ul class="sidebar-submenu collapse show " id="proposal">
                            <li class="sidebar-menu-item ">
                                <a class="sidebar-menu-button" href="{{route('approved_proposal')}}">
                                    <span class="sidebar-menu-text">Accepted Proposals</span>
                                </a>
                            </li>
                        </ul>
                        <ul class="sidebar-submenu collapse show " id="proposal">
                            <li class="sidebar-menu-item ">
                                <a class="sidebar-menu-button" href="{{route('declined_proposal')}}">
                                    <span class="sidebar-menu-text">Declined Proposals</span>
                                </a>
                            </li>
                        </ul>
                    </li>




                    <li class="sidebar-menu-item  ">
                        <a class="sidebar-menu-button" data-toggle="collapse" href="#project">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">dvr</i>
                            <span class="sidebar-menu-text">Project</span>
                            <span class="ml-auto sidebar-menu-toggle-icon"></span>
                        </a>
                        <ul class="sidebar-submenu collapse show " id="project">
                            <li class="sidebar-menu-item ">
                                <a class="sidebar-menu-button" href="{{ route('project.index') }}">
                                    <span class="sidebar-menu-text">All Project</span>
                                </a>
                            </li>
                        </ul>
                    </li>








                    <li class="sidebar-menu-item  ">
                        <a class="sidebar-menu-button" data-toggle="collapse" href="#estimate">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">dvr</i>
                            <span class="sidebar-menu-text">Estimates</span>
                            <span class="ml-auto sidebar-menu-toggle-icon"></span>
                        </a>
                        <ul class="sidebar-submenu collapse show " id="estimate">
                            <li class="sidebar-menu-item ">
                                <a class="sidebar-menu-button" href="{{ route('estimate.index') }}">
                                    <span class="sidebar-menu-text">Estimates List</span>
                                </a>
                            </li>
                        </ul>
                        <ul class="sidebar-submenu collapse show " id="estimate">
                            <li class="sidebar-menu-item ">
                                <a class="sidebar-menu-button" href="{{ route('estimate.create') }}">
                                    <span class="sidebar-menu-text">Add Estimate</span>
                                </a>
                            </li>
                        </ul>
                        <ul class="sidebar-submenu collapse show " id="estimate">
                            <li class="sidebar-menu-item ">
                                <a class="sidebar-menu-button" href="{{ route('estimate_status.index') }}">
                                    <span class="sidebar-menu-text">Panding Estimates</span>
                                </a>
                            </li>
                        </ul>
                        <ul class="sidebar-submenu collapse show " id="estimate">
                            <li class="sidebar-menu-item ">
                                <a class="sidebar-menu-button" href="{{ route('approved_estimate') }}">
                                    <span class="sidebar-menu-text">Accepted Estimates</span>
                                </a>
                            </li>
                        </ul>
                        <ul class="sidebar-submenu collapse show " id="estimate">
                            <li class="sidebar-menu-item ">
                                <a class="sidebar-menu-button" href="{{ route('declined_estimate') }}">
                                    <span class="sidebar-menu-text">Declined Estimates</span>
                                </a>
                            </li>
                        </ul>
                    </li>



                    <li class="sidebar-menu-item  ">
                        <a class="sidebar-menu-button" data-toggle="collapse" href="#expense">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">dvr</i>
                            <span class="sidebar-menu-text">Expense</span>
                            <span class="ml-auto sidebar-menu-toggle-icon"></span>
                        </a>
                        <ul class="sidebar-submenu collapse show " id="expense">
                            <li class="sidebar-menu-item ">
                                <a class="sidebar-menu-button" href="{{ route('expense.create') }}">
                                    <span class="sidebar-menu-text">Add Expense</span>
                                </a>
                            </li>
                        </ul>

                        <ul class="sidebar-submenu collapse show " id="expense">
                            <li class="sidebar-menu-item ">
                                <a class="sidebar-menu-button" href="{{ route('expense.index') }}">
                                    <span class="sidebar-menu-text">Expense List</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-menu-item active ">
                        <a class="sidebar-menu-button" data-toggle="collapse" href="#drpartment">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">dvr</i>
                            <span class="sidebar-menu-text">Departments</span>
                            <span class="ml-auto sidebar-menu-toggle-icon"></span>
                        </a>
                        <ul class="sidebar-submenu collapse show " id="drpartment">
                            <li class="sidebar-menu-item active">
                                <a class="sidebar-menu-button" href="{{ route('department.index') }}">
                                    <span class="sidebar-menu-text">Department List</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-menu-item active ">
                        <a class="sidebar-menu-button" data-toggle="collapse" href="#exp_cat">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">dvr</i>
                            <span class="sidebar-menu-text">Leads</span>
                            <span class="ml-auto sidebar-menu-toggle-icon"></span>
                        </a>
                        <ul class="sidebar-submenu collapse show " id="exp_cat">
                            <li class="sidebar-menu-item active">
                                <a class="sidebar-menu-button" href="{{ route('leads.index') }}">
                                    <span class="sidebar-menu-text">Show Lead</span>
                                </a>
                            </li>
                        </ul>
                    </li>



                    <li class="sidebar-menu-item active ">
                        <a class="sidebar-menu-button" data-toggle="collapse" href="#exp_cat">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">dvr</i>
                            <span class="sidebar-menu-text">Settings</span>
                            <span class="ml-auto sidebar-menu-toggle-icon"></span>
                        </a>
                        <ul class="sidebar-submenu collapse show " id="exp_cat">
                            <li class="sidebar-menu-item active">
                                <a class="sidebar-menu-button" href="{{ route('expensecat.index') }}">
                                    <span class="sidebar-menu-text">Expense Category</span>
                                </a>
                            </li>
                        </ul>
                        <ul class="sidebar-submenu collapse show " id="exp_cat">
                            <li class="sidebar-menu-item active">
                                <a class="sidebar-menu-button" href="{{ route('expensecat.create') }}">
                                    <span class="sidebar-menu-text">Add Expense Category</span>
                                </a>
                            </li>
                        </ul>
                    </li>


                    <li class="sidebar-menu-item active ">
                        <a class="sidebar-menu-button" data-toggle="collapse" href="#user">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">dvr</i>
                            <span class="sidebar-menu-text">User</span>
                            <span class="ml-auto sidebar-menu-toggle-icon"></span>
                        </a>
                        <ul class="sidebar-submenu collapse show " id="user">
                            <li class="sidebar-menu-item active">
                                <a class="sidebar-menu-button" href="{{ route('users.index') }}">
                                    <span class="sidebar-menu-text">User List</span>
                                </a>
                            </li>
                        </ul>
                    </li>


                </ul>


            </div>
        </div>
    </div>


     @else

     <div class="mdk-drawer  js-mdk-drawer" id="default-drawer" data-align="start">
        <div class="mdk-drawer__content">
            <div class="sidebar sidebar-light sidebar-left sidebar-p-t" data-perfect-scrollbar>
                <div class="sidebar-heading">Menu</div>
                <ul class="sidebar-menu">
                    <li class="sidebar-menu-item active open">
                        <a class="sidebar-menu-button" data-toggle="collapse" href="#dashboards_menu">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">dvr</i>
                            <span class="sidebar-menu-text">Dashboards</span>
                            <span class="ml-auto sidebar-menu-toggle-icon"></span>
                        </a>
                        <ul class="sidebar-submenu collapse show " id="dashboards_menu">
                            <li class="sidebar-menu-item active">
                                <a class="sidebar-menu-button" href="{{route('dashboard')}}">
                                    <span class="sidebar-menu-text">Dashboard</span>
                                </a>
                            </li>

                        </ul>
                    </li>

                    <li class="sidebar-menu-item active open">
                        <a class="sidebar-menu-button" data-toggle="collapse" href="#proposal">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">dvr</i>
                            <span class="sidebar-menu-text">Proposals</span>
                            <span class="ml-auto sidebar-menu-toggle-icon"></span>
                        </a>
                        
                        <ul class="sidebar-submenu collapse show ">
                            <li class="sidebar-menu-item active">
                                <a class="sidebar-menu-button" href="{{ route('proposals.index') }}">
                                    <span class="sidebar-menu-text">View All Proposals</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item active">
                                <a class="sidebar-menu-button" href="{{route('proposals.status')}}">
                                    <span class="sidebar-menu-text">View Proposal Status</span>
                                </a>
                            </li>
                       </ul>
                    </li>           


                    <li class="sidebar-menu-item active open">
                        <a class="sidebar-menu-button" data-toggle="collapse" href="#customer">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">dvr</i>
                            <span class="sidebar-menu-text">Customer</span>
                            <span class="ml-auto sidebar-menu-toggle-icon"></span>
                        </a>
                        <ul class="sidebar-submenu collapse show " id="customer">
                            <li class="sidebar-menu-item active">
                                <a class="sidebar-menu-button" href="{{ route('customer.index') }}">
                                    <span class="sidebar-menu-text">My Info</span>
                                </a>
                            </li>

                        </ul>
                    </li>




                </ul>




            </div>
        </div>
    </div>  
     @endif
                
            </div>
            <!-- // END drawer-layout -->

        </div>
        <!-- // END header-layout__content -->

    </div>
    <!-- // END header-layout -->

    App Settings FAB
    <div id="app-settings" style="display: none;">
        <app-settings layout-active="default" :layout-location="{
          'default': 'index.html',
          'fixed': 'fixed-dashboard.html',
          'fluid': 'fluid-dashboard.html',
          'mini': 'mini-dashboard.html'
        }"></app-settings>
    </div>

    

    <!-- Bootstrap -->
    <script src="{{asset('assets/vendor/popper.min.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap.min.js')}}"></script>

    <!-- Perfect Scrollbar -->
    <script src="{{asset('assets/vendor/perfect-scrollbar.min.js')}}"></script>

    <!-- DOM Factory -->
    <script src="{{asset('assets/vendor/dom-factory.js')}}"></script>

    {{-- toastr  --}}
    <script src="{{asset('assets/vendor/toastr.min.js')}}"></script>

    <!-- MDK -->
    <script src="{{asset('assets/vendor/material-design-kit.js')}}"></script>

    <!-- App -->
    <script src="{{asset('assets/js/script.js')}}"></script>

    <!-- App Settings (safe to remove) -->
    <script src="{{asset('assets/js/app-settings.js')}}"></script>

    <!-- table -->
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    {{-- file type name --}}
    <script>
        $("input[type=file]").change(function () {
        var fieldVal = $(this).val();

        // Change the node's value by removing the fake path (Chrome)
        fieldVal = fieldVal.replace("C:\\fakepath\\", "");

        if (fieldVal != undefined || fieldVal != "") {
            $(this).next(".custom-file-label").attr('data-content', fieldVal);
            $(this).next(".custom-file-label").text(fieldVal);
        }
    });
    </script>
    {{-- Table --}}
    <script>
        $(document).ready(function () {
            $('.data_table').DataTable()
        });
    </script>
    {{-- Ck editor --}}
    <script>
        ClassicEditor
                .create( document.querySelector( '.ckEditor' ) )
                .then( editor => {
                        console.log( editor );
                } )
                .catch( error => {
                        console.log( error );
                } );
</script>


<script>
    $(document).ready(function () {
            $('.toast').toast('show');

            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": true,
                "progressBar": false,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
    });
</script>



</body>

</html>