'use strict';

angular.module('Dummy.Controllers', ['Dummy.Controllers.Index']);

angular.module('Dummy.Controllers.Index', [])
	.controller('DummyIndexCtrl', [
		'$scope',
		'DummyServ',
		function($scope, DummyServ){
			$scope.data = 'Rewards!';
			
			DummyServ.query(
				{
					// id:'9',
				},
				function(response){
					$scope.dummyData = response;
					console.log(response, '<- QUERY');
				},
				function(response){
					console.log('OH NO AN ERROR!'); //this comes from the failure function
				}
			);

			// DummyServ.get(
			// 	{
			// 		id:'3'
			// 	},
			// 		function(response) {
			// 			console.log(response);
			// 		}
			// 	);

			// DummyServ.save( //Post request, 
			// 	{},
			// 		function(response) {
			// 			console.log(response);
			// 		}
			// 	);


			
		}
	]);