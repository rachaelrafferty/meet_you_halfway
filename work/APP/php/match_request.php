<?php
//require the php files necessary
require_once 'users.php';
require_once 'coords.php';
require_once 'requests.php';
require_once 'match.php';

//send the email request to the user to meet halfway
function send_request_email($user_b_email, $user_a_name, $user_a_surname){
	//email message
	$emailmessage = "Hello, Your friend ". $user_a_name ."  ".$user_a_surname . "would like to meet you half way";
	//email  subject
	$emailSubject = "Meet You Halfway Email";
	//confirm email was sent
	error_log("Sent email to $user_b_email");

  mail($user_b_email, $emailSubject, $emailmessage);
}

function send_match_request($user_a_id, $user_a_latitude, $user_a_longitude, $user_b_id, $user_b_email, $user_b_name, $user_b_surname){
	//Find both users by email address
	// The first email address and user should already exist
	// The second email address may not have a user yet, if so create one!
	$user_a = find_user($user_a_id);
	$user_b = find_or_create_user($user_b_id, $user_b_email, $user_b_name, $user_b_surname);

	//Update User A coords
	$coords = create_or_update_coords($user_a_id, $user_a_latitude, $user_a_longitude);

	//Create request
	//INSERT request into DB
	$request = create_request($user_a_id, $user_b_id, $coords['Coords_Id']);
	error_log("this is the requests $request");

	//Send Email
	send_request_email($user_b['Email'], $user_a['Name'], $user_a['Surname']);
}

function accept_request($request_id, $latitude, $longitude){

	//find the request by request id
	$request = find_request($request_id);
	
	//get user b id form request
	$user_b_id = $request['User_B_Id']; 
	
	//create coords for for user B

	$user_b_coords = create_or_update_coords($user_b_id, $latitude, $longitude);
	
	//update requests with user b coords id
	update_request_user_b_coords($request_id, $user_b_coords['Coords_Id']);

	//create halfway point coords
	
	//find user a coords
	$user_a_id = $request['User_A_Id']; 

	$user_a = find_user($user_a_id);

	//find the halfway points
	$user_a_coords = find_coords_by_user_id($user_a_id);
	$user_a_latitude = $user_a_coords['Latitude'];
	$user_a_longitude = $user_a_coords['Longitude'];
	
	$user_b_latitude = $user_b_coords['Latitude'];
	$user_b_longitude = $user_b_coords['Longitude'];

	$halfway_latitude = ($user_a_latitude + $user_b_latitude)/2;
	$halfway_longitude = ($user_a_longitude + $user_b_longitude)/2;


  error_log("Halfway point $halfway_latitude , $halfway_longitude");

	$halfway = create_coords($halfway_latitude, $halfway_longitude);

	//Create match
	create_match($request_id, $halfway['Coords_Id']);
}
?>
