<?php
  $request_user = find_user($request['User_B_Id']);

  $halfway = find_coords($match['Halfway_Coords']);
?>  
<meta http-equiv="refresh" content="20"> <!-- automatic refresh -->
<div class="fade-background" id="hide-modal">
  <div class="modal select-venue-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-header">
      <h3 id="myModalLabel">Pick a Place to Meet!</h3>
      <button type="button" class="close-btn" id="hide-modal-btn" data-dismiss="modal" aria-hidden="true">
        ×
      </button>
    </div>

    <div class="modal-body select_venue_body">
      <div class="row-fluid">
        <div class="span12">
          <p>See a list of all the different places you can meet <span class="make-bold"><?php echo $request_user['Name']; ?> <?php echo $request_user['Surname']; ?></span>.  
             Browse the map for all the different places that you can chose:
              <!-- Halfway coords = <?php //echo ''. $halfway['Latitude'] . ',' . $halfway['Longitude']; ?> -->
          </p>  
        </div>
      </div>
      <div class="row-fluid head-space">
        <div class="span12">
          <?php include 'partials/venue-list.php'; ?>
        </div>
      </div>
    </div>
  </div>
</div>