'use strict';

angular.module('Directives')
	.directive('placeHolderDir', [
		function(){
			
			return {
			    restrict: 'A',
			    require: 'ngModel',
			    link: function(scope, element, attr, ctrl) {      
			      
			      var value;
			      
			      var placeHolderDir = function () {
			          element.val(attr.placeHolderDir)
			      };
			      var unPlaceHolderDir = function () {
			          element.val('');
			      };
			      
			      scope.$watch(attr.ngModel, function (val) {
			        value = val || '';
			      });

			      element.bind('focus', function () {
			         if(value == '') unPlaceHolderDir();
			      });
			      
			      element.bind('blur', function () {
			         if (element.val() == '') placeHolderDir();
			      });
			      
			      ctrl.$formatters.unshift(function (val) {
			        if (!val) {
			          placeHolderDir();
			          value = '';
			          return attr.placeHolderDir;
			        }
			        return val;
			      });
			    }
		  };
		}
	]);