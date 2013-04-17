'use strict';

angular.module('Services')

	.factory('PlansServ', [
		'$resource', 
		function($resource){
			
			return { 
					server: $resource('api/operations/:id',
					{},
					{
						update:{ 
							method: 'PUT', 
						}
					}
				)
			};
		}
	]);