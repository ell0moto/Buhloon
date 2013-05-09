'use strict';

angular.module('Controllers')
    .controller('HeaderPartialCtrl', [
        '$scope',
        '$location',
        'UsersServ',
        'RewardsServ',
        'ChildrenServ',
        'PlansServ',
        'NotificationsServ',
        function($scope, $location, UsersServ, RewardsServ, ChildrenServ, PlansServ, NotificationsServ) {

            //Alert Box
            $scope.closeAlert = function(index) {
                $scope.alerts.splice(index, 1);
            };

            //Modal boxes
            $scope.openRewards = function () {
                $scope.rewardsBox = true;
            };

            $scope.closeRewards = function () {
                $scope.rewardsBox = false;
            };

            $scope.openPlans = function () {
                $scope.plansBox = true;
            };

            $scope.closePlans = function () {
                $scope.plansBox = false;
            };

            $scope.openActivity = function () {
                $scope.activityBox = true;
            };

            $scope.closeActivity = function () {
                $scope.activityBox = false;
            };

            $scope.items = ['item1', 'item2'];

            $scope.opts = {
                backdropFade: true,
                dialogFade:true
            };

            //Watching Rewards
            $scope.$watch (
                function() {
                    return RewardsServ.getRewards();
                },
                function() {
                    $scope.rewards = RewardsServ.getRewards();
                    
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

            //Submit Reward
            $scope.submitReward = function() {

                var payload = {
                    titleOfReward: $scope.titleOfReward,
                    ribbonCost: $scope.ribbonCost,
                };

                RewardsServ.server.save( 
                    {},
                    payload,
                    function(response){
                        console.log(response, '<- SAVE');

                        var extraLoad = {
                            id: response.content,
                            titleOfReward: $scope.titleOfReward,
                            ribbonCost: $scope.ribbonCost,
                            
                        };

                        if (response) {
                                //Server approves
                                RewardsServ.setNewReward(extraLoad);

                        }else{
                                //Server failed error of some sort
                                console.log('Response did not get picked up');
                        }
                    }
                );
            };

            //Delete
            $scope.removeReward = function(id) { 

                RewardsServ.server.remove(
                    {
                        id: id,
                    },
                    function(response){
                        console.log(response, '<- REMOVE');

                        if (response) {
                                //Server approves
                                RewardsServ.deleteReward(id);

                        }else{
                                //Server failed error of some sort
                                console.log('Response did not get picked up');
                        }
                    }
                );
            };

            //Post (create) plan
            $scope.submitPlan = function() { //function expression

				var childName;
                if($scope.nameOfChild) {
                    childName = $scope.nameOfChild;
                }else{
                    childName = $scope.existingUser;
                }

                if(!childName) {
                    $scope.alerts = [
                                { type: 'error', msg: "Please enter or re-enter the child's name" }, 
                            ];
                }

                var payload = { //payload is an object, created via literal notation
                    titleOfPlan: $scope.titleOfPlan,
                    description: $scope.description,
                    nameOfChild: childName,
                    totalIteration: $scope.totalIteration,
                    specificReward: $scope.specificReward,
                    noRibbon: $scope.noRibbon,
                    progress: 0,
                    active: 0,
                    complete: 0,
                };
            
                PlansServ.server.save( //.save is a function being called
                    {},
                    payload,
                    function(response){
                        console.log(response, '<- SAVE');

                        if (response) {

                            console.log(response); //id of new plan

                            var extraPayload = {

                                titleOfPlan: $scope.titleOfPlan,
                                description: $scope.description,
                                nameOfChild: childName,
                                totalIteration: $scope.totalIteration,
                                specificReward: $scope.specificReward,
                                noRibbon: $scope.noRibbon,
                                progress: 0,
                                active: 0,
                                complete: 0,
                                id: response.content.id,
                                userId: response.content.userId,
                                childId: response.content.childId,
                            };

                                //Server approves
                                ChildrenServ.createPlanChild(extraPayload);

                        }else{
                                //Server failed error of some sort
                                console.log('Response did not get picked up');
                        }
                    }
                );

            };

            //watching children
            $scope.$watch (
                function() {
                    return ChildrenServ.getChildren();
                },
                function() {
                    $scope.children = ChildrenServ.getChildren();
                    
                }
            );

            //Soft delete notices & obligations
            $scope.removeNotification = function(item) {

                var payload = {
                    active: 0,
                    id: item,
                };

                NotificationsServ.server.remove(
                    {id:0,}, //Dummy data to satisfy RESTFUL
                    payload,
                    function(response){

                        if (response) {

                                //Server approves
                                NotificationsServ.removeNotifiction(payload);
                                console.log(response, '<- SOFT DELETE');

                        }else{
                                //Server failed error of some sort
                                console.log('Response did not get picked up');
                        }

                    }
                );
            };

            $scope.login = function() { //function expression

                var payload = {
                    username: $scope.username,
                    password: $scope.password,
                };

                //reset the submission errors!
                $scope.loginErrors = [];
                $scope.validationErrors = {};

                UsersServ.loginSession( //passing in arguments
                    payload,

                    function(successResponse) { //anonomous function call back

                        console.log('Successfully Logged In');
                        UsersServ.setUserData('id', successResponse.content);
                        $location.path('/main');
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
                            { type: 'error', msg: 'This is unfortunate, your login and/or password is incorrect' }, 
                        ];

                    }
                );

            };

            $scope.logout = function(){

                UsersServ.logoutSession(UsersServ.getUserData().id);
                //$scope.$emit('authenticationDestroy', Us);

                $location.path('/');
            };

            $scope.$on('authenticationProvided', function(event,args) { //authenticationProvided is a global event that is being listen to
                $scope.state = true; //anything attached to $scope.state is a model
            });

            $scope.$on('authenticationLogout', function(event,args) {
                $scope.state = false;
            });

            
        }
    ])











    .controller('RewardsSubCtrl', [
        '$scope',
        'IncentivesServ',
        function($scope, IncentivesServ){



        //  //get
        //  $scope.get = function() {

        //      //get all rewards according to User ID
        //  //  IncentivesServ.get( 
        //  //      {
        //  //          // id:'9',
        //  //      },
        //  //      function(response){
        //  //          $scope.rewards = response.content; //references object .content and passes in it's array.
        //  //          console.log(response, '<- QUERY');
        //  //      },
        //  //      function(response){
        //  //          console.log('Error! Well this is hawkard'); //this comes from the fail function
        //  //      }
        //  //  );

        //  };

        //  //Post (create)
        //  $scope.submit = function() {

        //      var payload = {
        //          titleOfReward: $scope.titleOfReward,
        //          ribbonCost: $scope.ribbonCost,
        //      };

        //      IncentivesServ.save( 
        //          {}, //parameter passes in through URL
        //          payload,
        //          function(response){
        //              console.log(response, '<- SAVE');
        //          }
        //      );
        //  };

            //Delete
            // $scope.remove = function(id) { 

            //  console.log(id);

            //  IncentivesServ.remove(
            //      {
            //          id: id,
            //      },
            //      function(response){
            //          console.log(response, '<- REMOVE');
            //      }
            //  );
            // };

        }
    ])

    .controller('ActivitySubCtrl', [
        '$scope',
        'NotificationsServ',
        function($scope, NotificationsServ){

            $scope.isCollapsed = true;

            
            $scope.get = function() {
                
                // Get all notices & obligations (according to specific id)
                NotificationsServ.get( 
                    {},
                    function(response){

                        $scope.notifications = response.content; //references object .content and passes in it's array.
                        console.log(response, '<- QUERY');
                    },
                    function(response){
                        console.log('Error! Well this is hawkard'); //this comes from the failure function
                    }
                );
            };

            
            


    
        }
    ]);