'use strict';

var app = angular.module('App',[
	'Controllers'

]);

angular.module('Controllers', [
	'Home.Controllers',
]);

console.log('place');

//router
app.config(
	[
		'$routeProvider',
		'$locationProvider',
		function ($routerProvider, $locationProvider) {
			//time for routering!
			$routerProvider
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