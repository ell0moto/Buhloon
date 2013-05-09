'use strict';

angular.module('Controllers')
    .controller('MainIndexCtrl', [
        '$scope',
        'ChildrenServ',
        'PlansServ',
        'RewardsServ',
        'NotificationsServ',
        function($scope, ChildrenServ, PlansServ, RewardsServ, NotificationsServ){

            //Alert Box
            $scope.closeAlert = function(index) {
                $scope.alerts.splice(index, 1);
            };

            // $scope.$emit('authenticationFull');

            // Get all children (according to specific id)
            ChildrenServ.server.get( 
                {},
                function(response){                 

                    var children = response.content; //established to keep the objects inside first response from being overwritten.
                    
                    //Get all plans (according to user id)
                    PlansServ.server.get( 
                        {},
                        function(response){

                            ChildrenServ.setChildrenPlans(children, response.content);
                            $scope.children = ChildrenServ.getChildren();
                        
                        },
                        function(response){
                            console.log('Error! rewards');
                        }
                    );
                },
                function(response){
                    console.log('Error! No children'); //this comes from the failure function
                    
                    $scope.alerts = [
                            { type: 'success', msg: "Hey there you are, let's get started by creating a goal or plan with 'Add New' found above this message." }, 
                        ];
                }
            );

            // Watching notifications
            $scope.$watch (
                function() {
                    return NotificationsServ.getNotification();
                },
                function() {
                    $scope.notifications = NotificationsServ.getNotification();
                },
                true
            );

            
            //Watching Children
            $scope.$watch (
                function() {
                    return ChildrenServ.getChildren();
                },
                function() {
                    $scope.children = ChildrenServ.getChildren();
                    
                },
                true
            );      

            //Get all rewards (according to specific id)
            RewardsServ.server.get(
                {},
                function(response){
                    
                    RewardsServ.setRewards(response.content);
                    console.log(response, '<- QUERY');
                },
                function(response){
                    console.log('Error! rewards');
                }
            );

            //Watching rewards
            $scope.$watch (
                function() {
                    return RewardsServ.getRewards();
                },
                function() {
                    $scope.rewards = RewardsServ.getRewards();
                    
                }
            );

            // Get all notices & obligations (according to specific id)
            NotificationsServ.server.get( 
                {},
                function(response){

                    NotificationsServ.setNotifications(response.content);
                    console.log(response, '<- QUERY');
                },
                function(response){
                    console.log('Error! Well this is hawkard');
                }
            );

            // Watching notifications
            $scope.$watch (
                function() {
                    return NotificationsServ.getNotification();
                },
                function() {
                    $scope.notifications = NotificationsServ.getNotification();
                }
            );
        }
    ])


    .controller('ChildrenSubCtrl', [
        '$scope',
        'PlansServ',
        'ChildrenServ',
        'RewardsServ',
        function($scope, PlansServ, ChildrenServ, RewardsServ){

            $scope.isCollapsed = true;

            //Purchase reward
            $scope.purchase = function(rewardId,childId) {

                if (ChildrenServ.getNetRibbons(childId) - RewardsServ.getCosts(rewardId) > 0) {
                    
                    //True: item can be paid for
                    var payload = {
                        id: childId,
                        netRibbon: ChildrenServ.getNetRibbons(childId),
                        ribbonCost: RewardsServ.getCosts(rewardId),
                    };

                    ChildrenServ.server.update(
                        {id:0,}, //Dummy data to satisfy RESTFUL
                        payload,
                        function(response){
                            console.log(response, '<- UPDATE');

                            if (response) {
                                //Server approves
                                ChildrenServ.setPurchaseRibbons(payload.id,payload.netRibbon,payload.ribbonCost);

                            }else{
                                //Server failed error of some sort
                                console.log('Response did not get picked up');
                            }
                        }
                    );

                }else{
                    //false: item costs too much
                    console.log('failed');
                }
            };

            //Delete plan
            $scope.removePlan = function(id) { 

                PlansServ.server.remove(
                    {
                        id: id,
                    },
                    function(response){
                        console.log(response, '<- REMOVE');

                        if (response) {
                                //Server approves
                                ChildrenServ.deletePlan(id);

                        }else{
                                //Server failed error of some sort
                                console.log('Response did not get picked up');
                        }
                    }
                );
            };

        }
    ])

    .controller('PlansSubCtrl', [
        '$scope',
        'PlansServ',
        'ChildrenServ',
        'NotificationsServ',
        function($scope, PlansServ, ChildrenServ, NotificationsServ){

            $scope.plan.percent = (($scope.plan.progress)/($scope.plan.totalIteration)*100 + "%");
            $scope.plan.colour = ('#' + (Math.random() * 0xFFFFFF << 0).toString(16));

            // Put (update) plan
            $scope.updateProgress = function(plan,child) {

                plan.progress = (plan.progress + 1);
                plan.active = 1;

                if (plan.progress === plan.totalIteration) {
                    plan.complete = 1;

                    //to update completion ribbons
                    var payload = {
                        childId: child.id,
                        planId: plan.id,
                        totalRibbon: child.totalRibbon,
                        noRibbon: plan.noRibbon,
                    };

                    ChildrenServ.server.update(
                        {id:0,}, //Dummy data to satisfy RESTFUL
                        payload,
                        function(response){
                            console.log(response, '<- UPDATE');

                            if (response) {
                                //Server approves
                                ChildrenServ.setCompletionRibbons(child.id,plan.noRibbon);

                            }else{
                                //Server failed error of some sort
                                console.log('Response did not get picked up');
                            }
                        }
                    );
                }

                // console.log(child.id);
                // console.log(plan.noRibbon);
                // console.log(child.totalRibbon);

                var keepColour = plan.colour; //required because server side does not accept colour or percent in it's forms.

                delete plan.colour;
                delete plan.percent;

                PlansServ.server.update(
                    {id:0,}, //Dummy data to satisfy RESTFUL
                    plan,
                    function(response){
                        console.log(response, '<- UPDATE');

                        if (response) {
                            //Server approves

                                plan.colour = keepColour;
                                plan.percent = ((plan.progress)/(plan.totalIteration)*100 + "%");
                                ChildrenServ.updateProgress(plan); //updating client side 'database'

                                NotificationsServ.server.get( //triggers notifications in header to be updated
                                    {},
                                    function(response){

                                        NotificationsServ.setNotifications(response.content);
                                        console.log(response, '<- QUERY');
                                    },
                                    function(response){
                                        console.log('Error! Well this is hawkard');
                                    }
                                );

                        }else{
                                //Server failed error of some sort
                                console.log('Response did not get picked up');
                        }
                    }
                );

            };




            //Delete plan
            // $scope.remove = function(id) {

            //  PlansServ.server.remove(
            //      {
            //          id:id,
            //      },
            //      function(response){
            //          console.log(response, '<- REMOVE');
            //      }
            //  );
            // };

        }
    ]);