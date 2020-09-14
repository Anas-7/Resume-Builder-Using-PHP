<?php 
	include("config/db_connect.php");
	$email = $pwd_1 = $pwd_2 = '';
	$errors = array('email'=>'','pwd_1'=>'','pwd_2'=>'','all'=>'');

	if(isset($_POST['submit'])){
		//Check if all inputs have been entered
		if(empty($_POST['email']) || empty($_POST['pwd_1']) || empty($_POST['pwd_2'])){
			$errors['all'] = 'Please fill all the fields before submitting the form.';
		}
		else{
			//Check if email is valid.
			$email = $_POST['email'];
			if(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match('^[A-Za-z0-9._%+-]+@spit.ac.in$', $email)){
				$errors['email'] = 'Email id must be a valid email address.';
			}
			else{
				//Check if email already exists.
				$email = mysqli_escape_string($conn,$_POST['email']);
				$sql = "SELECT * FROM students WHERE semail='$email'";
				$result = mysqli_query($conn,$sql);
				$result = mysqli_fetch_assoc($result);
				if(!empty($result)){
					$errors['email'] = 'Email id already exists in database. Please choose a different email or login using the existing email.';
				}
				else{
					$pwd_1 = $_POST['pwd_1'];
					//Check if the password has spaces.
					if(preg_match("/\s/", $pwd_1)){
						$errors['all'] = 'Password cannot contain spaces. Please choose a different password.';
					}
					//if password is less than 8 characters.
					else if(strlen($pwd_1)<8){
						$errors['all'] = 'Password needs to have atleast 8 characters. Please choose a different password.';
					}
					else{
						$pwd_2 = $_POST['pwd_2'];
						//Check if the re-entered password matches.
						if(!($pwd_1 == $pwd_2)){
							$errors['pwd_2'] = 'Password didnt match. Please re-enter again.';
						}
						else{
							//Email is unique and passwords without spaces have matched. Insert into database.
							$email = mysqli_escape_string($conn,$email);
							$pwd_1 = mysqli_escape_string($conn,$pwd_1);

							$sql = "INSERT INTO students(semail,spwd) VALUES('$email','$pwd_1')";
							if(mysqli_query($conn,$sql)){
								if(session_status()==PHP_SESSION_NONE){
									session_start();
								}
								$sql = "SELECT * FROM students WHERE semail='$email'";
								$result = mysqli_fetch_assoc(mysqli_query($conn,$sql));
								$_SESSION['student_result'] = $result;
								header("Location: build_res.php");
							}
							else{
								echo "Error in processing query.";
							}
						}
					}
				}
			}
		}
	}

 ?>

<html>
	
	<?php include("templates/mat_css_header.php") ?>
	<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" class="amber lighten-1">
		<h5 class="center black-text">Sign Up</h5>
		<div class="red-text"><?php echo $errors['all'] ?></div>
		<label class="black-text">Email ID:</label>
		<input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">
		<div class="red-text"><?php echo $errors['email']; ?></div>
		<label class="black-text">Password: </label>
		<input type="password" name="pwd_1" value="<?php echo htmlspecialchars($pwd_1) ?>">
		<div class="red-text"><?php echo $errors['pwd_1']; ?></div>
		<label class="black-text">Re-enter Password: </label>
		<input type="password" name="pwd_2" value="<?php echo htmlspecialchars($pwd_2) ?>">
		<div class="red-text"><?php echo $errors['pwd_2']; ?></div>
		<div>
			<a href="student_login.php" name="signup" value="Go Back" class="btn brand z-depth-0 left-align">Go Back</a>
			<input type="submit" name="submit" value="Sign Up" class="btn brand z-depth-0 right-align" style="margin-left: 10px">
		</div>

	</form>

	<?php include("templates/footer.php") ?>
</html>