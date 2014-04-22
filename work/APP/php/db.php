<?php
//local database unedited 
// Create connection
// $db = mysqli_connect("localhost","root","root","halfway");
$db = mysqli_connect("217.199.187.64","cl51-halfway","Gu9eL5ph","cl51-halfway");


// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

function query($query){
	global $db;

	$result = mysqli_query($db, $query);
	if($result == false){
		error_log("Query failed: \n $query \n " . mysqli_error($db));
	}
	return $result;
}
?>