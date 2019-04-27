<?php
	// Include the database configuration file
	$connect = mysqli_connect("localhost", "root", "", "toletbd");
	
	function make_query_post($connect)
	{
		$query = "SELECT * FROM user_post ORDER BY post_id DESC ";
		$result = mysqli_query($connect, $query);
		return $result;
	}
	
	function make_query($connect)
	{
		$query = "SELECT * FROM user_post_images where username ='taira'";
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
		$result = make_query($connect);
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
			<img src="data:image/jpeg;base64,'.base64_encode($row['image']).'" style="width:100%;height:100%" />
			<div class="carousel-caption">
			</div>
			</div>
			';
			$count = $count + 1;
		}
		return $output;
	}
	function make_thumbnail($connect)
	{
		$output = '';
		$count = 0;
		$result = make_query_post($connect);
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
			<img src="data:image/jpeg;base64,'.base64_encode($row['photo']).'" style="width:280px;height:200px" />
			<div class="carousel-caption">
			</div>
			</div>
			';
			$count = $count + 1;
		}
		return $output;
	}
	
	
	// Get images from the database
	$query = $connect->query("SELECT * FROM user_post_images where username ='lele5'");
	
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
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="css/main.css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<title>To-Let</title>
		<style type = "text/css">
			.carousel-indicators{
			width: 5px;
			height:5px;
			}
			.ad-figure{
			background:white;
			padding:10px;
			}
			.ad-figure-img{
			background:white;
			padding:10px;
			}
		</style>
		<script type="text/javascript">
			var $ = jQuery.noConflict();
			$(document).ready(function() { 
				$("#dynamic_slide_show").carousel("pause");
			}); 
		</script>
	</head>
	<body>
		<header id="header" class="clearfix">
			<!-- navbar -->
			<nav class="navbar navbar-default" style="border-color:white;flex-wrap:nowrap;">
				<div class="container">
					<!-- navbar-header -->
					<div class="navbar-header">
						<a class="navbar-brand" href="#">
							<img src="images/home_logo_Recovered.jpg" alt="Logo" style="width:250px;" onclick="window.location.href='index.php'";>
						</a>                   
					</div>			
					<!-- /navbar-header -->				
					<div class="navbar-left">
						<ul >							
							<li><a href="index.php" style="font-weight:bold;">Home</a></li>
							<li><a href="index.php" style="font-weight:bold;">Contact us</a></li>
						</ul>																		
					</div>				
					<!-- nav-right -->
					<div class="navbar-right"> 				
						<ul>
							<button onclick="window.location.href='testpost.php'" type="button" class="btn btn-primary" style="margin-top:5px;float:right;">Post Your AD</button>									
							<li><i onclick="window.location.href='user-detail-test.php'" class="fa fa-user" style="font-size:20px;"></i></li>
						</ul> 
						
					</div>			
					<!-- nav-right -->				
				</div><!-- container -->
			</nav><!-- navbar -->
		</header><!-- header -->
		
		<section id="main" class="clearfix" >
			<br>
			<div class="container" >
				<div class="row">
					<!-- carousel -->
					<div class="col-md-9">	
						<div class="container" style="margin-left:-20px;">
							<br />
							<div id="dynamic_slide_show" class="carousel slide" data-ride="carousel" style ="height:400px;">
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
				</div><!-- row -->	
			</div><!-- container -->
			<br>
			<br>
			<br>
			
			<div class="container">		
				<h1>Featured Post</h1>
				<hr align = "left" width="100%"> 
				<br>
				<div class="row">
					<!-- carousel -->
					<div class="col-md-8">						
						<div class="ad-figure">
							<div>
								<?php echo make_thumbnail($connect); ?>	
							</div>
							<div style="float:right;">
								
							</div>
							<hr align = "left" width="100%"> 
						</div>						
					</div>	
					<div class="col-md-8">					
						<div class="ad-figure">
							<div>
								<?php echo make_thumbnail($connect); ?>	
							</div>
							<div style="float:right;">
								
							</div>
							<hr align = "left" width="100%"> 
						</div>						
					</div>
					
				</div><!-- row -->
			</div><!-- container -->
			
			
			
		</section><!-- signup-page -->
		
		
		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="js/jquery.min.js"></script>
		<script src="js/popper.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>