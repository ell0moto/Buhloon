<script type="text/ng-template" id="main_index.html">
	<h3>{{data}}</h3>
	<button type="button" ng-controller="MainIndexCtrl" ng-click="get()">refresh</button>
	<table>
		<thead>
			<tr>
				<th>Name</th>
				<th>Plan</th>
				<th>Description</th>
				<th>Progress</th>
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
				<td>{{columns.specificReward}}</td>
				<td>{{columns.noRibbon}}</td>
				<td>{{columns.active}}</td>
			</tr>
		</body>
	</table>
</script>