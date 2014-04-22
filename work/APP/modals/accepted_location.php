<?php
  
  require_once 'php/venue_helper.php';

  $venue_id = $match['Venue_Id']; 
  $request_user = find_user($request['User_B_Id']);

  $foursquare_venue = get_foursquare_single_venue($access_token, $venue_id);

?>  
<meta http-equiv="refresh" content="20"> <!-- automatic refresh -->
<div class="fade-background" id="hide-modal">
  <div class="modal the-chosen-location" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-header">
  		<h3 id="myModalLabel">Time to Meet Halfway</h3>
        <button type="button" class="close-btn" id="hide-modal-btn" data-dismiss="modal" aria-hidden="true">
          ×
        </button>
    </div>
    <div class="modal-body ">
      <div class="head-tagline">
        Congratulations!
      </div>
      <div class="big-success-icon">
        <i class="fa fa-check-circle-o finishing-big-icon"></i>
      </div>
      <div class="success-msg">
        <p>
           You and <span class="make-bold"><?php echo $request_user['Name']; ?> <?php echo $request_user['Surname']; ?></span> have decided to meet
           at <span class="make-bold"><?php echo $foursquare_venue['name']; ?></span>.   
        </p>
      </div>
      <div class="have-fun">
        Don't forget to have fun!
      </div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-success" onclick="finished(<?php echo $request['Request_Id']; ?>)">Finish</button>
    </div>
  </div>
</div>
