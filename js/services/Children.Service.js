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
					console.log(children);
				},
				// setChildrenProp: function(childId, propname, propvalue){ //future feature to change properties
				// 	for(var i=0; i<children.length; i++){
				// 		if(children[i].childId == childId){
				// 			children[propname] = propvalue;
				// 			return children[propname];
				// 		}
				// 	}
				// },
				getRibbons: function(childId){ //gets net ribbons
					for(var i=0; i<children.length; i++){
						if(children[i].id == childId){
							return children[i].netRibbon;
						}
					}
				},
				setRibbons: function(childId,netRibbon,ribbonCost){
					for(var i=0; i<children.length; i++){
						if(children[i].id == childId){
							children[i].spentRibbon = (children[i].spentRibbon + ribbonCost);
							children[i].netRibbon = (children[i].netRibbon - ribbonCost);
						}
					}
				},
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