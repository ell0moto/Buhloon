'use strict';

var app = angular.module('App', [
	'Controllers',


]);

angular.module('Controllers', [
	'Home.Controllers',
]);

//router
app.config(
	[
		'$routeProvider',
		'$locationProvider',
		function ($routeProvider, $locationProvider) {

			//HTML5 mode URLS I believe it removes /#/ hashbang
			$locationProvider.html5Mode (true).hashPrefix('!');

			//Routing
			$routeProvider
				.when(
					'/', 
					{
						templateUrl:'home_index.html',
						controller:'HomeIndexCtrl'
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