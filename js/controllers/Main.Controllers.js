'use strict';

angular.module('Controllers')
	.controller('PlansSubCtrl', [
		'$scope',
		'OperationsServ',
		function($scope, OperationsServ){
			$scope.data = 'Plans & Children';

//Get all plans (according to specific id)
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

//Post (create) plan
			$scope.submit = function() { //function expression

				var payload = { //payload is an object, created via literal notation
					titleOfPlan: $scope.titleOfPlan,
					description: $scope.description,
					nameOfChild: $scope.nameOfChild,
					totalIteration: $scope.totalIteration,
					specificReward: $scope.specificReward,
					noRibbon: $scope.noRibbon,
					progress: 0,
					active: 0,
					complete: 0,
				};

				OperationsServ.save( //.save is a function being called
					{}, //1st parameter passes in through URL
					payload,
					function(response){
						console.log(response, '<- SAVE');
					}
				);
			};
			
			
// Put (update) plan
			$scope.addItem = function(item) {

				item.progress = (item.progress + 1);
				item.active = 1;
				if (item.progress === item.totalIteration) {
					item.complete = 1;
				};

				console.log(item);

				OperationsServ.update(
					{id:0,}, //Dummy data to satisfy RESTFUL
					item,
					function(response){
						console.log(response, '<- UPDATE');
					}
				);

			};

//Delete plan
			$scope.remove = function(id) {

				OperationsServ.remove(
					{
						id:id,
					},
					function(response){
						console.log(response, '<- REMOVE');
					}
				);
			};
	
		}
	])

.controller('ChildrenSubCtrl', [
		'$scope',
		'OffspringServ',
		function($scope, OffspringServ){

//Get all plans (according to specific id)
			$scope.getmore = function() {
			
				OffspringServ.get( 
					{},
					function(response){

						$scope.childData = response.content; //references object .content and passes in it's array.
						console.log(response, '<- QUERY');
					},
					function(response){
						console.log('Error! Well this is hawkard'); //this comes from the failure function
					}
				);
			};

//Post (create) plan
			$scope.submit = function() { //function expression

				var payload = { //payload is an object, created via literal notation
					titleOfPlan: $scope.titleOfPlan,
					description: $scope.description,
					nameOfChild: $scope.nameOfChild,
					totalIteration: $scope.totalIteration,
					specificReward: $scope.specificReward,
					noRibbon: $scope.noRibbon,
					progress: 0,
					active: 0,
					complete: 0,
				};

				OffspringServ.save( //.save is a function being called
					{}, //1st parameter passes in through URL
					payload,
					function(response){
						console.log(response, '<- SAVE');
					}
				);
			};
			
			
// Put (update) plan
			$scope.addItem = function(item) {

				var values;
				for (values in item) {
					if (values === "progress") {
						item[values] = (item[values] + 1);
					}
					if (values === "active") {
						item[values] = 1;
					}
				};

				if (item["progress"] === item["totalIteration"]) {
					item["complete"] = 1;
				};

				console.log(item);

				OffspringServ.update(
					{id:0,}, //Dummy data to satisfy RESTFUL
					item,
					function(response){
						console.log(response, '<- UPDATE');
					}
				);

			};

//Delete plan
			$scope.remove = function(id) {

				OffspringServ.remove(
					{
						id:id,
					},
					function(response){
						console.log(response, '<- REMOVE');
					}
				);
			};
	
		}
	]);