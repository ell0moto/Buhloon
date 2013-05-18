'use strict';

angular.module('Services')

    .factory('PlansServ', [
        '$resource', 
        function($resource){
            
            return { 

                    formCheck: function(form) {

                        if(form.titleOfPlan === undefined) {

                            var response = {
                                status: false,
                                message: 'Please enter a name of this goal'
                            };
                            return response;

                        }else if (form.titleOfPlan.length < 3 || form.titleOfPlan.length > 50) {
                            
                            var response2 = {
                                status: false,
                                message: 'Please check your title as it may be too long'
                            };
                            return response2;

                        }else if (form.description === undefined) {
                            
                            var response3 = {
                                status: false,
                                message: 'Please enter a description for this goal'
                            };
                            return response3;

                        }else if (form.description.length < 3 || form.description.length > 140) {
                            
                            var response4 = {
                                status: false,
                                message: 'Please check the description as it may be too long'
                            };
                            return response4;

                        }else if (form.nameOfChild === undefined) {
                            
                            var response5 = {
                                status: false,
                                message: 'Please re try the name of the user'
                            };
                            return response5;

                        }else if (form.nameOfChild.length < 3 || form.nameOfChild.length > 13) {
                            
                            var response6 = {
                                status: false,
                                message: "Please check the user's name as it may be too long"
                            };
                            return response6;

                        }else if (form.totalIteration === undefined) {
                            
                            var response7 = {
                                status: false,
                                message: 'Please enter the number of steps for this goal'
                            };
                            return response7;

                        }else if (isNaN(form.totalIteration)) {
                            
                            var response8 = {
                                status: false,
                                message: 'Please check that the goal has a number of steps'
                            };
                            return response8;

                        }else if (form.specificReward === undefined) {
                            
                            var response9 = {
                                status: true,
                            };
                            return response9;

                        }else if (form.specificReward.length > 12) {
                            
                            var response10 = {
                                status: false,
                                message: 'Please check name of the reward as it may be too long'
                            };
                            return response10;

                        }else if (form.noRibbon === undefined) {
                            
                            var response11 = {
                                status: false,
                                message: 'Please enter the number of ribbons if any for this goal'
                            };
                            return response11;

                        }else if (isNaN(form.noRibbon)) {
                            
                            var response12 = {
                                status: false,
                                message: 'Please check that your have selected a number for ribbons'
                            };
                            return response12;

                        }else{
                            
                            var response13 = {
                                status: true,
                            };
                            return response13;
                        }
                    },

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