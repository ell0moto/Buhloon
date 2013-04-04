'use strict';

//Page Level Controller
//Can have multiple mini controllers, similar to methods
angular.module('Controllers')
	.controller('HomeIndexCtrl', [
		'$scope',
		function($scope){
			$scope.data = 'HELLO!';
		}
	]);