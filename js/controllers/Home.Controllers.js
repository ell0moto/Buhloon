'use strict';

//Page Level Controller
//Can have multiple mini controllers, similar to methods
angular.module('Controllers')
    .controller('HomeIndexCtrl', [
        '$scope',
        'UsersServ',
        function($scope, UsersServ){

            $scope.closeAlert = function(index) {
                $scope.alerts.splice(index, 1);
            };

            $scope.register = function() {

                var payload = {
                    username: $scope.createUserName,
                    password: $scope.createPassword,
                };

                //reset the submission errors!
                $scope.loginErrors = [];
                $scope.validationErrors = {};

                UsersServ.registerAccount( //Calling a function & passing in arguments
                    payload,

                    function(successResponse) { //anonomous function call back

                        console.log('Successfully Created account');
                        UsersServ.setUserData('id', successResponse.content);

                    },

                    function(failResponse) {

                        console.log('Could not log in');
                        
                        //check if it is a validation error
                        if(failResponse.data.code === 'validation_error'){
                            
                            if(Array.isArray(failResponse.data.content)){
                            
                                //if it is an array
                                $scope.loginErrors = failResponse.data.content;

                            
                            }else{
                            
                                //else it's an object
                                $scope.validationErrors = {
                                    username: failResponse.data.content.username,
                                    password: failResponse.data.content.password,
                                    rememberMe: failResponse.data.content.rememberMe
                                };
                            }
                        }

                        $scope.alerts = [
                            { type: 'error', msg: 'This is unfortunate, please note your user name may already be taken & passwords should be longer than 8 characters' }, 
                        ];

                    }
                );

            };
        }
    ]);