'use strict';

angular.module('Services')
	.factory('RewardsServ', [
		'$resource',
		function($resource){
		
			var rewards = [];
			
			return {

				getRewards: function(){
					return rewards;
				},
				setRewards: function(newRewards){
					rewards = newRewards;
				},
				// setChildrenProp: function(childId, propname, propvalue){ //future feature to change properties
				// 	for(var i=0; i<children.length; i++){
				// 		if(children[i].childId == childId){
				// 			children[propname] = propvalue;
				// 			return children[propname];
				// 		}
				// 	}
				// },
				getCosts: function(rewardId){ //gets cost of reward
					for(var i=0; i<rewards.length; i++){
						if(rewards[i].id == rewardId){
							return rewards[i].ribbonCost;
						}
					}
				},
				// setRibbonsNEEDS TO CHANGE: function(childId, ribbonAmount){
				// 	for(var i=0; i<children.length; i++){
				// 		if(children[i].childId == childId){
				// 			children[i].ribbons = ribbonAmount;
				// 			return children[i].ribbons;
				// 		}
				// 	}
				// }
				server: $resource('api/incentives/:id',
					{},
					{
						update: {
							method: 'PUT'
						}
					}
				)
			};
		
		}
	]);