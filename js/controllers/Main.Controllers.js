'use strict';

angular.module('Controllers')
	.controller('MainIndexCtrl', [
		'$scope',
		'OperationsServ',
		function($scope, OperationsServ){
			$scope.data = 'Plans!';

//Get all (according to specific id)
			$scope.get = function() {
			
				OperationsServ.get( 
					{},
					function(response){
						$scope.plansData = response.content; //references object .content and passes in it's array.
						console.log(response, '<- QUERY');
					},
					function(response){
						console.log('Error! Well this is hawkard'); //this comes from the failure function
					}
				);
			};

//Post (create)
			$scope.submit = function() { //function expression

				var payload = {
					titleOfPlan: $scope.titleOfPlan,
					description: $scope.description,
					nameOfChild: $scope.nameOfChild,
					totalIteration: $scope.totalIteration,
					specificReward: $scope.specificReward,
					noRibbon: $scope.noRibbon,
				};

				console.log(payload);

				OperationsServ.save( 
					{}, //parameter passes in through URL
					payload,
					function(response){
						console.log(response, '<- SAVE');
					}
				);
			};
			

//Put
			$scope.update = function() {
				OperationsServ.update(
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
			};

//Delete
			$scope.remove = function() {
				OperationsServ.remove(
					{
						// id:'8',
					},
					function(response){
						console.log(response, '<- REMOVE');
					}
				);
			};
	
		}
	]);