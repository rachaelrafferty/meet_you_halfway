<?php require_once 'php/foursquare.php'; ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
 
	<head>
		<title>Meet You Halfway Landing Page</title>
		
		<!-- META TAGS -->
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<meta name="generator" content="Geany 0.20" />
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />

		<!-- CSS LINKS -->
		<link rel="stylesheet" type="text/css" href="css/bootstrap/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="css/bootstrap/bootstrap-responsive.min.css" />
		<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="css/login.css" />
		<link rel="stylesheet" type="text/css" href="css/buttons.css" />

 		<!-- JAVASCRIPT LINKS -->
		<script type="text/javascript" src="js/bootstrap/bootstrap.js"></script>
		<script type="text/javascript" src="js/application.js"></script>
		<script type="text/javascript" src="js/bootstrap/bootstrap.min.js"></script>
		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>

	</head>
 
	<body>

		<div id="wrapper">
			<form action="callback.php" method="post"> 	
				<div class="well">
					<div class="row-fluid">
							<div class="span12">

								<div class="row-fluid text-logo">
									<div class="span12">
										<img src="http://www.meetyouhalfway.co.uk/APP/img/logos/meet-you-halfway.png" alt="text logo" />
									</div>
								</div>

								<div class="row-fluid map-logo">
									<div class="span12">
										<img src="http://www.meetyouhalfway.co.uk/APP/img/logos/map-logo.png" alt="map icon logo" />
									</div>
								</div>

								<div class="row-fluid gutter-top margin-sides">
									<div class="span12">
										<a href="https://foursquare.com/oauth2/authenticate?client_id=<?php echo $client_id; ?>&response_type=code&redirect_uri=<?php echo $redirect; ?>" 
											 title="Login" alt="login button" type="submit" class="btn btn-success login-btn"/>
											Login 
										</a>
									</div>
								</div>

								<div class="row-fluid gutter-top margin-sides">
									<div class="span12">
										<a href="https://foursquare.com/signup" alt="signup button" class="btn btn-info login-btn">
									 		Sign Up
									 	</a>
									</div>
								</div>

								<div class="row-fluid powered-by">
									<div class="span12">
										<a href="https://foursquare.com/" alt="foursquare powered by" >
											<img src="img/poweredByFoursquare.png" alt="powered by foursquare" />
										</a>
									</div>
								</div>

							</div>
					</div>
				</div>
			</form>
		</div>

		<div id="mapbg"></div>
		<div class="map-overlay"></div>

	</body> 
</html>
