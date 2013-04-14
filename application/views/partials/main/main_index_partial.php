<script type="text/ng-template" id="main_index.html">


    <div ng-controller="ActivitySubCtrl" >
        <div collapse="isCollapsed">
           <div class="well well-large">Some content</div>
        </div>
    </div>


	<div ng-controller="ChildrenSubCtrl" ng-repeat="child in children" ng-show="plans">
		<div>
			<h1>{{child.nameOfChild}}</h1>
		</div>
		<div ng-controller="PlansSubCtrl" ng-repeat="plan in plans" ng-hide="plan.complete">
			<div class="planscontainer">
				<div class="plansbox">
					<div class="center">

						<div class="boxleft">
							<button type="button" ng-click="remove(plan.id)">×</button>
							<h1>{{plan.titleOfPlan}}</h1>
								<div class="progressbox">
								    <div class="progress">
	    								<div class="bar" ng-style="{width:plan.percent}"></div>
	    								<a class="clickBox" href="/main"><a>
	    							</div>
    							</div>
							<p>{{plan.description}}</p>
							<p>{{plan.noRibbon}}</p>
						</div>
						<div class="boxright" ng-style="{backgroundColor:plan.colour}">
							<img src="<?= base_url() ?>/img/gift_icon.png" />
							<p>{{plan.specificReward}}</p>
							
						</div>

					</div>
				</div>
			</div>
		</div>

	</div>
	

</script>