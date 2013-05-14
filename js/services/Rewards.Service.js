'use strict';

angular.module('Services')
    .factory('RewardsServ', [
        '$resource',
        function($resource){
        
            var rewards = [];
            
            return {

                getRewards: function(){
                    return rewards;
                },
                setRewards: function(newRewards){
                    rewards = newRewards;
                    // console.log(newRewards);
                    // console.log(rewards);
                },

                setNewReward: function(newReward) {
                    rewards.push(newReward);
                },

                deleteReward: function(rewardId) {
                    for(var i=0; i<rewards.length; i++){
                        if(rewards[i].id === rewardId){
                            rewards.splice(i,1);
                            break;
                        }
                    }
                },

                getCosts: function(rewardId){ //gets cost of reward
                    for(var i=0; i<rewards.length; i++){
                        if(rewards[i].id === rewardId){
                            return rewards[i].ribbonCost;
                        }
                    }
                },

                formCheck: function(form) {

                        if(form.titleOfReward === undefined) {

                            var response = {
                                status: false,
                                message: 'Please enter a reward name'
                            };

                        }else if (form.titleOfReward.length < 3 || form.titleOfReward.length > 30) {
                            
                            var response = {
                                status: false,
                                message: 'Please check your reward name as it may be too long'
                            };

                        }else if (isNaN(form.ribbonCost)) {
                            
                            var response = {
                                status: false,
                                message: 'Please enter an amount of ribbons for this reward'
                            };

                        }else if (form.ribbonCost === 0) {
                            
                            var response = {
                                status: false,
                                message: 'Though it would be great, rewards can not be free'
                            };

                        }else if (form.ribbonCost > 99) {
                            
                            var response = {
                                status: false,
                                message: 'Please keep rewards under 100 ribbons'
                            };

                        }else{
                            
                            var response = {
                                status: true,
                            };
                        }

                        return response;
                    },

                server: $resource('api/incentives/:id',
                    {},
                    {
                        update: {
                            method: 'PUT'
                        }
                    }
                )
            };
        
        }
    ]);