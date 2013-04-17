'use strict';

angular.module('Services') //.factory is a more configurable but .provider is most configurable, you cannot have [] 'di' injection because it's in to the config phase not run phase

	.factory('NotificationsServ', [ 

		'$resource', 
		function($resource){
			
			return $resource('api/notifications/:id',
				{},
				{
					update:{ 
						method: 'PUT', 
					}
				}
			);
		}
	]);
