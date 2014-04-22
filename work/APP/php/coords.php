<?php
//connection to the database
require_once 'db.php';

//find already existing coords by the coords id
function find_coords($coords_id){
	$result = query("SELECT * FROM Coords WHERE Coords_Id = $coords_id LIMIT 1");
	if(mysqli_num_rows($result) > 0){
		$coords = mysqli_fetch_assoc($result);
		//return the coords by the coords id
		return $coords;
	}else{
		//if the coords do not exist, a terminal message will appear
		error_log("Could not find coord for user $user_id");
	}
}

//find the coords using the user'id
function find_coords_by_user_id($user_id){
	$result = query("SELECT * FROM Coords WHERE User_Id = $user_id LIMIT 1");
	if(mysqli_num_rows($result) > 0){
		$coords = mysqli_fetch_assoc($result);
		//return the coords by using the user's id
		return $coords;
	}else{
		//if can not find the coords by using the user id, a terminal error message
		error_log("Could not find coord for user $user_id");
	}
}

//either update user's coords and if dont exist, then make new user id with lat and long coords
function create_or_update_coords($user_id, $latitude, $longitude){
	global $db;
	error_log("Create or update coords for $user_id");
	$coords = find_coords_by_user_id($user_id); // There is only one coord per user
	if(!$coords){
		create_coords_for_user($user_id, $latitude, $longitude);
		$coords = find_coords_by_user_id($user_id);
	}else{
		update_coords($user_id, $latitude, $longitude);
		$coords = find_coords_by_user_id($user_id);
	}
	return $coords;
}

//create a new coords for the user
 function create_coords_for_user($user_id, $latitude, $longitude){
	global $db;
	error_log("Creating coords for $user_id");

	query("INSERT INTO Coords SET Longitude = $longitude, Latitude = $latitude, User_Id = $user_id");
	$coords_id = mysqli_insert_id($db);
 	$coords = find_coords_by_user_id($user_id);
 	//insert new coords with user's id and long and lat coords
 	return $coords;
}


//insert the user's coords into the database
 function create_coords($latitude, $longitude){
	global $db;
	error_log("Creating coords for halfway point");

	query("INSERT INTO Coords SET Longitude = $longitude, Latitude = $latitude");
	$coords_id = mysqli_insert_id($db);
 	$coords = find_coords($coords_id);

 	//this will be the halfway coords for the usser
 	return $coords;
 	error_log('THIS IS THE HALFWAY COORDS $coords');
}

//update the lat and long coords for user_id
 function update_coords($user_id, $latitude, $longitude){
 	error_log("Updating coords for $user_id");

 	query("UPDATE Coords SET Longitude = '$longitude', Latitude = '$latitude' WHERE User_Id = $user_id");
 	$coords = find_coords_by_user_id($user_id);
	return $coords;
 }

?>