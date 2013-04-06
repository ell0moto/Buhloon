'use strict';

angular.module('Controllers')
	.controller('MainIndexCtrl', [
		'$scope',
		'PlansServ',
		function($scope, PlansServ){
			$scope.data = 'Plans!';
			
//Get all (according to specific id)
			PlansServ.get( 
				{
					// id:'9',
				},
				function(response){
					$scope.plansData = response.content; //references object .content and passes in it's array.
					console.log(response, '<- QUERY');
				},
				function(response){
					console.log('Error! Well this is hawkard'); //this comes from the failure function
				}
			);

//Post (create)
			$scope.submit = function() { //function expression

				var payload = {
					username: $scope.username,
					password: $scope.password,
				};

				PlansServ.save( 
					{}, //parameter passes in through URL
					payload,
					function(response){
						console.log(response, '<- SAVE');
					}
				);
			};
			

//Put
			PlansServ.update(
				{},
				{
					// userId:'',
					// titleOfReward: '',
					// ribbonCost: '',
				},
				function(response){
					console.log(response, '<- UPDATE');
				}
			);

//Delete
			PlansServ.remove(
				{
					// id:'8',
				},
				function(response){
					console.log(response, '<- REMOVE');
				}
			);
	
		}
	]);