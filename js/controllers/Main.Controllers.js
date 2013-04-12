'use strict';

angular.module('Controllers')
	.controller('MainIndexCtrl', [
		'$scope',
		'OffspringServ',
		function($scope, OffspringServ){

			//Get all children (according to specific id)
			OffspringServ.get( 
				{},
				function(response){

					$scope.children = response.content; //references object .content and passes in it's array.
					console.log($scope.children, '<- QUERY');
				},
				function(response){
					console.log('Error! No children'); //this comes from the failure function
				}
			);
		}
	])

	.controller('ChildrenSubCtrl', [
		'$scope',
		'OperationsServ',
		function($scope, OperationsServ){

			$scope.child.id

			//Get all plans (according to child id)
			OperationsServ.get( 
				{
					id:$scope.child.id
				},
				function(response){

					$scope.plans = response.content; //references object .content and passes in it's array.
					console.log(response, '<- QUERY');
				},
				function(response){
					console.log('Error! No plans'); //this comes from the failure function
				}
			);

		}
	])

	.controller('PlansSubCtrl', [
		'$scope',
		'OffspringServ',
		function($scope, OffspringServ){

		}
	]);





// //Post (create) plan
// 			$scope.submit = function() { //function expression

// 				var payload = { //payload is an object, created via literal notation
// 					titleOfPlan: $scope.titleOfPlan,
// 					description: $scope.description,
// 					nameOfChild: $scope.nameOfChild,
// 					totalIteration: $scope.totalIteration,
// 					specificReward: $scope.specificReward,
// 					noRibbon: $scope.noRibbon,
// 					progress: 0,
// 					active: 0,
// 					complete: 0,
// 				};

// 				OperationsServ.save( //.save is a function being called
// 					{}, //1st parameter passes in through URL
// 					payload,
// 					function(response){
// 						console.log(response, '<- SAVE'); //upon success add payload to plansData
// 					}
// 				);
// 			};
			
			
// // Put (update) plan
// 			$scope.addItem = function(item) {

// 				item.progress = (item.progress + 1);
// 				item.active = 1;
// 				if (item.progress === item.totalIteration) {
// 					item.complete = 1;
// 				};

// 				console.log(item);

// 				OperationsServ.update(
// 					{id:0,}, //Dummy data to satisfy RESTFUL
// 					item,
// 					function(response){
// 						console.log(response, '<- UPDATE');
// 					}
// 				);

// 			};

// //Delete plan
// 			$scope.remove = function(id) {

// 				OperationsServ.remove(
// 					{
// 						id:id,
// 					},
// 					function(response){
// 						console.log(response, '<- REMOVE');
// 					}
// 				);
// 			};