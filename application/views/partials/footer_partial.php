<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

    <footer class="home-footer">
        <div class="rainbow-bar">
            <div class="vertical">
                <div class="centered">
                    <h1> buhloon <span>&copy;</span> | 2013</h1>
                    <ul class="footer-links">
                        <li><a href="#">Privacy</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="#">About</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- Rewards Modal -->
    <div id="rewards" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Specific rewards<span>  (enter details for each form)</span></h3>
        </div>
        <div class="modal-body">
                            <form class = "form-horizontal" id = "add-new-forms">
                            <!-- <form id="add-new-forms" class="form-horizontal" accept-charset="utf-8" method="post" action="#"> -->
                                <fieldset>
                                    <div class="control-group">
                                        <div class="controls controls-row">
                                            <div class="input-prepend">
                                                <span class="add-on"><i class="icon-gift"></i></span>
                                                <input type="text" name="title" placeholder="Reward name" />
                                                <span class="help-inline or-span"></span>
                                            </div>
                                            <div class="input-prepend">
                                                <span class="add-on"><i class="icon-tags"></i></span>
                                                <input type="text" name="ribbon_cost" placeholder="Number of ribbons for reward" />
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                    <div class="modal-footer">
                                        <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button> -->
                                        <button class="btn btn-primary" type='submit' value='true' name='submit' aria-hidden="true">Create reward</button>
                                    </div>
                            </form>
        </div>
    </div> <!-- End of model -->

    <!-- Activity Modal -->
    <div id="activity" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Activity<span>  (oversee what has been happening)</span></h3>
        </div>
        <div class="modal-body">
            <!-- Insert dynamic content -->
        </div>
        <div class="modal-footer">
            <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button> -->
            <!-- <button class="btn btn-primary" class="close" data-dismiss="modal" aria-hidden="true">Create reward</button> -->
        </div>
    </div> <!-- End of model -->

            <!-- Add New Modal -->
    <div id="add-new" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Add new goal<span>  (enter details for each form)</span></h3>
        </div>
        <div class="modal-body">
                            <form class="form-horizontal" id = "add-new-forms" >
                            <!-- <form id="add-new-forms" class="form-horizontal" accept-charset="utf-8" method="post" action="#"> -->
                                <fieldset>
                                    <div class="control-group">
                                        <div class="controls">
                                            <div class="input-prepend">
                                                <span class="add-on"><i class="icon-tag"></i></span>
                                                <input type="text" id="form_username" name="title" placeholder="Name of goal" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <div class="controls">
                                            <div class="input-prepend">
                                                <span class="add-on"><i class="icon-list-alt"></i></span>
                                                <input type="text" id="form_password" name="description" placeholder="Short description" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <div class="controls controls-row">
                                            <div class="input-prepend">
                                                <span class="add-on"><i class="icon-user"></i></span>
                                                <input type="text" id="form_password" name="name" placeholder="New user" />
                                                <span class="help-inline or-span"> Or </span>
                                            </div>
                                            <select id="form_service" name="service" > <!-- Will need to work on with dynamic content -->
                                                <option> Ben </option>
                                                <option> Sally </option>
                                                <option selected="selected">Existing user</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label iterations-label" for="form_progress"> Steps before achieving goal </label>
                                            <div class="controls">
                                                <select id="form_service" class="iterations-form" name="iteration" >
                                                    <option selected="selected"> 1 </option>
                                                    <option> 2 </option>
                                                    <option> 3 </option>
                                                    <option> 4 </option>
                                                    <option> 5 </option>
                                                    <option> 6 </option>
                                                    <option> 7 </option>
                                                    <option> 8 </option>
                                                    <option> 9 </option>
                                                    <option> 10 </option>
                                                </select>
                                            </div>
                                    </div>
                                    <div class="control-group">
                                        <div class="controls">
                                            <div class="input-prepend">
                                                <span class="add-on"><i class="icon-gift"></i></span>
                                                <input type="text" id="form_password" name="specific_reward" placeholder="Specific reward (or leave blank)" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label ribbins-label" for="form_progress"> Ribbons on completion </label>
                                            <div class="controls">
                                                <select id="form_service" class="iterations-form" name="no_ribbon" >
                                                    <option selected="selected"> 1 </option>
                                                    <option> 2 </option>
                                                    <option> 3 </option>
                                                    <option> 4 </option>
                                                    <option> 5 </option>
                                                    <option> 6 </option>
                                                    <option> 7 </option>
                                                    <option> 8 </option>
                                                    <option> 9 </option>
                                                    <option> 10 </option>
                                                </select>
                                            </div>
                                    </div>

                                </fieldset>
                                <div class="modal-footer">
                                    <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button> -->
                                    <button class="btn btn-primary" type='submit' value='true' name='submit' aria-hidden="true">Create goal</button>
                                </div>
                            </form>
        </div>

    </div> <!-- End of model -->


        <!-- Client Side Templates -->
        <? Template::partial('home/home_index'); ?>
        <? Template::partial('dummy/dummy_index') ?>
        <? Template::partial('incentives/incentives_index') ?>

        <!-- Pass in PHP variables to Javascript -->
        <script>
            var serverVars = {
                baseUrl: '<?= base_url() ?>',
                csrfCookieName: '<?= $this->config->item('cookie_prefix') . $this->config->item('csrf_cookie_name') ?>'
            };
        </script>
        
    	<!-- Vendor Javascripts -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.9.1.min.js"><\/script>')</script>
		<script src="js/vendor/bootstrap.min.js"></script>
		<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.0.5/angular.min.js"></script>
		<script>window.angular || document.write('<script src="js/vendor/angular.min.js"><\/script>')</script>
		<script src="js/vendor/angular-resource.min.js"></script>
		<script src="js/vendor/angular-cookies.min.js"></script>

        <!-- Shims and Shivs and Other Useful Things -->
        <!--[if lt IE 9]><script src="js/vendor/es5-shim.min.js"></script><![endif]-->
        <script src="js/vendor/es6-shim.min.js"></script>
        <!--[if lt IE 9]><script src="js/vendor/json3.min.js"></script><![endif]-->
        
        <!-- AngularJS Front Controller, Bootstrap and Router -->
        <script src="js/app.js"></script>

        <!-- Page Level Controllers -->
        <script src="js/controllers/Home.Controllers.js"></script>
        <script src="js/controllers/Dummy.Controllers.js"></script>
        <script src="js/controllers/Incentives.Controllers.js"></script>
        <script src="js/controllers/Login.Controllers.js"></script>

        <!-- Reusable Services -->
        <script src="js/services/Dummy.Service.js"></script>
        <script src="js/services/Incentives.Service.js"></script>
        <script src="js/services/Auth.Service.js"></script>
        <script src="js/services/Sessions.Service.js"></script>
        <script src="js/services/Users.Service.js"></script>

        <!-- Reusable Directives -->

        <!-- Reusable Filters -->

        <script>
            var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>

    </body>
</html>
