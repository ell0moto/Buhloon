'use strict';

//Page level controllers
//Can have multiple mini controllers, simlar to methods

angular.module('Home.Controllers', ['Home.Controllers.Index']);

//Define the default index "method" for the Home.Controllers
//Called HomeIndexCtrl

angular.module('Home.Controllers.Index', [])
	.controllers('HomeIndexCtrl', [
		'$scope',
		function($scope) {
			$scope.data = 'Hello';
			console.log('something');
		}

	]);

