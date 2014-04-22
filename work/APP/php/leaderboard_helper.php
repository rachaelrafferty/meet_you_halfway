<?php
//connection to the foursquare leaderboard api with oauth token
function get_foursquare_leaderboardinfo($access_token){

	$userLeaderboard = file_get_contents("https://api.foursquare.com/v2/users/leaderboard?oauth_token=".$access_token."&v=20140325&afterTimestamp=1279044824");
	
	$decoded_userLeaderboard = json_decode($userLeaderboard, true);
	
	//return the data about the user's status in the leaderboard on foursquare
	return $decoded_userLeaderboard['response']['leaderboard']['items'];
}
	
	
?>

