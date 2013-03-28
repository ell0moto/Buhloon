'use strict';

angular.module('Dummy.Controllers', ['Dummy.Controllers.Index']);

angular.module('Dummy.Controllers.Index', [])
	.controller('DummyIndexCtrl', [
		'$scope',
		'DummyServ',
		function($scope, DummyServ){
			$scope.data = 'Rewards';
			
			DummyServ.query(
				{},
				function(response){
					$scope.dummyData = response;


				}
				// function(response){
				// 	if(typeof response.data.error !== 'undefined'){
				// 		$scope.dummyError = response.data.error.database;
				// 	}else{
				// 		$scope.dummyError = 'Uh oh something did not work!';
				// 	}
				// }
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