<script type="text/ng-template" id="main_index.html">
	<h3>{{data}}</h3>
	
	<table ng-controller="MainIndexCtrl">
	<button type="button" ng-click="get()">refresh</button>
		<thead>
			<tr>
				<th>Name</th>
				<th>Plan</th>
				<th>Description</th>
				<th>Progress</th>
				<th>Update</th>
				<th>Reward</th>
				<th>Ribbons</th>
				<th>Active</th>
			</tr>
		</thead>
		<tbody>
			<tr ng-repeat="columns in plansData">
				<td>{{columns.nameOfChild}}</td>
				<td>{{columns.titleOfPlan}}</td>
				<td>{{columns.description}}</td>
				<td>{{columns.progresss}}</td>
				<td><button type="button" ng-click="update(columns.id)">&rsaquo</button></td>
				<td>{{columns.specificReward}}</td>
				<td>{{columns.noRibbon}}</td>
				<td>{{columns.active}}</td>
				<td>{{columns.id}}</td>
				<td><button type="button" ng-click="remove(columns.id)">×</button></td>
			</tr>
		</body>
	</table>
</script>