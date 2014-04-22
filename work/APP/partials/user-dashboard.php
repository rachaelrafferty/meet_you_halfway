<div id="user-dashboard">
	<div class="row-fluid">
		<div class="span12">
			
			<div class="span3 avatar-area">
				<div class="clip-circle" style="background-image: url(<?php echo substr_replace($avatar_pre, '', -1); ?><?php echo $avatar_size; ?><?php echo $avatar_suf; ?>);">
				</div>
				<?php foreach ($user_connection['checkins']['items'] as $id => $last_checkin): ?>
					<div class="last-seen">
						<i class="fa fa-map-marker make-bold"></i>
						Last seen at
						<span class="make-bold"> 
							<?php echo $last_checkin['venue']['name']; ?>
						</span>
					</div>
				<?php endforeach; ?>
			</div>
			
			<div class="span9 user-info">
				<span class="user-name"><?php echo $name; ?> <?php echo $surname; ?>
				</span>
				<div class="row-fluid">
					<div class="span12">
						<div class="span6 user-info">

							<span class="user-home-town"><i class="fa fa-globe globe"></i> Home City: <span class="make-bold"><?php echo $home_city; ?></span></span>
							

							<span class="user-rank"><i class="fa fa-shield shield"></i> Rank: 
								<span class="make-bold">
									<?php 


										require_once 'php/leaderboard_helper.php';
										$leaderboard_connection = get_foursquare_leaderboardinfo($_GET['access_token']);



										foreach ($leaderboard_connection as $id => $leaderboard_rank): 

											$leaderboard_user_id = $leaderboard_rank['user']['id'];
											$users_rank = $leaderboard_rank['rank'];

											$leaderboard_friend_id = $leaderboard_rank['user']['id'];
											$friend_rank = $leaderboard_rank['rank'];
						
											if ($leaderboard_user_id == $user_id){
												echo $users_rank;
											} 
											else{
												echo "";
											}
										endforeach; ?>
								 	
								</span>
							</span>

							<span class="bio"><?php echo $bio; ?></span>

						</div>
						<div class="span6 user-contact-details">

							<span class="user-email">
								<i class="fa fa-envelope contact-icon"></i>:
								<?php
								if ($email == ""){
									echo "You didn't tell Foursquare!";
								} 
								else{
									echo $email; 
								}
								?>
							</span>

							<span class="user-facebook">
								<i class="fa fa-facebook contact-icon"></i>:
								<?php
								if ($facebook == ""){
									echo "You didn't tell Foursquare!";
								} 
								else{
									echo $facebook; 
								}
								?>
							</span>
							
							<span class="user-twitter">
								<i class="fa fa-twitter contact-icon"></i>:
								<?php
								if ($twitter == ""){
									echo "You didn't tell Foursquare!";
								} 
								else{
									echo $twitter; 
								}
								?>
							</span>
							

						</div>

					</div>
				</div>
			</div>


		</div>
	</div>

	<div class="row-fluid hidden-phone user-info-panels">
		<div class="span12">
			
			<div class="span3">				
				<div class="info-panel blue hover panel">
					<div class="info-icon">
					  <div class="front">
					    <div class="pad set-height">
					    	<i class="fa fa-map-marker"></i>
							</div>
						</div>
						<div class="back">
			        <div class="pad set-height hover-text">
								<?php
								if ($checkin_count == ""){
									echo "0";
								} 
								else{
									echo $checkin_count; 
								}
								?>
			        </div>
			      </div>
					</div>
					<div class="info-title">
						Checkin Count
					</div>
				</div>
			</div>

			<div class="span3">				
				<div class="info-panel green hover panel">
					<div class="info-icon">
					  <div class="front">
					    <div class="pad set-height">
					    	<i class="fa fa-users"></i>
							</div>
						</div>
						<div class="back">
			        <div class="pad set-height hover-text">
								<?php
								if ($friend_count == ""){
									echo "0";
								} 
								else{
									echo $friend_count; 
								}
								?>
			        </div>
			      </div>
					</div>
					<div class="info-title">
						Friend Count
					</div>
				</div>
			</div>

			<div class="span3">				
				<div class="info-panel orange hover panel">
					<div class="info-icon">
					  <div class="front">
					    <div class="pad set-height">
					    	<img src="img/crown-icon.png" alt="crown icon" class="crown-icon" />
							</div>
						</div>
						<div class="back">
			        <div class="pad set-height hover-text">
								<?php
								if ($mayorships == ""){
									echo "0";
								} 
								else{
									echo $mayorships; 
								}
								?>
			        </div>
			      </div>
					</div>
					<div class="info-title">
						Mayorships
					</div>
				</div>
			</div>

			<div class="span3">				
				<div class="info-panel purple hover panel">
					<div class="info-icon">
					  <div class="front">
					    <div class="pad set-height">
					    	<i class="fa fa-trophy"></i>
							</div>
						</div>
						<div class="back">
			        <div class="pad set-height hover-text">
						<?php
						if ($badges == ""){
							echo "0";
						} 
						else{
							echo $badges; 
						}
						?>
			        </div>
			      </div>
					</div>
					<div class="info-title">
						Badges
					</div>
				</div>
			</div>

		</div>
	</div>

	<div class="row-fluid hidden-phone user-location">
		<div class="span12">
		<?php include 'geo.php'; ?>
		</div>
	</div>
</div>
