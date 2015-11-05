<!-- Stored in resources/views/layouts/master.blade.php -->

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="A front-end template that helps you build fast, modern mobile web apps.">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Inventory - @yield('title')</title>
        <link rel="stylesheet" href="/node_modules/material-design-lite/material.min.css">
        <script src="/node_modules/material-design-lite/material.min.js"></script>
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,700italic,500italic,400italic,300italic,100italic,900,900italic' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="/css/style.css">
    </head>
    <body>

        <div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer">
        @section('bannerbar')
        <header class="mdl-layout__header">
            <div class="mdl-layout-icon"></div>
            <div class="mdl-layout__header-row">
                <span class="mdl-layout__title">@yield('header_title')</span>
                <div class="mdl-layout-spacer"></div>
            </div>
        </header>
        @show
        
        @section('sidebar')
        <div class="mdl-layout__drawer">
            <span class="mdl-layout__title">Material Design Lite</span>
            <nav class="mdl-navigation">
                <a class="mdl-navigation__link" href="#">Hello</a>
                <a class="mdl-navigation__link" href="#">World.</a>
                <a class="mdl-navigation__link" href="#">How</a>
                <a class="mdl-navigation__link" href="#">Are</a>
                <a class="mdl-navigation__link" href="#">You?</a>
            </nav>
        </div>
        @show
      <main class="mdl-layout__content">
        @yield('content')
      </main>
    </div>
    </body>
</html>