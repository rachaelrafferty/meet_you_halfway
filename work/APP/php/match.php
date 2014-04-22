<?php 

//find already existing match by the match id
function find_match($match_id){

	$result = query("SELECT * FROM `Match` WHERE Match_Id = $match_id LIMIT 1");
	if(mysqli_num_rows($result) > 0){
		$match = mysqli_fetch_assoc($result);
		//return the match by the match id
		return $match;
	}else{
		//if the match does not exist, a terminal message will appear
		error_log("Could not find match for match_id $match_id");
	}
}

//find a match using the request id
function find_match_by_request_id($request_id){

	$result = query("SELECT * FROM `Match` WHERE Request_Id = $request_id LIMIT 1");
	if(mysqli_num_rows($result) > 0){
		$match = mysqli_fetch_assoc($result);
		//return the match info by using the request id
		return $match;
	}else{
		//if can not find the match by using the request id, a terminal error message
		error_log("Could not find match for request_id $request_id");
	}	
}

//insert the match's data into the database
function create_match($request_id, $coords_id){
	//connection to the database
	global $db;

	error_log("Create match $coords_id");

	query("INSERT INTO `Match` SET Request_Id = $request_id, Halfway_Coords = $coords_id");

	$match_id = mysqli_insert_id($db);
	$match = find_match($match_id);
	
	//this will be the match after the user accepts the request
	return $match;
}



?>

