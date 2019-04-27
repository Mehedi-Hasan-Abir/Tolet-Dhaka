<?php
	session_start();
	include('searchpost.php');
	// Include the database configuration file
	$connect = mysqli_connect("localhost", "root", "", "toletbd");
	function make_query($connect)
	{
		$username = $_SESSION['username'];	
		$query = "SELECT * FROM user_post_images where username ='$username'";
		$result = mysqli_query($connect, $query);
		return $result;
	}
	
	function make_slide_indicators($connect)
	{
		$output = ''; 
		$count = 0;
		$result = make_query($connect);
		while($row = mysqli_fetch_array($result))
		{
			if($count == 0)
			{
				$output .= '
				<li data-target="#dynamic_slide_show" data-slide-to="'.$count.'" class="active"></li>
				';
			}
			else
			{
				$output .= '
				<li data-target="#dynamic_slide_show" data-slide-to="'.$count.'"></li>
				';
			}
			$count = $count + 1;
		}
		return $output;
	}
	
	function make_slides($connect)
	{
		$output = '';
		$count = 0;
		$result = make_query_post_id($connect);
		while($row = mysqli_fetch_array($result))
		{
			if($count == 0)
			{
				$output .= '<div class="item active">';
			}
			else
			{
				$output .= '<div class="item">';
			}	  
			$output .= '
			<img src="data:image/jpeg;base64,'.base64_encode($row['image']).'" style="width:640px;height:360px" />
			<div class="carousel-caption">
			</div>
			</div>
			';
			$count = $count + 1;
		}
		return $output;
	}
	
	$title = "";
	$post_id = "";
	$month="";
	$rent = "";
	$negotiable = "";
	$address = "";
	$s_details ="";
	$area_name="";
	
	// Get images from the database
	$query = "SELECT * FROM user_post where  post_id = 6 ";
	$result = mysqli_query($connect, $query);
	$resultCheck = mysqli_num_rows($result);
	if($resultCheck>0){
		while($row = mysqli_fetch_assoc($result)){
			//echo $result;
			$username=$row['username'];
			$title = $row['title'];
			$post_id = $row['post_id'];
			$month = $row['month'];
			$rent = $row['rent'];	
			$address = $row['address'];	
			$s_details = $row['detail'];	
			$area_name = $row['area_name'];
		}
	}
	$sql = "SELECT * FROM account where username='$username';";
	$result = mysqli_query($connect, $sql);
	$resultCheck = mysqli_num_rows($result);
	
	if($resultCheck>0){
		while($row = mysqli_fetch_assoc($result)){
			//echo $result;
			$firstname = $row['first_name'];
			$lastname = $row['last_name'];
			$email = $row['email'];
			$address = $row['address'];
			$mobile = $row['mobile'];						
		}
	}
	/*
		if($query->num_rows > 0){
		while($row = $query->fetch_assoc()){
		$displ = $row['image'];
		//echo '<img src="data:image/jpeg;base64,'.base64_encode($displ).'" />';
		//$imageURL = 'uploads/'.$row["image"];
		?>
		<img src="<?php echo ''; ?>" alt="" /><?php }
		}else{ ?>
		<p>No image(s) found...</p>
		<?php }
	*/
?> 

<!DOCTYPE html>
<html>
	
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="css/jquery.bxslider.css" />
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="css/main.css" /> 
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<title>To-Let</title>
		<style type = "text/css">
			.slider{
			height: 200px;
			margin-top:20px;
			}
			.slider-text{font-size:15px;}
			.courousel-inner{
			width:10px;
			height:100%;
			}
			.description-info {margin :20px:}
		</style>
		
		<script type="text/javascript">
			$(document).ready(function() {
				$('.carousel').carousel({
					interval: 120000
				})
			});
		</script>
	</head>
	<body>
		
		<?php include('header.php'); ?> 				
		<div class="row">
			<!-- carousel -->
			<div class="col-md-7">	
				<div class="container">
					<br />
					<div id="dynamic_slide_show" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<?php echo make_slide_indicators($connect); ?>
						</ol>
						
						<div class="carousel-inner">
							<?php echo make_slides($connect); ?>
						</div>
						<a class="left carousel-control" href="#dynamic_slide_show" data-slide="prev">
							<span class="glyphicon glyphicon-chevron-left"></span>
							<span class="sr-only">Previous</span>
						</a>
						
						<a class="right carousel-control" href="#dynamic_slide_show" data-slide="next">
							<span class="glyphicon glyphicon-chevron-right"></span>
							<span class="sr-only">Next</span>
						</a>
						
					</div>
				</div>
			</div>				
			<!-- slider-text -->
			<div class="col-md-5">
				<div class="slider-text" style="margin-top:20px;">
					<h2 style="color:blue;font-weight:bold;font-family:Arial;"> <?php echo $title ?> </h2>
					<h3 style="font-weight:bold;"> BDT <?php echo $rent ?> </h3>
					<p><span>Offered by: <a href=""> <?php echo $username ?> </a></span>							
						<span class="icon"><i class="fa fa-map-marker"></i><a href=""> <?php echo $area_name ?> </a></span>
						
						
						
						<!-- short-info -->
						<div class="short-info">
							<h4>Short Info</h4>
							<p><strong>Condition: </strong><a href="">Room</a> </p>
							<p><strong>Categories: </strong><a href="">Student</a> </p> 
							<p><strong>Address: </strong><a href=""> <?php echo $address ?> </a> </p>
						</div><!-- short-info -->
						
						<!-- contact-with -->
						<div class="contact-with">
							<h4 style="color:blue;font-family:Arial;">Contact with </h4>
							<span class="btn btn-red show-number">
								<i class="fa fa-phone-square"></i>
								<span > <?php echo $mobile ?></span>
							</span>
						</div><!-- contact-with -->
						
						<!-- social-links -->
						<div class="social-links">
							<h4>Share this ad</h4>
						</div><!-- social-links -->	
						
						
						
						
					</div>
				</div><!-- slider-text -->				
			</div>				
			
			<div class="description-info" style="margin:15px;>
				<div class="row">	
						<!-- description -->
						<div class="col-md-8">
							<div class="description" ">
								<h1>Description :</h4>
								<p> </p>
							</div>
						</div><!-- description -->
				</div><!-- row -->
			</div><!-- description-info -->	
			
			<script type="text/javascript">
				var $ = jQuery.noConflict();
				$(document).ready(function() { 
					$('#dynamic_slide_show').carousel({ interval: 100000, cycle: false });
				}); 
			</script>
			
			<!-- Optional JavaScript -->
			<!-- jQuery first, then Popper.js, then Bootstrap JS -->
				<script src="js/jquery.bxslider.js"></script>
				<script src="js/jquery.min.js"></script>
				<script src="js/popper.min.js"></script>
				<script src="js/bootstrap.min.js"></script>
				
				
				
		</body>
	</html>							