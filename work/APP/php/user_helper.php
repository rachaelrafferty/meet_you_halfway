<!-- 
// This function is like a tool - you want to use it over and over again to make your life easier, so we set it up to act like one,
// we can pass it an $access_token, which it uses to convert it over to $decoded_userinfo and that's what we're returning back to
// your view. Every function should return something!
  -->
<?php
//connection to the foursquare user's api with oauth token
function get_foursquare_userinfo($access_token){

	$userinfo = file_get_contents("https://api.foursquare.com/v2/users/self?v=20130815&oauth_token=".$access_token);
	
	$decoded_userinfo = json_decode($userinfo, true);
	//return the data about the user and their profile on foursquare
	return $decoded_userinfo['response']['user'];
}
	$user_connection = get_foursquare_userinfo($_GET['access_token']);
	//the data i can call from the foursquare api 
	$user_id = $user_connection['id'];
	$name = $user_connection['firstName']; 
	$surname = $user_connection['lastName'];
	$gender = $user_connection['gender'];
	$bio = $user_connection['bio'];
	$avatar_pre = $user_connection['photo']['prefix'];
	$avatar_suf = $user_connection['photo']['suffix'];
	$avatar_size = "/150x150";
	$home_city = $user_connection['homeCity'];
	$email = $user_connection['contact']['email'];
	$facebook = $user_connection['contact']['facebook'];
	$twitter = $user_connection['contact']['twitter'];
	$badges = $user_connection['badges']['count'];
	$mayorships = $user_connection['mayorships']['count'];
	$friend_count = $user_connection['friends']['count'];
	$checkin_count = $user_connection['checkins']['count'];

?>

 <!-- 
// In your view or whatevs - get_foursquare_userinfo() is passing in the access_token which the tool is going to use to get the info
// and 'return' (remember from the previous one there ^^) it to the variable we set, which here is $user_connection. This means we can use
// the $user_connection variable and it'll have all the details we need, and $user_connection will change each time we send it a different
// access token :)
 
 -->