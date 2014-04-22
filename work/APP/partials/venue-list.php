<div class="row-fluid venue-ul">
  <div class="span12">
    <div class="span5">
  		<ul>
  			<?php 

  			require_once 'php/venue_helper.php';
  			$venue_connection = get_foursquare_venueinfo($_GET['access_token'], $halfway['Latitude'], $halfway['Longitude']);

  			foreach ($venue_connection as $id => $venue): 

  			$venue_id = $venue['id'];
  			$venue_number = $venue['contact']['formattedPhone'];
  			$venue_twitter = $venue['contact']['twitter'];
  			$venue_name = $venue['name'];
  			$venue_address = $venue['location']['address'];
  			$venue_lat = $venue['location']['lat'];
  			$venue_long = $venue['location']['lng'];

  			$venue_map_marker = ('['.$venue_name.', '.$venue_lat.', '.$venue_long.']');


  				foreach ($venue['categories'] as $cat_id => $category):
  			 
  				$venue_category_id = $category['id'];
  				$venue_category_name = $category['name'];

  				$venue_icon_pre = $category['icon']['prefix'];
  				$venue_icon_size = "bg_88";
  				$venue_icon_suf = $category['icon']['suffix'];

  				$venue_img_src = $venue_icon_pre.$venue_icon_size.$venue_icon_suf;

  				endforeach;
  			?>

  		 	<div class="venue-list">
  		 		<li>
					<!--<p><strong>var location: </strong><?php //echo $venue_map_marker; ?></p>-->
  		 			<div class="row-fluid">
  		 				<div class="span12">

  		 					<div class="span4 venue-icon">
  		 						<div class="clip-circle make-circle-even-smaller" style="background-image: url(<?php  echo $venue_img_src; ?>);"></div>
  		 					</div>
  		 					<div class="span8">
  		 						<div class="venue-name">
  		 							<?php echo $venue_name; ?>
  		 						</div>
  		 						<div class="venue-address">
	  		 						<?php 
	  		 							if (isset($venue_address) && !empty($venue_address)){
	  		 								echo ("<i class='fa fa-map-marker make-bold'></i>: ".$venue_address);
	  		 							}
	  		 							else{
	  		 								echo ("<i class='fa fa-map-marker make-bold'></i>: No Address Entered!");
	  		 							}
	  		 						?>
	  		 					</div>
  		 						<!--<p>venue lat : <?php //echo $venue_lat; ?></p>
  		 						<p>venue lng : <?php //echo $venue_long; ?></p>-->
  		 						<div class="venue-select-btn">

  		 							<button class='btn btn-success' onclick="send_venue_choice('<?php echo $venue_id; ?>', <?php echo $match['Match_Id']; ?>)">Select Venue</button>
  		 						</div>
  		 					</div>
  			 			</div>
  		 			</div>
		
  		 			<div class="row-fluid venue-contact">
  		 			  <div class="span12">
  		 			  	<div class="span6 venue-phone">
  		 			  		<div class="hover panel">
	  		 			  		<?php
	  		 			  		  if (isset($venue_number) && !empty($venue_number)){
	  		 			  		 		echo "

	  		 			  		 		  <div class='front'>
	  		 			  		 		    <div class='pad'>
	  		 			  		 		    	<i class='fa fa-phone'></i>
	  		 			  		 				</div>
	  		 			  		 			</div>

	 			  		 						<div class='back'>
	 			  		 			        <div class='pad hover-over'>"
	 			  		 			        	.$venue_number.
	 			  		 			        "</div>
	 			  		 			      </div>";
	  		 			  	  		}
	  	  							else{
	  	  								echo "<a href='' alt='twitter link' class='disabed-link'>
	  						  							<i class='fa fa-phone'></i>
	  	  											</a>";
	  	  							}

	 									?>

									</div>
  		 			  	</div> 
  		 			  	<div class="span6 venue-twitter">
  		 			  	  <?php 
  		 			  	  	if (isset($venue_twitter) && !empty($venue_twitter)){
  		 			  	  			echo "<a href='http://www.twitter.com/".$venue_twitter."' ". "alt='twitter link'>
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
  		 			  </div>
  		 			</div>
  	  		</li>
  			</div>
  		  <?php endforeach;  ?>
  		</ul>
    </div>
    <div class="span7">
    		
    	<div id="venue-map" style="width: 100%; height: 400px;"></div>

	    <script type="text/javascript">
	    		
	    		var locations = [
	    			<?php
	    				foreach ($venue_connection as $id => $venue): 

								$venue_id = $venue['id'];
								$venue_name = $venue['name'];
								$venue_address = $venue['location']['address'];
								$venue_lat = $venue['location']['lat'];
								$venue_long = $venue['location']['lng'];
								$venue_map_marker = ('[\''.addslashes($venue_name).'\', '.$venue_lat.', '.$venue_long.'],');
	    			?>
	    					<?php echo $venue_map_marker; ?>
	    			<?php endforeach; ?>
	    		];

			   	var map = new google.maps.Map(document.getElementById('venue-map'), {
			    	zoom: 17,
			    	//need to make this the halfway point coords
			    	// <?php $map_center = ($halfway['Latitude'].", ".$halfway['Longitude']); ?>
			    	<?php error_log('this is the map center coords = '.$map_center); ?>
			    		// center: new google.maps.LatLng(54.5827, -5.92518),
			    		center: new google.maps.LatLng(<?php echo $map_center; ?>),
			        mapTypeControl: true,
			        panControl: true,
			        PanControlOptions: true,
			        zoomControl: true,
			        zoomControlOptions: true,
			        scaleControl: true,
			        scrollwheel: true,
			     	rotateControl: true,
			     	streetViewControl: true,       
			        overviewMapControl: true,           
			     mapTypeId: google.maps.MapTypeId.ROADMAP
			   	});

			  	var infowindow = new google.maps.InfoWindow();

			  	var marker, i;

			  	for (i = 0; i < locations.length; i++) {  
			    	marker = new google.maps.Marker({
			      	position: new google.maps.LatLng(locations[i][1], locations[i][2]),
			      	map: map
		     	});

			    google.maps.event.addListener(marker, 'click', (function(marker, i) {
			      return function() {
			        infowindow.setContent(locations[i][0]);
			        infowindow.open(map, marker);
			      }
			    })(marker, i));
			  }
			</script>
		<button class='btn btn-danger cancel-request-btn' onclick="confirm_venue_choice(<?php echo $match['Match_Id']; ?>)">Cancel Request</button>
    </div>
  </div>
</div>
