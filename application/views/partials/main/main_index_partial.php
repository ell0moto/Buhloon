<script type="text/ng-template" id="main_index.html">

	<div class="childplans" ng-controller="ChildrenSubCtrl" ng-repeat="child in children" ng-show="plans">

		<div collapse="isCollapsed">
			<div class="well well-large">Some more content</div> 
		</div>

		<div class="childcontainer">
			<img class="messageicon" src="<?= base_url() ?>/img/message_icon.png"/>
			<img class="usericon" src="<?= base_url() ?>/img/user_icon.png"/>
			<h1>{{child.nameOfChild}}</h1>
			<button class="btn" ng-click="isCollapsed = !isCollapsed">Account</button>
		</div>
		<carousel interval="myInterval">
			<slide active="slide.active" ng-repeat="plan in plans" >
			<div class="planscontainer" ng-controller="PlansSubCtrl" >
				<div class="plansbox">
					<div class="center">

						<div class="boxleft">
							<img class="completedicon" ng-hide="!plan.complete" src="<?= base_url() ?>/img/completed_icon.png" />
							<button type="button" ng-click="remove(plan.id)">×</button>
							<h1>{{plan.titleOfPlan}}</h1>
								<div class="progressbox">
									<a class="clickBox" href="/main"><a>
								    <div class="progress">
	    								<div class="bar" ng-style="{width:plan.percent}"></div>
	    							</div>
    							</div>
							<p>{{plan.description}}</p>
							<div class="ribbonsbox">
								<img src="<?= base_url() ?>/img/ribbon_icon.png" />
								<p>Earn {{plan.noRibbon}} ribbons completing this goal</p>
								<img src="<?= base_url() ?>/img/ribbon_icon.png" />
							</div>
						</div>
						<div class="boxright" ng-style="{backgroundColor:plan.colour}">
							<img src="<?= base_url() ?>/img/gift_icon.png" />
							<p>{{plan.specificReward}}</p>
						</div>

					</div>
				</div>
			</div>
			</slide>

		</carousel>

	</div>

	</div>
	

</script>