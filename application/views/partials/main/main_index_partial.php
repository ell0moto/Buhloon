<script type="text/ng-template" id="main_index.html">

<div id="mainBody" class="main" ng-controller="ChildrenSubCtrl">
	<alert class="alertsBar" ng-repeat="alert in alerts" type="alert.type" close="closeAlert($index)">{{alert.msg}}</alert>
		
		<div class="container">
			<div class="childplans" ng-repeat="child in children" ng-show="child.plans">
				
				<div class="collapseContainer" collapse="isCollapsed">
					<div class="well well-large">
						<div class="accountContainer">
							<div class="childTop">
								<img class="avataricon" src="<?= base_url() ?>/img/avatar_icon.png"/>
								<div class="childDetails">
									<h1>{{child.nameOfChild}}</h1>
									<hr>
									<h5>Ribbons</h5>
									<div class="detailsBox"><h6>{{child.totalRibbon}}</h6><p>Earnt</p></div>
									<div class="detailsBox"><h6>{{child.spentRibbon}}</h6><p>Spent</p></div>
									<div class="detailsBox"><h6>{{child.netRibbon}}</h6><p>Available</p></div>
								</div>
							</div>
							<div class="rewardBottom">
								<div class="rewardContainer">
									<h3>Rewards</h3>
									<table>
									<tbody>
			                    		<tr ng-repeat="reward in rewards">
			                        		<td>{{reward.titleOfReward}}</td>
			                        		<td>{{reward.ribbonCost}}</td>
			                        		<td><button type="button" ng-click="purchase(reward.id,child.id)">buy</button></td>
			                    		</tr>
			                		</tbody>
			                		</table>
			                	</div>
							</div>
						</div>
					</div> 
				</div>

				<div class="childcontainer">
					<div class="clickBoxAccount" ng-click="isCollapsed = !isCollapsed"></div>
					<img class="messageicon" src="<?= base_url() ?>/img/message_icon.png"/>
					<img class="usericon" src="<?= base_url() ?>/img/user_icon.png"/>
					<div class="clickBoxChild" ng-click="isCollapsed = !isCollapsed"></div>
					<h1>{{child.nameOfChild}}</h1>
				</div>
				<carousel interval="myInterval">
					<slide active="slide.active" ng-repeat="plan in child.plans" >
					<div class="planscontainer" ng-controller="PlansSubCtrl" >
						<div class="plansbox">
							<div class="center">

								<div class="boxleft">
									<img class="completedicon" ng-hide="!plan.complete" src="<?= base_url() ?>/img/completed_icon.png" />
									<button type="button" ng-click="removePlan(plan.id)">&times;</button>
									<h1>{{plan.titleOfPlan}}</h1>
										<div class="progressbox" ng-click="openProgress()">
										    <div animate-bar class="progress">
			    								<div class="bar" ng-style="{width:plan.percent}"></div>
			    								<div class="clickBoxProgress"></div>
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

						<div modal="progressBox" options="opts">
					        <div class="modal-header">
					            <button type="button" class="close" ng-click="closeProgress()">×</button>
					            <h3 id="myModalLabel">{{child.nameOfChild}}, you are making progress<span></span></h3>
					        </div>
					        <div class="modal-body">
					        <h4 class="progressTitle">{{plan.titleOfPlan}}</h4>
					        	<div class="progressbox">
								    <div class="progress progress-striped active">
	    								<div class="bar" ng-style="{width:plan.percent}"></div>
	    							</div>
								</div>
					        </div>
					        <div class="modal-footer">
					            <button class="btn" ng-click="closeProgress()">No, not yet</button>
					            <button class="btn btn-primary" ng-click="updateProgress(plan,child)">Yes, I have</button>
					        </div>
				    	</div>

					</div>
					</slide>

				</carousel>

			</div>
		</div>
		<div class="largeFill" ng-show="largeFill"></div>
		<div class="smallFill" ng-show="smallFill"></div>
</div>

	

</script>