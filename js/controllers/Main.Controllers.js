'use strict';

angular.module('Controllers')
	.controller('MainIndexCtrl', [
		'$scope',
		'ChildrenServ',
		'OperationsServ',
		'RewardsServ',
		function($scope, ChildrenServ, OperationsServ, RewardsServ){

			// Get all children (according to specific id)
			ChildrenServ.server.get( 
				{},
				function(response){
					
					//children data from DB being injected into .factory function setChildren
					ChildrenServ.setChildren(response.content); 
					console.log(response, '<- QUERY');

				},
				function(response){
					console.log('Error! No children'); //this comes from the failure function
				}
			);

			$scope.$watch (
				function() {
					$scope.children = ChildrenServ.getChildren();
				}
			);

			//Get all rewards (according to specific id)
			RewardsServ.server.get(
				{},
				function(response){
					
					RewardsServ.setRewards(response.content);
					console.log(response, '<- QUERY');
				},
				function(response){
					console.log('Error! rewards');
				}
			);

			$scope.$watch (
				function() {
					$scope.rewards = RewardsServ.getRewards();
				}
			);

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
						console.log(response, '<- SAVE'); //upon success add payload to plansData
					}
				);

			};
		}
	])


	.controller('ChildrenSubCtrl', [
		'$scope',
		'OperationsServ',
		'ChildrenServ',
		'RewardsServ',
		function($scope, OperationsServ, ChildrenServ, RewardsServ){

			$scope.isCollapsed = true;

			$scope.purchase = function(rewardId,childId) {

				if (ChildrenServ.getRibbons(childId) - RewardsServ.getCosts(rewardId) > 0) {
					
					//True: item can be paid for
					var payload = {
						id: childId,
						netRibbon: ChildrenServ.getRibbons(childId),
						ribbonCost: RewardsServ.getCosts(rewardId),
					};

					ChildrenServ.server.update(
						{id:0,}, //Dummy data to satisfy RESTFUL
						payload,
						function(response){
							console.log(response, '<- UPDATE');

							if (response) {
								//Server approves
								ChildrenServ.setRibbons(payload.id,payload.netRibbon,payload.ribbonCost);

							}else{
								//Server failed error of some sort
								console.log('Response did not get picked up');
							}
						}
					);

				}else{
					//false: item costs too much
					console.log('failed');
				}
			};

			//Get all plans (according to child id)
			OperationsServ.get( 
				{
					id:$scope.child.id,
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
		'OperationsServ',
		function($scope, OperationsServ){

			$scope.plan.percent = (($scope.plan.progress)/($scope.plan.totalIteration)*100 + "%");
			$scope.plan.colour = ('#' + (Math.random() * 0xFFFFFF << 0).toString(16));

			// Put (update) plan
			$scope.addItem = function(item) {

				item.progress = (item.progress + 1);
				item.active = 1;
				if (item.progress === item.totalIteration) {
					item.complete = 1;
				}

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
	]);






			
			
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

