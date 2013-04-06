'use strict';

angular.module('Services')
	.factory('PlansServ', [ 

		'$resource', 
		function($resource){
			
			return $resource('api/operations/:id',
				{},
				{
					update:{ 
						method: 'PUT', 
					}
				}
			);
			
		}
	]);