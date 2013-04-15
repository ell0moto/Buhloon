'use strict';

angular.module('Services')
	.factory('ChildrenServ', [
		'$resource',
		function($resource){
		
			var children = [];
			
			return {

				getChildren: function(){
					return children;
				},
				setChildren: function(newChildren){
					children = newChildren;
				},
				// setChildrenProp: function(childId, propname, propvalue){ //future feature to change properties
				// 	for(var i=0; i<children.length; i++){
				// 		if(children[i].childId == childId){
				// 			children[propname] = propvalue;
				// 			return children[propname];
				// 		}
				// 	}
				// },
				// getRibbons: function(childId){
				// 	for(var i=0; i<children.length; i++){
				// 		if(children[i].childId == childId){
				// 			return children[i].ribbons;
				// 		}
				// 	}
				// },
				// setRibbons: function(childId, ribbonAmount){
				// 	for(var i=0; i<children.length; i++){
				// 		if(children[i].childId == childId){
				// 			children[i].ribbons = ribbonAmount;
				// 			return children[i].ribbons;
				// 		}
				// 	}
				// }
				server: $resource('api/offspring/:id',
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