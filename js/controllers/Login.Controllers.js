'use strict';

angular.module('Controllers')
	.controller('LoginIndexCtrl', [
		'$scope',
		'$location',
		'UsersServ',
		function($scope, $location, UsersServ) {

			$scope.submit = function() { //function expression

				var payload = {
					username: $scope.username,
					password: $scope.password,
				};

				//reset the submission errors!
				$scope.loginErrors = [];
				$scope.validationErrors = {};

				//Post (create)
				UsersServ.login(
					payload,

					function(successResponse) {

						console.log('Successfully Logged In');
						UsersServ.setUserData('id', successResponse.content);
						$location.path('/');
					},

					function(failureResponse) {

						if(failureResponse.data.code === 'validation_error') {
						console.log(failureResponse, 'Validation error')

						}
					}
				);

			};

			$scope.logout = function(){
				//get the id
				var userId = UsersServ.getUserData().id;
				if(typeof userId !== 'undefined'){
					console.log(userId, 'Successfully logged out');
					UsersServ.logout(userId);
				}
			};


			$scope.state = function(){
				var userId = UsersServ.getUserData().id;
				if(typeof userId == 'undefined'){
					return true;
				}else{
					return false;
				}
			};

		}
	]);