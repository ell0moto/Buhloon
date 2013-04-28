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
                            notifications[i].active = 0;
                        }
                    }
                    console.log(notifications);
                },

                // setChildrenPlans: function(allChildren, allPlans) {

                //  for(var i=0; i<allChildren.length; i++){
                //      var plans = [];

                //      for(var j=0; j<allPlans.length; j++) {
                //          if (allChildren[i].id == allPlans[j].childId) {
                //              plans.push(allPlans[j]);
                //          }
                //      }

                //      allChildren[i].plans = plans;
                //  }

                //  children = allChildren;
                // },

                // createPlanChild: function(payLoad) {

                //  for(var i=0; i<children.length; i++) {
                //      if (children[i].nameOfChild == payLoad.nameOfChild) {
                //          //Child exists
                //          children[i].plans.push(payLoad);
                //          return;
                //      }
                //  };

                //  //Create child
                //  var child = {
                //      id: payLoad.childId,
                //      userId: payLoad.userId,
                //      nameOfChild: payLoad.nameOfChild,
                //      totalRibbon: 0,
                //      spentRibbon: 0,
                //      netRibbon: 0,
                //      totalPlan: 0,
                //  };

                //  var plans = [];

                //  plans.push(payLoad);//Object array payLoad pushed into plans array

                //  child.plans = plans;//associating plans to .plans inside child

                //  children.push(child);//Object array child pushed into children array

                // },

                // deletePlan: function(planId) {
                //  for(var i=0; i<children.length; i++){
                //      var plans = children[i].plans;
                //      for(var j=0; j<plans.length; j++) {

                //          if(plans[j].id == planId){
                //              plans.splice(j,1);
                //              break;
                //          }
                //      }
                //  }
                // },

                // updateProgress: function(plan) {
                //  for(var i=0; i<children.length; i++){
                //      var plans = children[i].plans;
                //      for(var j=0; j<plans.length; j++) {

                //          if(plans[j].id == plan.id){
                //              children[i].plans[j] = plan;
                //              // return;
                //          }
                //      }
                //  }
                //  console.log(children);
                // },

                // getRibbons: function(childId){ //gets net ribbons
                //  for(var i=0; i<children.length; i++){
                //      if(children[i].id == childId){
                //          return children[i].netRibbon;
                //      }
                //  }
                // },

                // setRibbons: function(childId,netRibbon,ribbonCost){
                //  for(var i=0; i<children.length; i++){
                //      if(children[i].id == childId){
                //          children[i].spentRibbon = (children[i].spentRibbon + ribbonCost);
                //          children[i].netRibbon = (children[i].netRibbon - ribbonCost);
                //      }
                //  }
                // },

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