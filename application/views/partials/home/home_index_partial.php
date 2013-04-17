<script type="text/ng-template" id="home_index.html">

<div class="main" ng-controller="HomeIndexCtrl">

    

        <div id="myCarousel" class="carousel slide" data-interval="0">
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
            </ol>

            <div class="carousel-inner">
                <div class="active item">
                    <div class="vertical">
                        <div class="centered">
                            <h1>A tool to</h1>
                            <h1>encourage children</h1>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="vertical">
                        <div class="centered">
                        <alert class="alertsBar" id="homeIndexAlert" ng-repeat="alert in alerts" type="alert.type" close="closeAlert($index)">{{alert.msg}}</alert>
                                <!-- Start of forms -->
                            <form class="form-horizontal">
                                <fieldset>
                                    <div class="control-group">
                                        <div class="controls">
                                            <div class="input-prepend">
                                                <span class="add-on"><i class="icon-user"></i></span>
                                                <input type="text" name="username" ng-model="createUserName" place-holder-dir="Create a username here" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <div class="controls">
                                            <div class="input-prepend">
                                                <span class="add-on"><i class="icon-lock"></i></span>
                                                <input type="password" name="password" ng-model="createPassword" place-holder-dir="password" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions"> <!-- button -->
                                        <button class="btn btn-primary" ng-click="register()">Register</button>
                                    </div>
                                </fieldset>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

            <!-- <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a> -->
            <a class="carousel-control right" href="#myCarousel" data-slide="next"><p>Get started</p><p> its free &rsaquo;</p></a>
        </div>

        <div class="home-section2">
            <div class="top-bottom-pattern">
                <div class="vertical_horizontal">
                    <div class="centered">
                        <h1>Why?</h1>
                        <h2>We value the importance of teaching delayed gratification</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="home-section3">
            <div class="vertical">
                <div class="centered">
                    <h1>How it works</h1>
                    <ul class="three-icons">
                        <li><img src="<?= base_url() ?>/img/create_icon.png" /></li>
                        <li><img src="<?= base_url() ?>/img/encourage_icon.png" /></li>
                        <li><img src="<?= base_url() ?>/img/reward_icon.png" /></li>
                    </ul>
                </div>
            </div>
        </div> 

</div>
    
</script>
