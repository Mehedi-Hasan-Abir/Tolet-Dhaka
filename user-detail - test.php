<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<style>
			body {font-family: Arial;}
			
			/* Style the tab */
			.tab {
			overflow: hidden;
			border: 1px solid #ccc;
			background-color: #f1f1f1;
			}
			
			/* Style the buttons inside the tab */
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
			
			/* Change background color of buttons on hover */
			.tab button:hover {
			background-color: #ddd;
			}
			
			/* Create an active/current tablink class */
			.tab button.active {
			color:green;
			}
			
			/* Style the tab content */
			.tabcontent {
			display: none;
			padding: 6px 12px;
			border-top: none;
			}
			.detail-container{
			overflow: auto;
			margin-left:-15px;
			border: 1px solid #ccc;
			background-color: #f1f1f1;
			}
			.well{
			font-size: 25px;
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
		
		<header id="header" class="clearfix">
			<!-- navbar -->
			<nav class="navbar navbar-default">
				<div class="container">
					<!-- navbar-header -->
					<div class="navbar-header">
						<a class="navbar-brand" href="#">
							<img src="images/home_logo.png" alt="Logo" style="width:40px;">
						</a>                   
					</div>			
					<!-- /navbar-header -->				
					<div class="navbar-left">
						<ul >							
							<li><a href="#">Home</a></li>
							<li><a href="#">Contact us</a></li>
						</ul>																		
					</div>				
					<!-- nav-right -->
					<div class="navbar-right"> 				
						<ul>
							<li><button type="button" class="btn btn-primary nav-btn">Post Your AD</button></li>			
							<li><a href="#">Register</a></li>						
							<li><a href="#"> Sign In </a></li>											
						</ul>                                                                                                                   
					</div>			
					<!-- nav-right -->				
				</div><!-- container -->
			</nav><!-- navbar -->
		</header><!-- header -->
		<section id="main" class="clearfix">
		<div class= "user-detail">
			<div class="container">		
				<div class="tab">
					<div class="well">												
					<span class="category-title">
						Hello                
					</span>												     
					</div>
					<button class="tablinks" onclick="openCity(event, 'Profile')">Profile</button>
					<button class="tablinks" onclick="openCity(event, 'My ADs')">My ADs</button>
					<button class="tablinks" onclick="openCity(event, 'Pending ADs')">Pending ADs</button>
				</div>
				<br>
				<br>
				<br>
				
				
				<div class="col-md-8">
					<div class="detail-container">
						
					<div id="Profile" class="tabcontent">
						<b>UserName</b> <p>London is the capital city of England.</p>
						<b>FirstName</b> <p>London is the capital city of England.</p>	
						<b>LastName</b> <p>London is the capital city of England.</p>	
						<b>Email</b> <p>London is the capital city of England.</p>	
						<b>Address</b> <p>London is the capital city of England.</p>	
					</div>
				
					<div id="My ADs" class="tabcontent">
						<h3>Paris</h3>
						<p>Paris is the capital of France.</p> 
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
			function openCity(evt, cityName) {
				var i, tabcontent, tablinks;
			tabcontent = document.getElementsByClassName("tabcontent");
			for (i = 0; i < tabcontent.length; i++) {
				tabcontent[i].style.display = "none";
			}
			tablinks = document.getElementsByClassName("tablinks");
			for (i = 0; i < tablinks.length; i++) {
				tablinks[i].className = tablinks[i].className.replace(" active", "");
			}
			document.getElementById(cityName).style.display = "block";
			evt.currentTarget.className += " active";
			}
		</script>
		
	</body>
</html> 