'use strict';

angular.module('Directives')
    .directive('animateBar', [

        function() {
            return {
            // restrict: 'EA',
            // terminal: true,
                scope: true,
                link: function(scope, element) {

                    element.bind("mouseenter", function() {
                        element.removeClass().addClass('progress progress-striped active');
                    });

                    element.bind("mouseout", function() {
                        element.removeClass().addClass('progress');
                    });

                }
            };
        }
    ]);