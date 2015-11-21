<!-- Stored in resources/views/layouts/master.blade.php -->
<html ng-app="MaterialApp">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="A front-end template that helps you build fast, modern mobile web apps.">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Inventory - @yield('title')</title>
        <link rel="stylesheet" type="text/css" href="/bower_components/angular-material/angular-material.min.css">
        <link rel="stylesheet" type="text/css" href="/css/style.css">
    </head>
    <body>
        <section layout="row" flex>
            @section('bannerbar')
                <md-toolbar>
                    <h2>
          <span>Toolbar with Icon Buttons</span>
        </h2>
                </md-toolbar>
            @show
            @section('sidebar')
            <md-sidenav class="md-sidenav-left md-whiteframe-z2" md-component-id="left" md-is-locked-open="$mdMedia('gt-md')">
                <md-content layout-padding ng-controller="LeftCtrl">
                    <md-button ng-click="close()" class="md-primary" hide-gt-md>
                        Close Sidenav Left
                    </md-button>
                    <p hide-md show-gt-md>
                        This sidenav is locked open on your device. To go back to the default behavior,
                        narrow your display.
                    </p>
                </md-content>
            </md-sidenav>
            @show
            <main class="mdl-layout__content">
                @yield('content')
            </main>
        </section>
        <script type="text/javascript" src="/bower_components/angular/angular.min.js"></script>
        <script type="text/javascript" src="/bower_components/angular-animate/angular-animate.min.js"></script>
        <script type="text/javascript" src="/bower_components/angular-aria/angular-aria.min.js"></script>
        <script type="text/javascript" src="/bower_components/angular-material/angular-material.min.js"></script>
        <script type="text/javascript" src="/js/material_design_app.js"></script>
    </body>
</html>