<?php

	require_once 'php/match_request.php';

	$request_id = $_POST['request_id'];
	$latitude = $_POST['latitude'];
	$longitude = $_POST['longitude'];


	accept_request($request_id, $latitude, $longitude);

?>