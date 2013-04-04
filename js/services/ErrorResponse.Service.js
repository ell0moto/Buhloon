'use strict';

//Response Handler for Error Codes across all HTTP requests to show an alert box!

angular.module('Services')
	.config([ // Config phase to acquuire the $httpProvider service
		'$provide', // The provide service is only available in the configuration block, it allows the creation of services, factories, providers, values, constants and decorators
		'$httpProvider', // You can only inject Providers in config blocks
		function($provide, $httpProvider){

			//model variable...
			var httpMessages = [];

			//bind the httpMessages array to the httpMessages key so it can be dependency injected
			//the $provide configures the dependency injector, this is because we don't actually want to dependency inject this ErrorResponse handler, but instead it's output
			$provide.value('httpMessages', httpMessages);

			//we are using the responseInterceptors function to push in interceptors, as there could be multiple interceptors
            //$q is a promise implementation allowing us to pass a promise of a future value even if it doesn't exist currently
            $httpProvider.responseInterceptors.push(['$q', function($q) {

            		//we are in the interceptor that is being added to the list of responseInterceptors
 
                	//we have to return a function that accepts a promise parameter, and return the original or new promise

                	return function(promise) {

                		//here we are using a promise and applying a then function
                		return promise.then( //'then' is part of the promise API
                			function(sucessResponse) {

                				//we only want to show anything that wasn't a GET based request
                            	//these allow you show messages, you don't have to show these types though (because usually not required)

                            	//here I'm intercepting the HTTP method for the success, because the same 200 code could be used for multiple success states
	                            switch(successResponse.config.method.toUpperCase()) {
	                            	case 'GET':
	                            		httpMessages.push({
	                            			message: 'Successfully Received',
	                            			type: 'success'
	                            		});
	                            		break;
                            		case 'POST':
                                    	httpMessages.push({
                                        	message: 'Successfully Posted',
                                        	type: 'success'
                                    	});
                                    	break;
                                	case 'PUT':
                                    	httpMessages.push({
	                                        message: 'Successfully Updated',
	                                        type: 'success'
                                    	});
                                    break;
                                	case 'DELETE':
                                    	httpMessages.push({
	                                        message: 'Sucessfully Deleted',
	                                        type: 'success'
                                    	});
                                    break;
	                            }
	                            return successResponse;
                			},
                			function(failureResponse) {

                				//here I'm intercepting the actual HTTP status
                				//PUT CODE HERE
                			}
                		)
                	}
            }])
		}])