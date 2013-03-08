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

        
        
        <!-- Java script. "ajax.googleapis" is where google hosts jQuery files as it is faster that way -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.9.1.min.js"><\/script>')</script>
        <script src="<?= base_url() ?>/js/vendor/bootstrap.min.js"></script>

        <script src="<?= base_url() ?>/js/plugins.js"></script>
        <script src="<?= base_url() ?>/js/main.js"></script>

        <script>
            var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>

            <!-- Add New Modal -->
    <div id="add-new" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Add new task<span> (enter details for each form)</span></h3>
        </div>
        <div class="modal-body">
            
                            <form id="add-new-forms" class="form-horizontal" accept-charset="utf-8" method="post" action="#">
                                <fieldset>
                                    <div class="control-group">
                                        <div class="controls">
                                            <div class="input-prepend">
                                                <span class="add-on"><i class="icon-tag"></i></span>
                                                <input type="text" id="form_username" name="username" placeholder="Name of task" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <div class="controls">
                                            <div class="input-prepend">
                                                <span class="add-on"><i class="icon-list-alt"></i></span>
                                                <input type="text" id="form_password" name="password" placeholder="Short description" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <div class="controls controls-row">
                                            <div class="input-prepend">
                                                <span class="add-on"><i class="icon-user"></i></span>
                                                <input type="text" id="form_password" name="password" placeholder="New user" />
                                                <span class="help-inline or-span"> Or </span>
                                            </div>
                                            <select id="form_service" name="service" >
                                                <option> Ben </option>
                                                <option> Sally </option>
                                                <option selected="selected">Existing user</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label iterations-label" for="form_progress"> Iterations to acheive goal </label>
                                            <div class="controls">
                                                <select id="form_service" class="iterations-form" name="service" >
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
                                                <input type="text" id="form_password" name="password" placeholder="Specific Reward (or leave blank)" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label ribbins-label" for="form_progress"> Ribbins to reward </label>
                                            <div class="controls">
                                                <select id="form_service" class="iterations-form" name="service" >
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
                            </form>

        </div>
        <div class="modal-footer">
            <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button> -->
            <button class="btn btn-primary" class="close" data-dismiss="modal" aria-hidden="true">Create task</button>
        </div>
    </div> <!-- End of model -->

    </body>
</html>
