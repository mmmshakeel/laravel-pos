<!-- Stored in resources/views/layouts/master.blade.php -->
<!DOCTYPE html>
    <!--[if IE 9 ]><html class="ie9"><![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>Inventory - @yield('title')</title>

        <script src="/vendors/bower_components/jquery/dist/jquery.min.js"></script>

        <!-- Vendor CSS -->
        <link href="/vendors/bower_components/animate.css/animate.min.css" rel="stylesheet">
        <link href="/vendors/bower_components/bootstrap-sweetalert/lib/sweet-alert.css" rel="stylesheet">
        <link href="/vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css" rel="stylesheet">

        <link href="/vendors/bower_components/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet">
        <link href="/vendors/bower_components/nouislider/distribute/jquery.nouislider.min.css" rel="stylesheet">
        <link href="/vendors/bower_components/summernote/dist/summernote.css" rel="stylesheet">
        <link href="/vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
        <link href="/vendors/farbtastic/farbtastic.css" rel="stylesheet">
        <link href="/vendors/chosen_v1.4.2/chosen.min.css" rel="stylesheet">

        <!-- CSS -->
        <link href="/css/app.min.1.css" rel="stylesheet">
        <link href="/css/app.min.2.css" rel="stylesheet">
        <link href="/css/custom-style.css" rel="stylesheet">
    </head>

    <body>
        @section('header')
        <header id="header">
            <ul class="header-inner">
                <li id="menu-trigger" data-trigger="#sidebar">
                    <div class="line-wrap">
                        <div class="line top"></div>
                        <div class="line center"></div>
                        <div class="line bottom"></div>
                    </div>
                </li>

                <li class="logo hidden-xs">
                    <a href="index.html">Inventory Admin</a>
                </li>

                <li class="pull-right">
                <ul class="top-menu">

                    <li class="dropdown">
                        <a data-toggle="dropdown" class="tm-notification" href="">
                            <i class="tmn-counts">9</i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg pull-right">
                            <div class="list-group lv-body">
                                <div class="lv-header">
                                        Notifications
                                    </div>
                            </div>
                        </div>
                    </li>

                    <li id="toggle-width">
                        <div class="toggle-switch">
                            <input id="tw-switch" type="checkbox" hidden="hidden">
                            <label for="tw-switch" class="ts-helper"></label>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="tm-settings" href=""></a>
                        <ul class="dropdown-menu dm-icon pull-right">
                            <li class="hidden-xs">
                                <a data-action="fullscreen" href=""><i class="zmdi zmdi-fullscreen"></i> Toggle Fullscreen</a>
                            </li>
                            <li>
                                <a data-action="clear-localstorage" href=""><i class="zmdi zmdi-delete"></i> Clear Local Storage</a>
                            </li>
                            <li>
                                <a href=""><i class="zmdi zmdi-face"></i> Privacy Settings</a>
                            </li>
                            <li>
                                <a href=""><i class="zmdi zmdi-settings"></i> Other Settings</a>
                            </li>
                        </ul>
                    </li>

                </li>
            </ul>
        </header>
        @show

        <section id="main">
            @section('sidebar')
                @include('layouts.mainnav')
            @show


            <section id="content">
                <div class="container">
                    @yield('content')
                </div>
            </section>
        </section>

        <footer id="footer">

        </footer>

        <!-- Older IE warning message -->
        <!--[if lt IE 9]>
            <div class="ie-warning">
                <h1 class="c-white">Warning!!</h1>
                <p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers to access this website.</p>
                <div class="iew-container">
                    <ul class="iew-download">
                        <li>
                            <a href="http://www.google.com/chrome/">
                                <img src="img/browsers/chrome.png" alt="">
                                <div>Chrome</div>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.mozilla.org/en-US/firefox/new/">
                                <img src="img/browsers/firefox.png" alt="">
                                <div>Firefox</div>
                            </a>
                        </li>
                        <li>
                            <a href="http://www.opera.com">
                                <img src="img/browsers/opera.png" alt="">
                                <div>Opera</div>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.apple.com/safari/">
                                <img src="img/browsers/safari.png" alt="">
                                <div>Safari</div>
                            </a>
                        </li>
                        <li>
                            <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                                <img src="img/browsers/ie.png" alt="">
                                <div>IE (New)</div>
                            </a>
                        </li>
                    </ul>
                </div>
                <p>Sorry for the inconvenience!</p>
            </div>
        <![endif]-->

        <!-- Javascript Libraries -->
        <script src="/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

        <script src="/vendors/bower_components/jquery.nicescroll/jquery.nicescroll.min.js"></script>
        <script src="/vendors/bower_components/Waves/dist/waves.min.js"></script>
        <script src="/vendors/bootstrap-growl/bootstrap-growl.min.js"></script>
        <script src="/vendors/bower_components/bootstrap-sweetalert/lib/sweet-alert.min.js"></script>

        <script src="/vendors/bower_components/flot/jquery.flot.js"></script>
        <script src="/vendors/bower_components/flot/jquery.flot.resize.js"></script>
        <script src="/vendors/bower_components/flot.curvedlines/curvedLines.js"></script>
        <script src="/vendors/sparklines/jquery.sparkline.min.js"></script>
        <script src="/vendors/bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js"></script>

        <script src="/vendors/bower_components/moment/min/moment.min.js"></script>
        <script src="/vendors/bower_components/bootstrap-select/dist/js/bootstrap-select.js"></script>
        <script src="/vendors/bower_components/nouislider/distribute/jquery.nouislider.all.min.js"></script>
        <script src="/vendors/bower_components/simpleWeather/jquery.simpleWeather.min.js"></script>
        <script src="/vendors/bower_components/summernote/dist/summernote.min.js"></script>
        <script src="/vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
        <script src="/vendors/bower_components/typeahead.js/dist/typeahead.bundle.min.js"></script>

        <!-- Placeholder for IE9 -->
        <!--[if IE 9 ]>
            <script src="/vendors/bower_components/jquery-placeholder/jquery.placeholder.min.js"></script>
        <![endif]-->

        <script src="/vendors/chosen_v1.4.2/chosen.jquery.min.js"></script>
        <script src="/vendors/fileinput/fileinput.min.js"></script>
        <script src="/vendors/input-mask/input-mask.min.js"></script>
        <script src="/vendors/farbtastic/farbtastic.min.js"></script>
        <script src="/vendors/bootgrid/jquery.bootgrid.min.js"></script>

        <script src="/js/flot-charts/curved-line-chart.js"></script>
        <script src="/js/flot-charts/line-chart.js"></script>

        <script src="/js/functions.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                $("#l-login").addClass('hidden');
                var a = location.pathname.split("/");

                if (a[1] == 'login') {
                    $('body').addClass('login-content');
                    $("#l-login").removeClass('hidden');

                    $('body').removeClass('toggled sw-toggled');
                }

                if (a[2] == 'print') {
                    $('body').removeClass('toggled sw-toggled');
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            });

            function growlNotify(title, message, type){
                $.growl({
                    title: ' ' + title + ' ',
                    message: message,
                    url: ''
                    },{
                        element: 'body',
                        type: type,
                        allow_dismiss: true,
                        offset: {
                            x: 20,
                            y: 85
                        },
                        spacing: 10,
                        z_index: 1031,
                        delay: 2500,
                        timer: 1000,
                        url_target: '_blank',
                        mouse_over: false,
                        icon_type: 'class',
                        template: '<div data-growl="container" class="alert" role="alert">' +
                                        '<button type="button" class="close" data-growl="dismiss">' +
                                            '<span aria-hidden="true">&times;</span>' +
                                            '<span class="sr-only">Close</span>' +
                                        '</button>' +
                                        '<span data-growl="icon"></span>' +
                                        '<span data-growl="title"></span>' +
                                        '<span data-growl="message"></span>' +
                                        '<a href="#" data-growl="url"></a>' +
                                    '</div>'
                });
            }
        </script>
    </body>
</html>
