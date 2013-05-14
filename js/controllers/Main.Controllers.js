'use strict';

angular.module('Controllers')
    .controller('MainIndexCtrl', [
        '$scope',
        '$location',
        'ChildrenServ',
        'PlansServ',
        'RewardsServ',
        'NotificationsServ',
        'UsersServ',
        function($scope, $location, ChildrenServ, PlansServ, RewardsServ, NotificationsServ, UsersServ){

            //Variable, function & logic statement to check if user has logged in
            var userCheck = UsersServ.getUserData();

            function isEmpty(obj) {
                for(var key in obj) {
                    if (obj.hasOwnProperty(key)) {
                        return false;
                    }
                }
                return true;
            }

            if(isEmpty(userCheck)) {
                $location.path('/');
            }

            //Alert Box
            $scope.closeAlert = function(index) {
                $scope.alerts.splice(index, 1);
            };

            //Fill boxes for when there are no plans
            var largeFill;
            var smallFill;

            // Get all children (according to specific id)
            ChildrenServ.server.get( 
                {},
                function(response){                 

                    var children = response.content; //established to keep the objects inside first response from being overwritten.
                    
                    //Get all plans (according to user id)
                    PlansServ.server.get( 
                        {},
                        function(response){

                            //Sending both children & plans to be combined by the setChildrenPlans function
                            ChildrenServ.setChildrenPlans(children, response.content);
                            $scope.children = ChildrenServ.getChildren();

                            var number = ChildrenServ.countPlans();

                            if(number === 0) {
                                $scope.largeFill = true;
                                $scope.smallFill = false;
                            }else if (number === 1) {
                                $scope.largeFill = false;
                                $scope.smallFill = true;
                            }else{
                                $scope.largeFill = false;
                                $scope.smallFill = false;
                            }
                        
                        },
                        function(response){
                            console.log('No plans');
                        }
                    );
                },
                function(response){
                    console.log('No children');
                    
                    $scope.alerts = [
                            { type: 'success', msg: "Hey, to get started create a goal or plan with 'Add New' found above this very message." }, 
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

                    var number = ChildrenServ.countPlans();

                    if(number === 0) {
                        $scope.largeFill = true;
                        $scope.smallFill = false;
                    }else if (number === 1) {
                        $scope.largeFill = false;
                        $scope.smallFill = true;
                    }else{
                        $scope.largeFill = false;
                        $scope.smallFill = false;
                    }
                    
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
                    console.log('Error! No rewards');
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
                    console.log('No notifications');
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
                    console.log('failed, cannot afford item');
                }
            };

            //Delete plan
            $scope.removePlan = function(id) { 

                var largeFill;
                var smallFill;

                PlansServ.server.remove(
                    {
                        id: id,
                    },
                    function(response){
                        console.log(response, '<- REMOVE');

                        if (response) {
                                //Server approves
                                ChildrenServ.deletePlan(id);

                                var number = ChildrenServ.countPlans();

                                if(number === 0) {
                                    $scope.largeFill = true;
                                    $scope.smallFill = false;
                                }else if (number === 1) {
                                    $scope.largeFill = false;
                                    $scope.smallFill = true;
                                }else{
                                    $scope.largeFill = false;
                                    $scope.smallFill = false;
                                }

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

            //Modal boxes
            $scope.openProgress = function () {
                $scope.progressBox = true;
            };

            $scope.closeProgress = function () {
                $scope.progressBox = false;
            };

            $scope.items = ['item1', 'item2'];

            $scope.opts = {
                backdropFade: true,
                dialogFade:true
            };

            $scope.plan.percent = (parseInt((($scope.plan.progress)/($scope.plan.totalIteration)*100),10) + "%");
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

                                $scope.progressBox = false;

                            }else{
                                //Server failed error of some sort
                                console.log('Response did not get picked up');
                            }
                        }
                    );
                }

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
                                plan.percent = (parseInt(((plan.progress)/(plan.totalIteration)*100),10) + "%");
                                ChildrenServ.updateProgress(plan); //updating client side 'database'

                                $scope.progressBox = false;

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

        }
    ]);