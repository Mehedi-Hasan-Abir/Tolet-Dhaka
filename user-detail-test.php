<?php 	
	session_start();
	include('logouth.php') ;	
	include('db.php') ;
	$username = $_SESSION['username'];
	$sql = "SELECT * FROM account where username='$username';";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	
	$title = "";
	$post_id = "";
	$month="";
	$rent = "";
	$negotiable = "";
	$address = "";
	$s_details ="";
	$area_name="";
	
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
	
	$count = 0 ;
	$output='';
	$post_id = '';
	$query = "SELECT * FROM user_post where username='$username';";
	$result = mysqli_query($conn, $query);
	$resultCheck = mysqli_num_rows($result);
	if($resultCheck>0){
		while($row = mysqli_fetch_assoc($result)){
			//echo $result;
			$title = $row['title'];
			$post_id = $row['post_id'];
			$month = $row['month'];
			$rent = $row['rent'];	
			$address = $row['address'];	
			$s_details = $row['detail'];	
			$area_name = $row['area_name'];
			
			$query_img = "SELECT * FROM user_post_images where username='$username' and post_id = $post_id ";
			$result2 = mysqli_query($conn, $query_img);
			$row2 = mysqli_fetch_array($result2);
			$output .= '
			<img src="data:image/jpeg;base64,'.base64_encode($row2['image']).'" style="width:280px;height:190px;" />
			<div class="carousel-caption">
			</div>
			</div>
			';						
		}
		
		
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<style>
			body {font-family: Arial;}
			
			.tab {
			overflow: hidden;
			border: 1px solid #ccc;
			background-color: #f1f1f1;
			}
			
			.tab button {
			background-color: inherit;
			float: left;
			border: none;
			outline: none;
			cursor: pointer;
			padding: 14px 16px;
			transition: 0.3s;
			font-size: 17px;
			}
			
			.tab button:hover {
			background-color: #ddd;
			}
			
			.tab button.active {
			color:green;
			}
			
			.tabcontent {
			display: none;
			padding: 6px 12px;
			border-top: none;
			}
			.detail-container{
			overflow: auto;
			margin-left:-15px;
			border: 1px solid #ccc;
			border-radius:5px;
			background-color: #f1f1f1;
			}
			.well2{
			font-size: 30px;
			padding: 6px 12px;
			background-color: #f1f1f1;
			}
		</style>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/main.css" /> 
		<title>To-Let</title>
		
	</head>
	<body>			
		<section id="main" class="clearfix">
			<div class= "user-detail">
				<div class="container">	
					<br>
					<div class="tab">
						<div class="well2">												
							<span class="category-title">
								Hello 
								<?php echo $_SESSION['username']; ?>
							</span>												     
						</div>
						<button class="tablinks" onclick="openTab(event, 'Profile')">Profile</button>
						<button class="tablinks" onclick="openTab(event, 'My ADs')">My ADs</button>
						<button class="tablinks" onclick="openTab(event, 'Pending ADs')">Pending ADs</button>
					</div>
					<br>
					<br>
					<br>
					
					
					<div class="col-md-8">
						<div class="detail-container">
							
							<div id="Profile" class="tabcontent" style="display:block">
								<br>
								<b>FirstName:</b> <?php echo $firstname?>
								<br>
								<br>
								<b>LastName:</b> <?php echo $lastname?>	
								<br>
								<br>
								<b>Email:</b> <?php echo $email?>
								<br>
								<br>
								<b>Address:</b> <?php echo $address?>	
								<br>
								<br>
								<b>Mobile:</b> <?php echo $mobile?>
								<br>
								<br>
							</div>
							
							<div id="My ADs" class="tabcontent">
								<div class="container">					
									<div class="row">
										<!-- carousel -->
										<div class="col-md-8">	
											
											<div class="ad-figure">
												<div>
													<?php 
														echo $title ; 
														echo $area_name;
														echo $rent;
														echo $output;
													?>	
												</div>
												<div style="float:right;">
													HI
												</div>
												<hr align = "left" width="100%"> 
											</div>						
										</div>					
									</div><!-- row -->
								</div><!-- container -->
								
							</div>
							
							<div id="Pending ADs" class="tabcontent">
								<h3>Tokyo</h3>
								<p>Tokyo is the capital of Japan.</p>
							</div>
							
						</div>				
					</div>				
				</div>
			</div>
		</section>
		
		<script>
			function openTab(evt, tabName) {
				var i, tabcontent, tablinks;
				tabcontent = document.getElementsByClassName("tabcontent");
				for (i = 0; i < tabcontent.length; i++) {
					tabcontent[i].style.display = "none";
				}
				tablinks = document.getElementsByClassName("tablinks");
				for (i = 0; i < tablinks.length; i++) {
					tablinks[i].className = tablinks[i].className.replace(" active", "");
				}
				document.getElementById(tabName).style.display = "block";
				evt.currentTarget.className += " active";
			}
			
		</script>
		
	</body>
</html> 		