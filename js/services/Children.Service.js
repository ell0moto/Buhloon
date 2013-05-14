'use strict';

angular.module('Services')
    .factory('ChildrenServ', [
        '$resource',
        function($resource){
        
            var children = [];

            return {

                getChildren: function(){
                    return children;
                },
                // setChildren: function(newChildren){
                //  children = newChildren;
                // },

                setChildrenPlans: function(allChildren, allPlans) {

                    for(var i=0; i<allChildren.length; i++){
                        var plans = [];

                        for(var j=0; j<allPlans.length; j++) {
                            if (allChildren[i].id === allPlans[j].childId) {
                                plans.push(allPlans[j]);
                            }
                        }

                        allChildren[i].plans = plans;
                    }

                    children = allChildren;
                },

                countPlans: function() {
                    var number = 0;

                    for(var i=0; i<children.length; i++) {
                        if (children[i].plans.length > 0) {
                            number = number + 1;
                        }
                    }
                    return number;
                },

                createPlanChild: function(payLoad) {

                    for(var i=0; i<children.length; i++) {
                        if (children[i].nameOfChild === payLoad.nameOfChild) {
                        
                            //Child exists but if all plans have been deleted then .plans is now a property not object which equals false
                            if (children[i].plans === false) {

                                delete children[i].plans;

                                children[i].plans = [];

                                children[i].plans.push(payLoad);
                                return;

                            }else{

                                children[i].plans.push(payLoad);
                                return;
                            }
                        }
                    }

                    //Child does not exist, create child
                    var child = {
                        id: payLoad.childId,
                        userId: payLoad.userId,
                        nameOfChild: payLoad.nameOfChild,
                        totalRibbon: 0,
                        spentRibbon: 0,
                        netRibbon: 0,
                        totalPlan: 0,
                    };

                    var plans = [];

                    plans.push(payLoad);//Object array payLoad pushed into plans array

                    child.plans = plans;//associating plans to .plans inside child

                    children.push(child);//Object array child pushed into children array
                },

                deletePlan: function(planId) {
                    for(var i=0; i<children.length; i++){
                        var plans = children[i].plans;
                        for(var j=0; j<plans.length; j++) {

                            if(plans[j].id === planId){
                                plans.splice(j,1);
                            }
                        }
                        //ng-show needs false to accurately display that there are no plans for that child, to remove the child's name from being seen
                        if(children[i].plans.length === 0) {
                            children[i].plans = false;
                        }
                    }
                },

                updateProgress: function(plan) {
                    for(var i=0; i<children.length; i++){
                        var plans = children[i].plans;
                        for(var j=0; j<plans.length; j++) {

                            if(plans[j].id === plan.id){
                                children[i].plans[j] = plan;
                            }
                        }
                    }
                },

                getNetRibbons: function(childId){ //gets net ribbons
                    for(var i=0; i<children.length; i++){
                        if(children[i].id === childId){
                            return children[i].netRibbon;
                        }
                    }
                },

                setPurchaseRibbons: function(childId,netRibbon,ribbonCost){
                    for(var i=0; i<children.length; i++){
                        if(children[i].id === childId){
                            children[i].spentRibbon = (children[i].spentRibbon + ribbonCost);
                            children[i].netRibbon = (children[i].netRibbon - ribbonCost);
                        }
                    }
                },

                setCompletionRibbons: function(childId, noRibbon){
                    for(var i=0; i<children.length; i++){
                        if(children[i].id === childId){
                            children[i].totalRibbon = (children[i].totalRibbon + noRibbon);
                            children[i].netRibbon = (children[i].netRibbon + noRibbon);
                        }
                    }
                },

                server: $resource('api/offspring/:id',
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