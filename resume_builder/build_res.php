<?php
	include('config/db_connect.php'); 
	if(session_status() == PHP_SESSION_NONE){
		session_start();
	}
	if(!isset($sname) || !isset($cgpa) || !isset($skills) || !isset($phonenum) || !isset($syear) || !isset($sbranch) || !isset($semail) || !isset($sinfo) || !isset($s10) || !isset($s12)){
		$sname = $cgpa = $skills = $phonenum = $syear = $sbranch = $semail = $sinfo = $s10 = $s12 = '';
	}
	$errors = array('sname'=>'','cgpa'=>'','skills'=>'','phonenum'=>'','syear'=>'','sbranch'=>'','sinfo'=>'','s10'=>'','s12'=>'');
	
		if($_SESSION['student_result']==''){
			echo "Error";
		}		
		$sname = $_SESSION['student_result']['sname'];
		$cgpa = $_SESSION['student_result']['cgpa'];
		$skills = $_SESSION['student_result']['skills'];
		$phonenum = $_SESSION['student_result']['phonenum'];
		$syear = $_SESSION['student_result']['syear'];
		$sbranch = $_SESSION['student_result']['sbranch'];
		$semail = $_SESSION['student_result']['semail'];
		$sinfo = $_SESSION['student_result']['sinfo'];
		$s10 = $_SESSION['student_result']['s10'];
		$s12 = $_SESSION['student_result']['s12'];

		//To prevent the form details being lost in case of error.
		// function errorReset($errorVar,$errors){
		// 	foreach ($errors as $error=>$value) {
		// 		if($value!=''){
		// 			continue;
		// 		}else{
		// 			$$error = $_POST[$error];
		// 		}
		// 	}
		// }
	if(isset($_POST['submit'])){
		$sname = mysqli_escape_string($conn,$_POST['sname']);
		$sname = ucwords($sname);
		if(!preg_match('/^[a-zA-Z\s]+$/', $sname)){
			$errors['sname'] = 'Please use letters and spaces for names.';
			//errorReset('sname',$errors);
			//header("Location: build_res/php?edit=1");
		}
		else{
			$cgpa = mysqli_escape_string($conn,$_POST['cgpa']);
			if(((int) $cgpa)<0 || ((int) $cgpa)>10){
				$errors['cgpa'] = 'Please enter a valid CGPA.';
				//header("Location: build_res/php?edit=1");
			}
			else{
				$skills = mysqli_escape_string($conn,$_POST['skills']);
				$skills = strtolower($skills);	
				if(!preg_match('/^([a-zA-Z0-9\s]+)(,\s*[a-zA-Z0-9\s]*)*$/',$skills)){
					$errors['skills'] = "Please enter skills in comma separated manner using letters and numbers.";	
				}
				else{
					$phonenum = mysqli_escape_string($conn,$_POST['phonenum']);
					if(strlen($phonenum)!=10){
						$errors['phonenum'] = 'Please enter a valid 10 digit phone number.';
					}
					else{
						$syear = mysqli_escape_string($conn,$_POST['syear']);
						$syear = (int) $syear;
						if($syear<1 || $syear>4){
							$errors['syear'] = 'Please enter a year between 1 and 4.';
						}
						else{
							$sbranch = mysqli_escape_string($conn,$_POST['sbranch']);
							if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/',$sbranch)){
								$errors['sbranch'] = 'The branch should consist of letters and spaces only.';
							}
							else{
								$sinfo = mysqli_escape_string($conn,$_POST['sinfo']);
								$s10 = mysqli_escape_string($conn,$_POST['s10']);
								if(($s10<30 || $s10>=100) && !preg_match("/d{2}/", $s10)){
									$errors['s10'] = 'Please enter a valid 10th Percentage.';
								}
								else{
									$s12 = mysqli_escape_string($conn,$_POST['s12']);
									if(($s12<30 || $s12>=100) && !preg_match("/d{2}/", $s12)){
										$errors['s12'] = 'Please enter a valid 12th Percentage.';
									}
									else{
											$sql = "UPDATE students SET sname='$sname',cgpa=$cgpa,skills='$skills',syear=$syear,sbranch='$sbranch',sinfo='$sinfo',s10=$s10,s12=$s12,phonenum='$phonenum' WHERE sid=".$_SESSION['student_result']['sid'];

											if(mysqli_query($conn,$sql)){
												foreach ($errors as $error => $value) {
													$_SESSION['student_result'][$error] = $_POST[$error];
												}
												header('Location: student_home.php');
											}else{
												echo "Update failed";
												header("Location: build_res.php");
											}
										}
									}
								}
							}
						}
					}	
				}
			}
		}		
 ?>

<html>
	<?php include('templates/mat_css_header.php'); ?>
	<form class="amber lighten-1" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
		<h4 class="red-text center">Edit/Build Resume</h4>
		<label>Name: </label>
		<input type="text" name="sname" value="<?php echo htmlspecialchars($sname) ?>">
		<div class="red-text"><?php echo $errors['sname']; ?></div>
		<label>Phone Number: </label>
		<input type="number" name="phonenum" value="<?php echo htmlspecialchars($phonenum) ?>">
		<div class="red-text"><?php echo $errors['phonenum']; ?></div>
		<label>About you: </label>
		<input type="text" name="sinfo" value="<?php echo htmlspecialchars($sinfo) ?>">
		<div class="red-text"><?php echo $errors['sinfo']; ?></div>
		<label>10th Std Percentage </label>
		<input type="number"  name="s10" value="<?php echo htmlspecialchars($s10) ?>">
		<div class="red-text"><?php echo $errors['s10']; ?></div>
		<label>12th Std Percentage</label>
		<input type="number" name="s12" value="<?php echo htmlspecialchars($s12) ?>">
		<div class="red-text"><?php echo $errors['s12']; ?></div>
		<label>Year: </label>
		<input type="number" name="syear" value="<?php echo htmlspecialchars($syear) ?>">
		<div class="red-text"><?php echo $errors['syear']; ?></div>
		<label>Branch: </label>
		<input type="text" name="sbranch" value="<?php echo htmlspecialchars($sbranch) ?>">
		<div class="red-text"><?php echo $errors['sbranch']; ?></div>
		<label>CGPA: </label>
		<input type="number" step="0.01" name="cgpa" value="<?php echo htmlspecialchars($cgpa) ?>">
		<div class="red-text"><?php echo $errors['cgpa']; ?></div>
		<label>Skills: </label>
		<input type="text" name="skills" value="<?php echo htmlspecialchars($skills) ?>">
		<div class="red-text"><?php echo $errors['skills']; ?></div>
		<div class='center'>
			<input type="submit" name="submit" value="Edit/Build" class="btn brand z-depth-0">
		</div>

	</form>
	<?php include('templates/footer.php'); ?>

</html>