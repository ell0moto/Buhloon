<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

    <footer class="home-footer">
        <div class="rainbow-bar">
            <div class="vertical">
                <div class="centered">
                    <h1> buhloon <span>&copy;</span> | 2013</h1>
                    <ul class="footer-links">
<!--                         <li><a href="#">Privacy</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="#">About</a></li> -->
                    </ul>
                </div>
            </div>
        </div>
    </footer>

        <!-- Client Side Templates -->
        <? Template::partial('home/home_index') ?>
        <? Template::partial('main/main_index') ?>

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
        <script src="js/vendor/angular-ui.min.js"></script>
        <script src="js/vendor/ui-bootstrap-tpls-0.2.0.min.js"></script>

        <!-- Shims and Shivs and Other Useful Things -->
        <!--[if lt IE 9]><script src="js/vendor/es5-shim.min.js"></script><![endif]-->
        <script src="js/vendor/es6-shim.min.js"></script>
        <!--[if lt IE 9]><script src="js/vendor/json3.min.js"></script><![endif]-->

        <? if(ENVIRONMENT == 'development'){ ?>
            <?
                Template::asset('js', 'js', array(
                    'js/vendor',
                    'js/main.min.js'
                ));
            ?>
        <? }elseif(ENVIRONMENT == 'production'){ ?>
            <script src="js/main.min.js"></script>
            <script>
                var _gaq=[['_setAccount','<?= $google_analytics_key ?>'],['_trackPageview']];
                (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
                g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
                s.parentNode.insertBefore(g,s)}(document,'script'));
            </script>
        <? } ?>

    </body>
</html>
