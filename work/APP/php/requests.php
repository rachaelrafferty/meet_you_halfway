<?php
//connect to the database
require_once 'db.php';
require_once 'requests.php';

//find already existing requests by the request id
function find_request($request_id){
	//connect to the database
	global $db;

	$request_result = mysqli_query($db, "SELECT * FROM Requests WHERE Request_Id = '$request_id' LIMIT 1");

	if(mysqli_num_rows($request_result) > 0){
		$request = mysqli_fetch_assoc($request_result);
		error_log("this is the doller-request $request");
		//return the request by the request id
		return $request;
	}else{
		error_log("Request not found $request_id");
	}

}
//find the request by using user A's id
function find_requests_by_user_a_id($user_a_id){

	global $db;

	$result = mysqli_query($db, "SELECT * FROM Requests WHERE User_A_Id = $user_a_id AND Finished = false");

	if(mysqli_num_rows($result) > 0){
		$number_of_results = mysqli_num_rows($result);
		$requests = [];
		for($i = 0; $i < $number_of_results; $i++){
			array_push($requests, mysqli_fetch_assoc($result));	
		}
		error_log("this is the $requests");
		//found the request using user A's id
		return $requests;
	}else{
		//couldnt find the request with user A's id
		error_log("Request not found $request_id");
		return [];
	}
}

//find the request by using user B's id
function find_requests_by_user_b_id($user_b_id){

	global $db;

	$result = mysqli_query($db, "SELECT * FROM Requests WHERE User_B_Id = $user_b_id AND Finished = false");

	if(mysqli_num_rows($result) > 0){
		$number_of_results = mysqli_num_rows($result);
		$requests = [];
		for($i = 0; $i < $number_of_results; $i++){
			array_push($requests, mysqli_fetch_assoc($result));	
		}
		error_log("this is the $requests");
		//found the request using user B's id
		return $requests;
	}else{
		//couldnt find the request with user B's id
		error_log("Request not found $request_id");
		return [];
	}

}
//create a new request for the users with user A coords
function create_request($user_a_id, $user_b_id, $user_a_coords_id ){
	global $db;

	mysqli_query($db, "INSERT INTO Requests SET User_A_Id = '$user_a_id', User_B_Id = '$user_b_id', User_A_Coords = '$user_a_coords_id'");
	
	$request_id = mysqli_insert_id($db);
	$request = find_request($request_id);
 	//insert new request with user's id and long and lat coords
	return $request;
}
//update the request for user b with their coords
function update_request_user_b_coords($request_id, $user_b_coords){
	global $db; 

	mysqli_query($db, "UPDATE Requests SET User_B_Coords = '$user_b_coords' WHERE Request_Id = $request_id");
 	$request = find_request($request_id);
	return $request;
}

function finish_request($request_id){
	global $db;

	query("UPDATE `Requests` SET Finished = true WHERE Request_Id = $request_id");
}

?>