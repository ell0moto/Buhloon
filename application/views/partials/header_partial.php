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

        <!--[if lte IE 8]>
        <script>
        // The ieshiv takes care of our ui.directives, bootstrap module directives and 
        // AngularJS's ng-view, ng-include, ng-pluralize and ng-switch directives.
        // However, IF you have custom directives (yours or someone else's) then
        // enumerate the list of tags in window.myCustomTags
     
        </script>
        <script src="js/vendor/angular-ui-ieshiv.js"></script>
        <![endif]-->

    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

    <div class="header" ng-controller="HeaderPartialCtrl">

        <div class="navbar navbar-fixed-top">
            <alert class="alertsBar" ng-repeat="alert in alerts" type="alert.type" close="closeAlert($index)">{{alert.msg}}</alert>
            <div class="navbar-inner">
                <div class="container">
                    <a class="brand"><img src ="<?= base_url() ?>/img/buhloonlogo_icon.png" /></a>
                    <form name="myForm" ng-hide="state" ng-submit="login()" class = "navbar-form pull-right" >
                        <input class="span2" type="text" name="userName" ng-model="username" place-holder-dir="Existing username">
<!--                        <span class="error" ng-show="myForm.userName.$error.required">Required!</span><br> -->
                        <input class="span2" type="password" name="passWord" ng-model="password" place-holder-dir="Password">
                        <button type="submit" class="btn" ng-click="login()">Sign in</button>
                    </form>

                    <div ng-show="state" class="nav-collapse collapse">
                        <ul class="nav pull-right">
                            <li><div class="clickBoxRewards" ng-click="openRewards()"></div><p>Rewards</p></li>
                            <li><div class="clickBoxPlans" ng-click="openPlans()"></div><p class="pNew">Add New</p></li>
                            <li><div class="clickBoxActivities" ng-click="openActivity()"></div><div class="redBarActivity" ng-show="notifications"></div><p class="pNew2">Activity</p></li>
                            <li><div class="clickBoxLogout" ng-click="logout()"></div><p>Logout</p></li>
                        </ul>
                    </div>
                </div>
            </div>    
        </div>

        <div modal="rewardsBox" options="opts">
            <div class="modal-header">
                <button type="button" class="close" ng-click="closeRewards()">×</button>
                <h3 id="myModalLabel">Set rewards<span>  (enter details for each form)</span></h3>
            </div>
            <div class="modal-body">
                <form class = "form-horizontal" id = "add-new-forms">
                    <div class="control-group">
                        <div class="controls controls-row">
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-gift"></i></span>
                                <input type="text" name="reward" ng-model="titleOfReward" place-holder-dir="Name of reward"/>
                                <span class="help-inline or-span"></span>
                            </div>
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-tags"></i></span>
                                <input type="text" name="ribbonCost" ng-model="ribbonCost" place-holder-dir="Reward cost"/>
                            </div>
                        </div>
                    </div>

                    <div class="tableContainer">
                        <table class="activitiesTable">
                            <thead class="activitiesHead">
                                <tr>
                                   <th>Rewards</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <hr>
                            <tbody class="activitiesBody">
                                <tr ng-repeat="reward in rewards">
                                    <td>{{reward.titleOfReward}}</td>
                                    <td class="ribbonCost">{{reward.ribbonCost}}</td>
                                    <td class="ribbonId">{{reward.id}}</td>
                                    <td><button type="button" ng-click="removeReward(reward.id)">×</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" ng-click="submitReward()">Create reward</button>
            </div>
        </div>

        <div modal="plansBox" options="opts">
            <div class="modal-header">
                <button type="button" class="close" ng-click="closePlans()">×</button>
                <h3 id="myModalLabel">Add new goal<span>  (enter details for each form)</span></h3>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id = "add-new-forms">
                <!-- <form id="add-new-forms" class="form-horizontal" accept-charset="utf-8" method="post" action="#"> -->
                    <fieldset>
                        <div class="control-group">
                            <div class="controls">
                                <div class="input-prepend">
                                    <span class="add-on"><i class="icon-tag"></i></span>
                                    <input type="text" id="form_username" name="title" ng-model="titleOfPlan" place-holder-dir="Name of goal" />
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <div class="input-prepend">
                                    <span class="add-on"><i class="icon-list-alt"></i></span>
                                    <input type="text" id="form_password" name="description" ng-model="description" place-holder-dir="Short description" />
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls controls-row">
                                <div class="input-prepend">
                                    <span class="add-on"><i class="icon-user"></i></span>
                                    <input type="text" id="form_password" name="name" ng-model="nameOfChild" place-holder-dir="New user" />
                                    <span class="help-inline or-span"> Or </span>
                                </div>
                                <select id="form_service" name="existing" ng-model="existingUser" place-holder-dir="Existing users">
                                    <option ng-repeat="child in children">{{child.nameOfChild}}</option>
                                    <option selected="selected">Existing users</option>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label iterations-label" for="form_progress"> Steps to achieve goal </label>
                                <div class="controls">
                                    <select id="form_service" class="iterations-form" name="iteration" ng-model="totalIteration" >
                                        <option selected="selected">1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                        <option>6</option>
                                        <option>7</option>
                                        <option>8</option>
                                        <option>9</option>
                                        <option>10</option>
                                    </select>
                                </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <div class="input-prepend">
                                    <span class="add-on"><i class="icon-gift"></i></span>
                                    <input type="text" id="form_password" name="specific_reward" ng-model="specificReward" place-holder-dir="Specific reward (or leave blank)" />
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label ribbins-label" for="form_progress"> Ribbons on completion </label>
                                <div class="controls">
                                    <select id="form_service" class="iterations-form" name="no_ribbon" ng-model="noRibbon" >
                                        <option selected="selected">0</option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                        <option>6</option>
                                        <option>7</option>
                                        <option>8</option>
                                        <option>9</option>
                                        <option>10</option>
                                    </select>
                                </div>
                        </div>

                    </fieldset>
                </form>
            </div>
            <div class="modal-footer">
                <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button> -->
                <button class="btn btn-primary" ng-click="submitPlan()" >Create goal</button>
            </div>
        </div>

        <div modal="activityBox" options="opts">
            <div class="modal-header">
                <button type="button" class="close" ng-click="closeActivity()">×</button>
                <h3 id="myModalLabel">Activity<span>  (oversee what has been happening)</span></h3>
            </div>
            <div class="modal-body">
                <div class="activityBox">
                    <div class="activityContainer">
                        <table class="activityTable">
                            <tbody>
                                <tr ng-repeat="note in notifications">
                                    <td>{{note.nameOfChild}}</td>
                                    <td>{{note.titleOfPlan}}</td>
                                    <td>{{note.percent}}</td>
                                    <td>{{note.specificReward}}</td>
                                    <td><button type="button" ng-click="removeNotification(note.id)">Seen</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
            <div class="modal-footer">
                <!-- <button class="btn" ng-click="get()" >Refresh</button> -->
                <!-- <button class="btn btn-primary" class="close" data-dismiss="modal" aria-hidden="true">Activity</button> -->
            </div>
        </div>



    </div> <!-- End of header -->