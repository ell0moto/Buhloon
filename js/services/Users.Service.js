'use strict';

angular.module('Services')
	.factory('UsersServ', [
		'SessionsServ',
		function(SessionsServ){
		
			//empty object to insert stuff into it!
			var userData = {};
			
			return {
			
				getUserData: function(){
					return userData;
				},
				
				setUserData: function(propertyName, propertyValue){
					userData[propertyName] = propertyValue;
					//does this need to be propagated...?
				},
				
				//no need for default values, javascript allows you to call them even if they don't exist
				login: function(payload, successCallback, failCallback){
				
					SessionsServ.save(
						{},
						payload,
						successCallback,
						failCallback
					);
				
				},
				
				logout: function(id, successCallback, failCallback){
				
					SessionsServ.remove(
						{
							id: id,
						},
						successCallback,
						failCallback
					);
					
					userData = {};
				
				}
				
			};
		
		}
	]);