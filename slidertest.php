<?php
?> 

<!DOCTYPE html>
<html>
	
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="css/jquery.bxslider.css" />
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="css/main.css" /> 
		<title>To-Let</title>
		<style type = "text/css">
			.slider{
			height: 200px;
			margin-top:20px;
			}
		</style>
		<script>
			$(document).ready(function(){
				$('.slider').bxSlider();
			});
		</script>
	</head>
	<body>
		<?php include('header.php'); ?>	
							
			<div class="row">
				<!-- carousel -->
				<div class="col-md-7">					
					<div class = "slider">
						<div><img  src="images/ad.jpg"></div>
						<div><img  src="images/banner.jpg"></div>
						</div>
				</div>
				
				<!-- Optional JavaScript -->
				<!-- jQuery first, then Popper.js, then Bootstrap JS -->
				<script src="js/jquery.bxslider.js"></script>
				<script src="js/jquery.min.js"></script>
				<script src="js/popper.min.js"></script>
				<script src="js/bootstrap.min.js"></script>

			</body>
		</html>					