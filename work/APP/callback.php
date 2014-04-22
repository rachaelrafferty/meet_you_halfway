<?php

require_once 'php/foursquare.php';

	if($_GET['code']){
		//This links up the authkey URL and get the key in JSON format

		$authkey = file_get_contents("https://foursquare.com/oauth2/access_token?client_id=".$client_id."&client_secret=".$secret."&grant_type=authorization_code&redirect_uri=".$redirect."&code=".$_GET['code']);

		//decode it and store that key in a variable
		$decoded_auth = json_decode($authkey,true);

		$access_token = $decoded_auth['access_token'];
		//look up endpoint of the api I want

		header("Location: application.php?access_token=$access_token");
		die();
	}
