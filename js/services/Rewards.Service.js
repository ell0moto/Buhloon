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
                        return response;

                    }else if (form.titleOfReward.length < 3 || form.titleOfReward.length > 30) {
                        
                        var response2 = {
                            status: false,
                            message: 'Reward name may be too long'
                        };
                        return response2;

                    }else if (isNaN(form.ribbonCost)) {
                        
                        var response3 = {
                            status: false,
                            message: 'Please enter an amount of ribbons for this reward'
                        };
                        return response3;

                    }else if (form.ribbonCost === 0) {
                        
                        var response4 = {
                            status: false,
                            message: 'Though it would be great, rewards can not be free'
                        };
                        return response4;

                    }else if (form.ribbonCost > 99) {
                        
                        var response5 = {
                            status: false,
                            message: 'Please keep rewards under 100 ribbons'
                        };
                        return response5;

                    }else{
                        
                        var response6 = {
                            status: true,
                        };
                        return response6;
                    }
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