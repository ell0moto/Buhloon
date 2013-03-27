'use strict';

//Page Level Controller
//Can have multiple mini controllers, similar to methods
angular.module('Dummy.Controllers', ['Dummy.Controllers.Index']);

//Define the default index "method" for the the Home.Controllers
//Called HomeIndexCtrl
angular.module('Dummy.Controllers.Index', [])
	.controller('DummyIndexCtrl', [
		'$scope',
		function($scope){
			$scope.data = 'HELLO!';
		}
	]);