<?php

require_once 'php/match_request.php';


$user_a_id = $_POST['user_a']['id'];
$user_a_latitude = $_POST['user_a']['latitude'];
$user_a_longitude = $_POST['user_a']['longitude'];

$user_b_id = $_POST['user_b']['id'];
$user_b_email = $_POST['user_b']['email'];
$user_b_name = $_POST['user_b']['name'];
$user_b_surname = $_POST['user_b']['surname'];


send_match_request($user_a_id, $user_a_latitude, $user_a_longitude, $user_b_id, $user_b_email, $user_b_name, $user_b_surname);

?>
