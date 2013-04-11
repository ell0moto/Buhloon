<script type="text/ng-template" id="main_index.html">
	<h3>{{data}}</h3>

	<table ng-controller="ChildrenSubCtrl">
	<button type="button" ng-click="getmore()">refresh</button>
		<thead>
			<tr>
				<th>Name</th>
			</tr>
		</thead>
		<tbody>
			<tr ng-repeat="columns in childData">
				<td>{{columns.nameOfChild}}</td>
				<td><button type="button" ng-click="">Account</button></td>
			</tr>
		</body>
	</table>
	
	<table ng-controller="PlansSubCtrl">
	<button type="button" ng-click="get()">refresh</button>
		<thead>
			<tr>
				<th>Name</th>
				<th>Plan</th>
				<th>Description</th>
				<th>Progress</th>
				<th>Update</th>
				<th>Total Iteration</th>
				<th>Reward</th>
				<th>Ribbons</th>
				<th>Active</th>
				<th>Complete</th>
			</tr>
		</thead>
		<tbody>
			<tr ng-repeat="columns in plansData" ng-hide="columns.complete">
				<td>{{columns.nameOfChild}}</td>
				<td>{{columns.titleOfPlan}}</td>
				<td>{{columns.description}}</td>
				<td>{{columns.progress}}</td>
				<td><button type="button" ng-click="addItem(columns)">+1</button></td>
				<td>{{columns.totalIteration}}</td>
				<td>{{columns.specificReward}}</td>
				<td>{{columns.noRibbon}}</td>
				<td>{{columns.active}}</td>
				<td>{{columns.complete}}</td>
				<td>{{columns.id}}</td>
				<td><button type="button" ng-click="remove(columns.id)">×</button></td>
			</tr>
		</body>
	</table>
</script>