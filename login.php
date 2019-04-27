<?php
	include('header.php');
	session_start();
	// LOGIN USER
	$username = "";
	$password = "";
	$errors = array(); 
	// connect to the database
	$db = mysqli_connect('localhost', 'root', '', 'toletbd');
	if (isset($_POST['login_user'])) {
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$password = mysqli_real_escape_string($db, $_POST['password']);
		
		if (empty($username)) {
			array_push($errors, "Username is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}
		if (count($errors) == 0) {
			$password = md5($password);
			$query = "SELECT * FROM account WHERE username='$username' AND password='$password'";
			
			$results = mysqli_query($db, $query) or die(mysqli_error($db));
			if (mysqli_num_rows($results) == 1) {
				$_SESSION['username'] = $username;
				$_SESSION['success'] = "You are now logged in";
				header('location: homein.php');
				}else {
				array_push($errors, "Wrong username/password combination");
			}
		}
	}
	mysqli_close($db);
?>


<!DOCTYPE html>
<html>
	
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="css/main.css" /> 
		<title>To-Let</title>
	</head>
	<body>
		
		<!-- signin-page -->
		<section id="main" class="clearfix">		
			<div class="container">
				<div class="row">
					<div class = "col-md-6">
						<br>
						<br>
						<h1 style = "color:white; font-family:Times New Roman;" > ভালোবাসা এর অভাব থাকলেও </h1>
						<h1 style = "color:white; font-family:Times New Roman;" > ভালো বাসার অভাব নেই </h1>
					</div>				
					<!-- user-login -->			
					<div class="col-md-6" style="margin:0 auto;">
						<div class="user-account clearfix">
							<h2 style = "color:white; font-family:Arial">User Login</h2>
							
							<?php  if (count($errors) > 0) : ?>
							<div class="error">
								<?php foreach ($errors as $error) : ?>
								<p><?php echo $error ?></p>
								<?php endforeach ?>
							</div>
							<?php  endif ?>
							<!-- form -->
							<form method="POST" action="" accept-charset="UTF-8"><input name="_token" type="hidden" >
								<div class="form-group">
									<input type="text" class="form-control" placeholder="Username" name="username" >
								</div>
								<div class="form-group">
									<input type="password" class="form-control" placeholder="Password" name="password" >
								</div>
								<button type="submit" class="btn btn-primary" name="login_user" style="background-color:green;">Login</button>
							</form>
							<br>
							<br>
							<!-- forgot-password -->
							<div class="user-option" >
								<div class="pull-left" style="float:left; color:white;">
									<label for="logged"><input type="checkbox" name="logged" id="logged"> Keep me logged in </label>
								</div>
								<div class="pull-right" style="float:right;" >
									<a href="#">Forgot password</a>
								</div>
							</div><!-- forgot-password -->
						</div>					
					</div><!-- user-login -->
				</div><!-- row -->	
			</div><!-- container -->
		</section><!-- signin-page -->		
		<?php include('footer.php'); ?>
		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="js/jquery.min.js"></script>
		<script src="js/popper.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>