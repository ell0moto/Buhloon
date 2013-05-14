'use strict';

angular.module('Services')

    .factory('PlansServ', [
        '$resource', 
        function($resource){
            
            return { 

                    formCheck: function(form) {

                        console.log(form);

                        if(form.titleOfPlan === undefined) {

                            var response = {
                                status: false,
                                message: 'Please enter a name of this goal'
                            };

                        }else if (form.titleOfPlan.length < 3 || form.titleOfPlan.length > 50) {
                            
                            var response = {
                                status: false,
                                message: 'Please check your title as it may be too long'
                            };

                        }else if (form.description === undefined) {
                            
                            var response = {
                                status: false,
                                message: 'Please enter a description for this goal'
                            };

                        }else if (form.description.length < 3 || form.description.length > 140) {
                            
                            var response = {
                                status: false,
                                message: 'Please check the description as it may be too long'
                            };

                        }else if (form.nameOfChild === undefined) {
                            
                            var response = {
                                status: false,
                                message: 'Please re try the name of the user'
                            };

                        }else if (form.nameOfChild.length < 3 || form.nameOfChild.length > 40) {
                            
                            var response = {
                                status: false,
                                message: "Please check the user's name as it may be too long"
                            };

                        }else if (form.totalIteration === undefined) {
                            
                            var response = {
                                status: false,
                                message: 'Please enter the number of steps for this goal'
                            };

                        }else if (isNaN(form.totalIteration)) {
                            
                            var response = {
                                status: false,
                                message: 'Please check that the goal has a number of steps'
                            };

                        }else if (form.specificReward === undefined) {
                            
                            var response = {
                                status: true,
                            };

                        }else if (form.specificReward.length > 20) {
                            
                            var response = {
                                status: false,
                                message: 'Please check name of the reward as it may be too long'
                            };

                        }else if (form.noRibbon === undefined) {
                            
                            var response = {
                                status: false,
                                message: 'Please enter the number of ribbons if any for this goal'
                            };

                        }else if (isNaN(form.noRibbon)) {
                            
                            var response = {
                                status: false,
                                message: 'Please check that your have selected a number for ribbons'
                            };

                        }else{
                            
                            var response = {
                                status: true,
                            };
                        }

                        return response;
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