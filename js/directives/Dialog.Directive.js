'use strict';

angular.module('Directives')
    .directive('planDialogDir', [

        function() {
            return {

                link: function(scope, element, attributes) {

                    element.parent().show();
                    
                    element.hide().fadeIn('fast').delay(attributes.planDialogDir).fadeOut('slow', function(){
                        //we cant use ng-repeat's $last, because our messages happen intermittently
                        if(element.is(':last-child')){
                            element.parent().hide();
                        }
                    });
                }
            };
        }
    ]);