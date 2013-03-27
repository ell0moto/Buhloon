'use strict';

var app = angular.module('App', [
	'Controllers',
	'Filters',
	'Services',
	'Directives',
	'ngResource',
	'ngCookies'
]);

//Define all the page level controllers (Application Logic)
angular.module('Controllers', [
	'Home.Controllers'
]);
//Define all shared services (Interaction with Backend)
angular.module('Services', [
]);
//Define all shared directives (UI Logic)
angular.module('Directives', [
]);
//Define all shared filters (UI Filtering)
angular.module('Filters', [
]);

//router
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
				.otherwise(
					{
						redirectTo: '/'
					}
				);
			
		}
	]
);

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
