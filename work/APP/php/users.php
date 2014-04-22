<?php
//connect to the database
require_once 'db.php';

function find_or_create_user($user_id, $email, $first_name, $last_name){
	global $db;

	$user = find_user($user_id);

	if(!$user){
		$user = create_user($user_id, $email, $first_name, $last_name);
	}	
	return $user;
}
//create a user when they login 
function create_user($user_id, $email, $first_name, $last_name){
	global $db;

	mysqli_query($db, "INSERT INTO User SET User_Id = $user_id, Email = '$email', Name = '$first_name', Surname = '$last_name'");

	$user = find_user($user_id);

	return $user;
}
//find the user by the user'sid
function find_user($user_id){
	global $db;

	$result = mysqli_query($db, "SELECT * FROM User WHERE User_Id = '$user_id' LIMIT 1");
	
	if(mysqli_num_rows($result) > 0){
		$user = mysqli_fetch_assoc($result);
		return $user;
	}
}


?>