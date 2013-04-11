'use strict';

angular.module('Services') //.factory is a more configurable but .provider is most configurable, you cannot have [] 'di' injection because it's in to the config phase not run phase

	.factory('IncentivesServ', [ //declared service for a resource, which is then injected into a controller

		'$resource', //[]dependency injected Angual JS module '$resource' required
		function($resource){
			
			return $resource('api/incentives/:id', //id comes in a paramater
				{},//default paramenters for the resource object, left empty a this stage
				{
					update:{ //custom method
						method: 'PUT', //THIS METHOD DOESN'T EXIST BY DEFAULT
					}
				}
			);
			
		}
	])

	.factory('OperationsServ', [ 

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
	])

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
	])

	.factory('OffspringServ', [ 

		'$resource', 
		function($resource){
			
			return $resource('api/offspring/:id',
				{},
				{
					update:{ 
						method: 'PUT', 
					}
				}
			);
		}
	]);