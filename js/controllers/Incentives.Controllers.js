'use strict';

angular.module('Controllers') //
	.controller('IncentivesIndexCtrl', [
		'$scope',
		'IncentivesServ',
		function($scope, IncentivesServ){
			$scope.data = 'Rewards!';
			
//Get all (according to specific id)
			IncentivesServ.get( 
				{
					// id:'9',
				},
				function(response){
					$scope.incentivesData = response.content; //references object .content and passes in it's array.
					console.log(response, '<- QUERY');
				},
				function(response){
					console.log('Error! Well this is hawkard'); //this comes from the failure function
				}
			);

//Post (create)
			IncentivesServ.save( 
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

//Put
			IncentivesServ.update(
				{},
				{
					userId:'',
					titleOfReward: '',
					ribbonCost: '',
				},
				function(response){
					console.log(response, '<- UPDATE');
				}
			);

//Delete
			IncentivesServ.remove(
				{
					id:'8',
				},
				function(response){
					console.log(response, '<- REMOVE');
				}
			);
	
		}
	]);