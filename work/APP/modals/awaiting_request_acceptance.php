<?php
  $request_user = find_user($request['User_B_Id']);
?>  
<meta http-equiv="refresh" content="20"> <!-- automatic refresh -->
<div class="fade-background" id="hide-modal">
  <div class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-header">
  		<h3 id="myModalLabel">Request Sent</h3>
  <!-- 		<a href="" type="button" class="close-btn" data-dismiss="modal" aria-hidden="true">
  			×
  		</a> -->
    </div>

    <div class="modal-body">
      <p class="make-bold"><i class="fa fa-check-circle-o"></i> Your request was successfully sent!</p> 
      <div class="well">
        Now you are just waiting on <span class="make-bold"><?php echo $request_user['Name']; ?></span> to accept your request.
      </div> 
    </div>
    <div class="modal-footer">
      <button class="btn btn-danger" id="hide-modal-btn" data-dismiss="modal" aria-hidden="true">Close</button>
    </div>
  </div>
</div>
