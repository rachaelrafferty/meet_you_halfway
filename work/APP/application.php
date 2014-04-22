<?php
require_once 'php/foursquare.php';
require_once 'php/db.php';
require_once 'php/users.php';
require_once 'php/requests.php';
require_once 'php/coords.php';
require_once 'php/match.php';
require_once 'php/user_helper.php';
require_once 'php/venue.php';

$access_token = $_GET['access_token'];

$user = find_or_create_user($user_id, $email, $name, $surname);

$requests = find_requests_by_user_b_id($user_id);


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
 
	<head>
		
		<title>Meet You Halfway</title>
		
		<!-- META TAGS -->
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<meta name="generator" content="Geany 0.20" />
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
		<meta http-equiv="refresh" content="180"> <!-- automatic refresh -->


		<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=true"></script>

		<!-- FAV ICON -->
		<link rel="icon" href="favicon.ico" type="image/ico" />

		<!-- CSS LINKS -->
		<link rel="stylesheet" type="text/css" href="css/bootstrap/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="css/bootstrap/bootstrap-responsive.min.css" />
		<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
		<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="css/homepage.css" />
		<link rel="stylesheet" type="text/css" href="css/modal.css" />
		<link rel="stylesheet" type="text/css" href="css/buttons.css" />
		<link rel="stylesheet" type="text/css" href="css/flip.css" />

		<!-- JAVASCRIPT LINKS -->
		<script type="text/javascript" src="js/jquery-1.11.0.js"></script>
		<script type="text/javascript" src="js/bootstrap/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/application.js"></script>

	</head>
	 
	<body>

	<div class="container-fluid white-bg">

		<!-- ===== NAVIGATION SECTION ===== -->
		<?php include 'partials/nav.php'; ?>
		
		<!-- ====== Modals ================= -->
		<?php
			$requests_for_me = find_requests_by_user_b_id($user_id);
			$requests_from_me = find_requests_by_user_a_id($user_id);

			// Is there any requests from me?
			if(count($requests_from_me) > 0){

				$request = $requests_from_me[0];

				$match = find_match_by_request_id($request['Request_Id']);

				// Is there a match?
				if($match){
					// Have I picked a location
					if($match['Venue_Id']){
						//has the location been confirmed?
						if($match['Venue_Confirmed']){
							//  Show success! (5)
							include 'modals/accepted_location.php';
						}else{
							// Show Waiting location confirmation (4)
							include 'modals/waiting_on_venue_acceptance.php';
						}
									
					}else {//(request and match, no location)
						include 'modals/select_location.php';
					} // Show location list (3)
				}else{ // Else (request, no match)
					// Awaiting acceptance (2)
					include 'modals/awaiting_request_acceptance.php';
				}
				
					

			// Is there any request for me?
			}elseif(count($requests_for_me) > 0){
				$request = $requests_for_me[0];

				$match = find_match_by_request_id($request['Request_Id']);

				// Is there a match (Have I accepted request?)
				if($match){

					//Has the location been selected?
					if($match['Venue_Id']){

							if($match['Venue_Confirmed']){//Have I accepted the location?
								// Woot! Success (5)
								include 'modals/accepted_location.php';
							}else{

							// Else
								//Show accept location (4b)
								include 'modals/confirm_venue.php';
							}
					}else{

					// Else (no location)

						//Show waiting for location (3b)
						include 'modals/waiting_for_location.php';

					}
					
				}else{
					include 'modals/accept_request.php';
					// Show accept request (2b)
				}
		
					
			}else{
				//Show  Homepage i.e. Do Nothing!
				
			}

?>
		<!--<?php // include 'partials/venue-list.php'; ?>-->

		<!-- ===== USER DASHBOARD SECTION ===== -->
		<?php include 'partials/user-dashboard.php'; ?>

		<!-- ===== FRIEND LIST SECTION ===== -->
		<?php include 'partials/friend-list.php'; ?>
	
	</div>

	</body>
 
</html>