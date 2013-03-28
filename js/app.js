'use strict';

/* ==========================================================================
   BOOTSTRAPPER
   ========================================================================== */

//app is an module that is dependent on several top level modules
var app = angular.module('App', [
	'Controllers',
	'Filters',
	'Services',
	'Directives',
	'ngResource',
	'ngCookies',
]);

//Define all the page level controllers (Application Logic)
angular.module('Controllers', [
	'Home.Controllers',
	'Dummy.Controllers'
]);

//Define all shared services (Interaction with Backend)
angular.module('Services', [
	'Dummy.Service'
]);

//Define all shared directives (UI Logic)
angular.module('Directives', [
]);

//Define all shared filters (UI Filtering)
angular.module('Filters', [
]);



/* ==========================================================================
   ROUTER
   ========================================================================== */

//Define all routes here and which page level controller should handle them
app.config(
	[
		'$routeProvider',
		'$locationProvider',
		function($routeProvider, $locationProvider) {
			
			//HTML5 Mode URLs
			$locationProvider.html5Mode(true).hashPrefix('!');
			
			//Routing
			$routeProvider
				.when(
					'/',
					{
						templateUrl: 'home_index.html',
						controller: 'HomeIndexCtrl'
					}
				)
				.when(
					'/dummy',
					{
						templateUrl: 'dummy_index.html',
						controller: 'DummyIndexCtrl'
					}
				)
				.otherwise(
					{
						redirectTo: '/'
					}
				);
			
		}
	]
);


/* ==========================================================================
   GLOBAL FEATURES
   ========================================================================== */

app.run([
	'$rootScope',
	'$cookies',
	'$http',
	function($rootScope, $cookies, $http){
	
		//XSRF INTEGRATION
		
		$rootScope.$watch(
			function(){
				return $cookies[serverVars.csrfCookieName];
			},
			function(){
				$http.defaults.headers.common['X-XSRF-TOKEN'] = $cookies[serverVars.csrfCookieName];
			}
		);
		
		
		//XHR ERROR HANDLER
		
	}
]);
