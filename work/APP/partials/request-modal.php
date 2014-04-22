<div id="requestModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
		<h3 id="myModalLabel">Requests to Meet You Halfway</h3>
		<a href="" type="button" class="close-btn" data-dismiss="modal" aria-hidden="true">
			×
		</a>
  </div>

  <div class="modal-body">
    <?php
      
      foreach($requests as $request ): 
      
      $match = find_match_by_request_id($request['Request_Id']);
      $request_from = find_user($request['User_A_Id']);

      //Try to find venue selection
      //If venue exists show venue confirmation

      if($match): //Match already found
    ?>
            
    <div class='row-fluid'>
      <div class='span12 request'>
        <div class="well">
            <a href='' class="refresh-link" alt="refresh" >
              <i class="fa fa-check-circle-o make-bold"></i> 
              You have accepted a request from <span class="make-bold"><?php echo $request_from['Name'] . " " . $request_from['Surname']; ?></span>
            </a>
        </div>
      </div>
    </div>



    <?php
      else://Request needs accepted
        $request_from = find_user($request['User_A_Id']);
    ?>

    <div class='row-fluid'>
      <div class='span12 request'>
        <div class="well">
          <i class="fa fa-envelope make-bold"></i> You have a request from <span class="make-bold"><?php echo $request_from['Name'] . " " . $request_from['Surname']; ?></span>
          <button class='btn btn-success go-right' onclick="accept_request(<?php echo $request['Request_Id']; ?>)">Accept Request</button>
        </div>
      </div>
    </div>

    <?php
      endif;
      endforeach;
    ?>

    <!-- ===== Check for match request (by us) ======== -->

    <?php

          $requests = find_requests_by_user_a_id($user_id);
          //echo "<p>Your Requests: " . count($requests) . " requests </p>";

          foreach($requests as $request ): ?>
          <?php
            $match = find_match_by_request_id($request['Request_Id']);
            $request_to = find_user($request['User_B_Id']);


            if($match): //Match already found
          ?>
            <div class='row-fluid'>
              <div class='span12 request'>
                <div class="well">
                  <a href=" " alt="refresh" class="refresh-link">
                    <i class="fa fa-check-circle-o make-bold"></i> 
                    <span class="make-bold"><?php echo $request_to['Name'] . " " . $request_to['Surname']; ?></span>
                    accepted your match. 
                  </a>
                </div>
  
                <?php
                  //TODO

                  //Get a list of locations near halfway point
                  //Display the list

                  //Pick a location button
                    //onclick='select_location(something, something)'
                    //Javascript function -> Make AJAX call to select_location.php
                    //select_venue.php -> (looks like send_match_request.php)
                    //php/venue.php -> function create_venue($match_id, $venue_id) (venue_id is a foursquare venue id)
                
                  //See above for User B side
                ?>
              </div>
            </div>

          <?php
            else://Request needs accepted
          ?>

            <div class='row-fluid'>
              <div class='span12 request'>
                <div class="well">
                    <i class="fa fa-clock-o make-bold"></i>
                    You are waiting for <span class="make-bold"><?php echo $request_to['Name'] . " " . $request_to['Surname']; ?></span> to accept your request
                </div>
              </div>
            </div>

        <?php
          endif;
          endforeach;
        ?>    

  </div>
  <div class="modal-footer">
    <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Close</button>
  </div>
</div>
