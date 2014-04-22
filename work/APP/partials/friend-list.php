<div class="row-fluid" id="friends-list">
	<div class="span12">
		<ul>
			<?php 

			require_once 'php/friend_helper.php';
			$friend_connection = get_foursquare_friendinfo($_GET['access_token']);


			foreach ($friend_connection as $id => $friend): 

				$friend_id = $friend['id'];
				$friend_name = $friend['firstName'];
				$friend_surname = $friend['lastName'];

				$friend_avatar_pre = substr_replace($friend['photo']['prefix'], '', -1);
				$friend_avatar_size = "/128x128";
				$friend_avatar_suf = $friend['photo']['suffix'];
				$friend_profile_pict = $friend_avatar_pre.$friend_avatar_size.$friend_avatar_suf;

				$friend_homecity = $friend['homeCity'];
				$friend_bio = $friend['bio'];

				$friend_facebook = $friend['contact']['facebook'];
				$friend_twitter = $friend['contact']['twitter'];
				$friend_email = $friend['contact']['email']; 

			?>

		 	<div class="friend-list">
		 		<li>
			  	<div class="row-fluid friend-panel">
			  		<div class="span12">
			  			
			  			<div class="row-fluid">
			  				<div class="span12">
			  					<div class="span5 friend-picture">
			  						<div class="clip-circle make-circle-smaller" style="background-image: url(<?php echo $friend_profile_pict; ?>);"></div>
			  					</div>
			  					<div class="span7">
						  			<div class="friend-name">
						  				<?php echo $friend_name; ?> <?php echo $friend_surname; ?>
						  			</div>
						  			<div class="friend-home-city hidden-phone">
						  				<i class="fa fa-map-marker make-bold"></i>: <?php echo $friend_homecity; ?>
						  			</div>
							  		<div class="meet-btn">
							  			<form action="" method="post">
							  			  
							  			  <button type="submit" onclick="send_match_request('<?php echo $user_id; ?>', '<?php echo $friend_id; ?>','<?php echo $friend_email; ?>', '<?php echo $friend_name; ?>', '<?php echo $friend_surname; ?>'); return false;" class="btn btn-success" name="button_pressed" value="1">Meet a Friend</button>
							  			  
							  			</form>
							  		</div>
			  					</div>
			  				</div>
			  			</div>
			  			<div class="row-fluid friend-contact hidden-phone">
			  				<div class="span12">
			  					<div class="span4 friend-email">
			  						<?php 
			  							if (isset($friend_email) && !empty($friend_email)){
			  								echo "<a href='mailto:<?php echo $friend_email; ?>?Subject=Meet%20You%20Halfway' target='_top'>
								  							<i class='fa fa-envelope'></i>
			  											</a>";
			  							}
			  							else{
			  								echo "<a href='mailto:<?php echo $friend_email; ?>?Subject=Meet%20You%20Halfway' target='_top' class='disabed-link'>
								  							<i class='fa fa-envelope'></i>
			  											</a>";
			  							}
			  						?>		
			  					</div> 
			  					<div class="span4 friend-twitter">
			  						<?php 
			  							if (isset($friend_twitter) && !empty($friend_twitter)){
			  								echo "<a href='http://www.twitter.com/<?php echo $friend_twitter; ?>' alt='twitter link'>
								  							<i class='fa fa-twitter'></i>
			  											</a>";
			  							}
			  							else{
			  								echo "<a href='http://www.twitter.com' alt='twitter link' class='disabed-link'>
								  							<i class='fa fa-twitter'></i>
			  											</a>";
			  							}
			  						?>					  					
			  					</div>
			  					<div class="span4 friend-facebook">
			  						<?php 
			  							if (isset($friend_facebook) && !empty($friend_facebook)){
			  								echo "<a href='http://www.facebook.com/<?php echo $friend_facebook; ?>' alt='facebook link'>
			  												<i class='fa fa-facebook'></i>
			  											</a>";
			  							}
			  							else{
			  								echo "<a href='http://www.facebook.com' alt='facebook link' class='disabed-link'>
								  							<i class='fa fa-facebook'></i>
			  											</a>";
			  							}
			  						?>
			  					</div>
			  				</div>
			  			</div>
			  		</div>
			  	</div>
	  		</li>
			</div>
		  <?php endforeach; ?>
		</ul>
	 </div>
</div>