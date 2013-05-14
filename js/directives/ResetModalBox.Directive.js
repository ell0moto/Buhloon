'use strict';

angular.module('Directives')
    .directive('resetModalBoxDir', [

        function() {
            return {

                link: function(scope, element, attributes) {

                    element.on('hidden', function(){
                        $(this).data('modal', null);
                    });

                }
            };
        }
    ]);