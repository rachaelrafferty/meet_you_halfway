<?php

require_once 'php/venue.php';

//select_venue.php -> (looks like send_match_request.php)

//venue_id is the venue id from foursquare api 
$venue_id = $_POST['venue_id'];
$match_id = $_POST['match_id'];

update_venue_choice($venue_id, $match_id);

?>