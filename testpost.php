<?php
	include('header.php');
	session_start();
	
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "toletbd";
	
	// Create connection
	$db = mysqli_connect($servername, $username, $password, $dbname);
	
	// initializing variables
	$username = $_SESSION['username']; ;
	$title = "";
	$photos = "";
	$month="";
	$negotiable = "";
	$address = "";
	$s_details ="";
	$errors = array(); 
	
	if (isset($_POST['submit'])) {
		// receive all input values from the form
		$title = mysqli_real_escape_string($db, $_POST['title']);		
		$month = mysqli_real_escape_string($db, $_POST['month']);
		$rent = mysqli_real_escape_string($db, $_POST['rent']);
		$negotiable = mysqli_real_escape_string($db, $_POST['negotiable']);
		$address = mysqli_real_escape_string($db, $_POST['address']);
		$area_name = mysqli_real_escape_string($db, $_POST['area_name']);
		$s_details = mysqli_real_escape_string($db, $_POST['s_details']);
		
		$filename = $_FILES['files']['name'];
		$file_tmp = $_FILES['files']['tmp_name'];
		$filetype = $_FILES['files']['type'];
		$filesize = $_FILES['files']['size'];
		$temp = addslashes(file_get_contents($file_tmp[0]));
				
		$query = "INSERT INTO user_post(username,title,photo,month,rent,address,area_name,detail) 
		VALUES('$username','$title','$temp','$month',$rent,'$address','$area_name','$s_details')";	
		mysqli_query($db, $query) or die(mysqli_error($db));
		
		$query = "select * from user_post where username = '$username'";
		$result = mysqli_query($db, $query);
		$resultCheck = mysqli_num_rows($result);
		$post_id = '';
		while($row = mysqli_fetch_assoc($result)){
			//echo $result;
			$post_id = $row['post_id'];
		}
		
		$filename = $_FILES['files']['name'];
		$file_tmp = $_FILES['files']['tmp_name'];
		$filetype = $_FILES['files']['type'];
		$filesize = $_FILES['files']['size'];

		//echo count($file_tmp);
		for($i=0; $i<count($file_tmp); $i++){
			if(!empty($file_tmp[$i])){
				$name = addslashes($filename[$i]);
				$temp = addslashes(file_get_contents($file_tmp[$i]));
				$query = "INSERT INTO user_post_images(username,post_id,img_name,image) 
				VALUES('$username','$post_id','$name','$temp')";			
				mysqli_query($db, $query) or die(mysqli_error($db));
			}
		}
		/*		
			// File upload configuration
			$targetDir = "uploads/";
			$allowTypes = array('jpg','png','jpeg','gif');
			
			$statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = '';
			if(!empty(array_filter($_FILES['files']['name']))){
			foreach($_FILES['files']['name'] as $key=>$val){
			// File upload path
			$fileName = basename($_FILES['files']['name'][$key]);
			$targetFilePath = $targetDir . $fileName;
			
			// Check whether file type is valid
			$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
			if(in_array($fileType, $allowTypes)){
			// Upload file to server
			if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)){
			// Image db insert sql
			$insertValuesSQL .= "('".$fileName."', NOW()),";
			}else{
			$errorUpload .= $_FILES['files']['name'][$key].', ';
			}
			}else{
			$errorUploadType .= $_FILES['files']['name'][$key].', ';
			}
			}
			
			}else{
			$statusMsg = 'Please select a file to upload.';
			}
		*/
		// Display status message
		//echo $statusMsg;
		//echo '$query';
	}
?>
<!DOCTYPE html>
<html lang="en-US" >
	<head>
		<title>tolet</title> 
		
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">        
		<style>
			body {font-family: Arial;}
			.well{
			font-size:25px;
			border-radius:10px;
			}
			.control-label{ font-weight:bold; }
			.post{background-image:url("../images/main_background.jpg");}
		</style>
		<link rel="stylesheet" href="css/main.css" /> 
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css"> 
		
		
		
	</head>
	
	<body> 
		<br>
		<br>
		<img src="images/2.jpg" style = "float:left;padding-left:30px">
		<div  class="container "; >
			<div id=''>
				<div class="row">
					<section class="col-md-8" style="margin:0 auto; float:none;">
						<div class="well">
							<div class="text-center">							
								<span class="category-title">
									<b>Create Your Post</b>                  
								</span>						
							</div>        
						</div>
						<br>
						<div id="content" style="margin-left: 120px">
							
							<form class="form-horizontal" method="post" role="form" enctype="multipart/form-data" >
								<div class="form-group">
									
									<label for="title" class="col-sm-2 control-label">Title</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="title"  name="title" value="" title="Keep it Short" placeholder="Enter Title of Your Advertisement">
									</div>
								</div>
								<div class="form-group">
									<label for="images" class="col-sm-2 control-label">Photos</label>
									<div class="col-sm-10">
										<input type="file" name="files[]" id="filer_input" multiple="multiple">
									</div>
								</div>                
								<div class="form-group">
									<label for="month" class="col-sm-4 control-label">Month</label>
									<div class="col-sm-6">
										<select class="form-control" id="month"  name="month">
											<option value="">Select a Month</option>
											<option value="january">January</option>
											<option value="february">February</option>
											<option value="march">March</option>
											<option value="april">April</option>
											<option value="may">May</option>
											<option value="june">June</option>
											<option value="july">July</option>
											<option value="august">August</option>
											<option value="september">September</option>
											<option value="october">October</option>
											<option value="november">November</option>
											<option value="december">December</option>
										</select>
									</div>
									
								</div>                
								<div class="form-group">
									<label for="price" class="col-sm-2 control-label">Rent</label>
									<div class="col-sm-3">
										<input type="text" class="form-control" id="rent" name="rent" value="" title="Deal a Good Price" placeholder="Price(Tk)">
									</div>
									<div class="col-sm-5">
										<label class="checkbox-inline">
										<input type="checkbox" value="negotiable" name="negotiable">Negotiable</label>
									</div>
								</div>                 
								
								<div class="form-group">
									<label for="address" class="col-sm-2 control-label">Address</label>
									<div class="col-sm-10">
										<textarea class="form-control" id = "address" rows="2" style="resize:none"  name="address" value="" title="Right Address = Peaceful" placeholder="Enter Your Full Address"></textarea>
									</div>
								</div>
								
								<div class="form-group">
									<label for="place" class="col-sm-2 control-label">AreaName</label>
									<div class="col-sm-10">
										<select class="form-control" id="e1" name="area_name" style="width: 100%">
											<option></option>
										<option>Adabor</option><option>Aftabnagar</option><option>Agargaon</option><option>Ahmed Nagar</option><option>Ahmedbagh</option><option>Alambagh</option><option>Alamganj</option><option>Alinagar</option><option>Alu Bazar</option><option>Amin Bagh</option><option>Angur Jora</option><option>Arambagh</option><option>Asad Gate</option><option>Ashiyan City</option><option>Ashkona</option><option>Ashrafabad</option><option>Atipara</option><option>Azimpur</option><option>Babu Bazar</option><option>Badda DIT Project</option><option>Baddanagar</option><option>Bagbari</option><option>Bahadurpur</option><option>Baily Square</option><option>Bakshi</option><option>Banagram</option><option>Banani</option><option>Banani DOHS</option><option>Banasree</option><option>Bangla Bazar</option><option>Bangla Motor</option><option>Bangladesh Bank Colony </option><option>Bangsal</option><option>Banianagar</option><option>Bank Colony</option><option>Bara Katra</option><option>Bara Maghbazar</option><option>Barentek</option><option>Baridhara</option><option>Baridhara DOHS</option><option>Bashabo</option><option>Begum Bazar</option><option>Begumganj</option><option>Bibir Bazar</option><option>Bijoynagar</option><option>Boro Moghbazar</option><option>Box Nagar</option><option>Brahman Chiron</option><option>Byshteki</option><option>Chalk Bazar</option><option>Chamilibagh</option><option>Chankharpool</option><option>Chhaya Bithi Housing</option><option>Chhota Katra</option><option>Chowdhury Para Malibagh</option><option>Commissoner Bari</option><option>Companiganj</option><option>Court House Street</option><option>D.I.T.Area </option><option>Dakshin Khan</option><option>Dakshin Mugda Para</option><option>Dalpur</option><option>Darus Salam</option><option>Dawanpara</option><option>Dayaganj</option><option>Dhaka College Area</option><option>Dhaka Medical College</option><option>Dhalka Nagar </option><option>Dhanmondi</option><option>Dholairpar</option><option>Dilkusha</option><option>East Baragram</option><option>Eskaton</option><option>Faidabad</option><option>Fakira Pool</option><option>Farashganj</option><option>Faridabad</option><option>Free School Street</option><option>Gabtoli</option><option>Ganaktuli</option><option>Gendaria</option><option>Goalghat</option><option>Goalnagar</option><option>Golartek</option><option>Goran</option><option>Gulbagh</option><option>Gulistan</option><option>Gulshan -1 </option><option>Gulshan-2</option><option>Gupibagh</option><option>Haji Para</option><option>Hasan Nagar</option><option>Hatirpool Bazar</option><option>Hatkhola</option><option>Hazaribagh</option><option>Hazi Bari</option><option>Hazrat Nagar</option><option>Ibrahinpur</option><option>Islambagh</option><option>Islamnagar</option><option>Islampur</option><option>Jafrabad</option><option>Jaolahati</option><option>Jatrabari</option><option>Jeleypara</option><option>Jhigatola</option><option>Jurain</option><option>Kadamtala</option><option>Kafrul</option><option>Kakrail</option><option>Kalabagan</option><option>Kamalapur</option><option>Kaptan Bazar</option><option>Karatitola</option><option>Karimullah Bagh</option><option>Kather Pool</option><option>Kawranbazar</option><option>Kazipara</option><option>Khamer Bari  </option><option>Khilgaon</option><option>Khilkhat</option><option>Kumartuly</option><option>Kuril</option><option>Kusumbag</option><option>Lakshmi Bazar</option><option>Lalbagh</option><option>Lalmatia</option><option>Madartek</option><option>Madhu Bazar</option><option>Malibagh</option><option>Manikdey</option><option>Maticata</option><option>Mazibari</option><option>Meradia</option><option>Merul Badda</option><option>Middle Badda</option><option>Mir Hazirbagh</option><option>Mirpur Ceramic</option><option>Mirpur Colony</option><option>Mirpur Section-1</option><option>Mirpur Section-10 </option><option>Mirpur Section-11</option><option>Mirpur Section-12 </option><option>Mirpur Section-14</option><option>Mirpur Section-2</option><option>Mirpur Section-6 </option><option>Mirpur Section-7 </option><option>Mohakhali</option><option>Mohammadpur</option><option>Mokim Katra</option><option>Mominbagh</option><option>Moneshwar</option><option>Monipur</option><option>Monipuripara</option><option>Moshundi</option><option>Motijheil</option><option>Moulvi Bazar</option><option>Munshihati</option><option>Muradpur-1</option><option>Muradpur-2</option><option>Murgitola</option><option>Nabin Bag Bank Colony</option><option>Nadda Para</option><option>Namapara</option><option>Narinda</option><option>Nawab Katara</option><option>Nawabbari</option><option>Naya Bazar</option><option>Naya Paltan</option><option>Nazira Bazar</option><option>Newmarket</option><option>Neyatola</option><option>Niketan</option><option>Nikunjo</option><option>Nilkhet</option><option>Nilkhet Babupura</option><option>North Badda</option><option>Nowagaon</option><option>Nowapara</option><option>Nurerchala</option><option>Paikpara</option><option>Parbata</option><option>Parer Bagh</option><option>Paribagh</option><option>Patuatuly</option><option>Pilkhana</option><option>Pollabi</option><option>Postagola</option><option>Purana Paltan</option><option>Puratan Mogultoli</option><option>Purba</option><option>Purba Razabazar</option><option>Rajarbagh</option><option>Ramna</option><option>Rampura</option><option>Rasulpur</option><option>Rayer Bazar</option><option>Rishi Para Islamabed</option><option>Rokanpur</option><option>Royer Bazar Staff</option><option>Roysaheb Bazar</option><option>Rupnagar</option><option>Sabujbagh</option><option>Saidabad</option><option>Sawrapara</option><option>Science Laboratory</option><option>Segun Bagicha</option><option>Senpara</option><option>Shahidbagh</option><option>Shahidnagar</option><option>Shahjadpur</option><option>Shahjahanpur</option><option>Shakari Nagar</option><option>Shakertek</option><option>Shakhari Bazar </option><option>Shamibagh</option><option>Shantibagh</option><option>Shantinagar</option><option>Shikaritola</option><option>Siddeswary</option><option>Siddique Bazar</option><option>Sonatengar</option><option>South Badda</option><option>Sowarighat</option><option>Sultanganj</option><option>T &amp; T Colony</option><option>Takerhat</option><option>Takerhati</option><option>Tallabagh</option><option>Taltola</option><option>Tegturipara</option><option>Tejkunipara</option><option>Tennery</option><option>Thatary Bazar</option><option>Topkhana</option><option>Ulon</option><option>Ultinganj</option><option>Uttar Khan</option><option>Uttar Mousondi</option><option>Uttara ABM City</option><option>Uttara Model Town</option><option>Vasantek</option><option>Wari</option>                        </select>
									</div>
								</div>
								<div class="form-group">
									<label for="details" class="col-sm-2 control-label">ShortDetails</label>
									<div class="col-sm-10">
										<textarea class="form-control" id = "details" rows="4" style="resize:vertical"  name="s_details" value="" title="More Details = More Easygoing" placeholder="Write Attractive Description"></textarea>
									</div>
								</div>               							
								
								<div class="form-group">
									<label class="col-sm-2 control-label" style="margin: 0 auto;">
										<input type="reset" class="btn-danger reset-input-text" value="Reset">
									</label>
									<input type="hidden" name="token" />
									<div class="col-sm-10">
										<input type="submit" class="btn btn-block btn-success" name="submit" value="Submit Ad">
									</div>
								</div>
							</form>
						</div>
					</section>
				</div>
			</div>
		</div>
		<?php include('footer.php'); ?>
		
	</body>
</html>
