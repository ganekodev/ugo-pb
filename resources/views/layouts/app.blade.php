<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{config('app.name', 'THMS')}}</title>
        <link rel="icon" type="image/x-icon" href="{{asset('/images/favicon/favicon.ico')}}">
        <link rel="stylesheet" href="{{asset('/vendor/bootstrap5.1/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{ asset('/vendor/datatables/css/datatables.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/vendor/bootstrap5.1/css/dashboard.css') }}">
        <link rel="stylesheet" type="text/css" href="{{asset('/vendor/datatables/css/jquery.dataTables.min.css')}}">
        <link type="text/css" rel="stylesheet" href="{{ asset('/vendor/font-awesome/css/fontawesome.css') }}">
        <link type="text/css" rel="stylesheet" href="{{ asset('/vendor/font-awesome/css/brands.css') }}">
        <link type="text/css" rel="stylesheet" href="{{ asset('/vendor/font-awesome/css/solid.css') }}">
        <link type="text/css" rel="stylesheet" href="{{ asset('/vendor/sweetalert2/css/sweetalert2.min.css') }}">
        <link type="text/css" rel="stylesheet" href="{{ asset('/vendor/sweetalert2/css/animate.min.css') }}">
        <link rel="stylesheet" href="{{asset('/css/mystyle/style.css')}}">
        <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
        <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
        <style>
            div {
                padding: 0;
            }
            body {
                font-family: 'Roboto';
            }
            .bd-placeholder-img {
                font-size: 1.125rem;
                text-anchor: middle;
                -webkit-user-select: none;
                -moz-user-select: none;
                user-select: none;
            }
            .hide-sidebar {
                margin-left: -16.66%;
                transition: 1s;
            }
            .show-sidebar, .stretch-main-content{
                margin-left: 0;
                transition: 1s;
            }
            .shrink-main-content {
                margin-left: 16.66%;
                transition: 1s;
            }
            #report{
                width:97%;
                margin:0 auto;
            }
            #report .scroller{
                padding: 0 auto;
            }
            .bg-orange {
                background-color: #FFA500 !important;
                color: white !important;
            }
            .bg-light-orange {
                background-color: rgba(255, 155, 0, 0.5) !important;
                color: black !important;
            }
            input[type=text].form-control,
            input[type=password].form-control {
                border-color: gray;
                height: 0.7rem;
                font-size: 0.8rem;
            }
            input[type=text].form-control:focus,
            input[type=password].form-control:focus {
                box-shadow: 1px 1px rgb(97, 96, 96);
                height: 0.7rem;
                font-size: 0.8rem;
                font-weight: 500;
            }
            /* laptop */
            @media(max-width: 1366px){
                html{
                    font-size: 75%;
                }
            }
            /* tablet */
            @media(max-width: 758px){
                .bd-placeholder-img-lg {
                    font-size: 3.5rem;
                }
              /* layout */
                #sidebarMenu.show-sidebar{
                    display:none;
                }
                .hide-sidebar{
                    top:-0.5rem;
                    margin-left:0.2rem;
                    display:block!important;
                }
                .shrink-main-content{
                    margin-left:0;
                }
                .stretch-main-content{
                    margin-left:8rem;
                }
              /* dashboard */
                .dashboard{
                    display:flex;
                    padding: 5rem 2rem;
                    text-align: center;
                }
                .dash{
                    margin-top:-2rem;
                    margin-bottom:-3rem;
                }
                .dash-card{
                    flex: 1 1 45rem;
                    flex-wrap: wrap;
                    width:100%!important;
                    margin:0.2rem auto;
                }
              /* form */
                #btn_add button{
                    margin-bottom:0.5rem;
                }
                #btn-filter{
                    display:block!important;
                }
                #filter .d-flex{
                    flex-wrap: wrap;
                }
                #filter .d-flex .form-control{
                    max-width:3rem;
                }
                .card .row-detail,.fieldset .row-detail{
                    margin-bottom:-0.3rem!important;
                }
                .card .detail,.fieldset .detail, .fieldset .img{
                    width:13rem!important;
                }
                .card .col,.card .form-control,.fieldset .col, .fieldset .form-control, #btn_price_check{
                    width:20rem!important;
                }
                #price_check i{
                    display:none;
                }
                #footer .row{
                    text-align:center!important;
                }
                #footer .col{
                    width:24%!important;
                }
                #footer b{
                    font-size:0.57rem!important;
                }
              /* report */
                #report{
                    width:90%;
                }
                #report .scroller{
                    position:relative;overflow:auto;
                }
                #report .filter{
                    max-width:7rem;padding:0px 0px;
                }
                #report #order_date_filter{
                    padding:0rem -3rem 0rem 0rem;
                }
                #report table{
                    text-align:left!important;
                }
                #monthChart{
                    min-height:auto;
                }
            }
            /* mobile phone*/
            @media(max-width: 450){
                html{
                    font-size: 55%;
                }
            }
        </style>
    </head>
    <script src="{{ asset('/js/image-zoomer/panzoom.min.js') }}"></script>
    <body>
        <div id="app">
            @include('inc.navbar')
            @include('inc.sidebar')
            <main id="main-app" class="col-md-10s col-lg-10s ms-sm-autos p-2 shrink-main-content">
                @yield('content')
            </main>
        </div>
        <script src="{{asset('/js/app.js')}}"></script>
        <script src="{{asset('/vendor/bootstrap5.1/js/bootstrap.bundle.min.js')}}"></script>
        <script>
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });
            $(document).on('click', '#btn_hamburger_menu', function() {
                $('#sidebarMenu').toggleClass('show-sidebar');
                $('#sidebarMenu').toggleClass('hide-sidebar');
                $('#main-app').toggleClass('shrink-main-content');
                $('#main-app').toggleClass('stretch-main-content');
            });
            $(document).on('click', '#btn_sidebar_toggler', function() {
                $('#navbar_brand').toggleClass('hide-sidebar');
                $('#navbar_brand').toggleClass('show-sidebar');
                $('#sidebarMenu').toggleClass('hide-sidebar');
                $('#sidebarMenu').toggleClass('show-sidebar');
                $('#main-app').toggleClass('shrink-main-content');
                $('#main-app').toggleClass('stretch-main-content');
                $('.fixed-bottom').toggleClass('shrink-main-content');
                $('.fixed-bottom').toggleClass('stretch-main-content');
            });
        </script>
    </body>
</html>
