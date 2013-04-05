'use strict';

angular.module('Controllers')
	.controller('SessionsCtrl', [
		'$scope',

		function ($scope) {
  			$scope.user = {name: 'guest'};
		}
	]);