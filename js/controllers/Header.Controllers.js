'use strict';

angular.module('Controllers')

	.controller('LogInOutSubCtrl', [
		'$scope',
		'$location',
		'UsersServ',
		function($scope, $location, UsersServ) {

			$scope.login = function() { //function expression

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
						$location.path('/main');
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
					$location.path('/');
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
	])

	.controller('IncentivesSubCtrl', [
		'$scope',
		'IncentivesServ',
		function($scope, IncentivesServ){

			//get
			$scope.get = function() {

				IncentivesServ.get( 
					{
						// id:'9',
					},
					function(response){
						$scope.incentivesData = response.content; //references object .content and passes in it's array.
						console.log(response, '<- QUERY');
					},
					function(response){
						console.log('Error! Well this is hawkard'); //this comes from the failure function
					}
				);

			};

			//Post (create)
			$scope.submit = function() {

				var payload = {
					titleOfReward: $scope.titleOfReward,
					ribbonCost: $scope.ribbonCost,
				};

				IncentivesServ.save( 
					{}, //parameter passes in through URL
					payload,
					function(response){
						console.log(response, '<- SAVE');
					}
				);
			};

			//Delete
			$scope.remove = function(id) { 

				console.log(id);

				IncentivesServ.remove(
					{
						id: id,
					},
					function(response){
						console.log(response, '<- REMOVE');
					}
				);
			};

		}
	]);