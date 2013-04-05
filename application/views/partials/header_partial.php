<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" ng-app="App"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" ng-app="App"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" ng-app="App"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" ng-app="App"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>buhloon</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
<!--    <meta name="google-site-verification" content="<?= $google_site_verification ?>" /> -->

        <link rel="stylesheet" href="css/main.css" >
        <link rel="shortcut icon" href="favicon.ico">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script> <!-- Tests to check if browser can handle types of Java Scrip -->
        <base href="<?= base_url() ?>" />
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->
    <div class="header">
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <!-- <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a> -->
                    <a class="brand" href="#"><img src ="<?= base_url() ?>/img/buhloonlogo_icon.png" /></a>
                    <!-- <div class="nav-collapse collapse"> -->
                        <!-- <ul class="nav">
                            <li class="active"><a href="#">Home</a></li>
                            <li><a href="#about">About</a></li>
                            <li><a href="#contact">Contact</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Action</a></li>
                                    <li><a href="#">Another action</a></li>
                                    <li><a href="#">Something else here</a></li>
                                    <li class="divider"></li>
                                    <li class="nav-header">Nav header</li>
                                    <li><a href="#">Separated link</a></li>
                                    <li><a href="#">One more separated link</a></li>
                                </ul>
                            </li>
                        </ul> -->
                        <? if(!$this->ion_auth->logged_in()): ?> <!-- Condition statement showing login or header text -->
                        <form class = "navbar-form pull-right" >
                            <input class="span2" type="text" name="username" placeholder="User Name">
                            <input class="span2" type="password" name="password" placeholder="Password">
                            <button type="submit" class="btn">Sign in</button>
                        </form>
                            <div ng-controller="SessionsCtrl">
                            <form name="myForm">
                            User name: <input type="text" name="userName" ng-model="user.name" required>
                            <span class="error" ng-show="myForm.userName.$error.required">Required!</span><br>
                            </form>
                            </div>

                        <? else: ?>
                        <div class="nav-collapse collapse">
                            <ul class="nav pull-right">
                                <li><a href="#rewards" data-toggle="modal">Rewards</a></li>
                                <li><a href="#add-new" data-toggle="modal">Add New</a></li>
                                <li><a href="#activity" data-toggle="modal">Activity</a></li>
                                <li><a href="<?= base_url() ?>/sessions/logout">Logout</a></li>
                                <!-- <li><a href="#contact">Contact</a></li> -->
                            </ul>
                        </div> 
                        <? endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End of header -->