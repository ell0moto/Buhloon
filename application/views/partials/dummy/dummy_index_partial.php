<script type="text/ng-template" id="dummy_index.html">
	<h3>{{data}}</h3>
	<table>
		<thead>
			<tr>
				<th>Reward</th>
				<th>Ribbon cost</th>
			</tr>
		</thead>
		<tbody>
			<tr ng-repeat="individualDummyData in dummyData">
				<td>{{individualDummyData.titleOfReward}}</td>
				<td>{{individualDummyData.ribbonCost}}</td>
			</tr>
		</body>
</script>