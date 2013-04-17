'use strict';

angular.module('Controllers')
	.controller('MainIndexCtrl', [
		'$scope',
		'ChildrenServ',
		'PlansServ',
		'RewardsServ',
		function($scope, ChildrenServ, PlansServ, RewardsServ){

			// Get all children (according to specific id)
			ChildrenServ.server.get( 
				{},
				function(response){					

					var children = response.content; //established to keep the objects inside first response from being overwritten.
					
					//Get all plans (according to user id)
					PlansServ.server.get( 
						{},
						function(response){

							ChildrenServ.setChildrenPlans(children, response.content);
							$scope.children = ChildrenServ.getChildren();
						
						},
						function(response){
							console.log('Error! rewards');
						}
					);
				},
				function(response){
					console.log('Error! No children'); //this comes from the failure function
				}
			);

			//Watching Children
			$scope.$watch (
				function() {
					return ChildrenServ.getChildren();
				},
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

			//Watching rewards
			$scope.$watch (
				function() {
					return RewardsServ.getRewards();
				},
				function() {
					$scope.rewards = RewardsServ.getRewards();
				}
			);
		}
	])


	.controller('ChildrenSubCtrl', [
		'$scope',
		'PlansServ',
		'ChildrenServ',
		'RewardsServ',
		function($scope, PlansServ, ChildrenServ, RewardsServ){

			$scope.isCollapsed = true;

			//Purchase reward
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

			//Delete
			$scope.removePlan = function(id) { 

				ChildrenServ.deletePlan(id);
				console.log(id);

				// PlansServ.server.remove(
				// 	{
				// 		id: id,
				// 	},
				// 	function(response){
				// 		console.log(response, '<- REMOVE');

				// 		if (response) {
				// 				//Server approves
				// 				ChildrenServ.deletePlan(id);

				// 		}else{
				// 				//Server failed error of some sort
				// 				console.log('Response did not get picked up');
				// 		}
				// 	}
				// );
			};

		}
	])

	.controller('PlansSubCtrl', [
		'$scope',
		'PlansServ',
		function($scope, PlansServ){

			// $scope.plan.percent = (($scope.plan.progress)/($scope.plan.totalIteration)*100 + "%");
			// $scope.plan.colour = ('#' + (Math.random() * 0xFFFFFF << 0).toString(16));

			// Put (update) plan
			$scope.addItem = function(item) {

				item.progress = (item.progress + 1);
				item.active = 1;
				if (item.progress === item.totalIteration) {
					item.complete = 1;
				}

				PlansServ.server.update(
					{id:0,}, //Dummy data to satisfy RESTFUL
					item,
					function(response){
						console.log(response, '<- UPDATE');
					}
				);

			};


			//Delete plan
			// $scope.remove = function(id) {

			// 	PlansServ.server.remove(
			// 		{
			// 			id:id,
			// 		},
			// 		function(response){
			// 			console.log(response, '<- REMOVE');
			// 		}
			// 	);
			// };

		}
	]);