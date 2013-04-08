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
            <div class="navbar-inner" ng-controller="LogInOutSubCtrl">
                <div class="container">
                    <a class="brand" href="#"><img src ="<?= base_url() ?>/img/buhloonlogo_icon.png" /></a>

                        <form name="myForm" ng-show="state" ng-submit="login()" class = "navbar-form pull-right" >
                            <input class="span2" type="text" name="userName" ng-model="username" >
<!--                        <span class="error" ng-show="myForm.userName.$error.required">Required!</span><br> -->
                            <input class="span2" type="password" name="passWord" ng-model="password" >
                            <button type="submit" class="btn" id="login">Sign in</button>
                        </form>

                        <div ng-hide="state" class="nav-collapse collapse">
                            <ul class="nav pull-right">
                                <li><a href="main/#rewards" data-toggle="modal">Rewards</a></li>
                                <li><a href="main/#add-new" data-toggle="modal">Add New</a></li>
                                <li><a href="main/#activity" data-toggle="modal">Activity</a></li>
                                <li><a href="" ng-click="logout()">Logout</a></li>
                            </ul>
                        </div> 

                    </div>
                </div>
            </div>
    </div> <!-- End of header -->