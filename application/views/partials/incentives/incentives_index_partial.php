<script type="text/ng-template" id="incentives_index.html">
	<h3>{{data}}</h3>
	<table>
		<thead>
			<tr>
				<th>Reward</th>
				<th>Ribbon cost</th>
			</tr>
		</thead>
		<tbody>
			<tr ng-repeat="rewards in incentivesData">
				<td>{{rewards.titleOfReward}}</td>
				<td>{{rewards.ribbonCost}}</td>
			</tr>
		</body>
</script>