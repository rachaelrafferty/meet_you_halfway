<?php

function get_foursquare_venueinfo($access_token, $latitude, $longitude){

	//$venueinfo = file_get_contents("https://api.foursquare.com/v2/venues/search?ll=$la54.5814,-5.923&oauth_token=".$access_token."&v=20140401");
	$venueinfo = file_get_contents("https://api.foursquare.com/v2/venues/search?ll=".$latitude.",".$longitude."&oauth_token=".$access_token."&v=20140401");

	// error_log("Venue Info" . $venueinfo);

	$decoded_venueinfo = json_decode($venueinfo, true);

	return $decoded_venueinfo['response']['venues'];
}


function get_foursquare_single_venue($access_token, $venue_id){

	$venueinfo = file_get_contents("https://api.foursquare.com/v2/venues/".$venue_id."?oauth_token=".$access_token."&v=20140401");

	// error_log("Venue Info" . $venueinfo);

	$decoded_venueinfo = json_decode($venueinfo, true);

	return $decoded_venueinfo['response']['venue'];
}
?>
