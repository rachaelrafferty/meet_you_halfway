<?php
require_once 'php/foursquare.php';
require_once 'php/db.php';
require_once 'php/users.php';
require_once 'php/requests.php';
require_once 'php/match.php';
?>

<div class="row-fluid">
	<div class="span12">

		<div class="span5">
			<a href="http://www.meetyouhalfway.co.uk/APP/index.php" alt="home button">
				<img src="http://www.meetyouhalfway.co.uk/APP/img/logos/main-logo.png" class="main-logo" alt="full logo" />
			</a>
		</div>
		<div class="span7 no-left-margin">
			<div class="nav">

					<div class="nav-section">
						<a href="#aboutModal" data-toggle="modal" alt="about">About</a>
					</div>
					<div class="nav-section">
						<a href="#requestModal" data-toggle="modal" alt="requests">
							<?php

								

									if (count($requests) >= 1){
										echo "Requests<div class='badge-holder'><span class='badge badge-important requests-badge'>".(count($requests))."</span></div>";
						}
						else{
							echo "Requests";
						}
									?>

						</a>
					</div>
					<div class="nav-section">
						<a href="#contactModal" data-toggle="modal" alt="contact">Contact</a>
					</div>
			</div>
		</div>
	</div>
</div>

<!-- About Modal -->
<?php include 'partials/about-modal.php'; ?>

<!-- Contact Modal -->
<?php include 'partials/contact-modal.php'; ?>

<!-- Request Modal -->
<?php include 'partials/request-modal.php'; ?>