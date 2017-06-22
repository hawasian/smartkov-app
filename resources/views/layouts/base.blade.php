<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Document</title>
    
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    
    <link href="https://fonts.googleapis.com/css?family=Jura|Ubuntu" rel="stylesheet">
    <link href="{{ secure_asset('/css/base.css') }}" rel="stylesheet"/>
    @yield('css')
</head>
<body>
    
<!--    Base CSS    -->
    <section class="hidden-sm hidden-md hidden-lg">
        <nav class="navbar navbar-inverse navbar-static-top navbar-mobile" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <h3 class="mobile-logo" >SMARTKOV <span class="blinker">&nbsp;&nbsp;</span> </h3>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
        
        <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="@yield('lHome')"><a href="{{ route('home') }}">Home</a></li>
                        <li class="@yield('lAbout')"><a href="{{ route('about') }}">About</a></li>
                        <li class="@yield('lIn')"><a href="{{ route('admin') }}">{{Auth::guest() ? "Login":"Edit"}}</a></li>
                        <li class="@yield('lOut')  {{ !Auth::guest() ? 'logout':'hidden' }}"><a href="{{ route('logout') }}">Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </section>
<div class="">
    <section class="col-sm-4 col-md-3 hidden-xs" id="desktop-nav">
        <div class="namespace">
            <div class="scanlines"></div>
            <h2 class="logo">SMARTKOV <span class="blinker">&nbsp;&nbsp;</span> </h2>
        </div>
        <div class = "menu">
            <div class="scanlines"></div>
            <ul class="nav nav-stacked nav-custom">
                <li class="@yield('lHome')"><a href="{{ route('home') }}">Home...</a></li>
                <li class="@yield('lAbout')"><a href="{{ route('about') }}">About...</a></li>
                <li class="@yield('lIn')"><a href="{{ route('admin') }}">{{Auth::guest() ? "Login...":"Edit..."}}</a></li>
                <li class="@yield('lOut')  {{ !Auth::guest() ? 'logout':'hidden' }}"><a href="{{ route('logout') }}">Logout...</a></li>
            </ul>
        </div>
        <div class="signature">
            <a href="https://www.connorkyoung.com">Copyright <i class="fa fa-copyright" aria-hidden="true"></i> 2017 Connor Young</a>
        </div>
    </section>
    <section class="col-sm-8 col-md-9 col-xs-12 col-xs-offset-0 col-sm-offset-4 col-md-offset-3">
        <div class="scanlines"></div>
        <div class="container-fluid content">
            
            @yield('body')
        </div>
    </section>
</div>
<!--    End  CSS    -->



<!--    Scripts    -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</body>
</html>