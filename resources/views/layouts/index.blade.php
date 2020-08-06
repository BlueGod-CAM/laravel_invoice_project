<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Target Material Design Bootstrap Admin Template</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href=""{{asset("assets/materialize/css/materialize.min.css")}}" media="screen,projection" />
    <!-- Bootstrap Styles-->
    <link href="{{asset("assets/css/bootstrap.css")}}" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link rel="stylesheet" href="{{asset("https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css")}}">
    <!-- Morris Chart Styles-->
    <link href="{{asset("assets/js/morris/morris-0.4.3.min.css")}}" rel="stylesheet" />
    <!-- Custom Styles-->
    <link href="{{asset("assets/css/custom-styles.css")}}" rel="stylesheet" />
    <!-- Google Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="{{asset("assets/js/Lightweight-Chart/cssCharts.css")}}">

</head>

<body>
<div id="wrapper">
    <nav class="navbar navbar-default top-navbar" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle waves-effect waves-dark" data-toggle="collapse" data-target=".sidebar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand waves-effect waves-dark" href="/dashboard"><i class="large material-icons">track_changes</i> <strong>target</strong></a>

            <div id="sideNav" href=""><i class="material-icons dp48">toc</i></div>
        </div>

    </nav>

    <!--/. NAV TOP  -->
    <nav class="navbar-default navbar-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav" id="main-menu">
                <li style="padding: 70px 0 0;">
                    <a href="/dashboard" class="waves-effect"><i class="fa fa-clock-o fa-fw"
                                                                 aria-hidden="true"></i>Dashboard</a>
                </li>
                <li>
                    <a href="/customer" class="waves-effect"><i class="fa fa-users fa-fw"
                                                                aria-hidden="true"></i>Customer</a>
                </li>
                <li>
                    <a href="/category" class="waves-effect"><i class="fa fa-table fa-fw"
                                                                aria-hidden="true"></i>Category</a>
                </li>
                <li>
                    <a href="/invoice" class="waves-effect"><i class="fa fa-fw  fa-money"
                                                               aria-hidden="true"></i>Invoice</a>
                </li>
                <li>
                    <a href="/invoice_item" class="waves-effect"><i class="fa fa-fw fa-bookmark"
                                                                    aria-hidden="true"></i>Invoice Item</a>
                </li>
                <li>
                    <a href="/item" class="waves-effect"><i class="fa fa-bitcoin fa-fw"
                                                            aria-hidden="true"></i>Item</a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                        <i class="fa fa-user fa-fw"
                           aria-hidden="true"></i>
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    {{--                            <a href="#"><i class="fa fa-fw fa-power-off"></i> Log Out</a>--}}
                </li>
            </ul>

        </div>

    </nav>
    <!-- /. NAV SIDE  -->

    <div id="page-wrapper">
        <div class="header">
            <h1 class="page-header">
                {{auth()->user()->name}}
            </h1>
            <ol class="breadcrumb">
                <li><a href="/dashboard">Dashboard</a></li>
                <li class="active">Data</li>
            </ol>

        </div>
        <div id="page-inner">
            @yield("content")
        </div>
        <!-- /. PAGE INNER  -->
    </div>
    <!-- /. PAGE WRAPPER  -->
</div>
<!-- /. WRAPPER  -->
<!-- JS Scripts-->
<!-- jQuery Js -->
<script src="{{asset("assets/js/jquery-1.10.2.js")}}"></script>

<!-- Bootstrap Js -->
<script src="{{asset("assets/js/bootstrap.min.js")}}"></script>

<script src="{{asset("assets/materialize/js/materialize.min.js")}}"></script>

<!-- Metis Menu Js -->
<script src="{{asset("assets/js/jquery.metisMenu.js")}}"></script>
<!-- Morris Chart Js -->
<script src="{{asset("assets/js/morris/raphael-2.1.0.min.js")}}"></script>
<script src="{{asset("assets/js/morris/morris.js")}}"></script>


<script src="{{asset("assets/js/easypiechart.js")}}"></script>
<script src="{{asset("assets/js/easypiechart-data.js")}}"></script>

<script src="{{asset("assets/js/Lightweight-Chart/jquery.chart.js")}}"></script>

<!-- Custom Js -->
<script src="{{asset("assets/js/custom-scripts.js")}}"></script>
@yield("script")

</body>

</html>
