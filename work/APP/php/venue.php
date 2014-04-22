<?php
require_once 'db.php';
//php/venue.php -> function create_venue($match_id, $venue_id) (venue_id is a foursquare venue id)
function find_venue_choice($venue_id){
	global $db;

	$result = query("SELECT * FROM `Match` WHERE Venue_Id = '$venue_id' LIMIT 1");
	if(mysqli_num_rows($result) > 0){
		$venue_choice = mysqli_fetch_assoc($result);
		return $venue_choice;
	}else{
		error_log("Could not find venue choice for venue_id $venue_id");
	}
}

 //php/venue.php -> function create_venue($match_id, $venue_id) (venue_id is a foursquare venue id)
function update_venue_choice($venue_id, $match_id){

	global $db;
	error_log("Updating venue choice");
	query("UPDATE `Match` SET Venue_Id = '$venue_id' WHERE Match_Id = $match_id");
}

function confirm_venue_choice($match_id){

	query("UPDATE `Match` SET Venue_Confirmed = true WHERE Match_Id = $match_id");
}

?>

