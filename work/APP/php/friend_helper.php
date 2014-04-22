<?php

//connection to the foursquare friends api with oauth token
function get_foursquare_friendinfo($access_token){

	$userFriends = file_get_contents("https://api.foursquare.com/v2/users/self/friends?oauth_token=".$access_token."&v=20130815&afterTimestamp=1279044824");
	
	$decoded_userFriends = json_decode($userFriends, true);

	//return the data about the user's friends on foursquare
	return $decoded_userFriends['response']['friends']['items'];
}
	
?>

