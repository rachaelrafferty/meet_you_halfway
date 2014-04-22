<?php
  $request_user = find_user($request['User_A_Id']);
?>  
<meta http-equiv="refresh" content="20"> <!-- automatic refresh -->
<div class="fade-background" id="hide-modal">
  <div class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-header">
  		<h3 id="myModalLabel">You Have a Request!</h3>
  		<button type="button" class="close-btn" id="hide-modal-btn" data-dismiss="modal" aria-hidden="true">
  			×
  		</button>
    </div>

    <div class="modal-body center">
      <div class="row-fluid">
        <div class="span12">
          <div class="well">
            Your friend <span class="make-bold"><?php echo $request_user['Name']; ?> <?php echo $request_user['Surname']; ?></span> wants to meet you halfway!  

            <div class="friend-pict">

              <?php 
                require_once 'php/friend_helper.php';
                $friend_connection = get_foursquare_friendinfo($_GET['access_token']);

                foreach ($friend_connection as $id => $friend): 

                  $friend_name = $friend['firstName'];
                  $friend_avatar_pre = substr_replace($friend['photo']['prefix'], '', -1);
                  $friend_avatar_size = "/128x128";
                  $friend_avatar_suf = $friend['photo']['suffix'];
                  $friend_profile_pict = $friend_avatar_pre.$friend_avatar_size.$friend_avatar_suf;

                    if ($request_user['Name'] == $friend_name)
                    {
                      echo '<div class="clip-circle make-circle-smaller" style="background-image: url('.$friend_profile_pict.');"></div>';
                    }
                    else{
                      echo "";
                    } 

                endforeach; 
              ?>
            </div>
          </div>
          <button class='btn btn-success' onclick="accept_request(<?php echo $request['Request_Id']; ?>)">Accept Request</button>
        </div>
      </div>
    </div>
    <div class="modal-footer">

    </div>
  </div>
</div>
