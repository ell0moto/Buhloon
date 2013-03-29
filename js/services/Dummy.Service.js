'use strict';

angular.module('Dummy.Service', []) 

	.factory('DummyServ', [ //declared service for a resource, which is then injected into a controller

		'$resource',
		function($resource){
			
			return $resource('api/incentives/:id', //id comes in a paramater
				{},//default paramenters for the resource object, left empy a this stage
				{
					update:{ //custom method
						method: 'PUT', //THIS METHOD DOESN'T EXIST BY DEFAULT
					}
				}
			);
			
		}
	]);