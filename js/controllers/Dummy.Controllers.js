'use strict';

angular.module('Dummy.Controllers', ['Dummy.Controllers.Index']);

angular.module('Dummy.Controllers.Index', [])
	.controller('DummyIndexCtrl', [
		'$scope',
		'DummyServ',
		function($scope, DummyServ){
			$scope.data = 'Rewards!';
			
			DummyServ.query( //get all (with specific id)
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

			DummyServ.save( //create
				{}, //parameter passes in through URL
				{
					userId:'',
					titleOfReward: '',
					ribbonCost: '',
				},
				function(response){
					console.log(response, '<- SAVE');
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