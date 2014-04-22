
<?php 
  $request_user = find_user($request['User_A_Id']);
  $venue_id = $match['Venue_Id']; 
  error_log($venue_id);


  $venueinfo = file_get_contents("https://api.foursquare.com/v2/venues/".$venue_id."?oauth_token=".$access_token."&v=20140408");

  $decoded_venueinfo = json_decode($venueinfo, true);
  
  $venue_name = $decoded_venueinfo['response']['venue']['name'];
  $venue_address = $decoded_venueinfo['response']['venue']['location']['address'];
  $venue_number = $decoded_venueinfo['response']['venue']['contact']['formattedPhone'];
  $venue_twitter = $decoded_venueinfo['response']['venue']['contact']['twitter'];

  $venue_lat = $decoded_venueinfo['response']['venue']['location']['lat'];
  $venue_long = $decoded_venueinfo['response']['venue']['location']['lng'];

  foreach ($decoded_venueinfo['response']['venue']['categories'] as $cat_id => $category):
           
    $venue_category_name = $category['name'];

    $venue_icon_pre = $category['icon']['prefix'];
    $venue_icon_size = "bg_88";
    $venue_icon_suf = $category['icon']['suffix'];

    $venue_img_src = $venue_icon_pre.$venue_icon_size.$venue_icon_suf;

  endforeach;

  $venue_map_marker = ('[\''.addslashes($venue_name).'\', '.$venue_lat.', '.$venue_long.']');

?>
<meta http-equiv="refresh" content="20"> <!-- automatic refresh -->
<div class="fade-background" id="hide-modal">
  <div class="modal confirm-venue-choice" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-header">
  		<h3 id="myModalLabel">Would You Like to Meet Here?</h3>
      <button type="button" class="close-btn" id="hide-modal-btn" data-dismiss="modal" aria-hidden="true">
        ×
      </button>
    </div>

    <div class="modal-body">
      <p>
        <i class="fa fa-map-marker make-bold"></i> <span class="make-bold"><?php echo $request_user['Name']; ?> <?php echo $request_user['Surname']; ?></span> suggested you meet at
        <span class="make-bold"><?php echo $venue_name; ?></span>.
      </p>

      <div class="row-fluid">
        <div class="span12">
          <div class="span6 venue-list">
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
                  <div class="venue-select-btn">
                    <?php echo $venue_category_name; ?>
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
          </div>
          <div class="span6 single-map-area">
            <div id="single-venue-map" style="width: 100%; height: 130px;"></div>

              <script type="text/javascript">  
                var locations = [
                <?php echo $venue_map_marker; ?>
                ];

                var map = new google.maps.Map(document.getElementById('single-venue-map'), {
                  zoom: 17,
                    center: new google.maps.LatLng(<?php echo $venue_lat; ?>, <?php echo $venue_long; ?>),
                    mapTypeControl: false,
                    panControl: false,
                    PanControlOptions: false,
                    zoomControl: false,
                    zoomControlOptions: false,
                    scaleControl: false,
                    scrollwheel: false,
                  rotateControl: false,
                  streetViewControl: false,       
                    overviewMapControl: false,           
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
          </div>
        </div>
      </div>

    </div>
    <div class="modal-footer">
      <button class='btn btn-success' onclick="confirm_venue_choice(<?php echo $match['Match_Id']; ?>)">Accept Venue</button>
    </div>
  </div>
</div>
