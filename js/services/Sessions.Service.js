'use strict';

angular.module('Services') //.factory is a more configurable but .provider is most configurable, you cannot have [] 'di' injection because it's in to the config phase not run phase

    .factory('SessionsServ', [ //declared service for a resource, which is then injected into a controller

        '$resource', //[]dependency injected Angual JS module '$resource' required
        function($resource){
            
            return $resource('api/sessions/:id', //id comes in a paramater
                {},//default paramenters for the resource object, left empty a this stage
                {
                    update:{ //custom method
                        method: 'PUT', //THIS METHOD DOESN'T EXIST BY DEFAULT
                    }
                }
            );
            
        }
    ]);