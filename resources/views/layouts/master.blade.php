<!-- Stored in resources/views/layouts/master.blade.php -->
<!DOCTYPE html>
    <!--[if IE 9 ]><html class="ie9"><![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Inventory - @yield('title')</title>
    
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
    </head>
    
    <body>
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
    
        <section id="main">
            <aside id="sidebar">
                <div class="sidebar-inner c-overflow">
                    <div class="profile-menu">
                        <a href="">
                            <div class="profile-pic">
                                <img src="/img/profile-pics/1.jpg" alt="">
                            </div>

                            <div class="profile-info">
                                Malinda Hollaway

                                <i class="zmdi zmdi-arrow-drop-down"></i>
                            </div>
                        </a>

                        <ul class="main-menu">
                            <li>
                                <a href="profile-about.html"><i class="zmdi zmdi-account"></i> View Profile</a>
                            </li>
                            <li>
                                <a href=""><i class="zmdi zmdi-input-antenna"></i> Privacy Settings</a>
                            </li>
                            <li>
                                <a href=""><i class="zmdi zmdi-settings"></i> Settings</a>
                            </li>
                            <li>
                                <a href=""><i class="zmdi zmdi-time-restore"></i> Logout</a>
                            </li>
                        </ul>
                    </div>

                    <ul class="main-menu">
                        <li><a href="index.html"><i class="zmdi zmdi-home"></i> Home</a></li>
                        <li><a href="typography.html"><i class="zmdi zmdi zmdi-format-underlined"></i> Typography</a></li>
                        <li class="sub-menu">
                            <a href=""><i class="zmdi zmdi-widgets"></i> Widgets</a>

                            <ul>
                                <li><a href="widget-templates.html">Templates</a></li>
                                <li><a class="active" href="widgets.html">Widgets</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href=""><i class="zmdi zmdi-view-list"></i> Tables</a>

                            <ul>
                                <li><a href="tables.html">Normal Tables</a></li>
                                <li><a href="data-tables.html">Data Tables</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href=""><i class="zmdi zmdi-collection-text"></i> Forms</a>

                            <ul>
                                <li><a href="form-elements.html">Basic Form Elements</a></li>
                                <li><a href="form-components.html">Form Components</a></li>
                                <li><a href="form-examples.html">Form Examples</a></li>
                                <li><a href="form-validations.html">Form Validation</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu active toggled">
                            <a href=""><i class="zmdi zmdi-swap-alt"></i>User Interface</a>
                            <ul>
                                <li><a href="colors.html">Colors</a></li>
                                <li><a href="animations.html">Animations</a></li>
                                <li><a href="box-shadow.html">Box Shadow</a></li>
                                <li><a href="buttons.html">Buttons</a></li>
                                <li><a href="icons.html">Icons</a></li>
                                <li><a class="active" href="alerts.html">Alerts</a></li>
                                <li><a href="notification-dialog.html">Notifications & Dialogs</a></li>
                                <li><a href="media.html">Media</a></li>
                                <li><a href="components.html">Components</a></li>
                                <li><a href="other-components.html">Others</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href=""><i class="zmdi zmdi-trending-up"></i>Charts</a>
                            <ul>
                                <li><a href="flot-charts.html">Flot Charts</a></li>
                                <li><a href="other-charts.html">Other Charts</a></li>
                            </ul>
                        </li>
                        <li><a href="calendar.html"><i class="zmdi zmdi-calendar"></i> Calendar</a></li>
                        
                        <li class="sub-menu">
                            <a href=""><i class="zmdi zmdi-image"></i>Photo Gallery</a>
                            <ul>
                                <li><a href="photos.html">Default</a></li>
                                <li><a href="photo-timeline.html">Timeline</a></li>
                            </ul>
                        </li>
                        
                        <li><a href="generic-classes.html"><i class="zmdi zmdi-layers"></i> Generic Classes</a></li>
                        <li class="sub-menu">
                            <a href=""><i class="zmdi zmdi-collection-item"></i> Sample Pages</a>
                            <ul>
                                
                                <li><a href="profile-about.html">Profile</a></li>
                                <li><a href="list-view.html">List View</a></li>
                                <li><a href="messages.html">Messages</a></li>
                                <li><a href="pricing-table.html">Pricing Table</a></li>
                                <li><a href="contacts.html">Contacts</a></li>
                                <li><a href="wall.html">Wall</a></li>
                                <li><a href="invoice.html">Invoice</a></li>
                                <li><a href="login.html">Login and Sign Up</a></li>
                                <li><a href="lockscreen.html">Lockscreen</a></li>
                                <li><a href="404.html">Error 404</a></li>
                                
                            </ul>
                        </li>
                    </ul>
                </div>
            </aside>
            
            
        
        
            <section id="content">
                <div class="container">
                    @yield('content')
                </div>
            </section>
        </section>
        
        <footer id="footer">
            Copyright &copy; 2015 Material Admin
            
            <ul class="f-menu">
                <li><a href="">Home</a></li>
                <li><a href="">Dashboard</a></li>
                <li><a href="">Reports</a></li>
                <li><a href="">Support</a></li>
                <li><a href="">Contact</a></li>
            </ul>
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
        <script src="/vendors/bower_components/jquery/dist/jquery.min.js"></script>
        <script src="/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        
        <script src="/vendors/bower_components/jquery.nicescroll/jquery.nicescroll.min.js"></script>
        <script src="/vendors/bower_components/Waves/dist/waves.min.js"></script>
        <script src="/vendors/bootstrap-growl/bootstrap-growl.min.js"></script>
        <script src="/vendors/bower_components/bootstrap-sweetalert/lib/sweet-alert.min.js"></script>
        
        <script src="/vendors/bower_components/moment/min/moment.min.js"></script>
        <script src="/vendors/bower_components/bootstrap-select/dist/js/bootstrap-select.js"></script>
        <script src="/vendors/bower_components/nouislider/distribute/jquery.nouislider.all.min.js"></script>
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
        
        <script src="/js/functions.js"></script>
        <script src="/js/demo.js"></script>
    </body>
</html>