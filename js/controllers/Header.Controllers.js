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

				UsersServ.loginSession( //passing in arguments
					payload,

					function(successResponse) { //anonomous function call back

						console.log('Successfully Logged In');
						UsersServ.setUserData('id', successResponse.content);
						$location.path('/main');
					},

					function(failResponse) {

						console.log('Could not log in');
						
						//check if it is a validation error
						if(failResponse.data.code === 'validation_error'){
							
							if(Array.isArray(failResponse.data.content)){
							
								//if it is an array
								$scope.loginErrors = failResponse.data.content;
							
							}else{
							
								//else it's an object
								$scope.validationErrors = {
									username: failResponse.data.content.username,
									password: failResponse.data.content.password,
									rememberMe: failResponse.data.content.rememberMe
								};
							}
						}
					}
				);

			};

			$scope.logout = function(){

				UsersServ.logoutSession(UsersServ.getUserData().id);
				//$scope.$emit('authenticationDestroy', Us);
			};

			$scope.$on('authenticationProvided', function(event,args) { //authenticationProvided is a global event that is being listen to
				$scope.state = true; //anything attached to $scope.state is a model
			});

			$scope.$on('authenticationLogout', function(event,args) {
				$scope.state = false;
			});

		}
	])

	.controller('RewardsSubCtrl', [
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
						console.log('Error! Well this is hawkard'); //this comes from the fail function
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
	])

	.controller('ActivitySubCtrl', [
		'$scope',
		'NotificationsServ',
		function($scope, NotificationsServ){

			$scope.isCollapsed = true;

//Get all notices & obligations (according to specific id)
			$scope.get = function() {
			
				NotificationsServ.get( 
					{},
					function(response){

						$scope.noticesData = response.content; //references object .content and passes in it's array.
						console.log(response, '<- QUERY');
					},
					function(response){
						console.log('Error! Well this is hawkard'); //this comes from the failure function
					}
				);
			};

//Post (create) obligation
			$scope.submit = function() { //function expression

				// var payload = { //payload is an object, created via literal notation
				// 	titleOfPlan: $scope.titleOfPlan,
				// 	description: $scope.description,
				// 	nameOfChild: $scope.nameOfChild,
				// 	totalIteration: $scope.totalIteration,
				// 	specificReward: $scope.specificReward,
				// 	noRibbon: $scope.noRibbon,
				// 	progress: 0,
				// 	active: 0,
				// 	complete: 0,
				// };

				// NotificationsServ.save( //.save is a function being called
				// 	{}, //1st parameter passes in through URL
				// 	payload,
				// 	function(response){
				// 		console.log(response, '<- SAVE');
				// 	}
				// );
			};
			
			
// Put (update) obligation
			$scope.addItem = function(item) {

				// var values;
				// for (values in item) {
				// 	if (values === "progress") {
				// 		item[values] = (item[values] + 1);
				// 	}
				// 	if (values === "active") {
				// 		item[values] = 1;
				// 	}

				// };

				// if (item["progress"] === item["totalIteration"]) {
				// 	item["complete"] = 1;
				// };

				// console.log(item);

				// NotificationsServ.update(
				// 	{id:0,}, //Dummy data to satisfy RESTFUL
				// 	item,
				// 	function(response){
				// 		console.log(response, '<- UPDATE');
				// 	}
				// );

			};

//Soft delete notices & obligations
			$scope.remove = function(item) {

				item.active = 0;

				console.log(item);

				NotificationsServ.remove(
					{id:0,}, //Dummy data to satisfy RESTFUL
					item,
					function(response){
						console.log(response, '<- SOFT DELETE');
					}
				);
			};
	
		}
	]);