'use strict';

angular.module('Services')
    .config([ //<-  config phase to acquire the $httpProvider service
        '$httpProvider', //<- you can only inject Providers in config blocks
        function($httpProvider){

            //we are using the responseInterceptors function to push in interceptors, as there could be multiple interceptors
            //$q is a promise implementation allowing us to pass a promise of a future value even if it doesn't exist currently
            $httpProvider.responseInterceptors.push(['$q', '$location', function($q, $location) {
 
                //we are in the interceptor that is being added to the list of responseInterceptors
 
                //we have to return a function that accepts a promise parameter, and return the original or new promise
 
                return function(promise) {
 
                    //here we are using a promise and applying a then function 
                    return promise.then( //<- then is part of the promise API

                    	function(successResponse) {

                    		return successResponse;
                    	},

                        function(failureResponse) {

                            //here I'm intercepting the actual HTTP status
                            if (failureResponse.status===403){
                            	console.log(failureResponse);
                            	$location.path('/');

                            }
 
                            //we have return the $q promise as it will be passed onto to other interceptors
                            return $q.reject(failureResponse);
 
                        }
                    );
                };
            }]);
        }
    ]);