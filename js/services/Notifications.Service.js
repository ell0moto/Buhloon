'use strict';

angular.module('Services')
    .factory('NotificationsServ', [
        '$resource',
        function($resource){
        
            var notifications = [];

            return {

                getNotification: function(){
                    return notifications;
                },

                setNotifications: function(newNotice){
                    for(var i=0; i<newNotice.length; i++) {
                        newNotice[i].percent = ((newNotice[i].progress)/(newNotice[i].totalIteration)*100 + "%");
                    }
                    notifications = newNotice;
                },

                removeNotifiction: function(payload) {
                    for(var i=0; i<notifications.length; i++) {
                        if(notifications[i].id === payload.id) {
                            notifications.splice(i,1); //A better way to remove objects inside an array
                        }
                    }
                    
                    if (notifications.length === 0) { //To correct the red indication bar
                        notifications = false;
                    }
                },

                server: $resource('api/notifications/:id',
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