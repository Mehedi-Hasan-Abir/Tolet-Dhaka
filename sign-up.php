<?php
	session_start();
	
	// initializing variables
	$username = "";
	$firstname = "";
	$lastname = "";
	$email    = "";
	$address = "";
	$mobile ="";
	$password_1 = "";
	$password_2 = "";
	$errors = array(); 
	
	// connect to the database
	$db = mysqli_connect('localhost', 'root', '', 'toletbd');
	
	// REGISTER USER
	if (isset($_POST['register'])) {
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$firstname = mysqli_real_escape_string($db, $_POST['firstname']);
		$lastname = mysqli_real_escape_string($db, $_POST['lastname']);
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$address = mysqli_real_escape_string($db, $_POST['address']);
		$mobile = mysqli_real_escape_string($db, $_POST['mobile']);
		$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
		$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
		
		// form validation
		if (empty($username)) { 
			array_push($errors, "Username is required"); 
		}
		if (empty($email)) { array_push($errors, "Email is required"); }
		if (empty($password_1)) { array_push($errors, "Password is required"); }
		if ($password_1 != $password_2) {
			array_push($errors, '<label class="text-danger">Passwords don\'t match</label>');
		}
		//same username and/or email
		$user_check_query = "SELECT * FROM account WHERE username='$username' OR email='$email' LIMIT 1";
		$result = mysqli_query($db, $user_check_query);
		$user = mysqli_fetch_assoc($result);
		
		if ($user) { // if user exists
			if ($user['username'] === $username) {
				array_push($errors, '<label class="text-danger">username already exist</label>');
			}
			
			if ($user['email'] === $email) {
				array_push($errors, '<label class="text-danger">email already exist</label>');
			}
		}
		// register
		if (count($errors) == 0) {
			$password = md5($password_1);//encrypt
			
			$query = "INSERT INTO account(username,first_name,last_name,email,address,mobile,password) 
			VALUES('$username','$firstname','$lastname', '$email','$address','$mobile','$password')";
			mysqli_query($db, $query) or die(mysqli_error($db));
			mysqli_close($con);
			$_SESSION['username'] = $username;
			$_SESSION['success'] = "You are now logged in";
			header('location: index.php');
		}
	}
	
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
		<?php include('header.php'); ?>
		<!-- signup-page -->
		<section id="main" class="clearfix">		
			<div class="container">
				<div class="row text-center">
					<!-- user-signup -->			
					<div class="col-md-6" style="margin:0 auto; float:none;">
						<div class="user-account-register clearfix">
							<h2 style='color:white;font-weight:bold;'>Create A New Account</h2>
							
							<!--<div class="alert alert-block alert-success fade in">-->
							<?php  if (count($errors) > 0) : ?>
							<div class="error">
								<?php foreach ($errors as $error) : ?>
								<p><?php echo $error ?></p>
								<?php endforeach ?>
							</div>
							<?php  endif ?>
							
							<br>
							<!-- form -->
							<form method="POST" action="" accept-charset="UTF-8"><input name="_token" type="hidden" value="gkR26TLgd0cqIrrCmcb7DyiLzNNrtcBO4qbzulGp">
								<div class="form-group">
									<input type="text" class="form-control" placeholder="User name" name="username" value= "<?php echo $username; ?>" required autofocus>
								</div>
								<div class="form-group">
									<input type="text" class="form-control" placeholder="First name" name="firstname" value= "<?php echo $firstname; ?>" >
								</div>
								<div class="form-group">
									<input type="text" class="form-control" placeholder="Last name" name="lastname" value= "<?php echo $lastname; ?>">
								</div>							
								<div class="form-group">
									<input type="text" class="form-control" placeholder="Email" name="email" value= "<?php echo $email; ?>" required autofocus>
								</div>
								<div class="form-group">
									<input type="text" class="form-control" placeholder="Address" name="address" value= "<?php echo $address; ?>">
								</div>
								<div class="form-group">
									<input type="text" class="form-control" placeholder="Mobile No" name="mobile" value= "<?php echo $mobile; ?>"required autofocus>
								</div>
								<div class="form-group">
									<input type="password" class="form-control" placeholder="Password"  name = "password_1"required autofocus>
								</div>
								<div class="form-group">
									<input type="password" class="form-control" placeholder="Confirm Password" name = "password_2"required autofocus>
								</div>
								<button type="submit" class="btn btn-primary" name = "register" style="background-color:green;font-weight:bold;">Register</button>
								</form>
								
							</div>
						</div><!-- user-signup -->
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
	
<?php include('footer.php'); ?>